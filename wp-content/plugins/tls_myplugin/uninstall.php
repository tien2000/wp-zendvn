<?php
if(!defined('WP_UNINSTALL_PLUGIN')){
	exit();
}
tls_mp_uninstall();
function tls_mp_uninstall(){
	global $wpdb;
	//OPTION API
	delete_option('tls_mp_version');
	delete_option('tls_mp_option');

	$table_name = $wpdb->prefix . 'tls_mp_test';
	$sql = 'DROP TABLE wp4_tls_mp_test';
	$wpdb->query($sql);
}