<?php
/* 
 * register_taxonomy($name, $type, $args): Khởi tạo Taxonomy
 *  */
    class Tls_Mp_CustomTaxonomy_BookCategory{
        public function __construct(){
            //echo '<br>' . __METHOD__;
            add_action('init', array($this, 'create'));
        }
        
        public function create() {
            $labels = array(
                'name'          => 'Book Categories',
                'singular'      => 'Book Category',
                'menu_name'     => 'Book Categories 123',
                //'all_items'     => chưa xác định
                //'view_item'     => chưa xác định
                'edit_item'     => 'Edit Book Category',
                'update_item'   => 'Update Book Category',
                'add_new_item'  => 'Add New Book Category',
                //'new_item_name'     => chưa xác định
                //'parent_item'     => chưa xác định
                //'parent_item_colon'     => chưa xác định
                'search_items'  => 'Search Book Category',
                'popular_items' => 'Popular Book Category',
                'separate_items_with_commas'    => 'Separate tags with commas 123',
                'choose_from_most_used'         => 'Choose from the most used tags 123',
                'not_found'                     => 'No Book Categories found'
            );
            
            $args = array(
                'labels'     => $labels,
                'public'    => true
            );
            
            register_taxonomy('book-category', 'post', $args);
        }
    }