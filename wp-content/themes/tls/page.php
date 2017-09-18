<?php 
    /* 
        Template Name: Default
     */
?>

<?php get_header();?>
		<!-- #top-wrap -->
		<div class="site-main-wrap clr">
			<div id="main" class="site-main clr container">
				<div id="primary" class="content-area clr">
					<?php get_template_part('loop', 'page');?>
					<!-- #content -->
					<?php get_sidebar();?>
					<!-- #secondary -->
				</div>
				<!-- #primary -->

			</div>
			<!--.site-main -->
		</div>
		<!-- .site-main-wrap -->
	</div>
	<!-- #wrap -->

	<?php get_footer();?>	