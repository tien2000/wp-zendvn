<?php if(!empty($instance['content'])):?>	
	<div class="social-widget-description clr"><?php echo $instance['content'];?></div>
<?php endif;?>
	<!-- .social-widget-description -->
	<ul class="clr color flat">
    	<?php if(!empty($instance['twitter'])):?>
    		<li class="twitter">
    			<a href="<?php echo $instance['twitter'];?>" title="Twitter" target="_blank">
    				<span class="fa fa-twitter"></span>
    			</a>
    		</li>
    	<?php endif;?>
    		
    	<?php if(!empty($instance['facebook'])):?>
    		<li class="facebook">
    			<a href="<?php echo $instance['facebook'];?>" title="Facebook" target="_blank">
    				<span class="fa fa-facebook"></span>
    			</a>
    		</li>
    	<?php endif;?>
    		
    	<?php if(!empty($instance['google_plus'])):?>
    		<li class="google-plus">
    			<a href="<?php echo $instance['google_plus'];?>" title="Google+" target="_blank">
    				<span class="fa fa-google-plus"></span>
    			</a>
    		</li>
    	<?php endif;?>
    		
    	<?php if(!empty($instance['dribbble'])):?>
    		<li class="dribbble">
    			<a href="<?php echo $instance['dribbble'];?>" title="Dribbble" target="_blank">
    				<span class="fa fa-dribbble"></span>
    			</a>
    		</li>
    	<?php endif;?>
	</ul>