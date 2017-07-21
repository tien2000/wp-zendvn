<?php
/*
Plugin Name: TIENLS MyPlugin
Plugin URI: http://www.webcuatui.com
Description: Tìm hiểu về cây thư mục của 1 plugin
Author: Tien Le
Version: 1.0
Author URI: http://www.webcuatui.com
*/

define('TLS_MP_PLUGIN_URL', plugin_dir_url(__FILE__));
define('TLS_MP_PLUGIN_DIR', plugin_dir_path(__FILE__));

if(!is_admin()){
	require_once TLS_MP_PLUGIN_DIR . 'include/public.php';
	new TlsMp();
}else {
	
}

