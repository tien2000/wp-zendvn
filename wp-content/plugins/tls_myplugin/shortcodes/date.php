<?php
/*
 * get_the_ID(): Lấy Id của bài viết.
 * get_post(): Lấy thông tin của bài viết có ID = get_the_ID().
 * is_single(): Chỉ hiển thị shortcode trong bài viết mà ko hiển thị ngoài trang chủ.
 * has_shortcode: Kiểm tra xem trong một nội dung nào đó shortcode có được thêm vào hay ko.
 * date('l jS \of F Y h:i:s A'): Lấy thông tin của thứ/ngày/tháng/năm, giờ/phút/giây, sáng/tối
 */
    class Tls_Mp_Sc_Date{

        public function __construct(){
            add_shortcode('tls_mp_sc_show_date', array($this, 'showDate'));
        }

        public function showDate(){
            if(is_single()){
                $postObj = get_post(get_the_ID());
                if(has_shortcode($postObj->post_content, 'tls_mp_sc_show_date') == 1){
                    wp_register_style('tls_mp_sc_show_date_css', TLS_PLUGIN_CSS_URL . 'shortcode.css', array(), '1.0');
                    wp_enqueue_style('tls_mp_sc_show_date_css');
                }
                $str = '<div class="tls_mp_sc_show_date">' . date('l jS \of F Y h:i:s A') . '</div>';
                return $str;
            }
        }
    }