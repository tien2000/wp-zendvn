<?php 
    /* 
     * wp_verify_nonce( $nonce, $action )
     *  - $nonce: Giá trị security_code trong ô input ẩn trong form.
     *  - $action: value của ô input ẩn trong form
     *  */
?>

<?php 
    require_once TLS_PLUGIN_TABLE_DIR . 'caps.php';
?>

<?php
    class Tls_Mp_Table_MyArticle{
        
        private $_menuSlug = 'tls-mp-table-myarticle';        
        private $_caps;
        
        public function __construct(){
            //echo '<br>' . __METHOD__;
            
            $this->_caps = new Tls_Mp_Article_Caps();
            
            add_action('admin_menu', array($this, 'article_menu'));
            
            $page = $_REQUEST['page'];
            if($page == 'tls-mp-table-myarticle'){
                add_action('admin_enqueue_scripts',array($this, 'cssFile'));
            }
            
            // Khắc phục lỗi header trong file /wp-includes/pluggable.php
            add_action('init', array($this, 'do_output_buffer'));
            
            add_action('admin_init', array($this->_caps, 'add_caps_for_role'));
        }
        
        public function article_menu(){
            //echo '<br>' . __METHOD__;
            $action = @$_REQUEST['action'];
            $func = $this->get_func();
            
            add_menu_page('Articles', 'Articles', 'tls_mp_article', 
                            $this->_menuSlug, array($this, $func), '', 3);
            
            //===== Phân quyền thêm mới ======//
            $addFunc = 'display_add';
            if(!$this->_caps->check_cap('tls_mp_article_add')){
                $addFunc = 'no_access';
            }
            
            add_submenu_page($this->_menuSlug, 'Add New', 'Add New', 'tls_mp_article_list', 
                                $this->_menuSlug . '-add', array($this, $addFunc));
        }

        private function get_func(){
            $cap = $this->_caps;
            
            
            $action = @$_REQUEST['action'];
            
            $func = 'display';
            
            /* ======================================
             * Xử lý phân quyền trong trường hợp Edit
             * ====================================== */
            if($action == 'edit'){
                $func = 'display_edit';
                if(!$cap->check_cap('tls_mp_article_edit')){
                    $func = 'no_access';
                }
                if($cap->check_cap('tls_mp_article_own_edit')){
                    if ($this->check_author() == 1){
                        $func = 'display_edit';
                    }else {
                        $func = 'no_access';
                    }
                }
            }
            
            /* ======================================
             * Xử lý phân quyền trong trường hợp Delete
             * ====================================== */
            if($action == 'delete'){
                $func = 'delete_data';
                if(!$cap->check_cap('tls_mp_article_delete')){
                    $func = 'no_access';
                }
                if($cap->check_cap('tls_mp_article_own_delete')){
                    if ($this->check_author() == 1){
                        $func = 'delete_data';
                    }else {
                        $func = 'no_access';
                    }
                }
            }
            
            /* ======================================
             * Xử lý phân quyền trong trường hợp Status
             * ====================================== */
            if($action == 'inactive' || $action == 'active'){
                $func = 'status';
                if(!$cap->check_cap('tls_mp_article_status')){
                    $func = 'no_access';
                }
                if($cap->check_cap('tls_mp_article_own_status')){
                    if ($this->check_author() == 1){
                        $func = 'status';
                    }else {
                        $func = 'no_access';
                    }
                }
            }
            
            return $func;
        }
        
        private function check_author(){
            //echo '<br>' . __METHOD__;
            
            global $wpdb;
            $author = false;
            $tblArticle = $wpdb->prefix . 'mp_article';
            $articleID  = @$_REQUEST['article'];
            $sql = 'SELECT Count(a.id) '
                    . ' FROM ' . $tblArticle . ' AS a' 
                    .' WHERE a.author_id = %d' 
                    .' AND a.id = %d ';
            
            // =========== Xác định bài viết thuộc tác giả nào (trả về 1: đúng tác giả)  ================== //
            $item = $wpdb->get_var($wpdb->prepare($sql, get_current_user_id(), $articleID));
            
            if ($item == 1){
                $author = true;
            }
            return $author;
        }
        
        public function no_access(){
            echo '<h3>Bạn không có quyền truy cập vào vùng này</h3>';
        }
        
        public function display(){
            //echo '<br>' . __FILE__;
            
            if(isset($_POST['_wpnonce'])){
                $url = $this->createUrl();
                wp_redirect($url);
            }
            
            require_once TLS_PLUGIN_TABLE_DIR . 'tbl_article.php';
            
            require_once TLS_PLUGIN_TABLE_DIR . 'html/article_list.php';
        }
        
        private function createUrl(){
            $paged = max(1, @$_REQUEST['paged']);
            
            /* echo '<pre>';
            print_r($_POST);
            echo '</pre>'; */
            
            $url = 'admin.php?page=' . @$_REQUEST['page'];
            
            if(isset($_POST['filter_status']) && $_POST['filter_status'] != '0'){                
                $url .= '&filter_status=' . $_POST['filter_status'];
            }
            
            if(isset($_POST['s']) && strlen($_POST['s']) > 2){
                $url .= '&s=' . $_POST['s'];
            }
            
            $url .= '&paged=' . $paged;
            
            return $url;
        }
        
        public function display_edit(){
            //cho '<br>' . __METHOD__;
            
            // ========= Kiểm tra dữ liệu có được gửi qua hay ko. ==========
            // Lấy dữ liệu từ database đưa vào form
            if(!isset($_POST['title'])){
                global $wpdb;
                $article_id = (int)$_GET['article'];
                $table = $wpdb->prefix . 'mp_article';
                $sql = 'SELECT * FROM '. $table .' WHERE id='. $article_id .' ';
                $row = $wpdb->get_row($sql);
                
                /* echo '<pre>';
                print_r($row);
                echo '</pre>'; */
            }
            // Cập nhật dữ liệu mới
            else{
                $security_code = @$_REQUEST['security_code'];
                if(wp_verify_nonce($security_code, 'edit')){
                    // Kiểm tra dữ liệu nhập vào
                    $errors = $this->validate_form();
                    /* echo '<pre>';
                     print_r($errors);
                     echo '</pre>'; */
                    
                    if(count($errors) == 0){
                        $this->save_data('edit');
                        $url = $_REQUEST['_wp_http_referer'] . '&mes=1';
                        wp_redirect($url);
                    }
                }
            }            
            require_once TLS_PLUGIN_TABLE_DIR . 'html/article_form.php';
        }
        
        public function display_add(){
            //echo '<br>' . __METHOD__;
            
            $security_code = @$_REQUEST['security_code'];            
            
            if(wp_verify_nonce($security_code, 'add')){
                if(isset($_POST['title'])){
                    // Kiểm tra dữ liệu nhập vào
                    $errors = $this->validate_form();                    
                    /* echo '<pre>';
                    print_r($errors);
                    echo '</pre>'; */
                    
                    if(count($errors) > 0){
                        require_once TLS_PLUGIN_TABLE_DIR . 'html/article_form.php';
                    }else {
                        $this->save_data('add');
                        $url = 'admin.php?page=' . $_REQUEST['page'] . '&mes=1';
                        wp_redirect($url);
                    }
                }
            }
            require_once TLS_PLUGIN_TABLE_DIR . 'html/article_form.php';            
        }
        
        public function status(){
            global $wpdb;            
            $article_id     = @$_REQUEST['article'];            
            $status         = (@$_REQUEST['action'] == 'inactive')?0:1;
            $paged          = max(1, @$_REQUEST['paged']);
            $table          = $wpdb->prefix . 'mp_article';
            
            if(!is_array($_REQUEST['article'])){
                
                $data           = array( 'status' => $status );
                $where          = array( 'id' => $article_id );
                $format         = array('%d');
                $where_format   = array('%d');
                $wpdb->update($table, $data, $where, $format, $where_format);                
            }else{
                $ids = join(',', $_REQUEST['article']);
                $sql = 'UPDATE '. $table .' SET status='. $status .' WHERE id IN ('. $ids .') ';
                $wpdb->query($sql);
            }
            
            $url = 'admin.php?page=' . @$_REQUEST['page'] . '&paged=' . $paged . '&mes=1';
            wp_redirect($url);
            
            /* echo '<pre>';
            print_r($_POST);
            echo '</pre>'; */
        }
        
        public function delete_data(){
            //echo '<br>' . __METHOD__;
            
            global $wpdb;
            $table = $wpdb->prefix . 'mp_article';
            $article_id = @$_REQUEST['article'];
            //echo '<br>' . $article_id;   
            
            if(!is_array($_REQUEST['article'])){
                $where = array('id' => $article_id);
                $where_format = array('%d');
                
                $wpdb->delete($table, $where, $where_format);
            }else{
                $security_code = @$_REQUEST['security_code'];    // Kiểm tra dữ liệu POST qua
                if(wp_verify_nonce($security_code, 'delete')){
                    $ids = join(',', $_REQUEST['article']);
                    $sql = 'DELETE FROM '. $table .' WHERE id IN ('. $ids .') ';
                    //echo '<br>' . $sql;
                    $wpdb->query($sql);
                }                
            }
            
            $url = 'admin.php?page=' . @$_REQUEST['page'] . '&mes=1';
            wp_redirect($url);
            
            /* echo '<pre>';
            print_r($_POST);
            echo '</pre>'; */
        }
        
        private function save_data($action = 'add'){
            global $wpdb;
            $table = $wpdb->prefix . 'mp_article';
            $data = array(
                'title' => $_POST['title'],
                'picture' => $_POST['picture'],
                'content' => $_POST['content'],
                'status' => $_POST['status'],
                'author_id' => get_current_user_id()
            );
            $format = array('%s', '%s', '%s', '%d', '%d');
            
            if($action == 'add'){                                               
                $wpdb->insert($table, $data, $format);
            }else if($action == 'edit'){
                $where = array('id' => @$_GET['article']);
                $where_format = array('%d');
                $wpdb->update($table, $data, $where, $format, $where_format);                
            }            
        }
        
        private function validate_form(){
            //echo '<br>' . __METHOD__;
            
            // Show dữ liệu sau khi bấm submit
            /* echo '<pre>';
            print_r($_POST);
            echo '</pre>'; */
            
            $errors = array();
            if(empty($_POST['title'])){
                $errors['title'] = __('Title not empty');
            }
            if(empty($_POST['picture'])){
                $errors['picture'] = __('Picture not empty');
            }
            return $errors;
        }
        
        public function cssFile() {
            wp_register_style('tls_mp_table_article', TLS_PLUGIN_CSS_URL . 'tbl_article.css', 
                                array(), '1.0');
            
            wp_enqueue_style('tls_mp_table_article');
        }
        
        public function do_output_buffer(){
            ob_start();
        }
        
        /* private function get_func(){        
            $action = @$_REQUEST['action'];
            switch ($action){
                case 'edit'     :return 'display_edit';
                case 'delete'   :return 'delete_data';
                case 'inactive' :return 'status';
                case 'active'   :return 'status';
        
                default         :return 'display';
            }
        } */
    }