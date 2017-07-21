<?php
    class TlsMpAdmin{
        private $_menuSlug = 'tls-mp-my-setting';
        private $_optionSetting;     

        public function __construct(){
            $this->_optionSetting = get_option( 'tls_mp_my_setting_1', array() );
            
            add_action( 'admin_menu', array($this, 'addMySetting') );
            add_action( 'admin_init', array($this, registerSetting) );
        }

        public function registerSetting(){
            $mainSettingId = 'tls-mp-my-main-setting';
            $extSettingId = 'tls-mp-my-ext-setting';
            
            register_setting( 'tls_mp_my_setting_group', 'tls_mp_my_setting_1', array($this, 'validateSetting') );

            //Main Setting
            add_settings_section( $mainSettingId, 'Main Setting', array($this, 'myMainSetting'), $this->_menuSlug );

            add_settings_field( 'tls-mp-my-site-title', 'Site title', array($this, 'mySiteTitle'), 
                                    $this->_menuSlug, $mainSettingId );

            //Extend Setting
            add_settings_section( $extSettingId, 'Extend Setting', array($this, 'myExtendSetting'), $this->_menuSlug );

            add_settings_field( 'tls-mp-my-slogan', 'Slogan', array($this, 'mySlogan'), 
                                    $this->_menuSlug, $extSettingId );
            
            /*add_settings_field( 'tls-mp-my-security-code', '', array($this, 'mySecurityCode'), 
                                    $this->_menuSlug, 'tls' );*/
        }

        public function mySecurityCode(){
            echo '<div style="line-height: 1.3;font-weight: 600; color: #23282d;"> Security Code: </div>
                  <p>This is my Security Code</p>                
                  <input type="text" name="tls_mp_my_setting_1[tls-mp-my-security-code]" value="" />
                  ';
        }

        public function mySlogan(){
            $val = get_option( 'tls-mp-my-slogan' );
            echo '<input type="text" name="tls-mp-my-slogan" 
                        value="'. $val .'" />';
        }

        public function mySiteTitle(){
            echo '<input type="text" name="tls_mp_my_setting_1[tls-mp-my-site-title]" 
                        value="'. $this->_optionSetting['tls-mp-my-site-title'] .'" />';
        }

        public function myExtendSetting(){

        }

        public function myMainSetting(){

        }

        public function validateSetting($input_data){
            /*echo '<pre>';
            print_r($input_data);
            echo '</pre>';

            echo '<pre>';
            print_r($_POST);
            echo '</pre>';*/
            update_option( 'tls-mp-my-slogan', $_POST['tls-mp-my-slogan'] );
            //die();
            return $input_data;
        }

        public function addMySetting(){
            add_menu_page( 'My Setting', 'My Setting', 'manage_options', $this->_menuSlug, array($this, 'mySettingPage') );
        }

        public function mySettingPage(){
            require TLS_MP_VIEWS_DIR . 'my-setting-page.php';
        }
    }
?>