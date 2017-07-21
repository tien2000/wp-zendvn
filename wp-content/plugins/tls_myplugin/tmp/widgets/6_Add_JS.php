<?php
	class Tls_Mp_Widget_Simple extends WP_Widget {
	
	public function __construct(){
		$id_base = 'tls-mp-widget-simple';
		$name = 'ATls My First Widget';
		$widget_options = array(
			'classname' => 'tls-mp-widget-simple-css',
			'description' => 'This is my first widget'
		);
		$control_options = array(
			'width' => '400px',
		);

		parent::__construct($id_base, $name, $widget_options, $control_options);		

		//add_action('wp_head',array( $this, 'addJS' ));

		add_action( 'wp_enqueue_scripts',array($this, 'addFileJS') );
		//wp_enqueue_script( 'wp-tls', TLS_PLUGIN_JS_URL . 'wp_tls.js', array('jquery'), '1.0', true );
		/*global $wp_scripts;
		echo '<pre>';
		print_r($wp_scripts);
		echo '</pre>';*/
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

	public function widget( $args, $instance ){
		extract($args);
		$title = apply_filters( 'widget_title', $instance['title'] ) ;
		//$title = $instance['title'];

		$title = empty($title)? 'My Info': $instance['title'];
		$name = empty($instance['name'])? '&nbsp': $instance['name'];
		$phone = empty($instance['phone'])? '&nbsp': $instance['phone'];
		$css = empty($instance['css'])? ' ': $instance['css'];

		$classname = $this->widget_options['classname'];
		/*echo '<pre>';
		print_r($args);
		echo '</pre>';

		echo '<pre>';
		print_r($instance);
		echo '</pre>';*/

		$before_widget = str_replace($classname, $classname . ' ' . $css, $before_widget);
		echo $before_widget;
			echo $before_title;
				echo $title;
			echo $after_title;
			echo '
				<ul>
					<li>Name: '. $name .'</li>
					<li>Phone: '. $phone .'</li>
				</ul>
			';
		echo $after_widget;

	}

	public function form( $instance ){
		/*echo '<pre>';
		print_r($instance);
		echo '</pre>';*/

		$htmlObj = new TlsHtml();
		$inputId = $this->get_field_id('title');
		$inputName = $this->get_field_name('title');
		$inputValue = @$instance['title'];
		$arr = array(
			'class' => 'widefat',
			'id' => $inputId
		);
		$inputTls = $htmlObj->textbox($inputName, $inputValue, $arr);

		echo '
			<p>
				<label for="'. $inputId .'">'. translate( 'Title' ) .'</label>
				'. $inputTls .'
			</p>
		';

		$inputId = $this->get_field_id('name');
		$inputName = $this->get_field_name('name');
		$inputValue = @$instance['name'];
		$arr = array(
			'class' => 'widefat',
			'id' => $inputId
		);
		$inputTls = $htmlObj->textbox($inputName, $inputValue, $arr);

		echo '
			<p>
				<label for="'. $inputId .'">'. translate( 'Name' ) .'</label>
				'. $inputTls .'
			</p>
		';

		$inputId = $this->get_field_id('phone');
		$inputName = $this->get_field_name('phone');
		$inputValue = @$instance['phone'];
		$arr = array(
			'class' => 'widefat',
			'id' => $inputId
		);
		$inputTls = $htmlObj->textbox($inputName, $inputValue, $arr);

		echo '
			<p>
				<label for="'. $inputId .'">'. translate( 'Phone' ) .'</label>
				'. $inputTls .'
			</p>
		';

		$inputId = $this->get_field_id('css');
		$inputName = $this->get_field_name('css');
		$inputValue = @$instance['css'];
		$arr = array(
			'class' => 'widefat',
			'id' => $inputId
		);
		$inputTls = $htmlObj->textbox($inputName, $inputValue, $arr);

		echo '
			<p>
				<label for="'. $inputId .'">'. translate( 'Css Class' ) .'</label>
				'. $inputTls .'
			</p>
		';
	}

	public function update( $new_instance, $old_instance ){
		/*echo '<pre>';
		print_r($new_instance);
		echo '</pre>';*/

		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['name'] = strip_tags($new_instance['name']);
		$instance['phone'] = strip_tags($new_instance['phone']);
		$instance['css'] = strip_tags($new_instance['css']);

		//die();
		return $instance;
	}
}
?>