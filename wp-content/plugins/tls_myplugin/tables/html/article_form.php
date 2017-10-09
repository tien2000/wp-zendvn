<?php 
    /* 
     * wp_nonce_field($action, $name, $referer):
     *   - $name: Thay đổi tên của chuỗi bảo mật trong ô input ẩn (Mặc định "_wpnonce")
     *   - $referer: Hiển thị đường dẫn trả về (true / false)
     * wp_referer_field(): Hàm WP tạo đường dẫn trả về.
     *  */
?>

<?php    
    $page = @$_REQUEST['page'];
    $action     = 'add';
    
    // Lable
    $lbl = 'Add New Article';
    if(isset($_GET['action'])){
        $action = $_GET['action'];
        //echo '<br>' . $action;
        if($action == 'edit'){
            $lbl        = 'Edit Article';
            $vTitle     = $row->title;
            $vPicture   = $row->picture;
            $vContent   = $row->content;
            $vStatus    = $row->status;
        }
    }
    
    // In thông báo lỗi nhập liệu.
    $mes = '';
    if(count(@$errors) > 0){
        $mes .= '<div class="error"><ul>';
        foreach (@$errors as $val){
            $mes .= '<li>'. $val .'</li>';
        }
        $mes .= '</ul></div>';
        
        // Hiển thị những dữ liệu không có lỗi.
        $vTitle = @$_POST['title'];
        $vPicture = @$_POST['picture'];
        $vContent = @$_POST['content'];
        $vStatus = @$_POST['status'];
    }
    
    if(@$_GET['mes'] == 1){
        $mes = '<div class="updated"><p>'. __('Update Success') .'</p></div>';
    }
    
    $htmlObj    = new TlsHtml();
    $title      = $htmlObj->textbox('title', @$vTitle, array('class' => 'regular-text'));
    $picture    = $htmlObj->textbox('picture', @$vPicture, array('class' => 'regular-text'));
    $content    = $htmlObj->textarea('content', @$vContent, array('class' => 'regular-text', 'rows' => 6, 'cols' => 60));
    
    $options['data'] = array('Inactive', 'Active');
    $status     = $htmlObj->selectbox('status', @$vStatus, array('class' => 'regular-text'), $options);
?>

<div class="wrap">
	<h1><?php echo $lbl;?></h1>
	<?php echo $mes;?>
	<form method="post" action="" id="<?php echo $page;?>" enctype="multipart/form-data">
		<input type="hidden" name="action" value="<?php echo $action;?>">
		
		<?php 
		  if($action == 'edit'){
		      $action = 'edit_id_' . $_REQUEST['article'];
		  }
		?>
		
		<?php wp_nonce_field($action, 'security_code', true); // true thì đóng dòng dưới, false thì mở ra?>		
		<?php //wp_referer_field();?>
		<h3>Information:</h3>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label>Title</label></th>
					<td><?php echo $title;?></td>
				</tr>
				<tr>
					<th scope="row"><label>Picture</label></th>
					<td><?php echo $picture;?></td>
				</tr>
				<tr>
					<th scope="row"><label>Content</label></th>
					<td><?php echo $content;?></td>
				</tr>
				<tr>
					<th scope="row"><label>Status</label></th>
					<td><?php echo $status;?></td>
				</tr>
			</tbody>
		</table>
		<p class="submit">
			<input type="submit" name="submit" id="submit"
				class="button button-primary" value="Save Changes">
		</p>
	</form>
</div>