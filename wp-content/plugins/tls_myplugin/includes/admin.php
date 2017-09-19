<?php
    class TlsMpAdmin{
        public function __construct(){
            //$this->ajaxPage();
            //$this->ajaxPage2();
            //$this->tabsPage();
            
            $this->myArticle();
            
        }
        
        public function myArticle(){
            require_once TLS_PLUGIN_TABLE_DIR . 'my_article.php';
            new Tls_Mp_Table_MyArticle();
        }

        public function ajaxPage(){
            require_once TLS_PLUGIN_SETTINGS_DIR . 'ajax.php';
            new Tls_Mp_Settings_Ajax();
        }

        public function ajaxPage2(){
            require_once TLS_PLUGIN_SETTINGS_DIR . 'ajax-2.php';
            new Tls_Mp_Settings_Ajax_2();
        }

        public function tabsPage(){
            require_once TLS_PLUGIN_SETTINGS_DIR . 'tab.php';
            new Tls_Mp_Settings_Tabs();
        }
    }
?>