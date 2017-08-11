<?php
/*
 * Plugin Name: TIENLS MyPlugin
 * Plugin URI: http://www.webcuatui.com
 * Description: Tự học lập trình Wordpress ZendVN
 * Author: Tien Le
 * Version: 1.0
 * Author URI: http://www.webcuatui.com
 */

define('TLS_PLUGIN_URL', plugin_dir_url( __FILE__ ));
define('TLS_PLUGIN_CSS_URL', TLS_PLUGIN_URL . 'css/');
define('TLS_PLUGIN_JS_URL', TLS_PLUGIN_URL . 'js/');
define('TLS_PLUGIN_IMAGES_URL', TLS_PLUGIN_URL . 'images/');


define('TLS_PLUGIN_DIR', plugin_dir_path( __FILE__ ));
define('TLS_PLUGIN_VIEWS_DIR', TLS_PLUGIN_DIR . '/views/');
define('TLS_PLUGIN_INCLUDES_DIR', TLS_PLUGIN_DIR . '/includes/');
define('TLS_PLUGIN_WIDGETS_DIR', TLS_PLUGIN_DIR . '/widgets/');
define('TLS_PLUGIN_SHORTCODES_DIR', TLS_PLUGIN_DIR . '/shortcodes/');
define('TLS_PLUGIN_METABOX_DIR', TLS_PLUGIN_DIR . '/metabox/');
define('TLS_PLUGIN_SETTINGS_DIR', TLS_PLUGIN_DIR . '/settings/');
define('TLS_PLUGIN_CUSTOMPOSTS_DIR', TLS_PLUGIN_DIR . '/posts/');
define('TLS_PLUGIN_TAXXONOMY_DIR', TLS_PLUGIN_DIR . '/taxonomys/');

if(!is_admin()){
    require_once TLS_PLUGIN_INCLUDES_DIR . 'public.php';
    new TlsMp();
}else{
    require_once TLS_PLUGIN_INCLUDES_DIR . 'html.php';
    require_once TLS_PLUGIN_INCLUDES_DIR . 'admin.php';
    require_once TLS_PLUGIN_WIDGETS_DIR . 'dashboard_simple.php';
    new TlsMpAdmin();
    new Tls_Mp_Dashboard_Widget_Simple();

    require_once TLS_PLUGIN_METABOX_DIR . 'main.php';
    new Tls_Mp_Metabox_Main();
}

////////////////// Khu vực cả font-end và back-end đều hiển thị ////////////////////
/* require_once TLS_PLUGIN_CUSTOMPOSTS_DIR . 'product.php';
new Tls_Mp_Cp_Product(); */

/* require_once TLS_PLUGIN_TAXXONOMY_DIR . 'book.php';
new Tls_Mp_CustomTaxonomy_BookCategory(); */

/* require_once TLS_PLUGIN_METABOX_DIR . 'taxonomy.php';
new Tls_Mp_Mb_Taxonomy(); */

require_once TLS_PLUGIN_CUSTOMPOSTS_DIR . 'count_views.php';
new Tls_Mp_Count_Views();


/* require_once TLS_PLUGIN_SHORTCODES_DIR . 'main.php';
 new Tls_Mp_Sc_Main(); */

//////////// last_post //////////////
/* require_once TLS_PLUGIN_WIDGETS_DIR . 'last_post.php';
add_action('widgets_init', 'registerMyWidgetLastPost');
function registerMyWidgetLastPost(){
    register_widget('Tls_Mp_Widget_Last_Post');
} */

/*require_once TLS_PLUGIN_WIDGETS_DIR . 'simple.php';

add_action( 'widgets_init', 'registerMyWidgetSimple' );

function registerMyWidgetSimple(){
    register_widget( 'Tls_Mp_Widget_Simple' );
}

add_action( 'widgets_init', 'tls_mp_widget_remove' );
function tls_mp_widget_remove(){
    unregister_widget( 'Tls_Mp_Widget_Simple' );
}*/
