<?php
/**
 * The loop that displays a single post
 *
 * The loop displays the posts and the post content. See
 * https://codex.wordpress.org/The_Loop to understand it and
 * https://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop-single.php.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.2
 */
?>
<style>
#tls-mp-info{
	background-color: white;
	min-height: 300px;
	border: solid 1px #ccc;
	padding: 10px;
}
</style>

<h2><?php single_post_title('Tls: ', true);?></h2>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div id="tls-mp-info">
	<ul>
		<li>the_author()			: <?php the_author();?> </li>
		<li>get_the_author()		: <?php echo get_the_author();?> </li>
		<li>the_author_link()		: <?php the_author_link();?> </li>
		<li>get_the_author_link()	: <?php echo get_the_author_link();?> </li>
		<li>the_author_meta()		: <?php the_author_meta()?> </li>
		<li>the_author_posts()		: <?php the_author_posts();?> </li>	
		<li>the_author_posts_link()	: <?php the_author_posts_link()?> </li>
		<li>wp_dropdown_users()		: <?php wp_dropdown_users();?> </li>
		<li>wp_list_authors()		: <?php wp_list_authors()?> </li>
		<li>get_author_posts_url()	: <?php echo get_author_posts_url(3);?> </li>	
	</ul>
</div>

				<div id="nav-above" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentyten' ) . '</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentyten' ) . '</span>' ); ?></div>
				</div><!-- #nav-above -->

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1 class="entry-title"><?php the_title(); ?></h1>

					<div class="entry-meta">
						<?php twentyten_posted_on(); ?>
					</div><!-- .entry-meta -->

					<?php
					   $tls_price  = get_post_meta(get_the_ID(), 'tls_mp_mb_data2_price', true);
					   if(!empty($tls_price)) $tls_price = '<li>'.translate('Price: '. $tls_price .'').'</li>';

					   $tls_author  = get_post_meta(get_the_ID(), 'tls_mp_mb_data2_author', true);
					   if(!empty($tls_author)) $tls_author = '<li>'.translate('Author: '. $tls_author .'').'</li>';

					   $tls_level  = get_post_meta(get_the_ID(), 'tls_mp_mb_data2_level', true);
					   if(!empty($tls_level)) $tls_level = '<li>'.translate('Level: '. $tls_level .'').'</li>';

					   $tls_profile  = get_post_meta(get_the_ID(), 'tls_mp_mb_data2_profile', true);
					   if(!empty($tls_profile)) $tls_profile = '<li>'.translate('Profile: '. $tls_profile .'').'</li>';

					   if(!empty($tls_price) || !empty($tls_author) || !empty($tls_level) || !empty($tls_profile)):
                    ?>

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->

					<?php
					   $metaboxCssUrl = dirname(get_bloginfo('stylesheet_url')) . '/css/metabox-style.css';
					?>
					<link rel="stylesheet" type="text/css" media="all" href="<?php echo $metaboxCssUrl;?>">
					<div class="tls-meta-box">
						<ul>
							<?php echo $tls_price . $tls_author . $tls_level . $tls_profile;?>
						</ul>
					</div>
					<?php endif;?>

<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
					<div id="entry-author-info">
						<div id="author-avatar">
							<?php
							/** This filter is documented in author.php */
							echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyten_author_bio_avatar_size', 60 ) );
							?>
						</div><!-- #author-avatar -->
						<div id="author-description">
							<h2><?php printf( __( 'About %s', 'twentyten' ), get_the_author() ); ?></h2>
							<?php the_author_meta( 'description' ); ?>
							<div id="author-link">
								<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
									<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'twentyten' ), get_the_author() ); ?>
								</a>
							</div><!-- #author-link	-->
						</div><!-- #author-description -->
					</div><!-- #entry-author-info -->
<?php endif; ?>

					<div class="entry-utility">
						<?php twentyten_posted_in(); ?>
						<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-utility -->
				</div><!-- #post-## -->

				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentyten' ) . '</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentyten' ) . '</span>' ); ?></div>
				</div><!-- #nav-below -->

				<?php comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>
