<?php 
    /* 
     * Lấy giá trị trên thanh địa chỉ xuống thì sử dụng get_query_var($var) để khi chuyển
     *  qua permalink thân thiện với các bộ máy tìm kiếm sẽ ko phát sinh lỗi
     *  */
?>

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
    		
    		//echo '<br>paged:' . get_query_var('paged');
    		
    		$paged  = max(1, get_query_var('paged'));
    		$offset = ($paged - 1) * $per_page;
    		
    		$sql   .= ' LIMIT ' . $per_page . ' OFFSET ' . $offset;
    		
    		//echo '<br>' . $sql;
    		
    		$data       = $wpdb->get_results($sql, ARRAY_A);
    		$pagename = get_query_var('pagename');
    		
    		/* echo '<br>' . __FILE__;
    		echo  '<br>' . $pagename; */
    		
    		echo '<ul>';    		
    		  foreach ($data as $info){
    		      if (!empty($paged)){
    		          $url = $pagename . '/' . $info['slug'];          // Chế độ rewrite được bật
    		      }else {
    		          $url = '?page_id=' . get_query_var('page_id') . '&article=' . $info['id'];
    		      }    	
    		      $url = site_url($url);
    		      
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