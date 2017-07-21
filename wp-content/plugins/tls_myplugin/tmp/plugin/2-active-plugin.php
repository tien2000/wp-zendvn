<?php
/*
Plugin Name: TIENLS MyPlugin
Plugin URI: http://www.webcuatui.com
Description: Tìm hiểu về cây thư mục của 1 plugin
Author: Tien Le
Version: 1.0
Author URI: http://www.webcuatui.com
*/

register_activation_hook(__FILE__, 'tls_mp_active');

/* $str = 'a:3:{s:4:"Name";s:7:"Tien Le";s:7:"Address";s:5:"12345";s:5:"Phone";s:5:"04312";}';

echo '<pre>';
	print_r(unserialize($str)); //chuyển định dạng chuỗi thành đúng định dạng mảng.
echo '</pre>'; */

/* ========================================
 * Ví dụ 1 Thêm giá trị vào bảng option
 * ======================================== */
/* function tls_mp_active()
 {
	$tls_mp_version = '1.0';
	add_option('tls_mp_version', $tls_mp_version, '', 'yes');
} */

/* ========================================
 * Ví dụ 2 Thêm giá trị mảng vào bảng option
 * ======================================== */
/* function tls_mp_active()
{
	$tls_mp_option = array(
				'Name' => 'Tien Le',
				'Address' => '12345',
				'Phone' => '04312'				
			);
	add_option('tls_mp_option', $tls_mp_option, '', 'yes');
} */

/* ========================================
 * Ví dụ 3: Tạo bảng cho plugin trong db trong quá trình kích hoạt plugin.
* ======================================== */
function tls_mp_active(){
	global $wpdb;
	$table_name = $wpdb->prefix . "tls_mp_test";
	if ($wpdb->get_var("SHOW TABLES LIKE '".$table_name."'") != $table_name){
		$sql = "CREATE TABLE `".$table_name."` (
		`myid` TINYINT(4) UNSIGNED NOT NULL AUTO_INCREMENT ,
		`myname` VARCHAR(50) NULL , PRIMARY KEY (`myid`))
		ENGINE = InnoDB CHARSET=utf8 AUTO_INCREMENT=1;";
		
		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta($sql);
	}
}

