<?php
/**
 * Template for displaying Category Archive pages
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

<style>
.tls_mp_mb_taxonomy_category{
	border: 1px solid;
    padding: 5px;
    margin-bottom: 10px;
    background-color: #f2f7fc;
}

.tls_mp_mb_taxonomy_category .img{
	float: left;
    margin: 5px;
}

.tls_mp_mb_taxonomy_category .sumary{
	font-size: 14px;
    font-style: italic;
}

.tls_mp_mb_taxonomy_category h1{
	clear: none;
    margin-bottom: 7px !important;
    font-size: 16px;
}

.clr{
	clear: both;
}
</style>

		<div id="container">
			<div id="content" role="main">
			<div class="tls_mp_mb_taxonomy_category">
				<div class="img"><img alt="" src="<?php echo $tls_mp_mb_taxonomy_category['picture'];?>"></div>
				<div class="sumary">
					<h1 class="page-title">
						<?php printf( __( 'Category: %s', 'twentyten' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?>
    				</h1>
					<?php echo $tls_mp_mb_taxonomy_category['sumary']; ?>
				</div>
				<div class="clr"></div>
			</div>
				
			<?php
    			/*
    			 * Run the loop for the category page to output the posts.
    			 * If you want to overload this in a child theme then include a file
    			 * called loop-category.php and that will be used instead.
    			 */
    			get_template_part( 'loop', 'category' );
			?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
