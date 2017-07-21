<?php
    class Tls_Mp_Widget extends WP_Widget {

	public function __construct(){
	    $id_base = 'tls-mp-my-wg-simple';
	    $name = 'Tls My First Widget';
	    $widget_options = array(
	        'classname' => 'tls-mp-my-wg-simple-style',
	        'description' => 'This is my first widget'
	    );
        parent::__construct($id_base, $name, $widget_options);

		add_action( 'wp_enqueue_scripts', array($this, 'add_simple_css_2') );
    }

	public function add_simple_css_2(){
		wp_register_style( 'wg_simple_02', TLS_PLUGIN_CSS_URL . 'wg_simple_02.css', array(), '1.0', 'all' );
		wp_enqueue_style( 'wg_simple_02' );
		
	}

	public function update( $new_instance, $old_instance ){
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['name'] = strip_tags($new_instance['name']);
		$instance['phone'] = strip_tags($new_instance['phone']);
		$instance['css'] = strip_tags($new_instance['css']);

		return $instance;
	}

	public function widget( $args, $instance ){	
		extract($args);
		$title = apply_filters( 'widget_title', $instance['title'] );
		$title = (empty($title))? 'My Info' : $title;
		$name = (empty($instance['name']))? '&nbsp;' : $instance['name'];
		$phone = (empty($instance['phone']))? '&nbsp;' : $instance['phone'];
		$css = (empty($instance['css']))? ' ' : $instance['css'];
		//echo $css . '<br>';
		$classname = $this->widget_options['classname'];
		//echo $classname;
		$before_widget = str_replace($classname, $classname . ' ' . $css, $before_widget);

		echo $before_widget;
			echo $before_title . $title . $after_title;
			echo '
				<ul>
					<li>'. 'Name: ' . $instance['name'] .'</li>
					<li>'. 'Phone: ' . $instance['phone'] .'</li>
				</ul>';
		echo $after_widget;
	}

	public function form( $instance ){
		/*echo '<pre>';
		print_r($instance);
		echo '</pre>';*/

	    $htmlObj = new TlsHtml();
		$inputId = $this->get_field_id('title');
		$imputName = $this->get_field_name('title');
		$inputValue = $instance['title'];
		$inputAttr = array(
			'class' => 'widefat',
			'id' => $inputId
		);
		$inputMyTextbox = $htmlObj->textbox($imputName, $inputValue, $inputAttr);
		
		echo '
			<p>
				<label for="'. $inputId .'">'. translate( 'Title' ) .'</label>
				'. $inputMyTextbox .'
			</p>
		';

		$inputId = $this->get_field_id('name');
		$imputName = $this->get_field_name('name');
		$inputValue = $instance['name'];
		$inputAttr = array(
			'class' => 'widefat',
			'id' => $inputId
		);
		$inputMyTextbox = $htmlObj->textbox($imputName, $inputValue, $inputAttr);
		
		echo '
			<p>
				<label for="'. $inputId .'">'. translate( 'Name' ) .'</label>
				'. $inputMyTextbox .'
			</p>
		';

		$inputId = $this->get_field_id('phone');
		$imputName = $this->get_field_name('phone');
		$inputValue = $instance['phone'];
		$inputAttr = array(
			'class' => 'widefat',
			'id' => $inputId
		);
		$inputMyTextbox = $htmlObj->textbox($imputName, $inputValue, $inputAttr);
		
		echo '
			<p>
				<label for="'. $inputId .'">'. translate( 'Phone' ) .'</label>
				'. $inputMyTextbox .'
			</p>
		';

		$inputId = $this->get_field_id('css');
		$imputName = $this->get_field_name('css');
		$inputValue = $instance['css'];
		$inputAttr = array(
			'class' => 'widefat',
			'id' => $inputId
		);
		$inputMyTextbox = $htmlObj->textbox($imputName, $inputValue, $inputAttr);
		
		echo '
			<p>
				<label for="'. $inputId .'">'. translate( 'Css Class' ) .'</label>
				'. $inputMyTextbox .'
			</p>
		';
	}
}
?>