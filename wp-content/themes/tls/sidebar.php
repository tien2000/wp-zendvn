<aside id="secondary" class="sidebar-container" role="complementary">
	<div class="sidebar-inner">
		<div class="widget-area">
			<?php
			     /* 
			      * is_active_sidebar(): Kiểm tra xem có sử dụng sidebar ko.
			      *  */
			     if(is_active_sidebar('primary-widget-area')):
			 ?>			
        		<?php
                    /*
                     * dynamic_sidebar(): Hiển thị widget cho theme. Tham số là ID của widget.
                     */
                    dynamic_sidebar('primary-widget-area');
                ?>
            <?php endif;?>
		</div>
	</div>
</aside>