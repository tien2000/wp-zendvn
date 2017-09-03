<?php
/* 
 * Hook 'customize_preview_init': Hỗ trợ hiển thị thay đổi trong custom theme.
 * 'transport'     => 'postMessage': Sử dụng trong Theme Customizer's live preview.
 *  */    

    class Tls_Theme_General_Section{
        
        private $_theme_mods;
        
        public function __construct($theme_mods = array()){
            //echo __METHOD__;            
            /* echo '<pre>';
            print_r($theme_mods);
            echo '</pre>'; */
            
            $this->_theme_mods = $theme_mods;
            
            add_action('customize_register', array($this, 'register'));
            add_action('wp_head', array($this, 'css'));
            add_action('customize_preview_init', array($this,'live_preview'));
        }
        
        public function css(){
            $options = @$this->_theme_mods['tls_theme_general'];
            //echo '<br>' . __METHOD__;            
            echo '<pre>';
            print_r($options);
            echo '</pre>';
?>
			<style type="text/css">
                <?php if($options['date-time'] == 'no'):?>
                    #topbar-date{
                        display: none;
                    }
                <?php endif;?>
                <?php if($options['search'] == 'no'):?>
                    #topbar-search{
                        display: none;
                    }
                <?php endif;?>
                <?php if($options['site-description-color'] != ''):?>
                	#blog-description{
                		color: <?php echo $options['site-description-color'];?>;
                	}
            	<?php endif;?>
            </style>
<?php 
        }

        public function live_preview(){
            wp_enqueue_script('tls-theme-customize',
                                    TLS_THEME_JS_URL . 'theme-customize.js',
                                    array( 'jquery','customize-preview' ),
                                    '1.0.0',
                                    true
                                );
        }
        
        public function register($wp_customize){
            $sectionID = 'tls_theme_general';
            $wp_customize->add_section($sectionID, array(
                    'title'         =>      __('General'),
                    'description'   =>      __('General description'),
                    'priority'      =>      20
                ));            
                       
    //========================================================
    // Tạo ô SELECTBOX DATE-TIME
    //========================================================
            $inputName = 'date-time';
            $settingID = $sectionID . '[' . $inputName . ']';
            $wp_customize->add_setting($settingID, array(
                'default'       => 'yes',
                'capability'    => 'edit_theme_options',
                'type'          => 'theme_mod',
                //'type'          => 'option',
                'transport'     => 'postMessage',
            ));
            
            $controlID = 'tls-theme-' . $inputName;
            $wp_customize->add_control($controlID, array(
                'label'         =>  __('Show Time'),
                'section'       =>  $sectionID,
                'settings'      =>  $settingID,
                'type'          =>  'select',
                'description'   =>      __('Show time on header'),
                'choices'       =>  array(
                        'yes'       => __('Yes'),
                        'no'        => __('No')
                    )
            ));
            
            
    //========================================================
    // Tạo ô SELECTBOX SEARCH-FORM
    //========================================================
            $inputName = 'search';
            $settingID = $sectionID . '[' . $inputName . ']';
            $wp_customize->add_setting($settingID, array(
                'default'       => 'yes',
                'capability'    => 'edit_theme_options',
                'type'          => 'theme_mod',
                //'type'          => 'option',
                'transport'     => 'postMessage',
            ));
            
            $controlID = 'tls-theme-' . $inputName;
            $wp_customize->add_control($controlID, array(
                'label'         =>  __('Search'),
                'section'       =>  $sectionID,
                'settings'      =>  $settingID,
                'type'          =>  'select',
                'description'   =>      __('Search Form on Header'),
                'choices'       =>  array(
                    'yes'       => __('Yes'),
                    'no'        => __('No')
                )
            ));
            
            
    //========================================================
    // Tạo ô Logo
    //========================================================
            $inputName = 'site-logo';
            $settingID = $sectionID . '[' . $inputName . ']';
            $wp_customize->add_setting($settingID, array(
                'default' 		=> '<h1><a href="#" title="Spartan" rel="home">Spartan</a></h1>',
				'capability' 	=> 'edit_theme_options',
				'type'			=> 'theme_mod',
				'transport'		=> 'postMessage',
            ));
            
            $controlID = 'tls-theme-' . $inputName;
            $wp_customize->add_control($controlID, array(
				'label' 		=> __('Site logo'),
				'section' 		=> $sectionID,
				'settings' 		=> $settingID,
				'type'			=>'textarea',
		    ));
            
            
    //========================================================
    // Tạo ô Description
    //========================================================
            $inputName = 'site-description';
            $settingID = $sectionID . '[' . $inputName . ']';
            $wp_customize->add_setting($settingID, array(
                'default' 		=> "Edit your subheading via the theme customizer.<br>It looks much better when it's 2 lines long. ",
                'capability' 	=> 'edit_theme_options',
				'type'			=> 'theme_mod',
				'transport'		=> 'postMessage',
            ));
            
            $controlID = 'tls-theme-' . $inputName;
            $wp_customize->add_control($controlID, array(
                'label'         =>  __('Site Description'),
                'section'       =>  $sectionID,
                'settings'      =>  $settingID,
                'type'          =>  'textarea', 
                'description'   =>  __('Site description'),
            ));
            
            
    //========================================================
    // Tạo ô COLOR PICKER
    //========================================================
            $inputName = 'site-description-color';
    		$settingID = $sectionID . '[' . $inputName . ']';
    		$wp_customize->add_setting($settingID,array(
    				'default' 		=> '#878787',
    				'capability' 	=> 'edit_theme_options',
    				'type'			=> 'theme_mod',
    				'transport'		=> 'postMessage',
    		));
            
            $controlID = 'tls-theme-' . $inputName;
    		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $controlID,array(
    				'label' 		=> __('Site description text color'),
    				'section' 		=> $sectionID,
    				'settings' 		=> $settingID,
    		        'description'   =>  __('Site description color'),
    		)));
            
    //========================================================
    // Tạo Copyright
    //========================================================
            $inputName = 'site-copyright';
            $settingID = $sectionID . '[' . $inputName . ']';
            $wp_customize->add_setting($settingID, array(
                'default'       => __('Copyright 2014 Spartan'),
                'capability'    => 'edit_theme_options',
                'type'          => 'theme_mod',
                //'type'          => 'option',
                'transport'     => 'postMessage',
            ));
            
            $controlID = 'tls-theme-' . $inputName;
            $wp_customize->add_control($controlID, array(
                'label'         =>  __('Site Copyright'),
                'section'       =>  $sectionID,
                'settings'      =>  $settingID,
                'type'          =>  'textarea',
                'description'   =>  __('Site copyright footer'),
            ));
        }
    }