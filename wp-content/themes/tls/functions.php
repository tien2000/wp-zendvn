<?php
/* 
 * get_template_directory(): Đường dẫn tuyệt đối đến thư mục chứa theme.
 * get_template_directory_uri(): Đường dẫn(url) đến thư mục theme/
 * 
 * $wp_styles->add_data('tls_theme_ie8', 'conditional', 'IE 8'): Gọi tập tin ie8.css khi trình duyệt là IE 8
 * 
 * 'widget_init': Hook hiển thị widget cho theme
 * 'after_setup_theme': Hook thêm hỗ trợ cho theme.
 * add_theme_support( 'post-formats', array() ): Khai báo cho phần Format trong Post/Page.
 * add_theme_support( 'post-thumbnails' ): Khai báo phần Featured Image trong Post/Page.
 * register_nav_menus(): Khai báo hiển thị menu.
 * Hook 'walker_nav_menu_start_el': Tương tác vào cặp thẻ <i> trong thẻ <a>
 * Hook 'nav_menu_css_class': Tương tác vào cặp thẻ <li>
 * in_array(): Tìm giá trị trong mảng
 *  */

define('TLS_THEME_URL', get_template_directory_uri());
define('TLS_THEME_CSS_URL', TLS_THEME_URL . '/css/');
define('TLS_THEME_JS_URL', TLS_THEME_URL . '/js/');
define('TLS_THEME_IMAGE_URL', TLS_THEME_URL . '/images/');

define('TLS_THEME_DIR', get_template_directory());
define('TLS_THEME_INC_DIR', TLS_THEME_DIR . '/inc/');
define('TLS_THEME_WIDGETS_DIR', TLS_THEME_INC_DIR . 'widgets/');
define('TLS_THEME_CONTROLS_DIR', TLS_THEME_INC_DIR . 'controls/');

define('TLS_THEME_WIDGETS_HTML_DIR', TLS_THEME_WIDGETS_DIR . 'html/');

/* ============================================================
 * Gọi các tập tin
 * ============================================================ */
if(!class_exists('TlsHtml') && is_admin()){
    require_once TLS_THEME_INC_DIR . 'html.php';
}

require_once TLS_THEME_WIDGETS_DIR . 'main.php';
new Tls_Theme_Wg_Main();

require_once TLS_THEME_INC_DIR . 'customizer.php';
global $tlsCustomize;
$tlsCustomize = new Tls_Theme_Customize_Control();

require_once TLS_THEME_INC_DIR . 'support.php';
global $tlsSupport;
$tlsSupport = new Tls_Theme_Support();

/* ============================================================
 * 11. TLS_HOMEPAGE SHORTCODE
 * ============================================================ */
add_shortcode('tls_homepage', 'tls_theme_sc_homepage');

