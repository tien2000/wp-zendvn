<?php 
    global $tlsSupport;
    global $tlsCustomize;
?>

<?php 
    if(have_posts()): while (have_posts()): the_post();
?>
    <header class="post-header clr">
    	<h1 class="post-header-title"><?php the_title();?></h1>
    	<div class="post-meta clr">
    		<span class="post-meta-date"> <?php echo __('Posted on ');?> <?php the_modified_date();?> </span> <span
    			class="post-meta-author"> <?php echo __('by ');?> 
    			<?php the_author_posts_link();?>
    		</span> <span class="post-meta-category"> <?php echo __('in ');?> 
    		<?php the_category(', ')?>
    		</span> <span class="post-meta-comments"> <?php echo __('with ');?> 
    		<a href="<?php comment_link();?>"
    			class="comments-link"><?php comments_number('No comment', '1 comment', '% comments');?></a>
    		</span>
    	</div>
    </header>
    <div class="entry clr">
    	<div class="ad-spot post-top-ad clr">
    		<a href="#" title="Ad"><img
    			src="http://wpexplorer-demos.com/spartan/wp-content/themes/wpex-spartan/images/ad-250x250.png"
    			alt="Ad"></a>
    	</div>
    	<?php 
    	   $content = get_the_content();
    	   $format = get_post_format($post->ID);
    	   
    	   echo 'format: ' . $format . '<br>';
    	   
    	   if($format == false){
    	       $firstImg   = $tlsSupport->get_first_image($content);
    	       $content    = $tlsSupport->remove_first_image($firstImg, $content);
    	   }
    	   
    	   if($format == 'audio'){
    	       $firstAudio = $tlsSupport->get_first_audio($content);
    	       $content    = $tlsSupport->remove_first_audio($firstAudio, $content);
    	   }
    	   
    	   if($format == 'video'){
    	       $firstVideo = $tlsSupport->get_first_video($content);
    	       $content    = $tlsSupport->remove_first_video($firstVideo, $content);
    	   }
    	   
    	   if($format == 'gallery'){
    	       $firstGallery = $tlsSupport->get_first_gallery($content);
    	       $content    = $tlsSupport->remove_first_gallery($firstGallery, $content);
    	   }
    	   
    	   $content = apply_filters( 'the_content', $content );
	       $content = str_replace( ']]>', ']]&gt;', $content );
	       
    	   echo $content;
    	?>    	
    	<div class="ad-spot post-bottom-ad clr">
    		<?php 
			   echo $tlsCustomize->ads_section('content-banner');
			?>
    	</div>
    </div>
    <div class="post-tags">
    	<?php the_tags();?>
    </div>
    
    <div class="social-share-bottom clr">
    	<div class="social-share clr">
    		<a
    			href="http://twitter.com/share?text=Model+Shoot+February+2014&amp;url=http%3A%2F%2Fwpexplorer-demos.com%2Fspartan%2Fmodel-shoot-february-2014%2F"
    			target="_blank" title="Share on Twitter" rel="nofollow"
    			class="twitter-share"
    			onclick="javascript:window.open(this.href,
                    '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><span
    			class="fa fa-twitter"></span>Tweet</a> <a
    			href="http://www.facebook.com/share.php?u=http%3A%2F%2Fwpexplorer-demos.com%2Fspartan%2Fmodel-shoot-february-2014%2F"
    			target="_blank" title="Share on Facebook" rel="nofollow"
    			class="facebook-share"
    			onclick="javascript:window.open(this.href,
                    '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><span
    			class="fa fa-facebook-square"></span>Like</a> <a
    			title="Share on Google+" rel="external"
    			href="https://plus.google.com/share?url=http%3A%2F%2Fwpexplorer-demos.com%2Fspartan%2Fmodel-shoot-february-2014%2F"
    			class="googleplus-share"
    			onclick="javascript:window.open(this.href,
                    '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><span
    			class="fa fa-google-plus"></span>Plus</a> <a
    			href="http://pinterest.com/pin/create/button/?url=http%3A%2F%2Fwpexplorer-demos.com%2Fspartan%2Fmodel-shoot-february-2014%2F&amp;media=http%3A%2F%2Fwpexplorer-demos.com%2Fspartan%2Fwp-content%2Fuploads%2Fsites%2F91%2F2014%2F02%2Fshutterstock_160564226.jpg&amp;description=One+of+the+attending+harpooneers+now+advances+with+a+long%2C+keen+weapon+called+a+boarding-sword%2C+and+watching+his+chance+he+dexterously+slices+out+a+considerable+hole+in+the+lower+part+of+the+swaying+mass.+Into+this+hole%2C+the+end+of%26hellip%3B"
    			target="_blank" title="Share on Pinterest" rel="nofollow"
    			class="pinterest-share"
    			onclick="javascript:window.open(this.href,
                    '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><span
    			class="fa fa-pinterest"></span>Pin It</a> <a
    			title="Share on LinkedIn"
    			href="http://www.linkedin.com/shareArticle?mini=true&amp;url=http%3A%2F%2Fwpexplorer-demos.com%2Fspartan%2Fmodel-shoot-february-2014%2F&amp;title=Model+Shoot+February+2014&amp;summary=One+of+the+attending+harpooneers+now+advances+with+a+long%2C+keen+weapon+called+a+boarding-sword%2C+and+watching+his+chance+he+dexterously+slices+out+a+considerable+hole+in+the+lower+part+of+the+swaying+mass.+Into+this+hole%2C+the+end+of%26hellip%3B&amp;source=http%3A%2F%2Fwpexplorer-demos.com%2Fspartan"
    			target="_blank" rel="nofollow" class="linkedin-share"
    			onclick="javascript:window.open(this.href,
                    '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><span
    			class="fa fa-linkedin"></span>Share</a>
    	</div>
    </div>
    
    <div class="author-bio clr">
    	<div class="author-bio-avatar clr">
    		<a title="Visit Author Page" href="<?php echo get_author_posts_url($post->post_author);?>"> 
    		<?php echo get_avatar($post->post_author, 60);?>
    		</a>
    	</div>
    	<!-- .author-bio-avatar -->
    	<div class="author-bio-content clr">
    		<div class="author-bio-author clr">
    			<?php echo __('Authored by') . ': '?> 
				<?php the_author_posts_link();?>
    		</div>
    		<div class="author-bio-url">
    			<span><?php echo __('Website') . ': '?></span> 
    			<?php echo get_the_author_link();?>
    		</div>
    		<p><?php the_author_meta('description')?></p>
    	</div>
    	<!-- .author-bio-content -->
    	<div class="author-bio-social clr">
    		<a target="_blank" class="twitter" title="Twitter"
    			href="https://twitter.com/WPExplorer"> <span class="fa fa-twitter"></span></a>
    		<a target="_blank" class="facebook" title="Facebook" href="#"> <span
    			class="fa fa-facebook"></span>
    		</a> <a target="_blank" class="google-plus" title="Google Plus"
    			href="#"> <span class="fa fa-google-plus"></span>
    		</a> <a target="_blank" class="linkedin" title="LinkedIn" href="#"> <span
    			class="fa fa-linkedin"></span>
    		</a> <a target="_blank" class="pinterest" title="Pinterest" href="#">
    			<span class="fa fa-pinterest"></span>
    		</a> <a target="_blank" class="instagram" title="Instagram" href="#">
    			<span class="fa fa-instagram"></span>
    		</a>
    	</div>
    	<!-- .author-bio-social -->
    </div>
    <div class="next-prev clr">
    	<div class="post-prev">
    		<?php 
    		  /* previous_post_link( $format = '&laquo; %link', $link = '%title', 
    		      $in_same_term = false, $excluded_terms = '', $taxonomy = 'category' ); */
    		  $format = '<img src="'. TLS_THEME_IMAGE_URL . 'prev-post.png" alt="Previous Article">';
    		  $link = __('Previous Article');
    		  echo previous_post_link($format . '%link', $link);
    		?>
    		<!-- <a href="http://wpexplorer-demos.com/spartan/formula-1-is-boring/" rel="next">
    		<img src="http://wpexplorer-demos.com/spartan/wp-content/themes/wpex-spartan/images/prev-post.png"
    			alt="Next Article">Previous Article</a> -->
    	</div>
    	<div class="post-next">
    		<?php
    		  $format = '<img src="'. TLS_THEME_IMAGE_URL . 'next-post.png" alt="Next Article">';
    		  $link = __('Next Article');
    		  echo next_post_link($format . '%link', $link);
    		?>
    		<!-- <a href="http://wpexplorer-demos.com/spartan/nascar-results/"
    			rel="prev"><img
    			src="http://wpexplorer-demos.com/spartan/wp-content/themes/wpex-spartan/images/next-post.png"
    			alt="Next Article">Next Article</a> -->
    	</div>
    </div>
    
    <div id="comments" class="comments-area clr">
    	<?php comments_template('', true);?>
		<div class="comments-title">
		</div>
	</div>		
	
<?php endwhile;?>
<?php endif;?>