<?php
    class Tls_Mp_Metabox_Main{
        private $_metabox_name = 'tls_mp_mb_options';
        private $_metabox_option = array();

        public function __construct(){
            $defaultOptions = array(
                'tls_mp_mb_simple' => false,
                'tls_mp_mb_data' => false,
                'tls_mp_mb_data2' => false,
                'tls_mp_mb_editor' => false,
                'tls_mp_mb_media' => true
            );
            $this->_metabox_option = get_option($this->_metabox_name, $defaultOptions);
            //$this->simple();
            //$this->data();
            $this->data2();
            //$this->editor();
            $this->media();
        }

        public function media(){
            if($this->_metabox_option['tls_mp_mb_media'] == true){
                require_once TLS_PLUGIN_METABOX_DIR . 'media.php';
                new Tls_Mp_Metabox_Media();
            }
        }

        public function editor(){
            if($this->_metabox_option['tls_mp_mb_editor'] == true){
                require_once TLS_PLUGIN_METABOX_DIR . 'editor.php';
                new Tls_Mp_Metabox_Editor();
            }
        }

        public function data2() {
            if($this->_metabox_option['tls_mp_mb_data2'] == true){
                require_once TLS_PLUGIN_METABOX_DIR . 'data2.php';
                new Tls_Mp_Metabox_Data2();
            }
        }

        public function data() {
            if($this->_metabox_option['tls_mp_mb_data'] == true){
                require_once TLS_PLUGIN_METABOX_DIR . 'data.php';
                new Tls_Mp_Metabox_Data();
            }
        }

        public function simple() {
            if($this->_metabox_option['tls_mp_mb_simple'] == true){
                require_once TLS_PLUGIN_METABOX_DIR . 'simple.php';
                new Tls_Mp_Metabox_Simple();
            }
        }
    }