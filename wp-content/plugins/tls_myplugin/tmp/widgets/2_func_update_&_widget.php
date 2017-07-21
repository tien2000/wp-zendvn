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
    }

	public function widget( $args, $instance ){
		extract($args);
		$title = $instance['title'];
		$title = '';
		echo '<pre>';
		print_r($args);
		echo '</pre>';
		
		/* Tạo ra cặp thẻ ul li chứa nội dung */
		echo $before_widget . '<br>';
		echo 'My widgets';
		echo $after_widget . '<br>';

		/* Tạo ra cặp thẻ h3 chứa nội dung */
		echo $before_title . $title . $after_title;
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
	}

	public function update( $new_instance, $old_instance ){
		/*echo '<pre>';
		print_r($new_instance);
		echo '</pre>';*/

		$instance = $old_instance;

		/*
		***** strip_tags: Lọc những thẻ html không cần thiết *****
		*/
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['name'] = strip_tags($new_instance['name']);

		//die();
		return $instance;
	}
}
?>