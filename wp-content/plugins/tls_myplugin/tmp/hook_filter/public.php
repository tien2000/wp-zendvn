<?php 
require_once TLS_PLUGIN_DIR . 'includes/support.php';
	class TlsMp{
		public function __construct(){
			//add_filter('the_title', array($this, 'changeTitle'));
			//add_filter('the_title', array($this, 'changeTitleWithArgs'), 10, 2);
			//add_filter('the_title', array($this, 'changeTitleWithArgs2'), 10, 2);
			
			add_action('wp_footer',array($this, 'showFunction'));
			
			//add_filter('the_content', array($this, 'changeContent'));
			//add_filter('the_content', array($this, 'changeContentWithArgs'), 10, 1);
			//add_filter('the_content', array($this, 'changeContentWithArgs2'), 10, 1);
			
			//remove_filter('the_content', 'convert_smilies', 20);
			
			/* if(has_filter('the_content', 'convert_smilies', 20)){
				remove_filter('the_content', 'convert_smilies',20);
				add_filter('the_content', array($this, 'myNewSmilies'));
			} */
			
			add_filter('the_title',array($this, 'changeString'), 10);
			add_filter('the_content',array($this, 'changeString'), 10);
		}
		
		public function changeString($text){
			if(current_filter() == 'the_title'){
				if(!is_page()){
					$text .= ' - my title'; 
				}
			}
			if(current_filter() == 'the_content'){
				$text = str_replace('This is an example page', 'Đây là trang ví dụ', $text);
			}
			return $text;
		}
		
		public function myNewSmilies(){
			//code;
		}
		
		public function changeContentWithArgs2($content){
			global $post;
			if($post->post_type == 'page'){
				$content .= 'Thêm nội dung cuối bài viết';
				return $content;				
			}	
			return $content;
		}
		
		public function changeContentWithArgs($content){
			$content = str_replace('Welcome to WordPress', 'Nội dung được thay đổi', $content);
			return $content;
		}
		
		public function changeContent(){
			$str = 'Thay đổi nội dung bài viết';
			return $str;
		}
		
		public function showFunction(){
			TlsMpSupport::showFunc('the_content');
		}
		
		public function changeTitle(){
			$str = 'Thay đổi title bài viết';
			return $str;
		}
		
		public function changeTitleWithArgs($title, $id){
			if($id == 1){
				$title = 'Thay đổi title bài viết nếu là post';
				return $title;
			}
			return $title;
		}
		
		public function changeTitleWithArgs2($title, $id){
			if($id == 1){
				$title = str_replace('Hello', 'Xin chào', $title);
				return $title;
			}
			return $title;
		}
	}
?>