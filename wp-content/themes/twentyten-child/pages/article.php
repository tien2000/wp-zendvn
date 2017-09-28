<?php 
	global $wpdb;
	$tblArticle = $wpdb->prefix . 'mp_article';
	$tblUser    = $wpdb->prefix . 'users';
	$article_id = @$_GET['article'];
	$sql        = 'SELECT a.*, u.user_nicename
                    FROM '. $tblArticle .' AS a
                    INNER JOIN '. $tblUser .' AS u
                    ON a.author_id = u.ID
	                WHERE a.status = 1 
	                AND a.id = '. $article_id. '
                    ';   
	
	$data       = $wpdb->get_row($sql, ARRAY_A);
	
	/* echo '<pre>';
	print_r($data);
	echo '</pre>'; */	
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<h1 class="entry-title"><?php echo $data['title']?></h1>

	<div class="entry-content">
		<?php echo $data['content']?>
	</div>
</div>