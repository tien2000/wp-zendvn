<?php
/* 
 * get_template_directory(): Đường dẫn tuyệt đối đến thư mục chứa theme.
 * get_template_directory_uri(): Đường dẫn(url) đến thư mục theme/
 * 
 * $wp_styles->add_data('tls_theme_ie8', 'conditional', 'IE 8'): Gọi tập tin ie8.css khi trình duyệt là IE 8
 * 
 * 'widget_init': Hook hiển thị widget cho theme
 * 'after_setup_theme': Hook thêm hỗ trợ cho theme.
 * add_theme_support( 'post-formats', array() ): Khai báo cho phần Format trong Post/Page.
 * add_theme_support( 'post-thumbnails' ): Khai báo phần Featured Image trong Post/Page.
 *  */

define('TLS_THEME_URL', get_template_directory_uri());

define('TLS_THEME_DIR', get_template_directory());
define('TLS_THEME_INC_DIR', TLS_THEME_DIR . '/inc/');
define('TLS_THEME_WIDGETS_DIR', TLS_THEME_INC_DIR . 'widgets/');
define('TLS_THEME_WIDGETS_HTML_DIR', TLS_THEME_WIDGETS_DIR . 'html/');

/* ============================================================
 * 5. Gọi các tập tin
 * ============================================================ */
if(!class_exists('TlsHtml') && is_admin()){
    require_once TLS_THEME_INC_DIR . 'html.php';
}


require_once TLS_THEME_WIDGETS_DIR . 'main.php';
new Tls_Theme_Wg_Main();

/* ============================================================
 * 4. Hiển thị Widget cho Theme
 * ============================================================ */
add_action('widgets_init', 'tls_theme_widget_init');

function tls_theme_widget_init(){
    register_sidebar(array(
       'name'          => __( 'Primary Widget Area', 'Tls Widget' ),
	   'id'            => 'primary-widget-area',
       'description'   => __( 'Right Widget on Website', 'tls Widget' ),
       'class'         => '',
	   'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s clr">',
       'after_widget'  => '</div>',
       'before_title'  => '<span class="widget-title">',
       'after_title'   => '</span>'
    ));    
    
    register_sidebar(array(
        'name'          => __( 'Top Content Area', 'Tls Widget' ),
        'id'            => 'top-content-widget-area',
        'description'   => __( 'Top Widget on Website', 'tls Widget' ),
        'class'         => '',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '',
        'after_title'   => ''
    ));
}

/* ============================================================
 * 3. Nạp JS vào theme
 * ============================================================ */
add_action('after_setup_theme', 'tlsThemePostFormat');

function tlsThemePostFormat(){
    // array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' )
    add_theme_support( 'post-formats', array('aside', 'image', 'gallery', 'video', 'audio') );
    add_theme_support( 'post-thumbnails' );
}

	
/* ============================================================
 * 3. Nạp JS vào theme
 * ============================================================ */
add_action('wp_enqueue_scripts', 'tls_theme_register_script');
	
function tls_theme_register_script(){
    $jsUrl = get_template_directory_uri() . '/js/';
    
    wp_register_script('tls_theme_jquery_form_min', $jsUrl . 'jquery.form.min.js', array('jquery'), '1.0', true );
    wp_enqueue_script('tls_theme_jquery_form_min');
    
    wp_register_script('tls_theme_scripts', $jsUrl . 'scripts.js', array('jquery'), '1.0', true );
    wp_enqueue_script('tls_theme_scripts');
    
    wp_register_script('tls_theme_plugins', $jsUrl . 'plugins.js', array('jquery'), '1.0', true );
    wp_enqueue_script('tls_theme_plugins');
    
    wp_register_script('tls_theme_global', $jsUrl . 'global.js', array('jquery'), '1.0', true );
    wp_enqueue_script('tls_theme_global');
    
}

add_action('wp_footer', 'tls_theme_script_code');

function tls_theme_script_code(){
    echo '<script type=\'text/javascript\'>
    var wpexLocalize = {
        "mobileMenuOpen" : "Browse Categories",
        "mobileMenuClosed" : "Close navigation",
        "homeSlideshow" : "false",
        "homeSlideshowSpeed" : "7000",
        "UsernamePlaceholder" : "Username",
        "PasswordPlaceholder" : "Password",
        "enableFitvids" : "true"
    };
    </script>';
}

/* ============================================================
 * 1. Nạp CSS vào theme
 * ============================================================ */

add_action('wp_enqueue_scripts', 'tls_theme_register_style');

function tls_theme_register_style(){
    global $wp_styles;
    $cssUrl = get_template_directory_uri() . '/css/';
    
    wp_register_style('tls_theme_symple_shortcodes', $cssUrl . 'symple_shortcodes_styles.css', array(), '1.0');
    wp_enqueue_style('tls_theme_symple_shortcodes');
    
    wp_register_style('tls_theme_style', $cssUrl . 'style.css', array(), '1.0');
    wp_enqueue_style('tls_theme_style');
    
    wp_register_style('tls_theme_responsive', $cssUrl . 'responsive.css', array(), '1.0');
    wp_enqueue_style('tls_theme_responsive');    
    
    wp_register_style('tls_theme_site', $cssUrl . 'site.css', array(), '1.0');
    wp_enqueue_style('tls_theme_site');
    
    wp_register_style('tls_theme_customize', $cssUrl . 'customize.css', array(), '1.0');
    wp_enqueue_style('tls_theme_customize');
    
    wp_register_style('tls_theme_ie8', $cssUrl . 'ie8.css', array(), '1.0');
    $wp_styles->add_data('tls_theme_ie8', 'conditional', 'IE 8');
    wp_enqueue_style('tls_theme_ie8');
}
	