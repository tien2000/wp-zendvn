<?php
require_once TLS_MP_PLUGIN_DIR . 'include/support.php'; 
	class TlsMp{
		public function __construct(){
			//add_filter('the_title', array($this, 'changeTitle'));
			add_filter('the_title', array($this, 'changeTitleWithArgs'), 10, 2);			
			
			add_action('wp_footer', array($this, 'showFunction'));
						
			//===========================================================
			// Xóa filter hook
			//============= Xóa biểu tượng cảm xúc trong bài viết =================
			remove_filter('the_content', 'convert_smilies', 20);
			
			//============= Xóa title của bài viết =================
			remove_filter('the_title', array($this, 'changeTitleWithArgs'));
			
			//============= Xóa toàn bộ filter hook theo độ ưu tiên =================
			remove_all_filters('the_content', 10);
			
			//============= Xóa toàn bộ filter hook =================
			remove_all_filters('the_content');
			//===========================================================
		}
		
		
		public function changeTitleWithArgs($title, $id){
			$title = 'Đổi title có tham số';
			return $title;
		}		
		
		public function showFunction(){
			TlsMpSupport::showFunc('the_content');
		}
	}
?>