function tls_theme_sc_homepage($attr, $content = null){ 
    global $tlsSupport;
    $out = '';
    $catArr = explode(',', $attr['cats']);
    $number = $attr['number'];
    $i = 1;
    
    if(count($catArr) > 0){
        foreach ($catArr as $cat){
            //echo '<br>' . $cats;
            
            // Lấy danh sách bài viết của Category
            $args = array(
                'posts_per_page'    => $number,
                'paged'             => 1,
                'post_type'         => 'post',
                'ignore_sticky_posts'=> true,
                //'category__in'      => $cat,
                'cat'               => $cat
            );
            $wpQuery = new WP_Query($args);
            
            $col = ($i%2)?1:2;
            $i++;
            
            $out .= '<div class="home-cat-entry clr col-' . $col . '">
                        <h2 class="heading">
                            <a href="'. get_category_link($cat) .'" title="'. get_cat_name($cat) .'">'. get_cat_name($cat) .'</a>
                        </h2>
                        <ul>
                    ';
            
            if($wpQuery->have_posts()){
                $num = 1;
                while ($wpQuery->have_posts()){
                    $wpQuery->the_post();
                    if($num == 1){
                        $featured_img = wp_get_attachment_url(get_post_thumbnail_id($wpQuery->post->ID));
                        
                        if($featured_img == false){
                            $imgUrl = $tlsSupport->get_img_url($wpQuery->post->post_content);
                        }else {
                            $imgUrl = $featured_img;
                        }
                        if (isset($imgUrl)){
                            $imgUrl = $tlsSupport->get_new_img_url($imgUrl, '300px', '169px');
                        }
                        
                        $out .= '<li class="home-cat-entry-post-first clr">
                            		<div class="home-cat-entry-post-first-media clr">
                            			<a href="'.get_permalink().'" title="' . get_the_title() . '"> 
                            			    <img src="'.$imgUrl.'" alt="" width="620" height="350">
                            			</a>
                            			<div class="entry-cat-tag cat-'.$cat.'-bg">
                            				<a href="'.get_category_link($cat).'" title="' . get_cat_name($cat) . '">' . get_cat_name($cat) . '</a>
                            			</div>
                            		</div>
                            		<h3 class="home-cat-entry-post-first-title">
                            			<a href="'.get_permalink().'" title="' . get_the_title() . '">' . mb_substr(get_the_title() , 0, 40) . '...</a>
                            		</h3>
                            		<p>' .mb_substr(get_the_excerpt(), 0, 120) . '...</p>
                            	</li>
                                ';
                    }else{
                        $out .= '<li class="home-cat-entry-post-other clr">
                                    <a href="'.get_permalink().'" 
                                         title="' . get_the_title() . '">' . mb_substr(get_the_title() , 0, 40) . '...</a>
                                </li>
                                ';
                    }
                    $num++;
                }
            }
            $out .= '</ul></div>';
        }
    }
    return $out;
}

////////////////////////////////////////////////////////////////

/* ============================================================
 * 10. HIỂN THỊ DANH SÁCH COMMENT
 * ============================================================ */


////////////////////////////////////////////////////////////////

// Hàm định dạng comment
function tls_comment($comment, $args, $depth){
    //echo '<br>' . __FUNCTION__;
    
    global $post;    
    $author_id  = $post->post_author;
    $comment_user_id = $comment->user_id;
    
    /* echo '<pre>';
    print_r($post);
    echo '</pre>'; */
    /* echo '<pre>';
    print_r($comment);
    echo '</pre>'; */
    
    switch ($comment->comment_type){
        // Xử lý comment từ website bên ngoài.
        case 'pingback':
        case 'trackback':
?>
	<li id="comment-<?php comment_ID();?>" <?php comment_class('clr');?>>
		<div class="pingback-entry">
			<span class="pingback-heading"><?php _e('Pingback: ')?></span>
			<?php comment_author_link();?>
		</div>
<?php
        break;
        // Kết thúc xử lý comment từ website bên ngoài.
        
        case '':
?>

    <li id="li-comment-<?php comment_ID();?>">
    	<div id="comment-<?php comment_ID();?>" <?php comment_class('clr');?>>
    		<div class="comment-author vcard">
    			<?php echo get_avatar($comment, 60);?>
    		</div>
    		<div class="comment-details clr ">
    			<header class="comment-meta">
    				<cite class="fn"> 
    					<?php echo get_comment_author_link();?>
    					<?php 
    					   // Kiểm tra comment của User nào.
    					   if($comment_user_id == $author_id):
    					?>
    						<span class="author-badge">Author</span>
    					<?php endif;?>
    				</cite> <span class="comment-date"> <a
    					href="http://wpexplorer-demos.com/spartan/model-shoot-for-gq-2015/#comment-120"><time
    							datetime="2014-09-23T23:49:31+00:00"><?php comment_date();?></time></a>
    					<?php echo __('at ')?> <?php comment_time();?>
    				</span>
    			</header>
    			<div class="comment-content entry clr">
    				<?php comment_text();?>
    			</div>
    			<div class="reply comment-reply-link">
    				<?php 
    				    $replyArgs = array(
    				        'depth'       => $depth,
    				        'max_depth'   => $args['max_depth'],
    				        'reply_text'  => 'Reply to this message',
    				    );
    				    comment_reply_link($replyArgs);?>
    			</div>
    		</div>
    	</div>

<?php
        break;
    }
}

