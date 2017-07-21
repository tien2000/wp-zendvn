<?php
    class Zendvn_Mp_Widget extends WP_Widget {
	
	public function __construct(){
        $id_base = 'tls-mp-my-widget-simple';
        $name = 'Tls my first widget';
        $widget_option = array(
            'classname' => 'tls-mp-my-widget-simple-css',
            'description' => 'This is my first widget'
        );
        parent::__construct($id_base, $name, $widget_option);
    }	

	public function widget( $args, $instance ) {}

	public function form( $instance ){
        $htmlObj = new ZendvnHtml();
        $inputId = $this->get_field_id('title');
        $inputName = $this->get_field_name('title');
        $inputValue = '';
        $attr = array(
            'class' => 'widefat',
            'id' => $inputId
        );
        $WgInput = $htmlObj->textbox($inputName, $inputValue, $attr);

        echo '
                <p><label for="'. $inputId .'">'. translate('Title') .'</label>
                    '. $WgInput .'
                </p>
            ';
        
        $inputId = $this->get_field_id('name');
        $inputName = $this->get_field_name('name');
        $inputValue = '';
        $attr = array(
            'class' => 'widefat',
            'id' => $inputId
        );
        $WgInput = $htmlObj->textbox($inputName, $inputValue, $attr);

        echo '
                <p><label for="'. $inputId .'">'. translate('Name') .'</label>
                    '. $WgInput .'
                </p>
            ';

        $inputId = $this->get_field_id('phone');
        $inputName = $this->get_field_name('phone');
        $inputValue = '';
        $attr = array(
            'class' => 'widefat',
            'id' => $inputId
        );
        $WgInput = $htmlObj->textbox($inputName, $inputValue, $attr);

        echo '
                <p><label for="'. $inputId .'">'. translate('Phone') .'</label>
                    '. $WgInput .'
                </p>
            ';
    }

	public function update( $new_instance, $old_instance ) {}
}

?>