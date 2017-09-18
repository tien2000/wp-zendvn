<?php 
    /* 
        Template Name: List Authors
     */
?>

<?php get_header();?>
		<!-- #top-wrap -->
		<?php echo __FILE__;?>
		<div class="site-main-wrap clr">
			<div id="main" class="site-main clr container">
				<div id="primary" class="content-area clr">
					<div id="content" class="site-content left-content clr" role="main">
                        <?php if (have_posts()): while (have_posts()): the_post();?>
                        	<article id="post-<?php the_ID();?>" <?php post_class('clr');?>>
                        		<header class="page-header clr">
                        			<h1 class="page-header-title"><?php the_title();?></h1>
                        		</header>
                        		<div class="entry clr">
                            		<?php the_content();?>
                            	</div>
                            	
                            	                           	
            					<div id="contributors-template-wrap" class="clr">
                					<?php 
                                	   $authorArr = array(
                                	       'orderby'      => 'post_count',
    	                                   'order'        => 'DESC',
                                	   ); 
                                	   $allUsers = get_users($authorArr);
                                	?>
                                	<?php 
                                	   foreach ($allUsers as $key => $info){
                                	       $userID = $info->ID;
                                	       if(count_user_posts($userID) > 0){
                                	?>
            						<article class="contributor-entry boxed-content clr">
            							<div class="contributor-entry-inner clr">
            								<div class="contributor-entry-avatar">
            									<a href="<?php echo get_author_posts_url($userID);?>" title="<?php echo get_author_name($userID);?>">
            										<?php echo get_avatar($userID, 60);?>
            									</a>
            									<div class="contributor-entry-count">
            										<a href="<?php echo get_author_posts_url($userID);?>" 
            											title="<?php echo __('Posts by ') . get_the_author_meta('display_name', $userID);?>">
            											<?php 
            											    if(count_user_posts($userID) == 1)
            											        echo count_user_posts($userID) . __(' article');
            											    else 
            											        echo count_user_posts($userID) . __(' articles');
            											 ?>
            										</a>
            									</div>
            								</div>
            								<div class="contributor-entry-desc">
            									<h2 class="contributor-entry-title">
            										<a href="<?php echo get_author_posts_url($userID);?>" 
            											title="<?php echo __('Posts by ') . get_the_author_meta('display_name', $userID);?>">
            											<?php echo get_author_name($userID);?>
            										</a>
            									</h2>
            									<div class="contributor-entry-url">
            										<span><?php echo __('Website') . ': '?></span> <a href="<?php echo get_the_author_meta('url', $userID);?>"
            											title=""><?php echo get_the_author_meta('url', $userID);?></a>
            									</div>
            									<p><?php echo get_the_author_meta('user_description', $userID);?></p>
            									<div class="contributor-entry-social clr">
            										<a href="https://twitter.com/WPExplorer" title="Twitter"
            											class="twitter"><span class="fa fa-twitter"></span></a> <a
            											href="https://www.facebook.com/WPExplorerThemes"
            											title="Facebook" class="facebook"><span
            											class="fa fa-facebook"></span></a> <a
            											href="https://plus.google.com/+Wpexplorer/posts"
            											title="Google Plus" class="google-plus"><span
            											class="fa fa-google-plus"></span></a> <a
            											href="http://linkedin.com" title="Facebook" class="linkedin"><span
            											class="fa fa-linkedin"></span></a> <a
            											href="http://pinterest.com/wpexplorer/" title="Pinterest"
            											class="pinterest"><span class="fa fa-pinterest"></span></a> <a
            											href="http://instagram.com" title="Instagram"
            											class="instagram"><span class="fa fa-instagram"></span></a>
            									</div>
            								</div>
            							</div>
            						</article>
            						<?php 
                                	       }
                                	   };
            						?>
            					</div>
            				</article>                        	
                        	<div id="comments" class="comments-area clr">
                            	<?php comments_template('', true);?>		
                        	</div>
                        <?php endwhile; endif;?>
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