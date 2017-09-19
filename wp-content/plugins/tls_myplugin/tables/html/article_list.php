<?php 
    $tblArticle = new Article_Table();
    $tblArticle->prepare_items();
    /* echo '<pre>';
    print_r($tblArticle);
    echo '</pre>'; */
?>

<div class="wrap">
	<h1>Hello world</h1>	
	<?php $tblArticle->display();?>
</div>