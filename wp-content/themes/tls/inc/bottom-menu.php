<?php 
/* 
 * has_nav_menu('top-menu'): Kiểm tra hiển thị của menu.
 * wp_nav_menu($args): Mảng chứa thuộc tính hiển thị menu.
 *  */
?>

<?php if(has_nav_menu('bottom-menu')):?>	
	<?php 
	   $args = array( 
	       'menu'              => '', 
	       'container'         => '', 
	       'container_class'   => '',       // class của thẻ bọc menu
	       'container_id'      => '',                          // id của thẻ bọc menu
	       'menu_class'        => 'footer-nav clr',           // class của menu
	       'menu_id'           => 'menu-footer',                 // id của menu
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
	       'theme_location'    => 'bottom-menu'	       
	   );
	   wp_nav_menu($args);
	?>        		
<?php endif;?>

<!-- <ul id="menu-footer" class="footer-nav clr">
	<li><a href="#">Home</a></li>
	<li><a href="#">Archives</a></li>
	<li><a href="#">Contact</a></li>
</ul> -->