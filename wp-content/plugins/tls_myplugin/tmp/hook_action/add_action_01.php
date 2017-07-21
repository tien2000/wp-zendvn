<?php
/*
Plugin Name: TIENLS MyPlugin
Plugin URI: http://www.webcuatui.com
Description: Tìm hiểu về cây thư mục của 1 plugin
Author: Tien Le
Version: 1.0
Author URI: http://www.webcuatui.com
*/
add_action('wp_footer', 'tls_wp_footer2', 18);
add_action('wp_footer', 'tls_wp_footer2', 19);
add_action('wp_footer', 'tls_mp_exam_action_hook', 19);

function tls_mp_exam_action_hook(){
	echo '<div>Ví dụ của action Hook</div>';
}

function tls_wp_footer2(){
	echo '<div>Hello World!</div>';
}