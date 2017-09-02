<?php
/* 
 * Hook 'customize_register': Tạo phần điều khiển cho theme.
 * get_theme_mods(): Lấy mảng giá trị trong theme_mod
 * get_theme_mod($name): Lấy giá trị theo tên theme_mod
 * get_option($name); Lấy giá trị theo tên option (Khi chọn type là option trong add_setting)
 */

    class Tls_Theme_Customize_Control{
        
        private $_theme_mods = array();
        
        public function __construct(){
            //echo __METHOD__;
            
            $options = array(
                'general'          => true,  
            );
            
            $this->_theme_mods = get_theme_mods();
            
            if($options['general'] == true) $this->general();
            
        }
        
        public function general() {
            require_once TLS_THEME_CONTROLS_DIR . 'general_section.php';
            new Tls_Theme_General_Section($this->_theme_mods);
        }
    }

?>