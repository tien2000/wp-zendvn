<?php 
add_action('wp_enqueue_scripts', 'tls_theme_article_paging');
function tls_theme_article_paging(){
    $cssUrl = get_stylesheet_directory_uri() . '/css/';
    wp_register_style('tls_theme_article_paging', $cssUrl . 'article.css', array(), '1.0');
    wp_enqueue_style('tls_theme_article_paging');
}
?>