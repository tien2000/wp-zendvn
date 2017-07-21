<!--
  - wp_reset_query(): Hủy đối tượng wp_query và tạo ra 1 đối tượng mới
  - wp_reset_postdata(): Không hủy đối tượng wp_query mà chỉ thiết lập lại những giá trị trong đối tượng đó
                        (thường dùng vì không khởi tạo lại đối tượng mà chỉ thiết lập lại những phần nằm trong đối tượng wp_query mà thôi)
  - in_category(): Để trong the_loop: Kiểm tra bài viết trong vòng lặp có đúng category ko,
                        nếu đúng trả về 1, ko đúng trả về 0
  - get_query_var('', ''): Thực hiện custom loop, chỉnh lại những giá trị WP cung cấp để hiển
                            thị theo ý muốn. Để thực hiện thì phải gán giá trị $arrQuery vào
                            $wp_query thì mới hiển thị như mong muốn.
 -->
<!-- Cách viết của Wordpress -->
<?php if(have_posts()): while (have_posts()): the_post(); ?>
<!-- <!-- Phần nội dung bài viết -->
<?php endwhile; else: ?>
<!-- <!-- Không có bài viết -->
<?php endif; ?>

<?php
///////////// Thực hiện custom loop. ////////////////
    $paged = $paged = get_query_var('paged')?get_query_var('paged'):1;
    $arrQuery = array(
        'post_type'             => 'post',
        'ignore_sticky_posts'   => 1,
        'post_status'           => 'publish',
        'posts_per_page'        => '3',
        'paged'                 => $paged
    );
    $wp_query = new WP_Query($arrQuery);
?>

<?php if (  $wp_query->max_num_pages > 1 ) : ?>
				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentyten' ) ); ?></div>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?></div>
				</div><!-- #nav-below -->
<?php endif; ?>

<style>
    .tls-loop{
    	list-style-type: none;
    }
    .tls-loop li{
    	border: 1px solid #ccc;
    	padding: 8px;
    	margin-bottom: 10px;
    }
    .tls-loop .blue{
    	background: blue;
    }
    .tls-loop li a{
	   text-decoration: none;
    }
</style>

<!-- Cách viết PHP thông thường -->
<?php
    if(have_posts()){
        echo '<ul class="tls-loop">';
        while (have_posts()){
            the_post();
            $css = '';
            if(in_category(4)) $css = 'class = "blue"';
?>
            <li <?php echo $css;?>>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></a></h2>
                <div>id: <?php the_ID(); ?> - time: <?php the_time();?></div>
                <div>Author: <?php the_author();?></div>
                <div><?php the_tags();?></div>
                <div>Category: <?php the_category(' '); ?></div>
                <div>Excerpt: <?php the_excerpt(); ?></div>
            </li>
<?php
        }
        //wp_reset_query();
        wp_reset_postdata();
        echo '</ul>';
    }else{
        //Không có bài viết
    }
?>

<?php if (  $wp_query->max_num_pages > 1 ) : ?>
				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentyten' ) ); ?></div>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?></div>
				</div><!-- #nav-below -->
<?php endif; ?>

<?php
/////////// Thực hiện Multi loop. ////////////////
    echo '<br>' . $paged = get_query_var('paged')?get_query_var('paged'):1;
    $myOffset = 3 * $paged;
    $arrQuery = array(
        'post_type'             => 'post',
        'ignore_sticky_posts'   => 1,
        'post_status'           => 'publish',
        'posts_per_page'        => '5',
        'paged'                 => $paged,
        'offset'                => $myOffset
    );
    $wp_query = new WP_Query($arrQuery);
?>

<div>
	<div>Các bài viết khác</div>
	<?php if(have_posts()): while (have_posts()): the_post();?>
	<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a><br>
	<?php endwhile; wp_reset_postdata(); endif;?>
</div>