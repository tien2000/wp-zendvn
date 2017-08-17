<?php 
/* 
 * the_modified_date(); Hiển thị định dạng ngày tháng năm
 *  */
?>

<?php if($wp_query->have_posts()):?>
    <ul class="widget-latest-news clr">
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
        	<li class="first-post clr">
        		<div class="first-post-media clr">
        			<a href="#" title="I&#8217;m Hungry, Make Me A Sandwich"> <img
        				src="http://localhost/wp-zendvn/wp-content/themes/tls-theme/files/uploads/2013/12/shutterstock_167357615-620x350.jpg"
        				alt="I&#8217;m Hungry, Make Me A Sandwich" width="620" height="350" />
        			</a>
        			<div class="entry-cat-tag cat-36-bg">
        				<a href="category/health/food/index.html" title="Food">Food</a>
        			</div>
        			<!-- .entry-cat-tag -->
        		</div> <!-- .first-post-media --> <a href="#"
        		title="I&#8217;m Hungry, Make Me A Sandwich"
        		class="widget-recent-posts-title">I&#8217;m Hungry, Make Me A Sandwich</a>
        		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        			Pellentesque nec diam non velit vestibulum sagittis.&hellip;</p>
        	</li>
        	<li><a href="#" title="Best Places To Buy Music">Best Places To Buy
        			Music</a></li>
        	<li><a href="#" title="Speeding Down The Formula 1 Track">Speeding Down
        			The Formula 1 Track</a></li>
        	<li><a href="#" title="Run&#8230;Hes Coming To Get You!">Run&#8230;Hes
        			Coming To Get You!</a></li>
        	<li><a href="#" title="Online Fashion Shopping Tips">Online Fashion
        			Shopping Tips</a></li>
       	<?php endwhile;?>
    </ul>    
<?php endif;?>