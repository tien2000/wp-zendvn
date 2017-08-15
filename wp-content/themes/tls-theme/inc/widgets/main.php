<?php
/* 
 * Hook 'widgets_init': Hook khởi chạy Widget.
 *  */

class Tls_Theme_Wg_Main{
    private $_widget_options = array();
    
    public function __construct() {
        $this->_widget_options = array(
            'searchForm'    => true,
            'social'        => true,
            'tabs'          => true,
            'sliders'       => true,
        );
        
        foreach ($this->_widget_options as $key => $val){
            if($val == true){
                add_action('widgets_init', array($this, $key));
            }
        }
    }
    
    public function sliders() {
        require_once TLS_THEME_WIDGETS_DIR . 'sliders.php';
        register_widget('Tls_Theme_Widget_Sliders');
    }
    
    public function searchForm() {
        require_once TLS_THEME_WIDGETS_DIR . 'searchForm.php';
        register_widget('Tls_Theme_Wg_SearchForm');
    }
    
    public function social() {
        require_once TLS_THEME_WIDGETS_DIR . 'social.php';
        register_widget('Tls_Theme_Widget_Social');
    }
    
    public function tabs() {
        require_once TLS_THEME_WIDGETS_DIR . 'tabs.php';
        register_widget('Tls_Theme_Widget_Tabs');
    }
}