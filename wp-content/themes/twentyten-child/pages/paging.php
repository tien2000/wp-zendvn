<?php 
/* 
 * Nhúng vào file article-list.php
 *  */
?>

<?php
	   global $wp_query;
	   /* echo '<pre>';
	   print_r($wp_query);
	   echo '</pre>'; */
	   
	   $big = 999999999; // need an unlikely integer
	   //echo '<br>' . get_pagenum_link( $big );
	   //echo '<br>' . str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) );
	   //echo '<br>' . get_query_var('paged');
	   
	   $pagenum_link = str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) );
	   
       $args = array(
    	    'base'               => $pagenum_link,
    	    'format'             => '?paged=%#%',
    	    'total'              => ceil($total_items/$per_page),
    	    'current'            => max(1, get_query_var('paged')),
    	    'show_all'           => false,
    	    'end_size'           => 1,         // Xuất hiện số trang ở 2 đầu phân trang.
    	    'mid_size'           => 2,         // Hiển thị số trang bên cạnh trang hiện thời.
    	    'prev_next'          => false,
    	    //'prev_text'          => __('« Previous'),
    	    //'next_text'          => __('Next »'),
    	    'type'               => 'plan',
    	    //'add_args'           => array('test' => 'abc', 'type' => 'happy'),   // Thêm mảng vào sau link.
    	    //'add_fragment'       => '&test=abc',
    	    //'before_page_number' => '[',
    	    //'after_page_number'  => ']'
    	);
?> 	
<div class="nav-article">
    <span class="site-pagination-heading">Pages</span>
    <?php 	
    	echo paginate_links( $args );
    ?>
</div>