/* require_once TLS_THEME_INC_DIR . 'check_page.php';
new Check_Page(); */

//require TLS_THEME_CONTROLS_DIR . 'category_listbox.php';

////////////////////////////////////////////////////////////////

/* ============================================================
 * 9. Gallery - Thay đổi cấu trúc của GALLERY SHORTCODE đã tồn tại
 * ============================================================ */
add_action('after_setup_theme', 'tls_theme_gallery_shortcode');

function tls_theme_gallery_shortcode(){
    remove_shortcode('gallery');

    add_shortcode('gallery', 'tls_theme_sc_gallery');
}

function tls_theme_sc_gallery($attr, $content = null){
    static $instance = 0;
    $instance++;
    $selector = 'gallery-' . $instance;
    
    $out = '<div id="' . $selector . '" class="post-gallery owl-carousel wpex-gallery-lightbox owl-loaded owl-drag">';
    $imgIDs = explode(',', $attr['ids']);
    foreach ($imgIDs as $val){
        $imgUrl = wp_get_attachment_url($val);
        //echo '<br>' . $imgUrl;
        $out .= '<div class="owl-item">
    				<div data-dot="<img src=\''.$imgUrl.'\' alt=\'\'>">
    					<figure>
    						<a title="" href="'.$imgUrl.'">
    							<img width="620" height="350" alt="" src="'.$imgUrl.'">
    							<span class="overlay"></span>
    						</a>
    					</figure>
    				</div>
                   </div>
    			';
    }
     
    $out .= '</div>';
     
     /* echo '<pre>';
     print_r($imgIDs);
     echo '</pre>'; */
     /* echo '<pre>';
     print_r($content);
     echo '</pre>'; */

    return $out;
}

////////////////////////////////////////////////////////////////

/* ============================================================
 * 8. Caption - Thay đổi cấu trúc của HTML SHORTCODE đã tồn tại
 * ============================================================ */
add_action('after_setup_theme', 'tls_theme_caption_shortcode');

function tls_theme_caption_shortcode(){
    remove_shortcode('caption');

	add_shortcode('caption', 'tls_theme_sc_caption');
}

function tls_theme_sc_caption($attr, $content = null){
    /* echo '<pre>';
    print_r($attr);
    echo '</pre>'; */
    /* echo '<pre>';
    print_r($content);
    echo '</pre>'; */
    
    $strAttr = '';
	if(count($attr) >0 ){
		foreach ($attr as $key => $info){
			$strAttr .= ' ' . $key . '="' . $info .'" ';
		}
	}
	$pattern = '#(<a.*\/a>)(.*)#';
	preg_match_all($pattern, $content, $matches);

	$img = $matches[1][0];
	$desc = $matches[2][0];
	$out = '<p ' . $strAttr . ' class="wp-caption aligncenter">'
        	. $img
        	. '<span class="wp-caption-text">' . $desc . '</span>'
        	. '</p>';
	return $out;
}

//////////////////////////////////////////////////////////////

/* ============================================================
 * 7. Menu - Chỉnh sửa giá trị thuộc tính class trong thẻ <li>
 * ============================================================ */
add_filter('nav_menu_css_class', 'tls_theme_nav_css', 10, 4);

function tls_theme_nav_css($classes, $item, $args, $depth){
    if($args->theme_location == 'top-menu'){
        $itemClass = $item->classes;
        if(in_array('menu-item-has-children', $itemClass) && $item->menu_item_parent == 0){
            /* echo '<pre>';
            print_r($classes);
            echo '</pre>'; */
            $classes[] = 'dropdown';
        }
    }
    
    if($args->theme_location == 'center-menu'){
        if($item->menu_item_parent == 0){
            $newClass = 'cat-' . $item->object_id;
            //echo '<br>' . $newClass;
            $classes[] = $newClass;
        }
    }
    return $classes;
}

/* ============================================================
 * 6. Menu - Chỉnh sửa giá trị trong cặp thẻ <a>
 * ============================================================ */
add_filter('walker_nav_menu_start_el', 'tls_theme_nav_description', 10, 4);

