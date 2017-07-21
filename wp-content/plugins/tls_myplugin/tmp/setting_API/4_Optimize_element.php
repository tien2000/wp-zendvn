<?php
    class TlsMpAdmin{
        private $_menuSlug = 'tls-mp-my-settings';
        private $_optionSettings;

        public function __construct(){
            $this->_optionSettings = get_option( 'tls_mp_my_settings_name', array() );

            add_action( 'admin_menu', array($this, 'addMySettingMenu') );
            add_action( 'admin_init', array($this, 'resgiterMySettings') );
        }

        public function resgiterMySettings(){
            $mainSection = 'tls_mp_my_main_section';
            $extSection = 'tls_mp_my_extend_section';
            register_setting( 'tls_mp_my_settings_group', 'tls_mp_my_settings_name', array($this, 'validateSettings') );

            add_settings_section( $mainSection, 'Main Section', array($this, 'addMainSection'), $this->_menuSlug );

            add_settings_field( 'tls_mp_my_site_title', 'Site Title', array($this, 'allFields'), 
                                    $this->_menuSlug, $mainSection, array('name' => 'mySiteTitle') );

            add_settings_section( $extSection, 'Extend Section', array($this, 'addExtendSection'), $this->_menuSlug );

            add_settings_field( 'tls_mp_my_logo', 'Logo', array($this, 'allFields'), 
                                    $this->_menuSlug, $extSection, array('name' => 'myLogo') );

            //add_settings_field( 'tls_mp_my_site_name', 'Site Name', array($this, 'mySiteName'), $this->_menuSlug, $extSection );
        }

        public function validateSettings($data_input){
            // update_option( 'tls_mp_my_site_name', $_POST['tls_mp_my_site_name'] );

            if(!empty($_FILES['tls_mp_my_logo']['name'])){
                if(!empty ($this->_optionSettings['tls_mp_my_logo_path'])){
                    @unlink($this->_optionSettings['tls_mp_my_logo_path']);
                }
                $overrides = array('test_form' => false);
                $fileUpload = wp_handle_upload( $_FILES['tls_mp_my_logo'], $overrides );
                $data_input['tls_mp_my_logo'] = $fileUpload['url'];
                $data_input['tls_mp_my_logo_path'] = $fileUpload['file'];
            }
            

            /*echo '<pre>';
            print_r($data_input);
            echo '</pre>';*/
            //die();
            return $data_input;
        }

        public function allFields($args){
            if($args['name'] == 'mySiteTitle'){
                echo '<input type="text" name="tls_mp_my_settings_name[tls_mp_my_site_title]" 
                        value="'. $this->_optionSettings['tls_mp_my_site_title'] .'" />';
            }
            if($args['name'] == 'myLogo'){
                echo '
                    <input type="file" name="tls_mp_my_logo" /> <br /><br />
                    <img src="'. $this->_optionSettings['tls_mp_my_logo'] .'" width="100" />
                ';
            }
        }

        public function mySiteName(){
            $val = get_option( 'tls_mp_my_site_name' );
            echo '<input type="text" name="tls_mp_my_site_name" value="'. $val .'" />';
        }

        public function addMainSection(){

        }

        public function addExtendSection(){

        }


        public function addMySettingMenu(){
            add_options_page( 'My Settings', 'My Settings', 'manage_options', $this->_menuSlug, array($this, 'addMySettingPage') );
        }

        public function addMySettingPage(){
            require TLS_MP_VIEWS_DIR . 'my-setting-page.php';
        }
    }
?>