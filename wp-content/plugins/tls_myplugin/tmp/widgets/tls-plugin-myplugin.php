<?php
/*
 * Plugin Name: TIENLS MyPlugin
 * Plugin URI: http://www.webcuatui.com
 * Description: Tự học lập trình Wordpress với ZendVN
 * Author: Tien Le
 * Version: 1.0
 * Author URI: http://www.webcuatui.com
 */

define('TLS_PLUGIN_URL', plugin_dir_url( __FILE__ ));
define('TLS_PLUGIN_CSS_URL', TLS_PLUGIN_URL . 'css/');
define('TLS_PLUGIN_JS_URL', TLS_PLUGIN_URL . 'js/');


define('TLS_PLUGIN_DIR', plugin_dir_path( __FILE__ ));
define('TLS_PLUGIN_VIEWS_DIR', TLS_PLUGIN_DIR . '/views/');
define('TLS_PLUGIN_INCLUDES_DIR', TLS_PLUGIN_DIR . '/includes/');
define('TLS_PLUGIN_WIDGETS_DIR', TLS_PLUGIN_DIR . '/widgets/');

if(!is_admin()){
    require_once TLS_PLUGIN_INCLUDES_DIR . 'public.php';
    new TlsMp();
}else{
    require_once TLS_PLUGIN_INCLUDES_DIR . 'html.php';
    require_once TLS_PLUGIN_INCLUDES_DIR . 'admin.php';
    require_once TLS_PLUGIN_WIDGETS_DIR . 'dashboard_simple.php';
    new TlsMpAdmin();
    new Tls_Mp_Dashboard_Widget_Simple();    
}

/*require_once TLS_PLUGIN_WIDGETS_DIR . 'simple.php';

add_action( 'widgets_init', 'registerMyWidgetSimple' );

function registerMyWidgetSimple(){
    register_widget( 'Tls_Mp_Widget_Simple' );
}

add_action( 'widgets_init', 'tls_mp_widget_remove' );
function tls_mp_widget_remove(){
    unregister_widget( 'Tls_Mp_Widget_Simple' );
}*/
