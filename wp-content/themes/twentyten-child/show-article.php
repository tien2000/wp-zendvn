<?php
/* 
 * Template Name: Article page
 *  */

get_header(); ?>

	<div id="container">
		<div id="content" role="main">
			<?php if(have_posts()): while (have_posts()): the_post();?>
				<?php
				    if(!isset($_GET['article'])){
				        require_once  'pages/article-list.php';
				    }else{
				        require_once  'pages/article.php';
				    }
				    
				?>
			<?php endwhile;endif;?>
		</div><!-- #content -->
	</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
			