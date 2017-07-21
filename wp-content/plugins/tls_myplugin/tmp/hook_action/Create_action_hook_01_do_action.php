<?php
/*
Plugin Name: TIENLS MyPlugin
Plugin URI: http://www.webcuatui.com
Description: Tìm hiểu về cây thư mục của 1 plugin
Author: Tien Le
Version: 1.0
Author URI: http://www.webcuatui.com
*/

add_action('new_action_hook', 'new_action_callback');

function new_action_callback(){
	echo 'Test new action callback';
}

function tls_mp_new_hook(){
	do_action('new_action_hook');
}