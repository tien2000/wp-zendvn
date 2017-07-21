<?php
/*
 * esc_url: Lọc ra những giá trị là đường dẫn Url
 */
    class Tls_Mp_Metabox_Media{
        private $_meta_box_id = 'tls_mp_mb_media';
        private $_prefix_id = 'tls_mp_mb_media_';
        private $_prefix_key = 'tls_mp_mb_media_';

        public function __construct(){
            add_action('add_meta_boxes', array($this, 'create'));
            add_action('save_post', array($this, 'save'));

            //echo 'In ra đường dẫn đến: ' . __METHOD__;
        }

        public function create() {
            add_action('admin_enqueue_scripts', array($this, 'addCSSFile'));
            add_action('admin_enqueue_scripts', array($this, 'addJSFile'));
            add_meta_box($this->_meta_box_id, 'My media', array($this, 'display'), 'post');
        }

        private function create_key($val){
            return $this->_prefix_key . $val;
        }

        private function create_id($val){
            return $this->_prefix_id . $val;
        }

        public function save($post_id){
            $postVal = $_POST;

            /////////////////// Kiểm tra ô textbox ẩn có tồn tại hay ko ///////////////////
            if(!isset($postVal[$this->_meta_box_id . '-nonce'])) return $post_id;

            /////////////////// Kiểm tra giá trị gửi qua có bằng giá trị được lưu trong hệ thống hay ko ///////////////////
            if(!wp_verify_nonce($postVal[$this->_meta_box_id . '-nonce'], $this->_meta_box_id)) return $post_id;

            /////////////////// Kiểm tra trường họp bài viết tự động lưu sau một khoảng thời gian ///////////////////
            if(define('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;

            /////////////////// Kiểm tra user có quyền lưu bài viết hay ko ///////////////////
            if(!current_user_can('edit_post', $post_id)) return $post_id;

            $arrData = array(
                'file'     => esc_url($postVal[$this->create_id('file')]),
            );

            foreach ($arrData as $key => $val){
                update_post_meta($post_id, $this->create_key($key), $val);
            }

            //die();
        }

        public function display($post_id) {
            $htmlObj = new TlsHtml();

            /* echo '<pre>';
            print_r($post_id);
            echo '</pre>'; */

            wp_nonce_field($this->_meta_box_id, $this->_meta_box_id . '-nonce');

            echo '<div class="tls_mb_data_wrap">';
            echo '<p><b><i>' . translate('Please insert form ') . ':</i></b></p>';

            // Tạo phần tử chứa Button
            $btnId    = $this->create_id('button');
            $btnName  = $this->create_id('button');
            $btnValue = translate('Media Library Image');
            $attr = array(
                'class' => 'button-secondary',
                'id' => $btnId
            );
            $options = array('type' => 'button');

            $btnMedia = $htmlObj->button($btnName, $btnValue, $attr, $options);

            // Tạo phần tử chứa File
            $inputId    = $this->create_id('file');
            $inputName  = $this->create_id('file');
            $inputValue = get_post_meta($post_id->ID, $this->create_key('file'), true);
            $attr = array(
                'size' => '40',
                'id' => $inputId
            );

            $inputMedia = $htmlObj->textbox($inputName, $inputValue, $attr);
            $html = $htmlObj->label(translate( 'File: ' )) . $inputMedia . ' ' . $btnMedia;

            echo $htmlObj->pTag($html);

            echo $htmlObj->btn_media_script($btnId, $inputId);

    	    echo '</div>';
        }

        public function addJSFile(){
            wp_register_script('tls_mp_mb_button_media', TLS_PLUGIN_JS_URL. 'tls-media-button.js',
                                    array('jquery','media-upload','thickbox'),'1.0');
            wp_enqueue_script('tls_mp_mb_button_media');
        }

        public function addCSSFile() {
            wp_register_style('tls_mp_mb_data_style', TLS_PLUGIN_CSS_URL . 'mb_data.css', '1.0');
            wp_enqueue_style('tls_mp_mb_data_style');
        }
    }