<?php
/*
 * add_shortcode(): Thêm shortcode
 * remove_shortcode(): Xóa tác dụng của shortcode
 * shortcode_exists: Kiểm tra xem shortcode đã được đăng ký vào hệ thống hay chưa
 * strip_shortcodes(): Xóa toàn bộ shortcode trong bài viết.
 * get_shortcode_regex(): Tìm shortcode trong bài viết
 */
    class Tls_Mp_Sc_Main{
        private $_shortcodes_name = 'tls_mp_sc_options';
        private $_shortcodes_option = array(

        );

        public function __construct(){
            $defaultOptions = array(
                  'tls_mp_sc_date' => true,
                  'tls_mp_sc_title' => true
            );
            $this->_shortcodes_option = get_option($this->_shortcodes_name, $defaultOptions);

            $this->date();
            $this->titles();

            //remove_shortcode('tls_mp_sc_date');
            //echo '<br> shortcode_exists: ' . shortcode_exists('tls_mp_sc_show_date') ;

            //add_action('the_content', array($this, 'remove_all_shortcode'));

            //add_action('the_content', array($this, 'getShortcodeRegex'));
        }

        public function getShortcodeRegex($content){
            $pattern = '/' . get_shortcode_regex() . '/s';
            preg_match_all($pattern, $content, $matches);
            if(array_key_exists('2', $matches)){
                $shortcodeArr = $matches[2];
            }
            echo '<pre>';
            print_r($shortcodeArr);
            echo '</pre>';
            return $content;
        }

        public function remove_all_shortcode($content){
            $content = strip_shortcodes($content);
            return $content;
        }

        public function titles(){
            if($this->_shortcodes_option['tls_mp_sc_title'] == true){
                require_once TLS_PLUGIN_SHORTCODES_DIR . 'titles.php';
                new Tls_Mp_Sc_Titles();
            }else {
                add_shortcode('tls_mp_sc_show_titles', '__return_false');
            }
        }

        public function date(){
            if($this->_shortcodes_option['tls_mp_sc_date'] == true){
                require_once TLS_PLUGIN_SHORTCODES_DIR . 'date.php';
                new Tls_Mp_Sc_Date();
            }else {
                add_shortcode('tls_mp_sc_show_date', '__return_false');
            }
        }
    }
?>