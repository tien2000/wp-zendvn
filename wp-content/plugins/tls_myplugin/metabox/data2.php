<?php
    class Tls_Mp_Metabox_Data2{
        private $_meta_box_id = 'tls_mp_mb_data2';
        private $_prefix_id = 'tls_mp_mb_data2_';
        private $_prefix_key = 'tls_mp_mb_data2_';

        public function __construct(){
            add_action('add_meta_boxes', array($this, 'create'));
            add_action('save_post', array($this, 'save'));
        }

        public function create() {
            add_action('admin_enqueue_scripts', array($this, 'addCSSFile'));
            add_meta_box($this->_meta_box_id, 'My Data', array($this, 'display'), 'page');
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
                'price'     => sanitize_text_field( $postVal[$this->create_id('price')]),
                'author'    => sanitize_text_field( $postVal[$this->create_id('author')]),
                'level'     => sanitize_text_field( $postVal[$this->create_id('level')]),
                'profile'   => strip_tags($postVal[$this->create_id('profile')])
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

    	    // Tạo phần tử chứa Price
    	    $inputId = $this->create_id('price');
    	    $inputName = $this->create_id('price');
    	    $inputValue = get_post_meta($post_id->ID, $this->create_key('price'), true);
    	    $arr = array(
    	        'size' => '25',
    	        'id' => $inputId
    	    );

    	    $inputPrice = $htmlObj->textbox($inputName, $inputValue, $arr);
    	    $html = $htmlObj->label(translate( 'Price' )) . $inputPrice;

    	    echo $htmlObj->pTag($html);

    	    // Tạo phần tử chứa Author
    	    $inputId = $this->create_id('author');
    	    $inputName = $this->create_id('author');
    	    $inputValue = get_post_meta($post_id->ID, $this->create_key('author'), true);
    	    $arr = array(
    	        'size' => '25',
    	        'id' => $inputId
    	    );

    	    $inputAuthor = $htmlObj->textbox($inputName, $inputValue, $arr);
    	    $html = $htmlObj->label(translate( 'Author' )) . $inputAuthor;

    	    echo $htmlObj->pTag($html);

    	    // Tạo phần tử chứa Level
    	    $inputId = $this->create_id('level');
    	    $inputName = $this->create_id('level');
    	    $inputValue = get_post_meta($post_id->ID, $this->create_key('level'), true);
    	    $arr = array(
    	        'id' => $inputId
    	    );
    	    $options['data'] = array(
    	        'beginner' => translate( 'Beginner' ),
    	        'intermediate' => translate( 'Intermediate' ),
    	        'advanced' => translate( 'Advanced' )
    	    );

    	    $selectLevel = $htmlObj->selectbox($inputName, $inputValue, $arr, $options);
    	    $html = $htmlObj->label(translate( 'Level' )) . $selectLevel;

    	    echo $htmlObj->pTag($html);

    	    // Tạo phần tử chứa Profile
    	    $inputId = $this->create_id('profile');
    	    $inputName = $this->create_id('profile');
    	    $inputValue = get_post_meta($post_id->ID, $this->create_key('profile'), true);
    	    $arr = array(
    	        'id' => $inputId,
    	        'rows' => 6,
    	        'cols' => 60
    	    );

    	    $inputProfile = $htmlObj->textarea($inputName, $inputValue, $arr);
    	    $html = $htmlObj->label(translate( 'Profile' )) . $inputProfile;

    	    echo $htmlObj->pTag($html);

    	    echo '</div>';
        }

        public function addCSSFile() {
            wp_register_style('tls_mp_mb_data_style', TLS_PLUGIN_CSS_URL . 'mb_data.css', '1.0');
            wp_enqueue_style('tls_mp_mb_data_style');
        }
    }