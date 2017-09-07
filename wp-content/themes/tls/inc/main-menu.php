<?php 
/* 
 * has_nav_menu('top-menu'): Kiểm tra hiển thị của menu.
 * wp_nav_menu($args): Mảng chứa thuộc tính hiển thị menu.
 *  */
?>

<?php if(has_nav_menu('center-menu')):?>
	<div id="site-navigation-wrap" class="clr">
    	<div id="site-navigation-inner" class="clr container">
    		<nav id="site-navigation" class="navigation main-navigation clr" role="navigation">
            	<?php 
            	   $args = array( 
            	       'menu'              => '', 
            	       'container'         => 'div', 
            	       'container_class'   => 'menu-categories-container',       // class của thẻ bọc menu
            	       'container_id'      => '',                          // id của thẻ bọc menu
            	       'menu_class'        => 'main-nav dropdown-menu sf-menu',           // class của menu
            	       'menu_id'           => 'menu-categories',                 // id của menu
                       'echo'              => true, 
                       'fallback_cb'       => 'wp_page_menu', 
            	       'before'            => '',                          // Thẻ mở trước thẻ <a>
            	       'after'             => '',                          // Thẻ đóng sau thẻ <a>
            	       'link_before'       => '',                          // Giá trị sau thẻ mở <a>
            	       'link_after'        => '',                          // Giá trị trước thẻ đóng <a>
            	       'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>', 
            	       'item_spacing'      => 'preserve',
                       'depth'             => 0,                           // Số lượng cấp menu được hiển thị (0: Không giới hạn cấp menu)
            	       'walker'            => '',                          // new My_Walker_Menu: Lớp được truyền vào (tự tạo nếu cần)
            	       'theme_location'    => 'center-menu'	       
            	   );
            	   wp_nav_menu($args);
            	?>
        		<a href="#mobile-nav" class="navigation-toggle"> 
        			<span class="fa fa-bars navigation-toggle-icon"></span> 
        			<span class="navigation-toggle-text">Browse Categories</span>
    			</a>
    		</nav>
    	</div>
    </div>
<?php endif;?>

<!-- <div id="site-navigation-wrap" class="clr">
	<div id="site-navigation-inner" class="clr container">
		<nav id="site-navigation" class="navigation main-navigation clr"
			role="navigation">
			<div class="menu-categories-container">
				<ul id="menu-categories" class="main-nav dropdown-menu sf-menu">
					<li class="menu-item-object-category cat-28"><a href="#">Sports</a>
					</li>
					<li class="menu-item-object-category cat-5"><a href="#">Photography</a>
					</li>
					<li class="menu-item-object-category cat-6"><a href="#">Travel</a>
					</li>
					<li class="menu-item-object-category cat-3"><a href="#">Shopping</a>
					</li>
					<li class="menu-item-object-category cat-4"><a href="#">Nature</a>
					</li>
					<li class="menu-item-object-category cat-27"><a href="#">News</a></li>
					<li class="menu-item-object-category cat-2"><a href="#">Videos</a>
					</li>
					<li class="menu-item-object-category cat-26"><a href="#">Health</a>
					</li>
				</ul>
			</div>
			<a href="#mobile-nav" class="navigation-toggle"> <span
				class="fa fa-bars navigation-toggle-icon"></span> <span
				class="navigation-toggle-text">Browse Categories</span>
			</a>
		</nav>
	</div>
</div> -->