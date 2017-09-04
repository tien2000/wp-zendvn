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
                'general'      => true,  
                'ads'          => true,
                'menu_color'   => true,
            );
            
            $this->_theme_mods = get_theme_mods();
            
            if($options['general'] == true)         $this->general();
            if($options['ads'] == true)             $this->ads();
            if($options['menu_color'] == true)      $this->menu_color();
            
        }
        
        public function general() {
            require_once TLS_THEME_CONTROLS_DIR . 'general_section.php';
            new Tls_Theme_General_Section($this->_theme_mods);
        }
        
        public function ads() {
            require_once TLS_THEME_CONTROLS_DIR . 'ads_section.php';
            new Tls_Theme_Ads_Section($this->_theme_mods);
        }
        
        public function menu_color() {
            require_once TLS_THEME_CONTROLS_DIR . 'menu_section.php';
            new Tls_Theme_Menu_Color_Section($this->_theme_mods);
        }
        
        public function ads_section($val = ''){
            //  echo '<br>' . __METHOD__;
            $options = @$this->_theme_mods['tls_theme_ads'];
            
            if($val == 'top-banner'){
                /* echo '<pre>';
                print_r($options);
                echo '</pre>'; */
                
                if(empty($options['top-banner-link'])){
                    $val = '<img src="'. $options['top-banner'] .'">';
                }else{
                    $imgSrc = '<img src="'. $options['top-banner'] .'">';
                    $val = str_replace('</a>', $imgSrc . '</a>', $options['top-banner-link']);
                }
            }
            
            if($val == 'content-banner'){            
                if(empty($options['content-banner-link'])){
                    $val = '<img src="'. $options['content-banner'] .'">';
                }else{
                    $imgSrc = '<img src="'. $options['content-banner'] .'">';
                    $val = str_replace('</a>', $imgSrc . '</a>', $options['content-banner-link']);
                }
            }
            return $val;
        }
    }

?>