<?php
/*
Plugin Name: TIENLS MyPlugin
Plugin URI: http://www.webcuatui.com
Description: Tìm hiểu về cây thư mục của 1 plugin
Author: Tien Le
Version: 1.0
Author URI: http://www.webcuatui.com
*/

register_deactivation_hook(__FILE__, 'tls_mp_deactive');

function tls_mp_deactive(){
	global $wpdb;
	$table_name = $wpdb->prefix . 'options';
	$wpdb->update(
			$table_name, 
			array('autoload'=>'no'),
			array('option_name'=>'tls_mp_option'),
			array('%s'),  // %s đại diện cho 1 chuỗi
			array('%s')   // %d đại diện cho 1 số
			);
	$wpdb->update(
			$table_name,
			array('autoload'=>'no'), 
			array('option_name'=>'tls_mp_version'),
			array('%s'),
			array('%s')
			);
}