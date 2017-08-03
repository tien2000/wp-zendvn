<?php
/* 
 * domain/edit-tags.php?taxonomy=category | 'post_tag' | 'Custom Taxonomy'
 * 'category_add_form_fields': Thao tác trên Posts-Category (Hoặc Page, Custom Post)
 * 'category_edit_form_fields': Thao tác trên Posts-Category-Edit (Hoặc Page, Custom Post)
 * Tương tự cho 'post_tag' | 'Custom Taxonomy'
 * thickbox: Để hiển thị ra popup Media Libery Image
 * Hook 'edited_category': Có tham số $term_id
 *  */

    class Tls_Mp_Mb_Taxonomy{
        private $_prefix_id = 'tls-mp-mb-taxonomy-category-';
        private $_prefix_name = 'tls-mp-mb-taxonomy-category';
        
        public function __construct() {
            //echo '<br>' . __METHOD__;
            add_action('admin_enqueue_scripts', array($this, 'addCSSFile'));
            add_action('admin_enqueue_scripts', array($this, 'addJSFile'));
            add_action('category_add_form_fields', array($this, 'addForm'));
            add_action('category_edit_form_fields', array($this, 'editForm'));
            
            add_action('create_category', array($this, 'save'));
            add_action('edited_category', array($this, 'save'));
        }
        
        public function save($term_id){
            /* echo '<pre>';
            print_r($term_id);
            echo '</pre>';            
            echo '<pre>';
            print_r($_POST[$this->_prefix_name]);
            echo '</pre>'; */
            
            if(isset($_POST[$this->_prefix_name])){
                $option_name = $this->_prefix_id . $term_id;
                update_option($option_name, $_POST[$this->_prefix_name]);
            }
            
            //die();
        }
        
        public function addForm() {
            //echo '<br>' . __METHOD__;
            $htmlObj = new TlsHtml();
            
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
            
  // Tạo phần tử chứa Picture
            $inputId    = $this->create_id('picture');
            $inputName  = $this->create_name('picture');
            $inputValue = '';
            $attr = array(
                            'size' => '40',
                            'id' => $inputId
                        );
            
            $inputMedia = $htmlObj->textbox($inputName, $inputValue, $attr);
            $html = '<div class="form-field">'
                    . $htmlObj->label(translate( 'Picture' ), array('for' => 'tag-name')) 
                    . $inputMedia 
                    . ' ' . $btnMedia
                    . $htmlObj->pTag(translate('Description of picture'))
                    . '</div>';
            
            echo $html;
            
            echo $htmlObj->btn_media_script($btnId, $inputId);
            
  // Tạo phần tử chứa Sumary
            $inputId = $this->create_id('sumary');
            $inputName = $this->create_name('sumary');
            $inputValue = '';
            $arr = array(
                            'id' => $inputId,
                            'rows' => 5,
                            'cols' => 40
                        );
            
            $inputProfile = $htmlObj->textarea($inputName, $inputValue, $arr);
            $html = '<div class="form-field">'
                     .$htmlObj->label(translate( 'Sumary' ), array('for' => 'tag-name')) 
                     . $inputProfile
                     . $htmlObj->pTag(translate('Description of sumary'))
                     . '</div>';
            
            echo $html;
            
            /* <div class="form-field">
            <label for="tag-name">Name</label>
            <input name="tag-name" id="tag-name" type="text" value="" size="40" aria-required="true">
            <p>The name is how it appears on your site.</p>
            </div> */
        }
        
        public function editForm($term) {
            /* echo '<pre>';
            print_r($term);
            echo '</pre>'; */
            
            $option_name    = $this->_prefix_id . $term->term_id;
            $option_value   = get_option($option_name);
            
            /* echo '<pre>';
            print_r($option_value);
            echo '</pre>'; */
            
            $htmlObj = new TlsHtml();
            
  // Tạo phần tử chứa Button
            $btnId    = $this->create_id('button');
            $btnName  = $this->create_id('button');
            $btnValue = translate('Media Library Image');
            $attr = array('class' => 'button-secondary', 'id' => $btnId);
            $options = array('type' => 'button');            
            $btnMedia = $htmlObj->button($btnName, $btnValue, $attr, $options); // Create Button
            
  // Tạo phần tử chứa Picture
            $inputId    = $this->create_id('picture');
            $inputName  = $this->create_name('picture');
            $inputValue = $option_value['picture'];
            $attr = array('size' => '40', 'id' => $inputId);            
            $inputPicture   = $htmlObj->textbox($inputName, $inputValue, $attr);
            $lblPicture     = $htmlObj->label(translate( 'Picture' ), array('for' => $inputId));
            $pPicture       = $htmlObj->pTag(translate('Description of picture'), array('class' => 'description'));
        
  // Tạo phần tử chứa Sumary
            $inputId = $this->create_id('sumary');
            $inputName = $this->create_name('sumary');
            $inputValue = $option_value['sumary'];
            $arr = array('id' => $inputId, 'rows' => 5, 'cols' => 50);
            $inputSumary    = $htmlObj->textarea($inputName, $inputValue, $arr);
            $lblSumary      = $htmlObj->label(translate( 'Sumary' ), array('for' => 'sumary'));
            $pSumary        = $htmlObj->pTag(translate('Description of sumary'), array('class' => 'description'));
            
            // Gọi file taxonomy-category.php chứa thông tin của Picture và Sumary
            $JsMedia = $htmlObj->btn_media_script($this->create_id('button'), $this->create_id('picture'));
            require_once TLS_PLUGIN_VIEWS_DIR . 'taxonomy-category.php';
            
        }
        
        private function create_name($val){
            return $this->_prefix_name . '[' . $val . ']';
        }
        
        private function create_id($val){
            return $this->_prefix_id . $val;
        }
        
        public function addJSFile(){
            wp_register_script('tls_mp_mb_button_media', TLS_PLUGIN_JS_URL. 'tls-media-button.js',
                array('jquery','media-upload','thickbox'),'1.0');
            wp_enqueue_script('tls_mp_mb_button_media');
        }
        
        public function addCSSFile() {
            wp_enqueue_style('thickbox');
        }
    }
?>