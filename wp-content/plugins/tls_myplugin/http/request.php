<?php 
    /* 
     * wp_remote_get($url, $args):
     * wp_remote_post($url, $args): Gửi dữ liệu lên server (điền giá trị vào $args->body
     * wp_remote_head($url, $args): Lấy thông tin đơn giản, ko lấy body
     * wp_remote_retrieve_body($response): Lấy nội dung của phần body (bỏ qua những phần khác)
     * wp_remote_retrieve_header($response, 'content-type'): Lấy nội dung header kèm phần tử.
     * wp_remote_retrieve_headers($response): Lấy mảng nội dung header.
     * 
     * 
     * Kiểm tra đang GET hay POST: In biến $_SERVER xong kiểm tra [REQUEST_METHOD] => GET or POST
     *  */
?>

<?php
    class Tls_Mp_Http_Api{
        
        private $_menuSlug = 'tls-mp-http-api';
        
        public function __construct(){
            //echo '<br>' . __FILE__;
            
            add_action('admin_menu', array($this, 'menuSetting'));
        }
        
        public function menuSetting($param) {
            add_menu_page('HTTP API', 'HTTP API', 'manage_options', 
                            $this->_menuSlug, array($this, 'display2'), '', 3);
            add_submenu_page($this->_menuSlug, 'Get Info', 'Get Info', 'manage_options',
                $this->_menuSlug . '-info', array($this, 'display2'), '', 3);
        }
        
        public function display2() {
            $url = 'http://localhost/http/show_html.php?article=1&status=1';
        
            $args = array(
                'headers'     => array('cus-id' => '123456'),   // Giá trị gửi vào biến $_SERVER của website ( [HTTP...] )
                'body'        => array('username' =>'tienle', 'password' =>'123456'),
            );
        
            $response = wp_remote_request($url, $args);
            //$info = wp_remote_retrieve_body($response);
            //$info = wp_remote_retrieve_header($response, 'content-type');
            //$info = wp_remote_retrieve_headers($response);
            //$info = wp_remote_retrieve_response_code($response);
            $info = wp_remote_retrieve_response_message($response);            
            
            echo '<pre>';
            print_r($info);
            echo '</pre>';
        }
        
        public function display() {
            $url = 'http://localhost/http/show_html.php?article=1&status=1';
            //$url = 'http://localhost/http/wp-config.php';
            
            $args = array(
                'method'      => 'POST',
                'timeout'     => 5,     // Thời gian load website
                'redirection' => 5,     // Thời gian chuyển hướng website
                'httpversion' => '1.0', // Phiên bản phương thức truyền dữ liệu
                'user-agent'  => 'WordPress/' . $wp_version . '; ' . home_url(),
                'blocking'    => true,  // Cho phép gửi & nhận dữ liệu trở về. (false: Chỉ dữ liệu gửi đi ko quan tâm dữ liệu trở về)
                'headers'     => array('cus-id' => '123456'),   // Giá trị gửi vào biến $_SERVER của website ( [HTTP...] )
                //'cookies'     => array(),
                //'cookies'     => $_COOKIE,
                //'body'        => null,  // Mảng gửi dữ liệu lên server
                'body'        => array('username' =>'tienle', 'password' =>'123456'),
                'compress'    => false,
                'decompress'  => true,  // Thông báo cho máy chủ biết dữ liệu gửi lên ở dạng bình thường hay nén lại
                'sslverify'   => true,  // Key bảo mật dạng .crt
                //'sslcertificates' => 'zendvn.crt', // Key được cung cấp để lấy dữ liệu về (Ví dụ zendvn.crt)
                //'stream'      => true,
                //'filename'    => TLS_PLUGIN_DIR . 'http/abc.php'    // Lấy dữ liệu trong $url bỏ vào file abc.php (stream => true) (Nguy hiểm, có thể dùng cho mục đích xấu)
            );
            
            //$response = wp_remote_get($url, $args);
            //$response = wp_remote_post($url, $args);
            //$response = wp_remote_head($url, $args);
            $response = wp_remote_request($url, $args);
            
            echo '<pre>';
            print_r($response);
            echo '</pre>';
        }
    }