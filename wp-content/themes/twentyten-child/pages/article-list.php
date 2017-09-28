<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<h1 class="entry-title"><?php the_title(); ?></h1>

	<div class="entry-content">
		<?php the_content(); ?>
		
		<?php 
    		global $wpdb;
    		$tblArticle = $wpdb->prefix . 'mp_article';
    		$tblUser    = $wpdb->prefix . 'users';
    		$sql        = 'SELECT a.*, u.user_nicename
                            FROM '. $tblArticle .' AS a
                            INNER JOIN '. $tblUser .' AS u
                            ON a.author_id = u.ID
    		                WHERE a.status = 1 
    		                ORDER BY a.id DESC 
                            ';    		
    		
    		$total_items = $wpdb->query($sql);    //========= Tính tổng số bài viết ============//
    		$per_page = 5;
    		$paged  = max(1, @$_REQUEST['paged']);
    		$offset = ($paged - 1) * $per_page;
    		
    		$sql   .= ' LIMIT ' . $per_page . ' OFFSET ' . $offset;
    		
    		echo '<br>' . $sql;
    		
    		$data       = $wpdb->get_results($sql, ARRAY_A);
    		
    		echo '<ul>';    		
    		  foreach ($data as $info){
    		      $url = '?page_id=' . $_GET['page_id'] . '&article=' . $info['id'];
    		      $title = '<a href="' . $url . '">'.$info['title'].'</a>';
    		      $content = '<p>' . $info['content'] . '</p>';
    		      echo '<li>' . $title . $content .'</li>';    		      
    		  }
    		echo '</ul>';
    		
    		/* echo '<pre>';
    		print_r($data);
    		echo '</pre>'; */
    		
    		
		?>
		<?php include_once 'paging.php';?>
	</div>
	<!-- .entry-content -->
	
</div>