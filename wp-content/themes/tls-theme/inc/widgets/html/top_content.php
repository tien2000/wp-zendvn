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


<?php if($wp_query->have_posts()):?>
	<div class="slider-widget owl-carousel clr">
	<?php while ($wp_query->have_posts()): 
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
		<div class="slider-widget-slide clr">
			<a href="<?php the_permalink();?>" title="<?php the_title();?>"	class="widget-recent-posts-thumbnail clr"> 
				<img src="<?php echo $imgUrl;?>" alt="<?php the_title();?>" width="620" height="350" />
				<div class="slider-widget-title"><?php the_title();?></div>
			</a>
			<?php if($cat != 0):?>
    			<div class="entry-cat-tag cat-29-bg">
    				<a href="<?php echo get_category_link($cat);?>" title="<?php echo get_cat_name($cat);?>"><?php echo get_cat_name($cat);?></a>
    			</div>
			<?php endif;?>
		</div>
		<!-- .widget-slider-slide -->
	<?php endwhile;?>
	</div>
	<!-- .widget-slider -->
<?php endif;?>