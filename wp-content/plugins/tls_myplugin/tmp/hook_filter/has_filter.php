<?php
require_once TLS_MP_PLUGIN_DIR . 'include/support.php'; 
	class TlsMp{
		public function __construct(){
			//add_filter('the_title', array($this, 'changeTitle'));
			//add_filter('the_content', array($this, 'changeTitleWithArgs'), 123);			
			
			add_action('wp_footer', array($this, 'showFunction'));
			
			//======================================================
			// Kiểm tra tồn tại của Hook.
			//======================================================
			echo '<br />' . has_filter('the_content', 'convert_smilies');
			//echo '<br />' . has_filter('the_content', array($this, 'changeTitleWithArgs'));
			
			if(has_filter('the_content', 'convert_smilies', 20) != null){
				remove_filter('the_content', 'convert_smilies', 20);
				add_filter('the_content', array($this, 'newSmilles'), 20, 1);
			}
		}
		
		public function newSmilles($content){
			// Hàm xử lý.
			return $content;
		}		
		
		public function changeTitleWithArgs(){
			$title = 'Đổi title';
			return $title;
		}		
		
		public function showFunction(){
			TlsMpSupport::showFunc('the_content');
		}
	}
?>