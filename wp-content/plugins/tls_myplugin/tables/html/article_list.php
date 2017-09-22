<?php 
    $tblArticle = new Article_Table();
    $tblArticle->prepare_items();
    /* echo '<pre>';
    print_r($tblArticle);
    echo '</pre>'; */
?>

<div class="wrap">
	<h1>Articles</h1>	
	<?php $tblArticle->search_box('Search Articles', 'search-id');?>
	<?php $tblArticle->display();?>
</div>