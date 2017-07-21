<?php
    class Tls_Mp_Metabox_Simple{
        public function __construct(){
            add_action('add_meta_boxes', array($this, 'create'));

        }

        public function create() {
            add_meta_box('tls_mp_mb_simple', 'My Custom Metabox', array($this, 'display'), 'post');
        }

        public function display() {
            echo '<p>My first Metabox</p>';
        }
    }