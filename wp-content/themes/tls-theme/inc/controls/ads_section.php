<?php
/* 
 * Hook 'customize_preview_init': Hỗ trợ hiển thị thay đổi trong custom theme.
 * 'transport'     => 'postMessage': Sử dụng trong Theme Customizer's live preview.
 *  */    

    class Tls_Theme_Ads_Section{
        
        private $_theme_mods;
        
        public function __construct($theme_mods = array()){
            //echo __METHOD__;            
            /* echo '<pre>';
            print_r($theme_mods);
            echo '</pre>'; */
            
            $this->_theme_mods = $theme_mods;
            
            add_action('customize_register', array($this,'register'));
    		add_action('wp_head', array($this,'css'));
    		add_action('customize_preview_init', array($this,'live_preview'));
        }
        
        public function css(){
            $options = @$this->_theme_mods['tls_theme_ads'];
            //echo '<br>' . __METHOD__;            
            /* echo '<pre>';
            print_r($options);
            echo '</pre>'; */
?>
	<style type="text/css">
	
	</style>
<?php 
        }

        public function live_preview(){
            wp_enqueue_script('tls-theme-customize',
                                TLS_THEME_JS_URL . 'theme-customize.js',
                                array('jquery','customize-preview'),
                                '1.0.0',
                                true
                            );
        }
        
        public function register($wp_customize){
            $sectionID = 'tls_theme_ads';
            $wp_customize->add_section($sectionID,array(
                                'title'         => __('Ads banner'),
                                'description'   => __('Ads description'),
                                'priority'      => 20
                            
                            ));
                       
    //========================================================
    // Tạo ô TOP BANNER
    //========================================================            
            $inputName = 'top-banner';
            $settingID = $sectionID . '[' . $inputName . ']';
            $wp_customize->add_setting($settingID, array(
                'default' 		=> TLS_THEME_IMAGE_URL . '/ad-620x80.png',
                'capability' 	=>'edit_theme_options',
                'type'			=> 'theme_mod',
                'transport'		=> 'postMessage',
            ));
            
            $controlID = 'tls-theme-' . $inputName;
            $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $controlID, array(
                'label' 		=> __('Top Banner'),
                'section' 		=> $sectionID,
                'settings' 		=> $settingID,
            )));
            
            
    //========================================================
    // Tạo ô TOP BANNER LINK
    //========================================================
            $inputName = 'top-banner-link';
            $settingID = $sectionID . '[' . $inputName . ']';
            $wp_customize->add_setting($settingID, array(
                'default' 		=> '<a href="#" title="Ad"></a>',
                'capability' 	=> 'edit_theme_options',
                'type'			=> 'theme_mod',
                'transport'		=> 'postMessage',
            ));
              
            $controlID = 'tls-theme-' . $inputName;
            $wp_customize->add_control($controlID,array(
                'label' 		=> __('Top Banner Link'),
                'section' 		=> $sectionID,
                'settings' 		=> $settingID,
                'type'			=>'textarea',
            ));
            
            
    //========================================================
    // Tạo ô CONTENT BANNER
    //========================================================
            $inputName = 'content-banner';
            $settingID = $sectionID . '[' . $inputName . ']';
            $wp_customize->add_setting($settingID, array(
                'default' 		=> TLS_THEME_IMAGE_URL . '/ad-620x80.png',
                'capability' 	=>'edit_theme_options',
                'type'			=> 'theme_mod',
                'transport'		=> 'postMessage',
            ));
            
            $controlID = 'tls-theme-' . $inputName;
            $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $controlID, array(
                'label' 		=> __('Content Banner'),
                'section' 		=> $sectionID,
                'settings' 		=> $settingID,
            )));
            
            
    //========================================================
    // Tạo ô CONTENT BANNER LINK
    //========================================================
            $inputName = 'content-banner-link';
            $settingID = $sectionID . '[' . $inputName . ']';
            $wp_customize->add_setting($settingID, array(
                'default' 		=> '<a href="#" title="Ad"></a>',
                'capability' 	=> 'edit_theme_options',
                'type'			=> 'theme_mod',
                'transport'		=> 'postMessage',
            ));
            
            $controlID = 'tls-theme-' . $inputName;
            $wp_customize->add_control($controlID,array(
                'label' 		=> __('Content Banner Link'),
                'section' 		=> $sectionID,
                'settings' 		=> $settingID,
                'type'			=>'textarea',
            ));
            
            
    //========================================================
    // Tạo ô BANNER IN CONTENT
    //========================================================
            $inputName = 'banner-in-content';
            $settingID = $sectionID . '[' . $inputName . ']';
            $wp_customize->add_setting($settingID, array(
                'default' 		=> '<a href="#" title="Total Theme"><img src="http://localhost/wp-zendvn/wp-content/uploads/2017/09/banner_300x250.jpg" alt="Total Theme" /></a>',
                'capability' 	=> 'edit_theme_options',
                'type'			=> 'theme_mod',
                'transport'		=> 'postMessage',
            ));
            
            $controlID = 'tls-theme-' . $inputName;
            $wp_customize->add_control($controlID,array(
                'label' 		=> __('Banner In Content'),
                'section' 		=> $sectionID,
                'settings' 		=> $settingID,
                'type'			=>'textarea',
            ));
        }
    }