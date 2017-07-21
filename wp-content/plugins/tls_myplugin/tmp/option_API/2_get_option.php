<?php
    class TlsMpAdmin{
        public function __construct(){            
            add_action( 'admin_init', array($this, 'getMyOption') );
        }

        public function getMyOption(){
            $arrOption = array(
                'course' => 'Wordpress 4.x',
                'author' => 'Tls-Learning',
                'website' => 'www.zend.vn'
            );
            $tmp = get_option( 'tls-mp-wp-course', $arrOption );
            echo '<pre>';
            print_r($tmp);
            echo '</pre>';
        }
    }
?>