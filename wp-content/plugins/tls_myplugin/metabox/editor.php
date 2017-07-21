<?php
/*
 * wp_editor($content, $editor_id): Gọi ra Editor.
 * wp_filter_post_kses(): Lọc nội dung của Editor trước khi lưu vào database.
 */
    class Tls_Mp_Metabox_Editor{
        private $_meta_box_id = 'tls_mp_mb_editor';
        private $_prefix_id = 'tls_mp_mb_editor_';
        private $_prefix_key = 'tls_mp_mb_editor_';

        public function __construct(){
            add_action('add_meta_boxes', array($this, 'create'));
            add_action('save_post', array($this, 'save'));

            //echo 'In ra đường dẫn đến: ' . __METHOD__;
        }

        public function create() {
            //add_action('admin_enqueue_scripts', array($this, 'addCSSFile'));
            add_meta_box($this->_meta_box_id, 'My Editor', array($this, 'display'), 'post');
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
                'content'     => wp_filter_post_kses($postVal[$this->create_id('content')]),
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
            echo '<p><b><i>' . translate('Please insert form ') . ':</i></p></p>';
            $inputValue = get_post_meta($post_id->ID, $this->create_key('content'), true);
            $inputId    = $this->create_id('content');
            $options = array(
                'wpautop'             => false,
                'media_buttons'       => true,
                'default_editor'      => '',
                'drag_drop_upload'    => true,
                'textarea_name'       => $inputId,
                'textarea_rows'       => 10,
                'tabindex'            => '',
                'tabfocus_elements'   => ':prev,:next',
                'editor_css'          => '',
                'editor_class'        => '',
                'teeny'               => false,
                'dfw'                 => false,
                '_content_editor_dfw' => false,
                'tinymce'             => true,
                'quicktags'           => true
            );

            $htmlObj->pTag(wp_editor($inputValue, $inputId, $options));

    	    echo '</div>';
        }
    }