<?php
/* 
 * get_theme_support('post-formats'): In ra những Format đã định add bên functions.php (trong hàm tlsThemePostFormat())
 *  */

class Tls_Theme_Widget_Sliders extends WP_Widget {

	//private $_cache_name = 'tls_mp_wg_last_post_caching';
	public function __construct() {
		//echo '<br/>' . __METHOD__;
		$id_base = 'tls-theme-widget-sliders';
		$name	= 'Tls Sliders';
		$widget_options = array(
					'classname' => 'widget_wpex_slider_widget',
					'description' => 'Show Sliders '
				);
		$control_options = array('width'=>'350px');
		parent::__construct($id_base, $name,$widget_options, $control_options);	

	}	
	public function widget( $args, $instance ) {
	    $showFlag = false;	    
				
		/* echo '<pre>';
		print_r($instance);
		echo '</pre>'; */
		
		extract($args);
		$title 			= apply_filters('widget_title', $instance['title']);
		$title 			= (empty($title))? translate('Last Post'): $title;
		$cat 			= (empty($instance['cat']))? 0: $instance['cat'];
		$type 			= (empty($instance['type']))? 'only': $instance['type'];
		$post_format 	= (empty($instance['post_format']))? 'standard': $instance['post_format'];
		$items 			= (empty($instance['items']))? 5: $instance['items'];	
		$show_type 		= (empty($instance['show_type']))? 'sidebar': $instance['show_type'];
		$position 		= (empty($instance['position']))? 'all': $instance['position'];
		$feature		= (empty($instance['feature']))? 0: $instance['feature'];
		$width		    = (empty($instance['width']))? 100: $instance['width'];
		$height		    = (empty($instance['height']))? 100: $instance['height'];
		
		
		if ($position == 'all') { $showFlag = true; }
		else if ($position == 'is_home' && is_home() == true) { $showFlag = true; }
		else if ($position == "is_category" && is_category() == true) { $showFlag = true; }
				
		if($showFlag == true){
		    echo $before_widget;
    		    if(!empty($title)){
    		        if($show_type != 'top_content' && $show_type != 'bottom_content'){
    		            echo $before_title . $title . $after_title;
    		        }
		            
    		        $args = array(
    		            'post_type'           =>  'post',
    		            'orderby'             =>  'ID',
    		            'order'               =>  'DESC',
    		            'post_per_page'       =>  $items,
    		            'post_status'         =>  'publish',
    		            'ignore_sticky_posts' =>  true
    		        );
    		        
    		        if($cat != 0){
    		            if($type == 'only'){
    		                $args['category__in'] = array($cat);
    		            }else{
    		                $args['cat'] = $cat;
    		            }
    		        }
    		        
    		        if($feature == 1){
    		            $meta_query = array(
    		                array(
    		                    'key'    => '_thumbnail_id'
    		                )
    		            );
    		            $args['meta_query'] = $meta_query;
    		        }
    		        
    		        if($post_format != 'standard'){
    		            $tax_query = array(
                		                array(
                		                    'field'       =>  'slug',
                		                    'terms'       =>  'post-format-' . $post_format,
                		                    'taxonomy'    =>  'post_format',
                		                    'operator'    =>  'IN',
                		                )
                		            );
    		            $args['tax_query'] = $tax_query;
    		        }
    		        
    		        $wp_query = new WP_Query($args);
    		        
    		        // Sử dụng the_loop để in ra các giá trị
    		        if($show_type == 'sidebar'){
    		            require_once TLS_THEME_WIDGETS_HTML_DIR . 'sidebar.php';
    		        }else if($show_type == 'top_content'){
    		            require_once TLS_THEME_WIDGETS_HTML_DIR . 'top_content.php';
    		        }else if($show_type == 'bottom_content'){
    		            require_once TLS_THEME_WIDGETS_HTML_DIR . 'bottom_content.php';
    		        }
    		    }
		    echo $after_widget;
		}
	}
	
