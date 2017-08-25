<?php 
/* 
 * has_nav_menu('top-menu'): Kiểm tra hiển thị của menu.
 * wp_nav_menu($args): Mảng chứa thuộc tính hiển thị menu.
 *  */
?>

<?php if(has_nav_menu('top-menu')):?>
	<div id="topbar-nav" class="cr">
    	<?php 
    	   $args = array( 
    	       'menu'              => '', 
    	       'container'         => 'div', 
    	       'container_class'   => 'menu-menu-container',       // class của thẻ bọc menu
    	       'container_id'      => '',                          // id của thẻ bọc menu
    	       'menu_class'        => 'top-nav sf-menu',           // class của menu
    	       'menu_id'           => 'menu-menu',                 // id của menu
               'echo'              => true, 
               'fallback_cb'       => 'wp_page_menu', 
    	       'before'            => '',                          // Thẻ mở trước thẻ <a>
    	       'after'             => '',                          // Thẻ đóng sau thẻ <a>
    	       'link_before'       => '',                          // Giá trị sau thẻ mở <a>
    	       'link_after'        => '',                          // Giá trị trước thẻ đóng <a>
    	       'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>', 
    	       'item_spacing'      => 'preserve',
               'depth'             => 2,                           // Số lượng cấp menu được hiển thị (0: Không giới hạn cấp menu)
    	       'walker'            => '',                          // new My_Walker_Menu: Lớp được truyền vào (tự tạo nếu cần)
    	       'theme_location'    => 'top-menu'	       
    	   );
    	   wp_nav_menu($args);
    	?>
	</div>
<?php endif;?>

<!-- <div id="topbar-nav" class="cr">
	<div class="menu-menu-container">
		<ul id="menu-menu" class="top-nav sf-menu">
			<li><a href="#">Home</a></li>
			<li class="dropdown"><a href="#">Features <i
					class="fa fa-caret-down nav-arrow"></i></a>
				<ul class="sub-menu">
					<li><a href="#">Standard Post</a></li>
					<li><a href="#">Gallery</a></li>
					<li><a href="#">Audio</a></li>
					<li><a href="#">Video</a></li>
					<li><a href="#">Symple Shortcodes</a></li>
					<li><a href="#">Contributors</a></li>
				</ul></li>
			<li><a href="#">Archives</a></li>
			<li><a href="#">Contact</a></li>
			<li><a target="_blank" href="#">Customize</a></li>
			<li><a href="#" class="nav-loginout-link"> <span class="fa fa-lock"></span>
					Login
			</a></li>
		</ul>
	</div>
</div> -->