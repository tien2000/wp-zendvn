<?php
    class TlsMpAdmin{
        public function __construct(){
            add_action( 'admin_init', array($this, 'addNewOption') );
            add_action( 'admin_init', array($this, 'addArrayOption') );
            add_action( 'admin_init', array($this, 'delMyOption') );
        }

        public function delMyOption(){
            delete_option( 'tls-mp-wp-version' );
            delete_option( 'tls-mp-wp-course' );
        }

        public function addArrayOption(){
            $arrOption = array(
                'course' => 'Wordpress 4.x',
                'author' => 'Tls-Learning',
                'website' => 'www.zend.vn'
            );
            add_option( 'tls-mp-wp-course', $arrOption, 'yes' );
        }

        public function addNewOption(){
            add_option( 'tls-mp-wp-version', '4.0', '', 'yes');
            add_option( 'tls-mp-plugin-version', '1.0', '', no );
        }
    }
?>