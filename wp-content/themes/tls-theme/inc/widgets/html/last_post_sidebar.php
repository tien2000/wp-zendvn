<?php 
/* 
 * the_modified_date(); Hiển thị định dạng ngày tháng năm
 *  */
?>

<?php if($wp_query->have_posts()):?>
    <ul class="widget-recent-posts clr">
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
        	<li class="clr widget-recent-posts-li left-thumbnail format-">
        		<a href="<?php the_permalink();?>" title="<?php the_title();?>" class="widget-recent-posts-thumbnail clr"> 
        			<img src="<?php echo $imgUrl;?>" alt="<?php the_title();?>" width="620" height="350" />
        		</a>
        		<div class="widget-recent-posts-content clr">
        			<a href="<?php the_permalink();?>" title="<?php the_title();?>"
        				class="widget-recent-posts-title"><?php the_title();?></a>
        			<div class="widget-recent-posts-date"><?php the_modified_date();?></div>
        		</div> 
        		<!-- .widget-recent-posts-content -->
        	</li>
        <?php endwhile;?>
    </ul>    
<?php endif;?>