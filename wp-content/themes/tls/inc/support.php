<?php
    class Tls_Theme_Support{
        public function __construct(){
            
        }
        
        public function remove_first_video($video, $post_content){
            //echo '<br>' . __METHOD__;
        
            $video = str_replace('[', '\[', $video);
            $video = str_replace(']', '\]', $video);
            $video = str_replace('?', '\?', $video);
        
            $pattern = '#' . $video . '#';
        
            $post_content = preg_replace($pattern, '', $post_content, 1);
        
            return $post_content;
        }
        
        public function video_embed($url, $site = 'youtube'){
            $html = '';
            // https://www.youtube.com/watch?v=kJQP7kiw5Fk
            // <iframe src="https://www.youtube.com/embed/kJQP7kiw5Fk?feature=oembed" 
            //frameborder="0" allowfullscreen="" id="fitvid530068"></iframe>
            if($site == 'youtube'){
                $tmp = explode('v=', $url);
                $videoID = $tmp[1];
                $src = 'https://www.youtube.com/embed/' . $videoID . '?feature=oembed';
                $html = '<iframe src="'. $src .'" frameborder="0" allowfullscreen=""></iframe>';
            }
            return $html;
        }
        
        /*
         * CAPTION SHORTCODE - GET FIRST VIDEO
         *  */
        public function get_first_video($post_content = null){
            $firstVideo = '';
        
            if($post_content != null){
                // Sử dụng biểu thức chính quy để lấy hình nằm trong bài viết
                $pattern = '#(\[video.*/video\]|http.*www\.youtube\.com\S+)#im';
                preg_match_all($pattern, $post_content, $matches);
        
                /* echo '<pre>';
                print_r($matches);
                echo '</pre>'; */
        
                $videoArr = $matches[0];
                if(count($videoArr) > 0){
                    $firstVideo = $videoArr[0];
                }
            }
            return $firstVideo;
        }
        
        /*
         * CAPTION SHORTCODE - REMOVE FIRST AUDIO or PLAYLIST
         *  */
        public function remove_first_audio($audio, $post_content){
            //echo '<br>' . __METHOD__;
            
            $audio = str_replace('[', '\[', $audio);
            $audio = str_replace(']', '\]', $audio);
            
            $pattern = '#' . $audio . '#';
            
            $post_content = preg_replace($pattern, '', $post_content, 1);
        
            return $post_content;
        }
        
        /*
         * CAPTION SHORTCODE - GET FIRST AUDIO or PLAYLIST
         *  */
        public function get_first_audio($post_content = null){
            $firstAudio = '';
        
            if($post_content != null){
                // Sử dụng biểu thức chính quy để lấy hình nằm trong bài viết
                $pattern = '#(\[audio.*/audio\]|\[playlist.*\])#imU';
                preg_match_all($pattern, $post_content, $matches);
        
                /* echo '<pre>';
                print_r($matches);
                echo '</pre>'; */
        
                $audioArr = $matches[0];
                if(count($audioArr) > 0){
                    $firstAudio = $audioArr[0];
                }
            }
            return $firstAudio;
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