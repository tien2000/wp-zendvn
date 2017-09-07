<?php
class Tls_Theme_Widget_Tabs extends WP_Widget {

	//private $_cache_name = 'tls_mp_wg_last_post_caching';
	public function __construct() {
		//echo '<br/>' . __METHOD__;
		$id_base = 'tls-theme-widget-tabs';
		$name	= 'Tls Tabs';
		$widget_options = array(
					'classname' => 'widget_wpex_tabs_widget',
					'description' => 'Show Tabs '
				);
		$control_options = array('width'=>'250px');
		parent::__construct($id_base, $name,$widget_options, $control_options);	

	}	
	
	public function widget( $args, $instance ) {
	
		extract($args);
	
		$title = apply_filters('widget_title', @$instance['title']);
		$title = (empty($title))? '': $title;
	
		echo $before_widget;
		if(!empty($title)){
			echo $before_title . $title . $after_title;
		}
		
		/*
		 * XU LY MA HIEN THI CHO WIDGET
		 */
		require TLS_THEME_WIDGETS_HTML_DIR . 'tabs.php';
		echo $after_widget;
	}
	
	public function update( $new_instance, $old_instance ) {
	
		$instance = $old_instance;
	
		$instance['popular_title'] 		= strip_tags($new_instance['popular_title']);
		$instance['popular_items'] 		= strip_tags($new_instance['popular_items']);
		$instance['recent_title'] 		= strip_tags($new_instance['recent_title']);
		$instance['recent_items'] 		= strip_tags($new_instance['recent_items']);
		$instance['comment_title']		= strip_tags($new_instance['comment_title']);
		$instance['comment_items'] 		= strip_tags($new_instance['comment_items']);
		
	
		return $instance;
	}
	
	public function form( $instance ) {
	
		/* echo '<pre>';
		 print_r($instance);
		echo '</pre>'; */
		$htmlObj =  new TlsHtml();
		/* Popular
		Recent
		Comment */
		
		//Tao phan tu chua Popular title
		$inputID 	= $this->get_field_id('popular_title');
		$inputName 	= $this->get_field_name('popular_title');
		$inputValue = @$instance['popular_title'];
		$arr = array('class' =>'widefat','id' => $inputID);
		$html		= $htmlObj->label(translate('Popular title'),array('for'=>$inputID))
					. $htmlObj->textbox($inputName,$inputValue,$arr);
		echo $htmlObj->pTag($html);
		
		//Tao phan tu chua Popular items
		$inputID 	= $this->get_field_id('popular_items');
		$inputName 	= $this->get_field_name('popular_items');
		$inputValue = @$instance['popular_items'];
		$arr 		= array('class' =>'widefat','id' => $inputID);
		$html		= $htmlObj->label(translate('Items'),array('for'=>$inputID))
						. $htmlObj->textbox($inputName,$inputValue,$arr);
		echo $htmlObj->pTag($html);
		
		//Tao phan tu chua Recent title
		$inputID 	= $this->get_field_id('recent_title');
		$inputName 	= $this->get_field_name('recent_title');
		$inputValue = @$instance['recent_title'];
		$arr 		= array('class' =>'widefat','id' => $inputID);
		$html		= $htmlObj->label(translate('Recent title'),array('for'=>$inputID))
						. $htmlObj->textbox($inputName,$inputValue,$arr);
		echo $htmlObj->pTag($html);
		
		//Tao phan tu chua Popular items
		$inputID 	= $this->get_field_id('recent_items');
		$inputName 	= $this->get_field_name('recent_items');
		$inputValue = @$instance['recent_items'];
		$arr 		= array('class' =>'widefat','id' => $inputID);
		$html		= $htmlObj->label(translate('Items'),array('for'=>$inputID))
						. $htmlObj->textbox($inputName,$inputValue,$arr);
		echo $htmlObj->pTag($html);
		
		//Tao phan tu chua Comment title
		$inputID 	= $this->get_field_id('comment_title');
		$inputName 	= $this->get_field_name('comment_title');
		$inputValue = @$instance['comment_title'];
		$arr 		= array('class' =>'widefat','id' => $inputID);
		$html		= $htmlObj->label(translate('Comment title'),array('for'=>$inputID))
		. $htmlObj->textbox($inputName,$inputValue,$arr);
		echo $htmlObj->pTag($html);
		
		//Tao phan tu chua Popular items
		$inputID 	= $this->get_field_id('comment_items');
		$inputName 	= $this->get_field_name('comment_items');
		$inputValue = @$instance['comment_items'];
		$arr 		= array('class' =>'widefat','id' => $inputID);
		$html		= $htmlObj->label(translate('Items'),array('for'=>$inputID))
		. $htmlObj->textbox($inputName,$inputValue,$arr);
		echo $htmlObj->pTag($html);
	
	}

	private function get_img_url($post_content) {
		
		$image  = '';
		if(!empty($post_content)){	
			preg_match_all( '|<img.*?src=[\'"](.*?)[\'"].*?>|i', $post_content, $matches );
		}
	
		if ( isset( $matches ) ) $image = $matches[1][0];
		
		return $image;
	}
}