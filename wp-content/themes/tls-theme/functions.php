<?php 
/* <!--[if lt IE 9]>
		<script src="js/html5.js" type="text/javascript"></script>
<![endif]-->
<meta name='robots' content='noindex,follow' />

<script type='text/javascript' src='http://localhost/wp-zendvn/wp-content/themes/tls-theme/js/jquery/jquery.js'></script>
<script type='text/javascript' src='http://localhost/wp-zendvn/wp-content/themes/tls-theme/js/jquery/jquery-migrate.min.js'></script>

/* 
 * get_template_directory(): Đường dẫn tuyệt đối đến thư mục chứa theme.
 * get_template_directory_uri(): Đường dẫn(url) đến thư mục theme/
 * 
 * $wp_styles->add_data('tls_theme_ie8', 'conditional', 'IE 8'): Gọi tập tin ie8.css khi trình duyệt là IE 8
 *  */

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
    
    wp_register_style('tls_theme_ie8', $cssUrl . 'ie8.css', array(), '1.0');
    $wp_styles->add_data('tls_theme_ie8', 'conditional', 'IE 8');
    wp_enqueue_style('tls_theme_ie8');
}
	