function tls_theme_nav_description($item_output, $item, $depth, $args){
    // $item_output => Cặp thẻ <a> nằm trong hệ thống Menu.
    // $item        => Đối tượng WP_Post.
    // $depth       => Độ sâu của Menu.
    // $args        => Đối tượng chứa thông tin Menu.
    
    if($args->theme_location == 'top-menu'){
        /* echo '<pre>';
        print_r($item);
        echo '</pre>'; */
        $itemClass = $item->classes;
        if(in_array('menu-item-has-children', $itemClass) && $item->menu_item_parent == 0){
            $item_output = str_replace('</a>', '<i class="fa fa-caret-down nav-arrow"></i></a>', $item_output);
        }
        if($item->post_title == 'Login'){
            /* echo '<pre>';
            print_r($item);
            echo '</pre>'; */
            $item_output = str_replace('>Login', '><span class="fa fa-lock"></span>Login', $item_output);
            if(is_user_logged_in()){
                $hrefUrl = 'href="'. wp_logout_url() .'"';
                $item_output = str_replace('>Login<', '>Logout<', $item_output);
                $item_output = preg_replace('/href="(.*)"/', $hrefUrl, $item_output);
                $item_output = str_replace('>Logout', '><span class="fa fa-lock"></span>Logout', $item_output);
            }
        }
    }
    return $item_output;
}


/* ============================================================
 * 5. Khai báo hệ thống Menu cho Theme.
 * ============================================================ */
add_action('init', 'tls_theme_register_menus');

function tls_theme_register_menus(){
    register_nav_menus(array(
        'top-menu'      =>  __('Top Menu'),
        'center-menu'      =>  __('Center Menu'),
        'bottom-menu'      =>  __('Bottom Menu')
    ));
}


/* ============================================================
 * 4. Khai báo hệ thống Widget cho Theme.
 * ============================================================ */
add_action('widgets_init', 'tls_theme_widget_init');

function tls_theme_widget_init(){
    register_sidebar(array(
       'name'          => __( 'Primary Widget Area', 'Tls Widget' ),
	   'id'            => 'primary-widget-area',
       'description'   => __( 'Right Widget on Website', 'tls Widget' ),
       'class'         => '',
	   'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s clr">',
       'after_widget'  => '</div>',
       'before_title'  => '<span class="widget-title">',
       'after_title'   => '</span>'
    ));    
    
    register_sidebar(array(
        'name'          => __( 'Top Content Area', 'Tls Widget' ),
        'id'            => 'top-content-widget-area',
        'description'   => __( 'Top Widget on Website', 'tls Widget' ),
        'class'         => '',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '',
        'after_title'   => ''
    ));
    
    register_sidebar(array(
        'name'          => __( 'Bottom Content Area', 'Tls Widget' ),
        'id'            => 'bottom-content-widget-area',
        'description'   => __( 'Bottom Widget on Website', 'tls Widget' ),
        'class'         => '',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '',
        'after_title'   => ''
    ));
    
    register_sidebar(array(
        'name'          => __( 'Before Footer area 1', 'Tls Widget' ),
        'id'            => 'before-footer-area-1',
        'description'   => __( 'Before Footer area 1 on Website', 'tls Widget' ),
        'class'         => '',
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s clr">',
        'after_widget'  => '</div>',
        'before_title'  => '<span class="widget-title">',
        'after_title'   => '</span>'
    ));
    
    register_sidebar(array(
        'name'          => __( 'Before Footer area 2', 'Tls Widget' ),
        'id'            => 'before-footer-area-2',
        'description'   => __( 'Before Footer area 2 on Website', 'tls Widget' ),
        'class'         => '',
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s clr">',
        'after_widget'  => '</div>',
        'before_title'  => '<span class="widget-title">',
        'after_title'   => '</span>'
    ));
    
    register_sidebar(array(
        'name'          => __( 'Before Footer area 3', 'Tls Widget' ),
        'id'            => 'before-footer-area-3',
        'description'   => __( 'Before Footer area 3 on Website', 'tls Widget' ),
        'class'         => '',
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s clr">',
        'after_widget'  => '</div>',
        'before_title'  => '<span class="widget-title">',
        'after_title'   => '</span>'
    ));
    
    register_sidebar(array(
        'name'          => __( 'Before Footer area 4', 'Tls Widget' ),
        'id'            => 'before-footer-area-4',
        'description'   => __( 'Before Footer area 4 on Website', 'tls Widget' ),
        'class'         => '',
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s clr">',
        'after_widget'  => '</div>',
        'before_title'  => '<span class="widget-title">',
        'after_title'   => '</span>'
    ));
}


