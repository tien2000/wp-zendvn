<?php
class Tls_Theme_Widget_Social extends WP_Widget {

	//private $_cache_name = 'tls_mp_wg_last_post_caching';
	public function __construct() {
		//echo '<br/>' . __METHOD__;
		$id_base = 'tls-theme-widget-social';
		$name	= 'Tls Social';
		$widget_options = array(
					'classname' => 'widget_wpex_social_widget',
					'description' => 'Show Social'
				);
		$control_options = array('width'=>'350px');
		parent::__construct($id_base, $name, $widget_options, $control_options);	

	}	
	public function widget( $args, $instance ) {
	
		extract($args);
	
		$title = apply_filters('widget_title', $instance['title']);
		$title = (empty($title))? '': $title;
		
		echo $before_widget;
		if(!empty($title)){
			echo $before_title . $title . $after_title;
		}
		
		require TLS_THEME_WIDGETS_HTML_DIR . 'social.php';
		
		wp_reset_postdata();
		echo $after_widget;
	}
	
	public function update( $new_instance, $old_instance ) {
	
		$instance = $old_instance;
	
		$instance['title'] 		= strip_tags($new_instance['title']);
		$instance['content'] 	= strip_tags($new_instance['content']);
		$instance['twitter'] 	= strip_tags($new_instance['twitter']);
		$instance['facebook'] 	= strip_tags($new_instance['facebook']);
		$instance['google_plus']= strip_tags($new_instance['google_plus']);
		$instance['dribbble'] 	= strip_tags($new_instance['dribbble']);
	
		return $instance;
	}
	
	public function form( $instance ) {
	
		/* echo '<pre>';
		 print_r($instance);
		echo '</pre>'; */
		$htmlObj =  new TlsHtml();
			
		//Tao phan tu chua Title
		$inputID 	= $this->get_field_id('title');
		$inputName 	= $this->get_field_name('title');
		$inputValue = @$instance['title'];
		$arr = array('class' =>'widefat','id' => $inputID);
		$html		= $htmlObj->label(translate('Title'),array('for'=>$inputID))
					. $htmlObj->textbox($inputName,$inputValue,$arr);
		echo $htmlObj->pTag($html);
		
		//Tao phan tu chua Content
		$inputID 	= $this->get_field_id('content');
		$inputName 	= $this->get_field_name('content');
		$inputValue = @$instance['content'];
		$arr 		= array('class' =>'widefat','id' => $inputID);
		$html		= $htmlObj->label(translate('Content'),array('for'=>$inputID))
					  . $htmlObj->textbox($inputName,$inputValue,$arr);
		echo $htmlObj->pTag($html);
		
		
		//Tao phan tu chua twitter
		$inputID 	= $this->get_field_id('twitter');
		$inputName 	= $this->get_field_name('twitter');
		$inputValue = @$instance['twitter'];
		$arr 		= array('class' =>'widefat','id' => $inputID);
		$html		= $htmlObj->label(translate('Twitter link'),array('for'=>$inputID))
					. $htmlObj->textbox($inputName,$inputValue,$arr);
		echo $htmlObj->pTag($html);
		
		//Tao phan tu chua facebook
		$inputID 	= $this->get_field_id('facebook');
		$inputName 	= $this->get_field_name('facebook');
		$inputValue = @$instance['facebook'];
		$arr 		= array('class' =>'widefat','id' => $inputID);
		$html		= $htmlObj->label(translate('Facebook link'),array('for'=>$inputID))
		. $htmlObj->textbox($inputName,$inputValue,$arr);
		echo $htmlObj->pTag($html);
		
		//Tao phan tu chua google-plus
		$inputID 	= $this->get_field_id('google_plus');
		$inputName 	= $this->get_field_name('google_plus');
		$inputValue = @$instance['google_plus'];
		$arr 		= array('class' =>'widefat','id' => $inputID);
		$html		= $htmlObj->label(translate('Google plus link'),array('for'=>$inputID))
					. $htmlObj->textbox($inputName,$inputValue,$arr);
		echo $htmlObj->pTag($html);
		
		//Tao phan tu chua dribbble
		$inputID 	= $this->get_field_id('dribbble');
		$inputName 	= $this->get_field_name('dribbble');
		$inputValue = @$instance['dribbble'];
		$arr 		= array('class' =>'widefat','id' => $inputID);
		$html		= $htmlObj->label(translate('Dribbble link'),array('for'=>$inputID))
		. $htmlObj->textbox($inputName,$inputValue,$arr);
		echo $htmlObj->pTag($html);
	}
	

}
