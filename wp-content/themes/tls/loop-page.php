<div id="content" class="site-content left-content clr" role="main">
    <?php if (have_posts()): while (have_posts()): the_post();?>
    	<article id="post-<?php the_ID();?>" <?php post_class('clr');?>>
    		<header class="page-header clr">
    			<h1 class="page-header-title"><?php the_title();?></h1>
    		</header>
    		<div class="entry clr">
        		<?php the_content();?>
        	</div>
    	</article>    	
    	<div id="comments" class="comments-area clr">
        	<?php comments_template('', true);?>		
    	</div>
    <?php endwhile; endif;?>
</div>