<?php 
    global $tlsSupport;
    global $wp_query;
    $postObj = $wp_query->post;
    /* echo '<pre>';
    print_r($postObj);
    echo '</pre>'; */
    
    $format = get_post_format($postObj->ID);
    //echo '<br>format: ' . $format;
?>

<?php if($format == 'video'):?>
<?php 
    $firstVideo = $tlsSupport->get_first_video($postObj->post_content);    
    echo $firstVideo;
?>
<div class="single-post-media clr">
	<div class="post-video wpex-video-embed clr">
		<?php 
		  if(preg_match('#\[video.*\]#', $firstVideo)){
		      echo do_shortcode($firstVideo);
		  }else{
		      echo $tlsSupport->video_embed($firstVideo);
		  }
		?>
	</div>
</div>
<?php endif;?>

<?php if($format == 'audio'):?>
<?php 
    $firstAudio = $tlsSupport->get_first_audio($postObj->post_content);    
    echo $firstAudio;
?>
<div class="single-post-media clr">
	<div class="post-thumbnail">
		<?php echo do_shortcode($firstAudio);?>
	</div>
</div>
<?php endif;?>

<?php if($format == false):?>
<?php 
    $firstImg = $tlsSupport->get_first_image($postObj->post_content);    
?>
<div class="single-post-media clr">
	<div class="post-thumbnail">
		<?php echo $firstImg;?>
	</div>
</div>
<?php endif;?>