<?php get_header();?>
		<!-- #top-wrap -->
		<div class="site-main-wrap clr">
			<div id="main" class="site-main clr container">
				<div id="primary" class="content-area clr">
					<div id="content" class="site-content left-content boxed-content" role="main">
						<?php echo '<br>' . __FILE__;?>
						<?php require_once TLS_THEME_INC_DIR . 'top-content.php';?>
						<!-- #home-slider-wrap -->
						<?php require_once TLS_THEME_DIR . '/archive-header.php';?>
						<!-- .archive-header -->
						<?php
						  // Tìm tập tin loop.php và loop-index.php
						  // Nếu loop.php tồn tại thì lấy loop.php
						  // Nếu loop-index.php tồn tại thì lấy loop-index.php
						  echo get_template_part('loop', 'archive');
						?>
						<!-- .home-cats -->
						<?php require_once TLS_THEME_INC_DIR . 'bottom-content.php';?>
						<!-- .featured-carousel-wrap -->
						<div class="ad-spot home-bottom-ad clr">
    						<?php 
        					   global $tlsCustomize;
        					   echo $tlsCustomize->ads_section('content-banner');
        					?>
							<!-- <a href="#" title="Ad"><img src="<?php echo TLS_THEME_IMAGE_URL; ?>ad-620x80.png" alt="Ad" /></a> -->
						</div>
						<!-- .ad-spot -->
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