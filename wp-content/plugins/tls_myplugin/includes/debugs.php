<?php 
    /* 
     * current_user_can(string $capability): Kiểm tra quyền của người đang đăng nhập
     *  */
?>

<?php
    new Tls_Mp_Debugs();

    class Tls_Mp_Debugs{
        public function __construct() {
            //echo '<br>' . __FILE__;
            
            add_action('init', array($this, 'debug_check'));
        }
        
        public function debug_check() {
            //?debug=1&obj=wp_query
            $debug = (isset($_GET['debug']))?$_GET['debug']:0;
            if($debug == 1 && current_user_can('manage_options') == 1){
                //echo '<br>' . __METHOD__;
                add_action('wp_footer', array($this, 'debug_output'));
            }
        }
        
        public function debug_output() {
            echo '<br>' . __METHOD__;
            $obj = $_GET['obj'];
            
            $tmp = array();
            
            switch ($obj){
                case 'wp_query': global $wp_query; $tmp = $wp_query; break;
                
                case 'wp_rewrite': global $wp_rewrite; $tmp = $wp_rewrite; break;
                
                case 'wp': global $wp; $tmp = $wp; break;
                
                case 'query':
                default:
                    global $wpdb; $tmp = $wpdb->queries; break;
            }
            
            echo '<pre>';
            print_r($tmp);
            echo '</pre>';
        }
    }