<?php get_header();?>
		<!-- #top-wrap -->
		<div class="site-main-wrap clr">
			<div id="main" class="site-main clr container">
				<div id="primary" class="content-area clr">
					<div id="content" class="site-content left-content clr" role="main">
						<article class="single-post-article clr">
    						<?php //echo '<br>' . __FILE__;?>
    						<?php require_once TLS_THEME_DIR . '/single-header.php';?>
    						
    						<?php
    						  // Tìm tập tin loop.php và loop-index.php
    						  // Nếu loop.php tồn tại thì lấy loop.php
    						  // Nếu loop-index.php tồn tại thì lấy loop-index.php
    						  echo get_template_part('loop', 'single');
    						?>
        				</article>
        			</div>
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