	public function update( $new_instance, $old_instance ) {
	
		$instance = $old_instance;
	
		$instance['title'] 		= strip_tags($new_instance['title']);
		$instance['cat'] 		= strip_tags($new_instance['cat']);
		$instance['type'] 		= strip_tags($new_instance['type']);
		$instance['post_format']= strip_tags($new_instance['post_format']);
		$instance['items']		= strip_tags($new_instance['items']);
		$instance['show_type']	= strip_tags($new_instance['show_type']);
		$instance['width']		= strip_tags($new_instance['width']);
		$instance['height']		= strip_tags($new_instance['height']);
		$instance['position']	= strip_tags($new_instance['position']);
		$instance['feature']	= (int)$new_instance['feature'];
		
	
		return $instance;
	}
	
	public function form( $instance ) {
	    $htmlObj =  new TlsHtml();
		/* echo '<pre>';
		print_r($instance);
		echo '</pre>';  */
			
		//Tao phan tu chua Title
		$inputID 	= $this->get_field_id('title');
		$inputName 	= $this->get_field_name('title');
		$inputValue = @$instance['title'];
		$arr = array('class' =>'widefat','id' => $inputID);
		$html		= $htmlObj->label(translate('Title'),array('for'=>$inputID))
					. $htmlObj->textbox($inputName,$inputValue,$arr);
		echo $htmlObj->pTag($html);
		
		//Tao phan tu chua Category
		$inputID 	= $this->get_field_id('cat');
		$inputName 	= $this->get_field_name('cat');
		$inputValue = @$instance['cat'];		
		
		$args = array(
				'show_option_all'    => translate('All category'),
				'show_option_none'   => '',
				'orderby'            => 'ID',
				'order'              => 'ASC',
				'show_count'         => 2,
				'hide_empty'         => 1,
				'child_of'           => 0,
				'exclude'            => '',
				'echo'               => 0,
				'selected'           => $inputValue,
				'hierarchical'       => 1,
				'name'               => $inputName,
				'id'                 => $inputID,
				'class'              => 'widefat',
				'depth'              => 0,
				'tab_index'          => 0,
				'taxonomy'           => 'category',
				'hide_if_empty'      => false,
		);
		//echo wp_dropdown_categories($args);
		
		$html		= $htmlObj->label(translate('Categories'),array('for'=>$inputID))
						. wp_dropdown_categories($args);
		echo $htmlObj->pTag($html);
		
		//Tao phan tu chua Type Show
		$inputID 	= $this->get_field_id('type');
		$inputName 	= $this->get_field_name('type');
		$inputValue = @$instance['type'];
		$arr 		= array('class' =>'widefat','id' => $inputID);
		$options['data'] = array(
								'only' => 'Only category',
								'child' => 'Include child'
								);
		$html		= $htmlObj->label(translate('Show Post in category'),array('for'=>$inputID))
					.	$htmlObj->selectbox($inputName,$inputValue,$arr,$options);
		echo $htmlObj->pTag($html);
		
		//Tao phan tu chua Featured Images
		$inputID 	= $this->get_field_id('feature');
		$inputName 	= $this->get_field_name('feature');
		$inputValue = 1;
		//$inputValue = @$instance['feature'];
		$arr 		= array('class' =>'widefat','id' => $inputID);
		$options['current_value'] = @$instance['feature'];
		$html		= $htmlObj->label(translate('Show only Featured Images Posts'),array('for'=>$inputID))
		              . '<br/>' .	$htmlObj->checkbox($inputName,$inputValue,$arr,$options)
		              . translate(' Yes');
		echo $htmlObj->pTag($html);
		
		
		//Tao phan tu chua Post Format
		$inputID 	= $this->get_field_id('post_format');
		$inputName 	= $this->get_field_name('post_format');
		$inputValue = @$instance['post_format'];
		$arr 		= array('class' =>'widefat','id' => $inputID);
		$tmp 		= get_theme_support('post-formats');		
		
		/* echo '<pre>';
		print_r($tmp);
		echo '</pre>'; */
		
		$tmp 		= $tmp[0];
		
		$options['data'] = array(
	           'standard' => 'Standard',
		);
		for($i=0; $i< count($tmp); $i++){
				//echo '<br>' . $tmp[$i];
				$options['data'][$tmp[$i]] = $tmp[$i];
		}
		$html		= $htmlObj->label(translate('Post Format'),array('for'=>$inputID))
						.	$htmlObj->selectbox($inputName,$inputValue,$arr,$options);
		echo $htmlObj->pTag($html);
		
		//Tao phan tu chua Position 
		$inputID 	= $this->get_field_id('position');
		$inputName 	= $this->get_field_name('position');
		$inputValue = @$instance['position'];
		$arr 		= array('class' =>'widefat','id' => $inputID);
		
		$options['data'] = array(
				'all' 				=> 'All page',
				'is_home' 			=> 'Home',
				'is_category' 		=> 'In Category',
				
				);
		
		$html		= $htmlObj->label(translate('Position show'),array('for'=>$inputID))
					.	$htmlObj->selectbox($inputName,$inputValue,$arr,$options);
		echo $htmlObj->pTag($html);
		
		//Tao phan tu chua Type
		$inputID 	= $this->get_field_id('show_type');
		$inputName 	= $this->get_field_name('show_type');
		$inputValue = @$instance['show_type'];
		$arr 		= array('class' =>'widefat','id' => $inputID);
		
		$options['data'] = array(
				'sidebar' 			=> 'Sidebar',
				'top_content' 		=> 'Top content',
				'bottom_content' 	=> 'Bottom content',
		);
		
		$html		= $htmlObj->label(translate('Show Type'),array('for'=>$inputID))
					.	$htmlObj->selectbox($inputName,$inputValue,$arr,$options);
		echo $htmlObj->pTag($html);
		
		//Tao phan tu chua Item
		$inputID 	= $this->get_field_id('items');
		$inputName 	= $this->get_field_name('items');
		$inputValue = @$instance['items'];
		$arr 		= array('class' =>'widefat','id' => $inputID);
		$html		= $htmlObj->label(translate('Items'),array('for'=>$inputID))
						. $htmlObj->textbox($inputName,$inputValue,$arr);
		echo $htmlObj->pTag($html);
		
		//Tao phan tu chua Size
		$inputID 	= $this->get_field_id('width');
		$inputName 	= $this->get_field_name('width');
		$inputValue = @$instance['width'];
		$arr 		= array('id' => $inputID,'size'=> 10);
		$inputWidth	= $htmlObj->textbox($inputName,$inputValue,$arr);
		
		$inputID 	= $this->get_field_id('height');
		$inputName 	= $this->get_field_name('height');
		$inputValue = @$instance['height'];
		$arr 		= array('id' => $inputID,'size'=> 10);
		$inputHeight	= $htmlObj->textbox($inputName,$inputValue,$arr);
		
		$html		= $htmlObj->label(translate('Width size  - Height size'),array('for'=>$inputID))
					. '<br>' . $inputWidth . ' x ' . $inputHeight;
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
	
	private function get_new_img_url($imgUrl, $width = 0, $height = 0 ,	$suffixes = '-tls-slider-'){
		$suffixes = $suffixes . $width . 'x'. $height;
	
		//Lay ten tap tin hinh anh hien tai
		preg_match("/[^\/|\\\]+$/", $imgUrl, $currentName);
		$currentName = $currentName[0];
	
		//Tạo tên mới cho hình ảnh dựa trên tên cũ
		$tmpFileName = explode('.', $currentName);
		$newFileName = $tmpFileName[0] . $suffixes . '.' . $tmpFileName[1];
	
		//Chuyển từ đường dẫn URL sang PATH
		$tmp 	= explode('/wp-content/', $imgUrl);
		$imgDir = ABSPATH.'wp-content/' . $tmp[1];
	
	
		$newImgDir = str_replace($currentName, $newFileName, $imgDir);
		//echo '<br>' . $newImgDir;
		if(!file_exists($newImgDir)){			
			$wpImageEditor =  wp_get_image_editor( $imgDir);
			if ( ! is_wp_error( $wpImageEditor ) ) {
				$wpImageEditor->resize($width, $height, array('center','center'));
				$wpImageEditor->save( $newImgDir);
			}
		}
		$newImgUrl= str_replace($currentName, $newFileName, $imgUrl);
	
		return $newImgUrl;
	}
}
