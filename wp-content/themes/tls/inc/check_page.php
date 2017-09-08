<?php
class Check_Page{
	private $_is_arr = array();
	
	public function __construct(){	
		
		$this->check();
	
	}
	
	public function check(){
		if(is_404()) 				$this->is404();
	
		if(is_search()) 			$this->isSearch();
	
		if(is_archive()) 			$this->isArchive();
	
		if(is_singular()) 			$this->isSingular();
	
		if(is_front_page()) 		echo '<br/>is_front_page';
	
		if(is_home()) 				echo '<br/>is_home';
	
		if(is_comments_popup()) 	echo '<br/>is_comments_popup';
	}
	
	public function is404(){
		$tmp = array();		
		$tmp['function'] 	= 'is_404()';
		$tmp['page'] 		= '404.php';
		
		echo '<pre>';
		print_r($tmp);
		echo '</pre>';
		
	}
	
	public function isSearch(){
		$tmp = array();		
		$tmp['function'] 	= 'is_search()';
		$tmp['page'] 		= 'search.php';
		
		echo '<pre>';
		print_r($tmp);
		echo '</pre>';
	}
	
	public function isSingular(){
		//echo '<br/>' . __METHOD__;
		global $wp_query;
	
		if(is_single()){
			
			if(!is_attachment()){
				$postType = $wp_query->queried_object->post_type;
				if($postType == 'post'){
					$tmp['function'] 	= 'is_singular() -> is_single() -> post_type = post';
					$tmp['page'] 		= 'index.php -> single.php -> single-post.php';
				}else{
					$tmp['function'] 	= 'is_singular() -> is_single() -> post_type != post';
					$tmp['page'] 		= 'index.php -> single.php -> single-'. $postType . '.php';
				}
			}else{				
				$tmp['function'] 	= 'is_singular() -> is_single() -> is_attachment()';
				$tmp['page'] 		= 'index.php -> single.php -> attachment.php';			
			}
			
		}
		
		if(is_page()){
			$tmp['function'] 	= 'is_singular() -> is_single()';
			$tmp['page'] 		= 'index.php -> page.php';
		}
		echo '<pre>';
		print_r($tmp);
		echo '</pre>';
	}
	
	public function isArchive(){
		global $wp_query;
		get_query_var('cat');		
		
		$tmp = array();
		
		if(is_tax()){
			$tmp[] = 'is_tax -> taxonomy.php';
		}
	
		if(is_category()){
			
			$tmp['function'] = 'is_archive() -> is_category()'; 			
			$mySlug 	= 'category-' . $wp_query->queried_object->slug . '.php';
			$myId 		= 'category-' . $wp_query->queried_object->cat_ID . '.php';				
			$tmp['page'] = 'index.php -> archive.php -> category.php -> ' . $myId . ' -> ' . $mySlug;
		}
	
		if(is_tag()){
						
			$tmp['function'] = 'is_archive() -> is_tag()';
			$mySlug 	= 'tag-' . $wp_query->queried_object->slug . '.php';
			$myId 		= 'tag-' . $wp_query->queried_object->term_id . '.php';
			$tmp['page'] = 'index.php -> archive.php -> tag.php -> ' . $myId . ' -> ' . $mySlug;
		}
	
		if(is_author()){
	
		}
	
		if(is_date()){
			if(is_year()) 
				$tmp[] = 'is_year -> date.php';
			if(is_month()) 
				$tmp[] = 'is_month -> date.php';
			if(is_day()) 
				$tmp[] = 'is_day -> date.php';
		}
	
		if(is_post_type_archive()){
	
		}
	
		echo '<pre>';
		print_r($tmp);
		echo '</pre>';
	
	}
	

}