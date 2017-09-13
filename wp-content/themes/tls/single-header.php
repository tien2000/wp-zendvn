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