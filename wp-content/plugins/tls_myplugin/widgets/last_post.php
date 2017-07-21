<?php
	class Tls_Mp_Widget_Last_Post extends WP_Widget {

	private $_cache_name = 'tls-mp-widget-last_post-caching';

	public function __construct(){
	    $id_base = 'tls-mp-widget-last_post';
	    $name = 'ATls My Last Post Widget';
	    $widget_options = array(
	        'classname' => 'tls-mp-widget-last-post-css',
	        'description' => 'Show New Post'
	    );

	    parent::__construct($id_base, $name, $widget_options);
	}

	public function form( $instance ){
	    $htmlObj = new TlsHtml();

	    // Tạo phần tử chứa Title
	    $inputId = $this->get_field_id('title');
	    $inputName = $this->get_field_name('title');
	    $inputValue = @$instance['title'];
	    $arr = array(
	        'class' => 'widefat',
	        'id' => $inputId
	    );
	    $inputTitle = $htmlObj->textbox($inputName, $inputValue, $arr);

	    echo '
			<p>
				<label for="'. $inputId .'">'. translate( 'Title' ) .'</label>
				'. $inputTitle .'
			</p>
		';

	    // Tạo phần tử chứa Format
	    $inputId = $this->get_field_id('format');
	    $inputName = $this->get_field_name('format');
	    $inputValue = @$instance['format'];
	    $arr = array(
	        'class' => 'widefat',
	        'id' => $inputId
	    );
	    $options['data'] = array(
	        'standard' => 'standard',
	    );

	    $tmp = get_theme_support('post-formats');
	    $tmp = $tmp[0];
	    for($i = 0; $i < count($tmp); $i++){
	        //echo '<br>' . $tmp[$i];
	        $options['data'][$tmp[$i]] = $tmp[$i];
	    }

	    $selectFormat = $htmlObj->selectbox($inputName, $inputValue, $arr, $options);

	    echo '
			<p>
				<label for="'. $inputId .'">'. translate( 'Type of Format' ) .'</label>
				'. $selectFormat .'
			</p>
		';

	    // Tạo phần tử chứa Items
	    $inputId = $this->get_field_id('items');
	    $inputName = $this->get_field_name('items');
	    $inputValue = @$instance['items'];
	    $arr = array(
	        'class' => 'widefat',
	        'id' => $inputId
	    );
	    $inputItems = $htmlObj->textbox($inputName, $inputValue, $arr);

	    echo '
			<p>
				<label for="'. $inputId .'">'. translate( 'Number Of Item' ) .'</label>
				'. $inputItems .'
			</p>
		';

	    // Tạo phần tử chứa Odering
	    $inputId = $this->get_field_id('odering');
	    $inputName = $this->get_field_name('odering');
	    $inputValue = @$instance['odering'];
	    $arr = array(
	        'class' => 'widefat',
	        'id' => $inputId
	    );

	    $options['data'] = array(
            'asc' => 'ASC (a-z)',
	        'desc' => 'DESC (z-a)'
	    );
	    $inputOrdering = $htmlObj->selectbox($inputName, $inputValue, $arr, $options);

	    echo '
			<p>
				<label for="'. $inputId .'">'. translate( 'Odering' ) .'</label>
				'. $inputOrdering .'
			</p>
		';
	}

	public function update( $new_instance, $old_instance ){
	    $instance = $old_instance;

	    $instance['title'] = strip_tags($new_instance['title']);
	    $instance['format'] = strip_tags($new_instance['format']);
	    $instance['items'] = strip_tags($new_instance['items']);
	    $instance['odering'] = strip_tags($new_instance['odering']);
	    delete_transient($this->_cache_name);
        return $instance;
	}

	public function widget( $args, $instance ){
                /////////////// Thiết lập giá trị mặc định ////////////////////
	    $title = apply_filters( 'widget_title', $instance['title'] );

	    $title = (empty($title))? ' Tls Last Post': $instance['title'];
	    $format = (empty($instance['format']))? 'standard': $instance['format'];
	    $items = (empty($instance['items']))? '5': $instance['items'];
	    $odering = (empty($instance['odering']))? 'DESC': $instance['odering'];
	    $caching = get_transient($this->_cache_name);

	    if($caching == false){
	        echo '<br> Không sử dụng cache';
	        $args = array(
	            'post_type' => 'post',
	            'order' => $odering,
	            'orderby' => 'ID',
	            'posts_per_page' => $items,
	            'post_status' => 'publish',
	            'ignore_sticky_posts' => true
	        );

	        if($format != 'standard'){
	            $tax_query = array(
	                array(
	                    'field' => 'slug',
	                    'terms' => 'post-format-' . $format,
	                    'taxonomy' => 'post_format',
	                    'operator' => 'NOT IN'
	                )
	            );
	            $args['tax_query'] = $tax_query;
	        }

	        $wpQuery = new WP_Query($args);
	        set_transient($this->_cache_name, $wpQuery, 3 * MINUTE_IN_SECONDS);

	    }else{
	        echo '<br> Có sử dụng cache';
	        $wpQuery = $caching;
	    }



	    if($wpQuery->have_posts()){
	        echo '<ul>';
	           while ($wpQuery->have_posts()){
	               $wpQuery->the_post();
	               //$wpQuery->post;
	               $lnk = $wpQuery->post->guid;
	               echo '<li><a href="'. $lnk .'">' . get_the_title() . '</a></li>';
	           }
	        echo '</ul>';
	        wp_reset_postdata();
	    }else{
	        echo 'Data not found';
	    }

	    //echo do_shortcode('[tls_mp_sc_show_date]');
	    //echo do_shortcode("[tls_mp_sc_show_titles ids='56,54' title='Các bài viết liên quan đến Wordpress']");

	    /* $attr = array(
	        'src'      => 'http://localhost/media/audio/Chuyen-ngay-xua-do-Jimmy%20Nguyen.mp3',
	        'loop'     => '',
	        'autoplay' => true,
	        'preload'  => 'none'
	    );
	    echo wp_audio_shortcode( $attr ); */

	    /* $attr = array(
	        'src'      => 'http://localhost/media/video/Video-007.mp4',
	        'loop'     => '',
	        'autoplay' => true,
	        'preload'  => 'none',
	    );
	    echo wp_video_shortcode( $attr ); */
	}
}
?>