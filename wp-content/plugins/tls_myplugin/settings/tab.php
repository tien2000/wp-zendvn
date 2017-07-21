<?php
/*
 * json_encode($string): Hàm PHP, biến, đối tượng, mảng thành chuỗi
 */

    class Tls_Mp_Settings_Tabs{
        private $_menuSlug = 'tls-mp-st-tabs';

        public function __construct() {
            add_action( 'admin_menu', array($this, 'addSettingMenu') );
            add_action('wp_ajax_tls_load_content', array($this, 'tls_load_content'));

        }

        public function tls_load_content(){
            $tab = $_POST['tab'];
            if($tab == "#tab1"){
                echo "<h3>Đã load thành công tab1</h3>";
            }
            if($tab == "#tab2"){
                echo "<h3>Đã load thành công tab2</h3>";
            }
            if($tab == "#tab3"){
                echo "<h3>Đã load thành công tab3</h3>";
            }
            if($tab == "#tab4"){
                echo "<h3>Đã load thành công tab4</h3>";
            }
            die();
        }

        public function addJsFile(){
            wp_register_script($this->_menuSlug, TLS_PLUGIN_JS_URL . 'tabs.js', array('jquery'), '1.0');
            wp_enqueue_script($this->_menuSlug);
        }

        public function addCSSFile(){
            wp_register_style($this->_menuSlug, TLS_PLUGIN_CSS_URL . 'tabs-ajax.css', array(), '1.0');
            wp_enqueue_style($this->_menuSlug);
        }

        public function display(){
            require TLS_PLUGIN_VIEWS_DIR . 'my-tab.php';
        }

        public function addSettingMenu(){
            add_menu_page( 'My Tabs', 'My Tabs', 'manage_options', $this->_menuSlug, array($this, 'display') );
            if($_GET['page'] == 'tls-mp-st-tabs'){
                add_action('admin_enqueue_scripts', array($this, 'addCSSFile'));
                add_action('admin_enqueue_scripts', array($this, 'addJsFile'));
            }
        }
    }