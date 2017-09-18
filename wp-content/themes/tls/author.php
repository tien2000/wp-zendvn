<?php get_header();?>

<style>
    .archive-header{
        padding-left: 80px;
    }
</style>

		<!-- #top-wrap -->
		<div class="site-main-wrap clr">
			<div id="main" class="site-main clr container">
				<div id="primary" class="content-area clr">
					<div id="content" class="site-content left-content clr" role="main">
					<?php 
					   $userID = get_query_var('author');
					?>
        				<header class="archive-header clr">
        					<div class="author-archive-gravatar clr">
        						<?php echo get_avatar($userID, 60);?>
        					</div>
        					<h1 class="archive-header-title"><?php echo __('Articles Written By' . ': ') . get_the_author_meta('display_name', $userID);?></h1>
        					<div class="archive-description clr"><?php echo __('This author has written ');?> 
								<?php 
    								if(count_user_posts($userID) == 1)
								        echo count_user_posts($userID) . __(' article');
								    else if(count_user_posts($userID) > 1)
								        echo count_user_posts($userID) . __(' articles');
								?>
							</div>
        					<span class="layout-toggle"><span class="fa fa-th-list"></span></span>
        				</header>
						<?php echo get_template_part('loop', 'archive'); ?>
						<!-- .home-cats -->						
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