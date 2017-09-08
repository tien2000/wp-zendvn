<?php 
    global $tlsSupport;
?>

<header class="archive-header clr">
	<h1 class="archive-header-title"><?php echo __('Home');?></h1>
	<div class="layout-toggle">
		<span class="fa fa-bars"></span>
	</div>
	<!-- .layout-toggle -->
</header>
<!-- .archive-header -->
<div class="clr" id="blog-wrap">
<?php $i = 1;?>
<?php while (have_posts()): the_post();?>
<?php 
    $col = ($i%2)?1:2;
    $col = 'col-' . $col;
    $i++;
?>
	<article class="clr loop-entry <?php echo $col; ?>">
		<div class="loop-entry-media clr">
    		<?php 
    		  $cats       = get_the_category($post->ID);
    		  $catObj     = $cats['0'];
    		  $catID      = $catObj->cat_ID;
    		  $catName    = get_cat_name($catID);    		  
    		  $catUrl     = get_category_link($catID);
    		  $catCss     = 'cat-' . $catID . '-bg';
    		  
    		  /* echo '<pre>';
    		   print_r($catName);
    		   echo '</pre>'; */
    		?>
			<div class="entry-cat-tag <?php echo $catCss;?>">
				<a title="<?php echo $catName;?>" href="<?php echo $catUrl;?>"><?php echo $catName;?></a>
			</div>
			<!-- .entry-cat-tag -->
			<?php 
                $featured_img = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
                
                if($featured_img == false){
                    $imgUrl = $tlsSupport->get_img_url($post->post_content);
                }else {
                    $imgUrl = $featured_img;
                }
                if (isset($imgUrl)){
                    $imgUrl = $tlsSupport->get_new_img_url($imgUrl, $width, $height);
                }
            ?>
			<figure class="loop-entry-thumbnail">
				<a title="<?php the_title();?>" href="<?php the_permalink();?>">
					<div class="post-thumbnail">
						<img width="620" height="350" alt="<?php the_title();?>"
							src="<?php echo $imgUrl;?>">
					</div> <!-- .post-thumbnail -->
				</a>
			</figure>
			<!-- .loop-entry-thumbnail -->
		</div>
		<!-- .loop-entry-media -->
		<div class="loop-entry-content clr">
			<header>
				<h2 class="loop-entry-title">
					<a title="<?php the_title();?>" href="<?php the_permalink();?>"><?php the_title();?></a>
				</h2>
				<div class="loop-entry-meta clr">
					<div class="loop-entry-meta-date">
						<span class="fa fa-clock-o"></span><?php the_modified_date();?>
					</div>
					<div class="loop-entry-meta-comments">
						<span class="fa fa-comments"></span> <a
							title="<?php the_title();?>" href="<?php comment_link();?>"><?php comments_number('No Comment', '1 Comment', '% Comments');?></a>
					</div>
				</div>
				<!-- .loop-entry-meta -->
			</header>
			<div class="loop-entry-excerpt entry clr">
				<?php echo mb_substr(get_the_excerpt(), 0, 200) . '...'?>
			</div>
			<!-- .loop-entry-excerpt -->
		</div>
		<!-- .loop-entry-content -->
	</article>
	<!-- .loop-entry -->
<?php endwhile;?>

</div>
<!-- #blog-wrap -->
<div class="site-pagination clr">
	<span class="site-pagination-heading">Pages</span>
	<ul class="page-numbers">
		<li><span class="page-numbers current">1</span></li>
		<li><a href="#" class="page-numbers">2</a></li>
	</ul>
</div>
<div class="ad-spot archive-bottom-ad clr">
	<a title="Ad" href="#"> <img alt="Ad" src="images/ad-620x80.png">
	</a>
</div>
<!-- .ad-spot -->
