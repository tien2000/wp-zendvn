<?php
/* 
 * 
 *  */

class Tls_Theme_Wg_SearchForm extends WP_Widget{
    public function __construct(){
		$id_base = 'tls-mp-widget-search-form';
		$name = 'Tls Search Form Widget';
		$widget_options = array(
			'classname' => 'widget_search',
			'description' => 'This is my search form widget'
		);
		$control_options = array(
			'width' => '250px',
		);

		parent::__construct($id_base, $name, $widget_options, $control_options);
		
	}

	public function addFileJS(){
		wp_register_script( 'wp-tls', TLS_PLUGIN_JS_URL . 'wp_tls.js', array('jquery'), '1.0', false );
		wp_enqueue_script( 'wp-tls' );
	}

	public function addJS(){
		$jsUrl = TLS_PLUGIN_JS_URL . 'wp_tls.js';

		//$output = '<script>alert("Page is loading...")</script>';
		$output = '<script type="text/javascript" src="'. $jsUrl .'"></script>';
		echo $output;
	}
	
	public function addFileCSS(){
		wp_enqueue_style( 'wg-search-form-home', TLS_PLUGIN_CSS_URL . 'wg_search_form_home.css', array( 'wg-search-form-01', 'wg-search-form-02' ), '1.0', 'all' );
		wp_register_style( 'wg-search-form-01', TLS_PLUGIN_CSS_URL . 'wg_search_form_01.css', array(), '1.0', 'all' );
		wp_register_style( 'wg-search-form-02', TLS_PLUGIN_CSS_URL . 'wg_search_form_02.css', array(), '1.0', 'all' );
		//wp_enqueue_style( 'wg-search-form-01' );

		global $wp_styles;
		echo '<pre>';
		print_r($wp_styles);
		echo '</pre>';
	}

	public function widget( $args, $instance ){
		extract($args);
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo $before_widget;
    		if(!empty($title)){
    		    echo $before_title . $title . $after_title;
    		}
    		require_once TLS_THEME_WIDGETS_HTML_DIR . 'searchForm.php';
		echo $after_widget;

	}

	public function form( $instance ){
		$htmlObj = new TlsHtml();
		$inputId = $this->get_field_id('title');
		$inputName = $this->get_field_name('title');
		$inputValue = @$instance['title'];
		$arr = array(
			'class' => 'widefat',
			'id' => $inputId
		);
		
		$html = $htmlObj->label(translate( 'Title:' ), array('for' => $inputId))
		          . $htmlObj->textbox($inputName, $inputValue, $arr);
		
	    echo $htmlObj->pTag($html);
	}

	public function update( $new_instance, $old_instance ){
		/*echo '<pre>';
		print_r($new_instance);
		echo '</pre>';*/

		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);

		//die();
		return $instance;
	}
}