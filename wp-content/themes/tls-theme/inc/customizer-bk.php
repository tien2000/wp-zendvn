<?php
/* 
 * Hook 'customize_register': Tạo phần điều khiển cho theme.
 * get_theme_mods(): Lấy mảng giá trị trong theme_mod
 * get_theme_mod($name): Lấy giá trị theo tên theme_mod
 * get_option($name); Lấy giá trị theo tên option (Khi chọn type là option trong add_setting)
 */

    $tmp = get_theme_mods();
    /* echo '<pre>';
    print_r($tmp);
    echo '</pre>'; */
        
    //echo get_theme_mod('tls_theme_size_name', '');
    
    //echo get_option('tls_theme_size_name');


/////////////////////////////////////////////////////////////////////////////////

    add_action('customize_register', 'tls_theme_customize_register');
    
    function tls_theme_customize_register($wp_customize){
        /* echo '<pre>';
        print_r($wp_customize);
        echo '</pre>'; */
        
        $sectionID = 'tls_theme_general';
        $wp_customize->add_section($sectionID, array(
                'title'         =>      __('General'),
                'description'   =>      __('General description'),
                'priority'      =>      20
            ));
        
    //========================================================
    // Tạo ô CATEGORIES LIST CONTROL
    //========================================================
        $inputName = 'my-cats';
        $settingID = $sectionID . '[' . $inputName . ']';
        $wp_customize->add_setting($settingID, array(
            //'default'       => '#eaeaea',
            'capability'    => 'edit_theme_options',
            'type'          => 'theme_mod',
            'transport'     => 'refresh',
        ));
        
        $controlID = 'tls-theme' . $inputName;
        $wp_customize->add_control(new WP_Customize_Category_List_Control($wp_customize, $controlID, array(
            'label'         =>  __('My Categories'),
            'section'       =>  $sectionID,
            'settings'      =>  $settingID,
            'description'   =>  __('Show Categories'),
            'multiple'      =>  1,
            'size'          =>  5
        )));
        
        
    //========================================================
    // Tạo ô SELECTBOX CATEGORY
    //========================================================
         $cats = get_categories();
        /* echo '<pre>';
        print_r($cats);
        echo '</pre>'; */
        
        $catData = array();
        $catData[] = '--Select--';
        foreach ($cats as $key => $info){            
            $catData[$info->cat_ID] = $info->name;
        }
        
        /* echo '<pre>';
        print_r($catData);
        echo '</pre>'; */
        
        $inputName = 'my-categories';
        $settingID = $sectionID . '[' . $inputName . ']';
        $wp_customize->add_setting($settingID, array(
            'default'       => '0',
            'capability'    => 'edit_theme_options',
            'type'          => 'theme_mod',
            //'type'          => 'option',
            'transport'     => 'refresh',            
        ));
        
        /* $controlID = 'tls-theme' . $inputName;
        $wp_customize->add_control($controlID, array(
            'label'         =>  __('Select Category'),
            'section'       =>  $sectionID,
            'settings'      =>  $settingID,
            'type'          =>  'select',
            'choices'       =>  $catData,
            'description'   =>  __('Show Categories')
        )); */
        
        
    //========================================================
    // Tạo ô PAGE DROPDOWN
    //========================================================
        $inputName = 'my-page';
        $settingID = $sectionID . '[' . $inputName . ']';
        $wp_customize->add_setting($settingID, array(
            'default'       => '0',
            'capability'    => 'edit_theme_options',
            'type'          => 'theme_mod',
            //'type'          => 'option',
            'transport'     => 'refresh',            
        ));
        
        $controlID = 'tls-theme' . $inputName;
        $wp_customize->add_control($controlID, array(
            'label'         =>  __('Pages'),
            'section'       =>  $sectionID,
            'settings'      =>  $settingID,
            'type'          =>  'dropdown-pages',
        ));
        
        
    //========================================================
    // Tạo ô TEXTAREA
    //========================================================
        $inputName = 'my-textarea';
        $settingID = $sectionID . '[' . $inputName . ']';
        $wp_customize->add_setting($settingID, array(
            'default'       => __('This is a textarea'),
            'capability'    => 'edit_theme_options',
            'type'          => 'theme_mod',
            //'type'          => 'option',
            'transport'     => 'refresh',
        ));
        
        $controlID = 'tls-theme' . $inputName;
        $wp_customize->add_control($controlID, array(
            'label'         =>  __('Content'),
            'section'       =>  $sectionID,
            'settings'      =>  $settingID,
            'type'          =>  'textarea',            
        ));
        
        
    //========================================================
    // Tạo ô SELECTBOX
    //========================================================
        $inputName = 'my-select';
        $settingID = $sectionID . '[' . $inputName . ']';
        $wp_customize->add_setting($settingID, array(
                'default'       => 'male',
                'capability'    => 'edit_theme_options',
                'type'          => 'theme_mod',
                //'type'          => 'option',
                'transport'     => 'refresh',
            ));
        
        $controlID = 'tls-theme' . $inputName;
        $wp_customize->add_control($controlID, array(
                'label'         =>  __('Select Sex'),
                'section'       =>  $sectionID,
                'settings'      =>  $settingID,
                'type'          =>  'select',
                'choices'       =>  array(
                                        'male'      => __('Male'), 
                                        'female'    => __('Female'),
                                        'unknown'    => __('Unknown')
                                    )
            ));
        
        
    //========================================================
    // Tạo ô COLOR PICKER
    //========================================================
        $inputName = 'my-color-picker';
        $settingID = $sectionID . '[' . $inputName . ']';
        $wp_customize->add_setting($settingID, array(
            'default'       => '#eaeaea',
            'capability'    => 'edit_theme_options',
            'type'          => 'theme_mod',
            'transport'     => 'refresh',
        ));
        
        $controlID = 'tls-theme' . $inputName;
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $controlID, array(
            'label'         =>  __('Color Picker'),
            'section'       =>  $sectionID,
            'settings'      =>  $settingID,
        )));
        
        
    //========================================================
    // Tạo ô IMAGE UPLOAD
    //========================================================
        $inputName = 'my-image-upload';
        $settingID = $sectionID . '[' . $inputName . ']';
        $wp_customize->add_setting($settingID, array(
            'default'       => 'http://localhost/wp-zendvn/wp-content/uploads/2017/07/2.png',
            'capability'    => 'edit_theme_options',
            'type'          => 'theme_mod',
            'transport'     => 'refresh',
        ));
        
        $controlID = 'tls-theme' . $inputName;
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $controlID, array(
            'label'         =>  __('Upload Image'),
            'section'       =>  $sectionID,
            'settings'      =>  $settingID,
        )));        
        
        
    //========================================================
    // Tạo ô FILE UPLOAD
    //========================================================
        $inputName = 'my-file-upload';
        $settingID = $sectionID . '[' . $inputName . ']';
        $wp_customize->add_setting($settingID, array(
            //'default'       => '',
            'capability'    => 'edit_theme_options',
            'type'          => 'theme_mod',
            'transport'     => 'refresh',
        ));
        
        $controlID = 'tls-theme' . $inputName;
        $wp_customize->add_control(new WP_Customize_Upload_Control($wp_customize, $controlID, array(
            'label'         =>  __('Upload File'),
            'section'       =>  $sectionID,
            'settings'      =>  $settingID,            
        )));
        
        
    //========================================================
    // Tạo ô CHECKBOX
    //========================================================
        $inputName = 'my-checkbox';
        $settingID = $sectionID . '[' . $inputName . ']';
        $wp_customize->add_setting($settingID, array(
            //'default'       => '',
            'capability'    => 'edit_theme_options',
            'type'          => 'theme_mod',
            'transport'     => 'refresh',            
        ));
        
        $controlID = 'tls-theme' . $inputName;
        $wp_customize->add_control($controlID, array(
            'label'         =>  __('Checkbox list'),
            'section'       =>  $sectionID,
            'settings'      =>  $settingID,
            'type'          =>  'checkbox',
        ));
        
        
    //========================================================
    // Tạo ô RADIO
    //========================================================
        $inputName = 'my-radio';
        $settingID = $sectionID . '[' . $inputName . ']';
        $wp_customize->add_setting($settingID, array(
                'default'       => 'male',
                'capability'    => 'edit_theme_options',
                'type'          => 'theme_mod',
                //'type'          => 'option',
                'transport'     => 'refresh',
                //'sanitize_callback' => 'sanitize_tls_theme_size_name'
            ));
        
        $controlID = 'tls-theme' . $inputName;
        $wp_customize->add_control($controlID, array(
                'label'         =>  __('Sex'),
                'section'       =>  $sectionID,
                'settings'      =>  $settingID,
                'type'          =>  'radio',
                'choices'       =>  array(
                                        'male'      => __('Male'), 
                                        'female'    => __('Female'),
                                        'unknown'    => __('Unknown')
                                    )
            ));
    }
    
    /* function sanitize_tls_theme_size_name($value){
        $value = trim($value);
        if(empty($value)) $value = 'Spartan';
        return $value;
    } */