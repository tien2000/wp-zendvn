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
        		<li>comment_ID()			: <?php comment_ID()?></li>
        		<li>comment_author()			: <?php comment_author()?></li>
        		<li>comment_author_email()		: <?php comment_author_email()?></li>
        		<li>comment_author_email_link()	: <?php comment_author_email_link()?></li>
        		<li>comment_author_IP()		: <?php comment_author_IP()?></li>
        		<li>comment_author_link()		: <?php comment_author_link()?></li>
        		<li>comment_author_rss()		: <?php comment_author_rss()?></li>
        		<li>comment_author_url()		: <?php comment_author_url()?></li>
        		<li>comment_author_url_link()		: <?php comment_author_url_link()?></li>
        			
        		<li>comment_class()			: <?php comment_class()?></li>
        		<li>comment_date()			: <?php comment_date()?></li>
        		<li>comment_excerpt()			: <?php comment_excerpt()?></li>
        		<li>comment_form_title()		: <?php comment_form_title()?></li>
        		<li>comment_form()			: <?php comment_form()?></li>
        		
        		<li><hr/></li>
        	</ul>
        	<?php 
    }
?>