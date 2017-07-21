<?php
/*
Plugin Name: TIENLS MyPlugin
Plugin URI: http://www.webcuatui.com
Description: Tìm hiểu về cây thư mục của 1 plugin
Author: Tien Le
Version: 1.0
Author URI: http://www.webcuatui.com
*/

class TlsMp{
	public function __construct(){
		add_action('wp_footer', array($this, 'newFooter'));
		add_action('wp_footer', array($this, 'newFooter2'));
	}
	
	public function newFooter(){
		echo 'Hello World';
	}
	
	public function newFooter2(){
		echo '<br/> Hello World 2';
	}
}

new TlsMp();