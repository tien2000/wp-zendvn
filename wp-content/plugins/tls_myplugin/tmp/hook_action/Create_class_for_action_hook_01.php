<?php
/*
Plugin Name: TIENLS MyPlugin
Plugin URI: http://www.webcuatui.com
Description: Tìm hiểu về cây thư mục của 1 plugin
Author: Tien Le
Version: 1.0
Author URI: http://www.webcuatui.com
*/

$includeDir = plugin_dir_path(__FILE__) . 'include/public.php';
require_once  $includeDir;

$tlsMp = new TlsMp();
add_action('wp_footer', array($tlsMp, 'newFooter'));
add_action('wp_footer', array($tlsMp, 'newFooter2'));