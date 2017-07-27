<style>
#tls-mp-info{
	background-color: white;
	min-height: 300px;
	border: solid 1px #ccc;
	padding: 10px;
}
</style>

<?php
    function twentyten_comment( $comment, $args, $depth ) {
        ?>
        	<ul>
        		<li>comment_ID()				: <?php comment_ID(); ?></li>	
        		<li>get_avatar()				: <?php echo get_avatar($comment, 40 );?></li>				
        		<li>next_comments_link()		: <?php next_comments_link()?></li>
        		<li>paginate_comments_links()	: <?php paginate_comments_links()?></li>
        		<li>permalink_comments_rss()	: <?php //permalink_comments_rss()?></li>
        		<li>previous_comments_link()	: <?php previous_comments_link()?></li>
        		<li><hr/></li>
        	</ul>
        	<?php 
    }
?>