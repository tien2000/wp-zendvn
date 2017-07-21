<?php 
    class TlsMpAdmin{
        private $_menuSlug = 'tls-mp-my-setting';

        public function __construct(){
            add_action( 'admin_menu', array($this, 'addMySettingPage') );
        }

        public function registerSettingAndFields(){
            register_setting( 'tls_mp_options_group', 'tls_mp_options_setting', array($this, 'validateSetting') );
        }

        public function validateSetting(){

        }

        public function addMySettingPage(){
            add_menu_page( 'My Settings', 'My Settings', 'manage_options', $this->_menuSlug, array($this, 'mySettingPage') );
        }

        public function mySettingPage(){
            require TLS_MP_VIEWS_DIR . 'my-setting-page.php';
        }
    }
?>