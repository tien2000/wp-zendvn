<?php
/* 
 * Template Name: Article page
 *  */

get_header(); ?>

	<div id="container">
		<div id="content" role="main">
			<?php if(have_posts()): while (have_posts()): the_post();?>
				<?php
				    //echo '<br>article: ' . $article = get_query_var('article');
				
				    if(empty($article)){
				        require_once  'pages/article-list.php';
				    }else{
				        require_once  'pages/article.php';
				    }
				    
				    /* echo '<pre>';
				    print_r($wp);
				    echo '</pre>'; */
				    
				    echo '<pre>';
				    print_r($wp_rewrite);
				    echo '</pre>'; 
				    
				?>
			<?php endwhile;endif;?>
		</div><!-- #content -->
	</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
			