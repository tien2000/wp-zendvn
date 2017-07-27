<?php

/* 
 * register_post_type($post_type, $args)
 *   - $post_type: Kiểu post mới
 *  */

    class Tls_Mp_Cp_Product{
        public function __construct() {
            //echo '<br>'. __METHOD__;
            
            add_action('init', array($this, 'create'));
        }
        
        public function create() {
            $labels = array(
                'name'          => 'Products',
                'singular_name' => 'Product',
                'menu_name'     => 'TProduct',
                'name_admin_bar'=> 'TProduct',
                'add_new'       => 'Add TProduct',
                'add_new_item'  => 'Add New TProduct'
            );
            
            $args = array(
			'labels'                => $labels,
			'description'           => 'Hiển thị nội dung mô tả về Custom Post',
			'public'                => true,
 			'hierarchical'          => true,
// 			'exclude_from_search'   => null, // kế thừa từ phần public
// 			'publicly_queryable'    => null, // kế thừa từ phần public
// 			'show_ui'               => null, // kế thừa từ phần public
// 			'show_in_menu'          => null,
 			'show_in_nav_menus'     => false, // kế thừa từ phần public, hiển thị ở Appearance-Menu
 			'show_in_admin_bar'     => false, // kế thừa từ phần public, hiển thị ở AdminBar-New
 			'menu_position'         => 3,     // Vị trí xuất hiện trên menu left
 			'menu_icon'             => TLS_PLUGIN_IMAGES_URL . 'icon-setting16x16.png',
 			'capability_type'       => 'post',
// 			'capabilities'          => array(),
// 			'map_meta_cap'          => null,
 			'supports'              => array('title' ,'editor','author','thumbnail','excerpt','trackbacks' ,'custom-fields' ,'comments','revisions' ,'page-attributes','post-formats'),
// 			'register_meta_box_cb'  => null,
// 			'taxonomies'            => array(),
// 			'has_archive'           => false,
// 			'rewrite'               => true,
// 			'query_var'             => true,
// 			'can_export'            => true,
// 			'delete_with_user'      => null,
// 			'show_in_rest'          => false,
// 			'rest_base'             => false,
// 			'rest_controller_class' => false,
// 			'_builtin'              => false,
// 			'_edit_link'            => 'post.php?post=%d',
		);
            
            register_post_type('tproduct', $args);
        }
    }