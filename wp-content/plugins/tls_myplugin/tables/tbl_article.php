<?php
if(!class_exists('WP_List_Table')){
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class Article_Table extends WP_List_Table{
    private $_per_page = 5;
    private $_sql;
    
    public function __construct() {
       // echo '<br>' . __METHOD__;
       $args = array(
                    'plural'    => 'article',       // class CSS article
                    'singular'  => 'article',       // tbody data-wp-lists="list:article"
                    'ajax'      => false,
                    'screen'    => null,
                );
       parent::__construct($args);
    }
    
    public function prepare_items() {
        $hidden     = $this->get_hidden_columns();
        $sortTable  = $this->get_sortable_columns();
        $column     = $this->get_columns();        
        
        $this->_column_headers = array($column, $hidden, $sortTable);
        $this->items = $this->table_data();
        
        $total_items = $this->total_items();
        $per_page = $this->_per_page;
        $total_pages = ceil($total_items/$per_page);
        
        $this->set_pagination_args(array(
            'total_items' => $total_items,
            'per_page' => $per_page,
            'total_pages' => $total_pages,        
        ));
    }
    
    //=============== HÀM LẤY DỮ LIỆU TRONG BẢNG ARTICLE =====================//
    private function table_data(){
        $data = array();
        global $wpdb;
    
        //&orderby=title&order=asc
        $orderby    = (@$_REQUEST['orderby'] == '')?'id':$_REQUEST['orderby'];
        $order      = (@$_REQUEST['order'] == '')?'desc':$_REQUEST['order'];
        $tblArticle = $wpdb->prefix . 'mp_article';
        $tblUser    = $wpdb->prefix . 'users';
        $sql        = 'SELECT a.*, u.user_nicename
                        FROM '. $tblArticle .' AS a
                        INNER JOIN '. $tblUser .' AS u
                        ON a.author_id = u.ID
                        ';
        
        //========== Lọc theo status hoặc search hoặc cả 2 =============// 
        $whereArr = array();
        
        $filter_status = @$_GET['filter_status'];
        if(isset($_GET['filter_status']) && $filter_status != '0'){
            $status = ($filter_status == 'active')?1:0;
            $whereArr[] = " (a.status = $status) ";
        }
        
        if(isset($_GET['s']) && strlen($_GET['s']) > 2){     
            $s = $_GET['s'];
            $whereArr[] = " (a.title LIKE '%$s%' OR a.content LIKE '%$s%') ";
        }
        
        if(count($whereArr) > 0){
            $sql .= " WHERE " . join(" AND ", $whereArr);
        }
        
        $this->_sql = $sql;
        
        $paged  = max(1, @$_REQUEST['paged']);
        $offset = ($paged - 1) * $this->_per_page;
        
        $sql   .= 'ORDER BY a.'.$orderby.' '. $order .' LIMIT ' . $this->_per_page 
                   . ' OFFSET ' . $offset;
        
        echo '<br>' . $sql;
    
        $data       = $wpdb->get_results($sql, ARRAY_A);
        
        /* echo '<pre>';
         print_r($data);
         echo '</pre>'; */
    
        return $data;
    }
    
    private function total_items(){
        global $wpdb;
        return $wpdb->query($this->_sql);
    }
    
    public function column_default( $item, $column_name ) {
    
        return $item[$column_name];
    }
    
    public function column_user_nicename( $item ) {
        return get_the_author_meta('display_name', $item['author_id']);
    }
    
    public function column_status( $item ){
        $page = @$_REQUEST['page'];
        
        if($item['status'] == 1){
            $action = 'inactive';
            $src = TLS_PLUGIN_IMAGES_URL . 'active.png';
        }else{
            $action = 'active';
            $src = TLS_PLUGIN_IMAGES_URL . 'inactive.png';
        }       
        
        $paged = max(1, @$_REQUEST['paged']);       //Phân trang
        
        $html = '<img src=' . $src . ' />';
        $html = '<a href="?page=' . $page . '&paged=' . $paged . '&action=' . $action 
                . '&article=' . $item['id'] . '">'.$html.'</a>';
        
        return $html;
    }
    
    public function get_sortable_columns(){
        $sortTable = array(
            'title'     => array('title', false),    // Tạo mũi tên sắp xếp cho Title, Id
            'id'        => array('id', true),        // false: mũi tên lên, true: mũi tên xuống
        );
        return $sortTable;
    }
    
    public function get_hidden_columns(){
        $hidden = array('content', 'author_id');
        return $hidden;
    }
    
    public function get_columns() {
        $columns = array(
            'cb'        => '<input type="checkbox" />',
            'title'     => 'Title',
            'picture'   => 'Picture',
            'content'   => 'Content',
            'author_id' => 'Author ID',
            'user_nicename' => 'Author',            
            'author_id' => 'Author',
            'status'    => 'Status',
            'id'        => 'ID',
        );
        return $columns;
    }
    
    public function get_bulk_actions(){
        $action = array(
            'delete'    => 'Delete',
            'active'    => 'Active',
            'inactive'  => 'Inactive'
        );
        
        return $action;
    }
    
    protected function extra_tablenav($which){
        /* echo '<pre>';
        print_r($which);
        echo '</pre>'; */
        
        if($which == 'top'){
            $htmlObj = new TlsHtml();
            $filterVal = @$_REQUEST['filter_status'];
            $options['data'] = array(
                '0' => 'Status filter',
                'active' => 'Active',
                'inactive' => 'Inactive',
            );
            
            $attr = array(
                'id'    => 'filter_action',
                'class' => 'button'
            );
            
            $btnFilter = $htmlObj->button('filter_action', 'Filter', $attr);
            $slbFilter = $htmlObj->selectbox('filter_status', $filterVal, array(), $options);
            
            $html = '<div class="alignleft actions bulkactions">'
                    . $slbFilter
                    . $btnFilter
                    . '</div>';
            
            echo $html;
        }
    }
    
    //====================== HÀM THAY ĐỔI DỮ LIỆU HIỂN THỊ TRONG BẢNG =================// 
    public function column_title($item){
        $page = $_REQUEST['page'];
        
        $actions = array(
            'edit'          => '<a href="?page='. $page .'&action=edit&article='. $item['id'] .'">Edit</a>',
            'delete'        => '<a href="?page='. $page .'&action=delete&article='. $item['id'] .'">Delete</a>',
            'view'          => '<a href="#">View</a>',
        );
        $title = '<strong><a href="?page='. $page .'&action=edit&article='. $item['id'] .'">' 
                    . $item['title'] . '</a></strong>' . $this->row_actions($actions);
        return $title;
    }
    
    public function column_cb($item){
        $singular = $this->_args['singular'];
        $cb = '<input type="checkbox" name="'.$singular.'[]" value="'.$item['id'].'"/>';
        return $cb;
    }
    
}