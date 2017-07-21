<?php
/*
 * sanitize_text_field(): Dùng cho textbox, textarea, làm sạch dữ liệu trước khi lưu vào database (phòng ngừa mã độc)
 * get_post_meta(): Lấy dữ liệu từ datatabse hiển thị lên website.
 */

    class Tls_Mp_Metabox_Data{
        public function __construct(){
            add_action('add_meta_boxes', array($this, 'create'));
            add_action('save_post', array($this, 'save'));
        }

        public function save($post_id){
            $postVal = $_POST;

            /* echo '<pre>';
            print_r($post_id);
            echo '</pre>';
            echo '<pre>';
            print_r($postVal);
            echo '</pre>'; */

            update_post_meta($post_id, 'tls_mp_mb_data_price',
                                    sanitize_text_field( $postVal['tls_mp_mb_data_price']));
            update_post_meta($post_id, 'tls_mp_mb_data_author',
                                    sanitize_text_field( $postVal['tls_mp_mb_data_author']));
            update_post_meta($post_id, 'tls_mp_mb_data_level',
                                    sanitize_text_field( $postVal['tls_mp_mb_data_level']));
            update_post_meta($post_id, 'tls_mp_mb_data_profile',
                                    strip_tags($postVal['tls_mp_mb_data_profile']));
            //die();
        }

        public function create() {
            add_action('admin_enqueue_scripts', array($this, 'addCSSFile'));
            add_meta_box('tls_mp_mb_data', 'My Data', array($this, 'display'), 'post');
        }

        public function display($post_id) {
            /* echo '<pre>';
            print_r($post_id);
            echo '</pre>'; */

            echo '<div class="tls_mb_data_wrap">';
            echo '<p><b><i>' . translate('Please insert form ') . ':</i></p></p>';
            $htmlObj = new TlsHtml();

    	    // Tạo phần tử chứa Price
    	    $inputId = 'tls_mp_mb_data_price';
    	    $inputName = 'tls_mp_mb_data_price';
    	    $inputValue = get_post_meta($post_id->ID, 'tls_mp_mb_data_price', true);
    	    $arr = array(
    	        'size' => '25',
    	        'id' => $inputId
    	    );
    	    $inputTitle = $htmlObj->textbox($inputName, $inputValue, $arr);

    	    echo '
    			<p>
    				<label for="'. $inputId .'">'. translate( 'Price' ) .'</label>
    				'. $inputTitle .'
    			</p>
    		';

    	    // Tạo phần tử chứa Author
    	    $inputId = 'tls_mp_mb_data_author';
    	    $inputName = 'tls_mp_mb_data_author';
    	    $inputValue = get_post_meta($post_id->ID, 'tls_mp_mb_data_author', true);
    	    $arr = array(
    	        'size' => '25',
    	        'id' => $inputId
    	    );
    	    $inputTitle = $htmlObj->textbox($inputName, $inputValue, $arr);

    	    echo '
    			<p>
    				<label for="'. $inputId .'">'. translate( 'Author' ) .'</label>
    				'. $inputTitle .'
    			</p>
    		';

    	    // Tạo phần tử chứa Level
    	    $inputId = 'tls_mp_mb_data_level';
    	    $inputName = 'tls_mp_mb_data_level';
    	    $inputValue = get_post_meta($post_id->ID, 'tls_mp_mb_data_level', true);
    	    $arr = array(
    	        'id' => $inputId
    	    );
    	    $options['data'] = array(
    	        'beginner' => translate( 'Beginner' ),
    	        'intermediate' => translate( 'Intermediate' ),
    	        'advanced' => translate( 'Advanced' )
    	    );
    	    $inputTitle = $htmlObj->selectbox($inputName, $inputValue, $arr, $options);

    	    echo '
    			<p>
    				<label for="'. $inputId .'">'. translate( 'Level' ) .'</label>
    				'. $inputTitle .'
    			</p>
    		';

    	    // Tạo phần tử chứa Profile
    	    $inputId = 'tls_mp_mb_data_profile';
    	    $inputName = 'tls_mp_mb_data_profile';
    	    $inputValue = get_post_meta($post_id->ID, 'tls_mp_mb_data_profile', true);
    	    $arr = array(
    	        'id' => $inputId,
    	        'rows' => 6,
    	        'cols' => 60
    	    );
    	    $inputTitle = $htmlObj->textarea($inputName, $inputValue, $arr);

    	    echo '
    			<p>
    				<label for="'. $inputId .'">'. translate( 'Profile' ) .'</label>
    				'. $inputTitle .'
    			</p>
    		';
    	    echo '</div>';
        }

        public function addCSSFile() {
            wp_register_style('tls_mp_mb_data_style', TLS_PLUGIN_CSS_URL . 'mb_data.css', '1.0');
            wp_enqueue_style('tls_mp_mb_data_style');
        }
    }