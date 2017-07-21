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
            $error = array();            

            if($this->stringValidateSettings($data_input['tls_mp_my_site_title'], 50) == false){
                $error['tls_mp_my_site_title'] = 'Site Title: Chuỗi vượt quá số ký tự quy định';
            }

            if(!empty($_FILES['tls_mp_my_logo']['name'])){
                if($this->fileUploadExtensionSettings($_FILES['tls_mp_my_logo']['name'], "PNG|JPG|GIF") == false){
                    $error['tls_mp_my_logo'] = 'Logo: File upload không đúng định dạng PNG|JPG|GIF';
                }else{
                    if(!empty ($this->_optionSettings['tls_mp_my_logo_path'])){
                        @unlink($this->_optionSettings['tls_mp_my_logo_path']);
                    }
                    $overrides = array('test_form' => false);
                    $fileUpload = wp_handle_upload( $_FILES['tls_mp_my_logo'], $overrides );
                    $data_input['tls_mp_my_logo'] = $fileUpload['url'];
                    $data_input['tls_mp_my_logo_path'] = $fileUpload['file'];
                }
            }else{
                $data_input['tls_mp_my_logo'] = $this->_optionSettings['tls_mp_my_logo'];
                $data_input['tls_mp_my_logo_path'] = $this->_optionSettings['tls_mp_my_logo_path'];
            }
            
            if(count($error) >0){
                $data_input = $this->_optionSettings;
                $strErrors = '';
                foreach ($error as $key => $val) {
                    $strErrors .= $val . '<br />';
                }
                add_settings_error( $this->_menuSlug, 'my-settings', $strErrors, 'error' );
            }

            /*echo '<pre>';
            print_r($error);
            echo '</pre>';*/
            //die();
            return $data_input;
        }

        public function stringValidateSettings($val, $max){
            $flag = false;
            $str = trim($val);
            if(strlen($str) <= $max){
                $flag = true;
            }
            return $flag;
        }

        public function fileUploadExtensionSettings($fileName, $fileType){
            $flag = false;
            $pattern = '/^.*\.('. strtolower($fileType) .')$/i';
            if(preg_match($pattern, strtolower($fileName)) == 1){
                $flag = true;
            }
            return $flag;
        }

        public function allFields($args){
            if($args['name'] == 'mySiteTitle'){
                echo '
                        <input type="text" name="tls_mp_my_settings_name[tls_mp_my_site_title]" 
                                value="'. $this->_optionSettings['tls_mp_my_site_title'] .'" />
                        <p class="description">Chuỗi nhập vào không quá 20 ký tự</p>
                    ';
            }
            if($args['name'] == 'myLogo'){
                echo '
                    <input type="file" name="tls_mp_my_logo" />
                    <p class="description">Định dạng ảnh PNG|JPG|GIF</p>
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