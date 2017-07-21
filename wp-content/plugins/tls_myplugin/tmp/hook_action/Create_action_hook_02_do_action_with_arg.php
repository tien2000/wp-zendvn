<?php
/*
Plugin Name: TIENLS MyPlugin
Plugin URI: http://www.webcuatui.com
Description: Tìm hiểu về cây thư mục của 1 plugin
Author: Tien Le
Version: 1.0
Author URI: http://www.webcuatui.com
*/

add_action('new_action_hook', 'new_action_callback', 10, 3);

function new_action_callback($courseName, $author, $year){
	echo 'Tự học '.$courseName . ' của ' . $author . ' năm ' . $year;
}

function tls_mp_new_hook($courseName = 'Wordpress', $author = 'TienLS', $year = '2017'){
	do_action('new_action_hook', $courseName, $author, $year);
}