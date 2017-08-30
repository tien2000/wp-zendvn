<?php
/* 
 * get_categories(): Lấy ra mảng giá trị của Category.
 *  */

if(class_exists('WP_Customize_Control')){
    class WP_Customize_Category_List_Control extends WP_Customize_Control{
        
        private $_custom_args = array();
        
        public function __construct($manager, $id, $args = array()) {
            parent::__construct($manager, $id, $args);
            
            /* echo '<pre>';
            print_r($args);
            echo '</pre>'; */
            
            $this->_custom_args = $args;
        }
        
        public function render_content(){
            //echo __METHOD__;
            
            $args = $this->_custom_args;
            $size = '';
            $style = '';
            if($args['size'] > 1){
                $size = 'size = "'. $args['size'] .'"';
                $style = 'style="height:auto"';
            }
            
            $multiple = '';
            if($args['multiple'] == 1){
                $multiple = 'multiple';
            }
            
            //2. Kiểm tra giá trị của $value
            $strValue = '';
            if(is_array($this->value())){
                $strValue = implode("|", $this->value());
            }else{
                $strValue = $this->value();
            }
            
            
            
            $cats = get_categories();
            $strOptions = '<option value="0">--Select--</option>';
            foreach ($cats as $key => $info){
                $selected = '';
                if(preg_match('/^(' . $strValue .')$/i', $key)){
                    $selected = ' selected="selected" ';
                }
                $strOptions .= '<option value="'. $info->cat_ID .'" '. $selected .'>'. $info->name .'</option>';
            }
            
            $html = '<label>
                        <span class="customize-control-title">'. $this->label .'</span>
                        <span class="description customize-control-description">'. $this->description .'</span>
                        <select '.$this->get_link().' '. $size .' '. $style .' '. $multiple .'>'. $strOptions .'</select>                        
                    </label>
                   ';
            echo $html;
        }
    }
}
?>

<!-- <label> <span class="customize-control-title">Select Category</span>
<div class="customize-control-notifications-container" style="">
		<ul>

		</ul>
	</div> <select data-customize-setting-link="tls_theme_general[my-categories]">
		<option value="0">--Select--</option>
		<option value="3" selected="selected">PHP</option>
		<option value="4">PHP cơ bản</option>
		<option value="1">Uncategorized</option>
		<option value="6">Vòng lặp trong PHP</option>
</select>
</label> -->