<?php
    class TlsMpAdmin{
        public function __construct(){
            add_action( 'admin_init', array($this, 'addNewOption') );
            add_action( 'admin_init', array($this, 'addArrayOption') );
            add_action( 'admin_init', array($this, 'updateMyOption') );
            add_action( 'admin_init', array($this, 'updateMyOption2') );            
            add_action( 'admin_init', array($this, 'updateMyOptionAutoload') );
            add_action( 'admin_init', array($this, 'updateMyOption3') );
        }

        public function updateMyOption3(){            
            update_option( 'tls-mp-plugin-version', '2.0' );
            update_option( 'tls-mp-wp-version', '2.0' );
        }

        public function updateMyOptionAutoload(){
            $old_options = get_option( 'tls-mp-plugin-version' );
            delete_option( 'tls-mp-plugin-version' );
            add_option( 'tls-mp-plugin-version', $old_options, '', no );
        }

        public function updateMyOption2(){
            $old_options = get_option( 'tls-mp-wp-course' );
            $old_options['course'] = 'Wordpress 5.x';
            update_option( 'tls-mp-wp-course', $old_options );
        }

        public function updateMyOption(){
            update_option( 'tls-mp-wp-version', '4.5','yes' );
            //////////////////////////////////////////////////////////
             $arrOption = array(
                'course' => 'Wordpress 4.5',
                'author' => 'Tls-Learning',
                'website' => 'www.zend.vn'
            );
            update_option( 'tls-mp-wp-course', $arrOption );
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