/* ============================================================
 * 3. Khai báo Post Format
 * ============================================================ */
add_action('after_setup_theme', 'tlsThemeSupport');

function tlsThemeSupport(){
    // array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' )
    add_theme_support( 'post-formats', array('aside', 'image', 'gallery', 'video', 'audio') );
    add_theme_support( 'post-thumbnails' );
    /* add_theme_support( 'custom-background' );
    add_theme_support( 'custom-header' ); */
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption') );
}

	
/* ============================================================
 * 2. Nạp JS vào theme
 * ============================================================ */
add_action('wp_enqueue_scripts', 'tls_theme_register_script');
add_action('wp_footer', 'tls_theme_script_code');

function tls_theme_register_script(){
    $jsUrl = get_template_directory_uri() . '/js/';
    
    wp_register_script('tls_theme_jquery_form_min', $jsUrl . 'jquery.form.min.js', array('jquery'), '1.0', true );
    wp_enqueue_script('tls_theme_jquery_form_min');
    
    wp_register_script('tls_theme_scripts', $jsUrl . 'scripts.js', array('jquery'), '1.0', true );
    wp_enqueue_script('tls_theme_scripts');
    
    wp_register_script('tls_theme_plugins', $jsUrl . 'plugins.js', array('jquery'), '1.0', true );
    wp_enqueue_script('tls_theme_plugins');
    
    wp_register_script('tls_theme_global', $jsUrl . 'global.js', array('jquery'), '1.0', true );
    wp_enqueue_script('tls_theme_global');
    
    if(is_singular() && comments_open()){
        // scrip hỗ trợ hiển thị Form comment dưới phần Reply
        wp_enqueue_script('comment-reply');
    }
}

function tls_theme_script_code(){
    echo '<script type=\'text/javascript\'>
    var wpexLocalize = {
        "mobileMenuOpen" : "Browse Categories",
        "mobileMenuClosed" : "Close navigation",
        "homeSlideshow" : "false",
        "homeSlideshowSpeed" : "7000",
        "UsernamePlaceholder" : "Username",
        "PasswordPlaceholder" : "Password",
        "enableFitvids" : "true"
    };
    </script>';
}


/* ============================================================
 * 1. Nạp CSS vào theme
 * ============================================================ */

add_action('wp_enqueue_scripts', 'tls_theme_register_style');

function tls_theme_register_style(){
    global $wp_styles;
    $cssUrl = get_template_directory_uri() . '/css/';
    
    wp_register_style('tls_theme_symple_shortcodes', $cssUrl . 'symple_shortcodes_styles.css', array(), '1.0');
    wp_enqueue_style('tls_theme_symple_shortcodes');
    
    wp_register_style('tls_theme_style', $cssUrl . 'style.css', array(), '1.0');
    wp_enqueue_style('tls_theme_style');
    
    wp_register_style('tls_theme_responsive', $cssUrl . 'responsive.css', array(), '1.0');
    wp_enqueue_style('tls_theme_responsive');    
    
    /* wp_register_style('tls_theme_site', $cssUrl . 'site.css', array(), '1.0');
    wp_enqueue_style('tls_theme_site'); */
    
    wp_register_style('tls_theme_customize', $cssUrl . 'customize.css', array(), '1.0');
    wp_enqueue_style('tls_theme_customize');
    
    wp_register_style('tls_theme_ie8', $cssUrl . 'ie8.css', array(), '1.0');
    $wp_styles->add_data('tls_theme_ie8', 'conditional', 'IE 8');
    wp_enqueue_style('tls_theme_ie8');
}
	