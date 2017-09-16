<?php 
    /* 
     * Kiểm tra bài viết có password ko.
     * Nếu có password mà user ko có password thì sẽ ko hiển thị. 
     */
    if(post_password_required() == true) return ;
    /* 
     * Kiểm tra bài viết có cho hiển thị comment và thêm comment mới hay ko.
     * Đếm số lượng comment của bài viết có tồn tại hay ko.
     */
    if(!comments_open() && get_comment_pages_count() == 0) return ;
?>

<?php 
    $comments_number = get_comments_number();
?>

<div class="comments-title">
	<?php 
	   if($comments_number == 1){
	       echo __('There is 1 comment for this article ');
	   }else if($comments_number > 1){
	       // Thay giá trị $comments_number vào %s.
	        echo sprintf(__('There are %s comments for this article '), $comments_number);
	   }
	?>
</div>
<div class="comments-inner clr">
	<ol class="commentlist">
    	<?php 
    	   $commentListArr = array(
    	       'callback' => 'tls_comment',  // Có 3 tham số (WP hỗ trợ): Thông tin comment, mảng tham số, độ sâu comment.
    	   );
    	   wp_list_comments($commentListArr);
    	?>
	</ol>
	
	<?php 
	   /* echo '<br>Page: ' . get_comment_pages_count();
	   echo '<br>Page comments: ' . get_option('page_comments'); */
	   
	   if(get_comment_pages_count() > 1 && get_option('page_comments') == 1){
	?>
    	<nav class="comment-navigation clr" role="navigation">
    		<div class="nav-previous span_1_of_2 col col-1">
    			<?php previous_comments_link(_('&larr; Older Comments'));?>
    		</div>
    		<div class="nav-next span_1_of_2 col">
    			<?php next_comments_link(_('Newer Comments &rarr;'));?>
    		</div>
    	</nav>
	<?php }?>
	
	<?php 
	   $formArr = array(
	       'cancel_reply_link' => '<i class="fa fa-times"></i>' . __('Cannel comment reply')
	   );
	   comment_form($formArr);?>
</div>