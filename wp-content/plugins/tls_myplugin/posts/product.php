<?php

/* 
 * register_post_type($post_type, $args)
 *   - $post_type: Kiểu post mới
 *   
 * __($text): translate language
 *
 * Hook Filter "pre_get_post": Trước khi lấy ra những bài viết
 * 
 * Hook Filter "template_include": Load template (Dùng để debug, kiểm tra giao diện nằm ở tập tin nào trong theme)
 * 
 * is_home(): Kiểm tra có phải ở trang đầu hay ko.
 * is_single(): Kiểm tra có phải đang ở trang hiển thị 1 bài viết thông thường hay ko.
 * is_archive(): Kiểm tra có phải đang ở trang archive.php ko. Nếu đúng trả về giá trị 1.
 * 
 * $query->is_main_query(): Khi gặp câu Query nằm trong vùng chạy chính thì mới xử lý bằng cách thêm vào 
 *                           post_type và post_type bao gồm 2 giá trị ('post', 'tproduct'). Nếu không sử dụng
 *                           có thể ảnh hưởng đến Query ở những vùng khác. Ví dụ như mất menu.
 *  */

    class Tls_Mp_Cp_Product{
        public function __construct() {
            //echo '<br>'. __METHOD__;
            
            add_action('init', array($this, 'create'));
            add_filter('pre_get_posts', array($this, 'showHome'));
            add_filter('template_include', array($this, 'loadTemplate'));
        }
        
        public function loadTemplate($template_file) {
            global $wp;
            /* echo '<br>'. __FUNCTION__;
            echo '<br>'. $template_file;
            echo '<br>'. $wp->query_vars['post_type'];
            echo '<br>'. is_archive(); */
            
            if(is_single()){
                //echo '<br>'. $template_file;                
                /* echo '<pre>';
                print_r($wp);
                echo '</pre>'; */
                
                if(isset($wp->query_vars['post_type']) && $wp->query_vars['post_type'] == 'tproduct'){
                    //echo '<br>' . locate_template('loop-tproduct.php');
                    $file = TLS_PLUGIN_CUSTOMPOSTS_DIR . 'templates/loop-tproduct.php';
                    if(file_exists($file)){
                        $template_file = $file; //Kiểm tra file loop-tproduct.php có tồn tại ko, nếu ko sẽ chạy file loop-single.php
                    }
                }
            }
            
            if(is_archive()){
                if(isset($wp->query_vars['post_type']) && $wp->query_vars['post_type'] == 'tproduct'){
                    $file = TLS_PLUGIN_CUSTOMPOSTS_DIR . 'templates/list-tproduct.php';
                    if(file_exists($file)){
                        $template_file = $file; //Kiểm tra file list-tproduct.php có tồn tại ko, nếu ko sẽ chạy file loop-single.php
                    }
                }
            }
            
            return $template_file;
        }
        
        public function showHome($query){
            if(is_home() && $query->is_main_query()){
                $query->set('post_type', array('post', 'tproduct')); // Hiển thị cả post và tproduct trên Home
            }
            
            return $query;
        }
        
        public function create() {
            $labels = array(
                'name'                  => __('Products'),
                'singular_name'         => __('Product'),
                'menu_name'             => __('TProduct'),
                'name_admin_bar'        => __('TProduct'),
                'add_new'               => __('Add TProduct'),
                'add_new_item'          => __('Add New TProduct'),
                'search_items'          => __('Search Product'),
                'not_found'             => __('No product found.'),
                'not_found_in_trash'    => __('No product found in Trash'),
                'view_item'             => __('View Product'),
                'edit_item'             => __('Edit TProduct')
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
     			'menu_position'         => 5,     // Vị trí xuất hiện trên menu left
     			'menu_icon'             => TLS_PLUGIN_IMAGES_URL . 'icon-setting16x16.png',
     			'capability_type'       => 'post',
    // 			'capabilities'          => array(),
    // 			'map_meta_cap'          => null,
     			'supports'              => array('title' ,'editor','author','thumbnail','excerpt','trackbacks' ,'custom-fields' ,'comments','revisions' ,'page-attributes','post-formats'),
    // 			'register_meta_box_cb'  => null,
    // 			'taxonomies'            => array(),
     			'has_archive'           => true,
     			'rewrite'               => true,
    // 			'query_var'             => true,
    // 			'can_export'            => true,
    // 			'delete_with_user'      => null,
    // 			'show_in_rest'          => false,
    // 			'rest_base'             => false,
    // 			'rest_controller_class' => false,
    // 			'_builtin'              => false,
     			'_edit_link'            => 'post.php?post=%d',
		    );
            
            register_post_type('tproduct', $args);
        }
    }