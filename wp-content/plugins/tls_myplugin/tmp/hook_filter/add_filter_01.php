<?php 
require_once TLS_MP_PLUGIN_DIR . 'include/support.php';
	class TlsMp{
		public function __construct(){
			//=======================================================
			// 1. Thay đổi nội dung title trong hook the_title
			//=======================================================
			//add_filter('the_title', array($this, 'changeTitle'));
			
			//=======================================================
			// 2. Thay đổi nội dung title trong hook the_title có tham số
			//=======================================================
			//add_filter('the_title', array($this, 'changeTitle2'), 10, 2);
			
			//=======================================================
			// 3. Thay đổi nội dung title trong hook the_title có tham số
			//=======================================================
			//add_filter('the_title', array($this, 'changeTitle3'), 10, 2);
			
			//=======================================================
			// 4. Hiển thị các action đang thực thi trong Hook.
			//=======================================================
			add_action('wp_footer', array($this, 'showFunction'));
			
			//=======================================================
			// 5. Sử dụng tham số $content trong Hook the_content
			//=======================================================
			//add_filter('the_content', array($this, 'changeContent'), 10, 1);
			
			//=======================================================
			// 6. Sử dụng tham số $content trong Hook the_content
			//=======================================================
			//add_filter('the_content', array($this, 'changeContent2'), 10, 1);
			
			//=======================================================
			// 7. Sử dụng tham số $content trong Hook the_content
			//=======================================================
			add_filter('the_content', array($this, 'changeContent3'), 10, 1);
		}
		
		//=======================================================
		// 1. Thay đổi nội dung title trong hook the_title
		//=======================================================
		function changeTitle(){
			$str = 'Thay đổi nội dung title';
			return $str;
		}
		
		//=======================================================
		// 2. Thay đổi nội dung title trong hook the_title có tham số
		//=======================================================
		function changeTitle2($title, $id){
			if($id == 1){
				$title = str_replace('Hello world!', 'My world', $title);
				return $title;
			}
		}
		
		//=======================================================
		// 3. Thay đổi nội dung title trong hook the_title có tham số
		//=======================================================
		function changeTitle3($title, $id){
			if($id == 1){
				$title = 'Tui thích thì tui đổi thôi';
				return $title;
			}
		}
		
		//=======================================================
		// 4. Hiển thị các action đang thực thi trong Hook.
		//=======================================================
		public function showFunction(){
			TlsMpSupport::showFunc();
		}
		
		//=======================================================
		// 5. Sử dụng tham số $content trong Hook the_content
		//=======================================================
		public function changeContent($content){
			$content .= 'Thích thì xóa thôi';
			return $content;
		}
		
		//=======================================================
		// 6. Sử dụng tham số $content trong Hook the_content
		//=======================================================
		public function changeContent2($content){
			$content = str_replace('WordPress', 'WP', $content);
			return $content;
		}
		
		//=======================================================
		// 7. Sử dụng tham số $content trong Hook the_content
		//=======================================================
		public function changeContent3($content){
			global $post;
			/* echo '<pre>';
			print_r($post->post_type);			
			echo '</pre>'; */
			
			if($post->post_type == 'page'){
				$content .= 'Chuỗi thêm vào page'; 
			}
			return $content;
		}
	}
?>