<?php 
    $tblArticle = new Article_Table();
    $tblArticle->prepare_items();
    /* echo '<pre>';
    print_r($tblArticle);
    echo '</pre>'; */
    $page = @$_REQUEST['page'];   
?>

<div class="wrap">
	<h1>Articles</h1>
	<form action="" method="post" name="<?php echo $page;?>" id="<?php echo $page;?>">
    	<?php $tblArticle->search_box('Search Articles', 'search-id');?>
    	<?php $tblArticle->display();?>
	</form>
</div>