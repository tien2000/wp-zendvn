<?php
class Tls_Mp_Count_Views{

	public function __construct(){
		//echo '<br/>' . __METHOD__;
		if(!is_admin()){
			add_action( 'wp_head', array($this,'set_post_views'));
		}else{
			//Them cot moi
			add_filter( 'manage_posts_columns' , array($this,'add_columns'));
			//Hien thi gia tri
			add_action( 'manage_posts_custom_column' ,array($this,'display_values'), 10, 2 );
			
			//
			add_filter( 'manage_edit-post_sortable_columns', array($this,'sortable_cols'));
			
			add_action( 'pre_get_posts', array($this,'orderby_cols' ));
			
			//Su dung file CSS
			add_action('admin_enqueue_scripts', array($this,'add_css_file'));
		
			
		}
		
	}
	
	public function set_post_views(){
		
		if ( !is_single() ) return;
		
		global $post;
		$postID = $post->ID;
		
		$count_key = 'tls_post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if($count==''){
			$count = 1;
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, $count);
		}else{
			$count++;
			update_post_meta($postID, $count_key, $count);
		}
	}
	
	
	function orderby_cols( $query ) {
		$count_key = 'tls_post_views_count';
	
		$orderby = $query->get( 'orderby');
	
		if( 'view' == $orderby ) {
			
			$meta_query = array(			
					'relation' => 'OR',					
					array(
					
							'key' => $count_key,					
							'compare' => 'NOT EXISTS',					
							'value' => '0',
					
					),
					array(			
							'key' => $count_key,
							
					)			
			);
			
			$query->set( 'meta_query', $meta_query );
			$query->set( 'meta_key', $count_key );
			$query->set( 'orderby', 'meta_value' );
			//echo '<br/>' . __METHOD__;
		}
		
		if( 'id' == $orderby ) {
			$query->set('orderby','ID');
		}
		
		
	}
	
	public function sortable_cols( $columns ) {
		
		$columns['id'] 		= 'ID';
		$columns['view'] 	= 'view';
		/* echo '<pre>';
		print_r($columns);
		echo '</pre>'; */
		return $columns;
	}
	
	public function add_columns( $columns ) {		
		
		$new_columns = array(
						'view' => __('View'),
						'id' => __( 'ID'),
						
					);
		return array_merge( $columns,$new_columns);
	}
	
	public function display_values( $column, $post_id ) {
		if($column == 'id'){
			echo $post_id;
		}
		if($column == 'view'){
			$count_key 	= 'tls_post_views_count';
			$count 		= get_post_meta($post_id, $count_key, true);
			$count		= (empty($count))? 0: $count;
			echo $count;
		}		
	}
	

	public function add_css_file(){
		wp_register_style('tls_mp_post_cols', TLS_MP_CSS_URL . '/post_cols.css', array(),'1.0');
		wp_enqueue_style('tls_mp_post_cols');
	}
	
}