<?php
/**
 * Main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>
<style type="text/css">
    #tls-mp-info{
    	border: 1px solid #ccc;
    	background: white;
    	min-height: 100px;
    }
</style>

		<div id="container">
			<div id="content" role="main">
			<div id="tls-mp-info">

<?php $args = array(
	'type'            => 'monthly',
	'limit'           => '',
	'format'          => 'html',
	'before'          => '',
	'after'           => '',
	'show_post_count' => false,
	'echo'            => 1,
	'order'           => 'DESC',
        'post_type'     => 'post'
); ?>

				<ul>
					<li>wp_get_archives('type'): <?php wp_get_archives($args['post_type']); ?></li>
				</ul>
			</div>
			<?php
			/*
			 * Run the loop to output the posts.
			 * If you want to overload this in a child theme then include a file
			 * called loop-index.php and that will be used instead.
			 */
			get_template_part( 'loop', 'index' );
			?>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
