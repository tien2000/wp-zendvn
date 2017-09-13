<?php
    class Tls_Theme_Support{
        public function __construct(){
            
        }
        
        /*
         * CAPTION SHORTCODE - REMOVE FIRST IMAGE
         *  */
        public function remove_first_image($image, $post_content){
            //echo '<br>' . __METHOD__;
            $pattern = '\[caption.*' . $image . '.*\[/caption\]';
            $post_content = preg_replace('#' . $pattern . '#', '', $post_content,1);
		    $post_content = preg_replace('#' . $image . '#', '', $post_content, 1);
            
            return $post_content;
        }
        
        /* 
         * CAPTION SHORTCODE - GET FIRST IMAGE
         *  */
        public function get_first_image($post_content = null){
            $firstImg = '';
            
            if($post_content != null){
                // Sử dụng biểu thức chính quy để lấy hình nằm trong bài viết
                $pattern = '#\<img.*>#imU';           
                preg_match_all($pattern, $post_content, $matches);
                
                /* echo '<pre>';
                print_r($matches);
                echo '</pre>'; */
                
                $imgArr = $matches[0];
                if(count($imgArr) > 0){
                    $firstImg = $imgArr[0];
                }
            }    
            return $firstImg;
        }
        
        public function get_img_url($post_content) {
        
            $image  = '';
            if(!empty($post_content)){
                preg_match_all( '|<img.*?src=[\'"](.*?)[\'"].*?>|i', $post_content, $matches );
            }
        
            if ( isset( $matches ) ) $image = $matches[1][0];
        
            return $image;
        }
        
        public function get_new_img_url($imgUrl, $width = 0, $heigt = 0 ,	$suffixes = '-tls-slider-'){
            $suffixes = $suffixes . $width . 'x'. $heigt;
        
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
                //echo '<br/>Chua ton tai hinh anh';
                $wpImageEditor =  wp_get_image_editor( $imgDir);
                if ( ! is_wp_error( $wpImageEditor ) ) {
                    $wpImageEditor->resize($width, $heigt, array('center','center'));
                    $wpImageEditor->save( $newImgDir);
                }
            }
            $newImgUrl= str_replace($currentName, $newFileName, $imgUrl);
        
            return $newImgUrl;
        }
    }