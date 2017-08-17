<?php 
/* 
 * get_category_link($cat): Lấy link của Category.
 * get_cat_name($cat): Lấy tên của Category.
 * $postObj = $wp_query->post; Gọi đến đối tượng post trong $wp_query (để lấy ra ID hoặc else của bài viết).
 * get_post_thumbnail_id($postObj->ID): Lấy ra giá trị meta_value trong bảng postmeta.
 * wp_get_attachment_url(get_post_thumbnail_id($postObj->ID)): Lấy ra đường dẫn chứa hình ảnh có giá trị meta_value trong bảng
 *                                                              postmeta (đường dẫn chứa ảnh của Featured).
 *  */
?>
<?php $i = 1;?>
<?php if($wp_query->have_posts()):?>
    <div id="home-slider-wrap" class="clr">
    	<div id="home-slider" class="owl-carousel">
        	<?php        	   
        	   while ($wp_query->have_posts()):         	       
        	       $wp_query->the_post();
        	       $postObj = $wp_query->post; 
        	       //echo $postObj->ID;
        	       //echo get_post_thumbnail_id($postObj->ID);
        	       $featured_img = wp_get_attachment_url(get_post_thumbnail_id($postObj->ID));
        	       
        	       if($featured_img == false){
        	           $imgUrl = $this->get_img_url($postObj->post_content);
        	       }else {
        	           $imgUrl = $featured_img;
        	       }
        	       if (isset($imgUrl)){
        	           $imgUrl = $this->get_new_img_url($imgUrl, $width, $height);
        	       }        	       
        	?>        	
        	<div class="home-slider-slide" data-dot="<?php echo $i; $i++;?>">
        		<?php if($cat != 0):?>
        			<div class="entry-cat-tag cat-25-bg">
        				<a href="<?php echo get_category_link($cat);?>" title="<?php echo get_cat_name($cat);?>"><?php echo get_cat_name($cat);?></a>
        			</div>
    			<?php endif;?>
    			<!-- .entry-cat-tag -->
    			<div class="home-slider-media">
    				<a href="<?php the_permalink();?>" title="<?php the_title();?>"> <img
    					src="<?php echo $imgUrl;?>"
    					alt="<?php the_title();?>" />
    				</a>
    			</div>
    			<!-- .home-slider-media -->
    			<div class="home-slider-caption clr">
    				<h2 class="home-slider-caption-title">
    					<a href="<?php the_permalink();?>" title="<?php the_title();?>" rel="bookmark"><?php the_title();?></a>
    				</h2>
    				<div class="home-slider-caption-excerpt clr"><?php echo mb_substr(get_the_excerpt(), 0, 50) . '...'?></div>
    				<!-- .home-slider-caption-excerpt -->
    			</div>
    			<!--.home-slider-caption -->
    		</div>
    		<!-- .home-slider-slide-->
    		<?php endwhile;?>
    	</div>
    	<!-- #home-slider -->
    	<div id="home-slider-numbers"></div>
    </div>
<?php endif;?>