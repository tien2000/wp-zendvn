<?php
/* 
 * Hook 'customize_register': Tạo phần điều khiển cho theme.
 * get_theme_mods(): Lấy mảng giá trị trong theme_mod
 * get_theme_mod($name): Lấy giá trị theo tên theme_mod
 * get_option($name); Lấy giá trị theo tên option (Khi chọn type là option trong add_setting)
 * Hook 'after_switch_theme': Dùng kiểm tra theme có phải chạy lần đầu hay ko.
 * 
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
            
            //remove_theme_mods();	
            
    		$this->_theme_mods = get_theme_mods();
    		
    		/* echo '<pre>';
    		print_r($this->_theme_mods);
    		echo '</pre>'; */
    		
    		//$this->setDefault();
    		
    		if(!isset($this->_theme_mods['theme_check'])){
    			add_action('after_switch_theme', array($this,'setDefault'));
    		}
            
            if($options['general'] == true)         $this->general();
            if($options['ads'] == true)             $this->ads();
            if($options['menu_color'] == true)      $this->menu_color();
        }       
        
    public function setDefault(){
		
		$arrDefault = array();
		$arrDefault['theme_check'] = 1;
		
		$arrDefault['tls_theme_general'] = array(
    				'date-time' 				=> 'yes',
    				'search' 				    =>'yes',
    				'site-logo' 				=> '<h1><a href="#" title="Spartan" rel="home">Spartan</a></h1>',
    				'site-description' 			=> 'Edit your subheading via the theme customizer. <br /> It looks much better when it\'s 2 lines long.',
    				'site-color' 	            => '#878787',
    				'site-copyright' 	        => 'Copyright 2014 Spartan'				
				);
		$arrDefault['tls_theme_ads'] = array(
					'top-banner' 			    => TLS_THEME_IMAGE_URL . 'ad-620x80.png',
					'top-banner-link' 		    => '<a href="#" title="Ad"></a>',
					'content-banner' 		    => TLS_THEME_IMAGE_URL . 'ad-620x80.png',
					'content-banner-link' 	    => '<a href="#" title="Ad"></a>',
					'banner-in-content' 	    => '<a href="#" title="Total Theme"> <img src="' . TLS_THEME_IMAGE_URL . 'banner_300x250.jpg" alt="Total Theme" />'
				);
		
		update_option('theme_mods_tls', $arrDefault);
		
	}
        
        public function general_section($val = ''){
            //  echo '<br>' . __METHOD__;
            
            $options = @$this->_theme_mods['tls_theme_general'];
            
            /* echo '<pre>';
            print_r($options);
            echo '</pre>'; */
            
            if($val == "tls_theme_general[site-logo]"){
                return $options['site-logo'];
            }
            if($val == "tls_theme_general[site-description]"){
                return $options['site-description'];
            }
            if($val == "tls_theme_general[site-copyright]"){
                return $options['site-copyright'];
            }            
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
    }

?>