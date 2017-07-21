<?php
/*
 * json_encode($string): Hàm PHP, biến, đối tượng, mảng thành chuỗi
 */

    class Tls_Mp_Settings_Ajax{
        private $_menuSlug = 'tls-mp-st-ajax';
        private $_optionName = 'tls_mp_st_ajax';
        private $_settingOptions;

        public function __construct() {
            $this->_settingOptions = get_option( $this->_optionName, array() );

            add_action( 'admin_menu', array($this, 'addMySettingMenu') );
            add_action( 'admin_init', array($this, 'resgiterMySettings') );
        }

        public function addMySettingMenu(){
            add_menu_page( 'My Settings', 'My Settings', 'manage_options', $this->_menuSlug, array($this, 'display') );
        }

        public function resgiterMySettings(){
            $mainSection = 'tls_mp_my_main_section';

            add_action('admin_enqueue_scripts', array($this, 'addJsFile'));

            add_action('wp_ajax_tls_check_form', array($this, 'tls_check_form'));

            register_setting( $this->_menuSlug, $this->_optionName, array($this, 'validateSettings') );

            add_settings_section( $mainSection, 'Main Section', array($this, 'addMainSection'), $this->_menuSlug );

            add_settings_field( $this->create_id('title'), 'Site Title', array($this, 'createForm'),
                $this->_menuSlug, $mainSection, array('name' => 'title') );
        }

        public function tls_check_form(){
            $postVal = $_POST;
            $errors = array();
            $msg = array();

            /* echo __METHOD__;
            echo '<pre>';
            print_r($_POST);
            echo '</pre>'; */

            if(!empty($postVal['value'])){
                if($this->stringMaxValidate($postVal['value'], 20) == false){
                    $errors[$this->create_id('title')] = "Chuỗi dài quá 20 ký tự";
                }
            }

            if(count($errors) > 0){
                $msg['status'] = false;
                $msg['errors'] = $errors;
            }else{
                $msg['status'] = true;
            }

            echo json_encode($msg);
            die();
        }

        public function validateSettings($data_input){
            $error = array();

            if($this->stringMaxValidate($data_input['title'], 20) == false){
                $error['title'] = 'Site Title: Chuỗi vượt quá số ký tự quy định';
            }

            if(count($error) > 0){
                $data_input = $this->_settingOptions;
                $strErrors = '';
                foreach ($error as $key => $val) {
                    $strErrors .= $val . '<br />';
                }
                add_settings_error( $this->_menuSlug, 'my-settings', $strErrors, 'error' );
            }else{
                add_settings_error( $this->_menuSlug, 'my-settings', 'Cập nhật dữ liệu thành công', 'updated' );
            }

            //die();
            return $data_input;
        }

        public function createForm($args){
            $htmlObj = new TlsHtml();

            if($args['name'] == 'title'){
                // Tạo phần tử chứa Title
                $inputId = $this->create_id('title');
                $inputName = $this->create_name('title');
                $inputValue = $this->_settingOptions['title'];
                $attr = array(
                    'size' => '25',
                    'id' => $inputId
                );
                $attrPTag = array(
                    'class' => 'description'
                );

                $html = $htmlObj->textbox($inputName, $inputValue, $attr)
                . $htmlObj->pTag('Chuỗi nhập vào không quá 20 ký tự', $attrPTag);
                echo $html;
            }
        }

        public function addJsFile(){
            wp_register_script($this->_menuSlug, TLS_PLUGIN_JS_URL . 'ajax.js', array('jquery'), 1.0);
            wp_enqueue_script($this->_menuSlug);
        }

        public function stringMaxValidate($val, $max){
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

        private function create_id($val){
            return $this->_optionName . '_' . $val;
        }

        private function create_name($val){
            return $this->_optionName . '[' . $val . ']';
        }


        public function addMainSection(){

        }

        public function addExtendSection(){

        }

        public function display(){
            require TLS_PLUGIN_VIEWS_DIR . 'my-ajax-setting-page.php';
        }
    }