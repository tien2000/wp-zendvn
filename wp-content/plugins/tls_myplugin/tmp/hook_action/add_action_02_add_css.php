<?php
/*
Plugin Name: TIENLS MyPlugin
Plugin URI: http://www.webcuatui.com
Description: Tìm hiểu về cây thư mục của 1 plugin
Author: Tien Le
Version: 1.0
Author URI: http://www.webcuatui.com
*/

add_action('wp_head', 'tls_mp_new_css');

function tls_mp_new_css(){
	$cssUrl = plugins_url('/css/abc.css', __FILE__);
	$css = '<link rel="stylesheet" type="text/css" media="all" href="' . $cssUrl . '" />';
	echo $css;
}