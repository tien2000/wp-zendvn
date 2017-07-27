<!--
  - wp_reset_query(): Há»§y Ä‘á»‘i tÆ°á»£ng wp_query vÃ  táº¡o ra 1 Ä‘á»‘i tÆ°á»£ng má»›i
  - wp_reset_postdata(): KhÃ´ng há»§y Ä‘á»‘i tÆ°á»£ng wp_query mÃ  chá»‰ thiáº¿t láº­p láº¡i nhá»¯ng giÃ¡ trá»‹ trong Ä‘á»‘i tÆ°á»£ng Ä‘Ã³
                        (thÆ°á»�ng dÃ¹ng vÃ¬ khÃ´ng khá»Ÿi táº¡o láº¡i Ä‘á»‘i tÆ°á»£ng mÃ  chá»‰ thiáº¿t láº­p láº¡i nhá»¯ng pháº§n náº±m trong Ä‘á»‘i tÆ°á»£ng wp_query mÃ  thÃ´i)
  - in_category(): Ä�á»ƒ trong the_loop: Kiá»ƒm tra bÃ i viáº¿t trong vÃ²ng láº·p cÃ³ Ä‘Ãºng category ko,
                        náº¿u Ä‘Ãºng tráº£ vá»� 1, ko Ä‘Ãºng tráº£ vá»� 0
  - get_query_var('', ''): Thá»±c hiá»‡n custom loop, chá»‰nh láº¡i nhá»¯ng giÃ¡ trá»‹ WP cung cáº¥p Ä‘á»ƒ hiá»ƒn
                            thá»‹ theo Ã½ muá»‘n. Ä�á»ƒ thá»±c hiá»‡n thÃ¬ pháº£i gÃ¡n giÃ¡ trá»‹ $arrQuery vÃ o
                            $wp_query thÃ¬ má»›i hiá»ƒn thá»‹ nhÆ° mong muá»‘n.
 -->
<!-- CÃ¡ch viáº¿t cá»§a Wordpress -->
<?php if(have_posts()): while (have_posts()): the_post(); ?>
<!-- <!-- Pháº§n ná»™i dung bÃ i viáº¿t -->
<?php endwhile; else: ?>
<!-- <!-- KhÃ´ng cÃ³ bÃ i viáº¿t -->
<?php endif; ?>

<?php
///////////// Thá»±c hiá»‡n custom loop. ////////////////
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
        //KhÃ´ng cÃ³ bÃ i viáº¿t
    }
?>

<?php if (  $wp_query->max_num_pages > 1 ) : ?>
				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentyten' ) ); ?></div>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?></div>
				</div><!-- #nav-below -->
<?php endif; ?>

<?php
/////////// Thá»±c hiá»‡n Multi loop. ////////////////
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
	<div>CÃ¡c bÃ i viáº¿t khÃ¡c</div>
	<?php if(have_posts()): while (have_posts()): the_post();?>
	<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a><br>
	<?php endwhile; wp_reset_postdata(); endif;?>
</div>