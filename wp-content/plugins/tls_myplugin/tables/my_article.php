<?php
    class Tls_Mp_Table_MyArticle{
        
        private $_menuSlug = 'tls-mp-table-myarticle';
        
        public function __construct(){
            //echo '<br>' . __METHOD__;
            
            add_action('admin_menu', array($this, 'article_menu'));
            
            $page = $_REQUEST['page'];
            if($page == 'tls-mp-table-myarticle'){
                add_action('admin_enqueue_scripts',array($this, 'cssFile'));
            }            
        }
        
        public function article_menu(){
            //echo '<br>' . __METHOD__;
            $action = @$_REQUEST['action'];
            $func = 'display';
            
            if($action == 'edit'){
                $func = 'display_edit';
            }
            
            add_menu_page('Articles', 'Articles', 'manage_options', 
                            $this->_menuSlug, array($this, $func), '', 3);
            
            add_submenu_page($this->_menuSlug, 'Add New', 'Add New', 'manage_options', 
                                $this->_menuSlug . '-add', array($this, 'display_add'));
        }
        
        public function display(){
            //echo '<br>' . __FILE__;
            require_once TLS_PLUGIN_TABLE_DIR . 'tbl_article.php';
            
            require_once TLS_PLUGIN_TABLE_DIR . 'html/article_list.php';
        }
        
        public function display_edit(){
            echo '<br>' . __METHOD__;
        }
        
        public function display_add(){
            echo '<br>' . __METHOD__;
        }
        
        public function cssFile($param) {
            wp_register_style('tls_mp_table_article', TLS_PLUGIN_CSS_URL . 'tbl_article.css', 
                                array(), '1.0');
            
            wp_enqueue_style('tls_mp_table_article');
        }
    }