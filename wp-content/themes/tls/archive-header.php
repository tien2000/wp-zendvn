<?php 
/* 
 * Hàm hiển thị title của Category: single_cat_title(string $prefix, bool $display)
 * Hàm hiển thị title của Tag: single_tag_title(string $prefix, bool $display)
 * Lấy từ được search: get_search_query();
 *  */
?>

<?php 
    $title = '';
    $prefix = '';
    if(is_category()){
        $prefix = __('Category') . ': ';
        $title = single_cat_title($prefix, false);
    }
    if(is_tag()){
        $prefix = __('Tag') . ': ';
        $title = single_tag_title($prefix, false);
    }
    if(is_search()){
        $title = __('Search Result for' . ': ' . get_search_query());
    }
    if(is_date()){
        $title = single_month_title('', false);
    }
?>

<header class="archive-header clr">
	<h1 class="archive-header-title"><?php echo __($title);?></h1>
	<div class="layout-toggle">
		<span class="fa fa-bars"></span>
	</div>
	<!-- .layout-toggle -->
</header>
