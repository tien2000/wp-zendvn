<?php 
    /* 
     * wp_kses($val, $allowed_html, $allowed_protocols): Hàm lọc dữ liệu của hệ thống WP.
     * wp_kses_post($val): Hàm lọc dữ liệu của hệ thống WP.
     * wp_kses_allowed_html('post'): Xem thông tin mảng các thẻ html của phần post.
     * force_balance_tags($text): Bổ sung thẻ html còn thiếu (Chưa tối ưu).
     * esc_html($val): Biến định dạng code html thành text.
     * sanitize_text_field($val): Loại bỏ các thẻ html, chỉ còn lại text.
     * esc_attr(): Bỏ qua các thuộc tính của thẻ.
     * esc_js(): Bỏ qua các giá trị js
     * esc_url($val): Bỏ qua các giá trị url (Sử dụng cho chuỗi nhận được trong quá trình GET hoặc POST để in đường dẫn)
     * esc_url_raw( $url, $protocols): Bỏ qua các giá trị url (Sử dụng cho nội dung lấy trong db)
     *  */
?>

<?php      
    $htmlObj    = new TlsHtml();
    
    /* ==================================
     * URL || POST - GET - DB
     * ================================== */
    $val = 'http://zend.vn/<script>alert(\'XSS\')</script>';
    echo '<br>Origin: ' . esc_url($val);
    
    /* $val = "javascript:alert('XSS')";
    $url = '<a href="'.$val.'">regular-text</a>';
    echo '<br>Origin: ' . $url;
    echo '<br>Filter: ' . '<a href="'.esc_url($val).'">regular-text</a>'; */
    
    
    /* ==================================
     * JavaScript || POST - GET - DB
     * ================================== */
    /* $val = 'I love <script>document.write("Wordpress");</script>';
    echo '<br>' . $val;
    echo '<br>' . esc_js($val); */
    
    
    /* ==================================
     * Text Nodes || POST - GET - DB
     * ================================== */
    /* $js = '" onmouseover="alert(\'XSS\')';
    $val = '<a href="http://www.zend.vn" title="' . esc_attr($js) . '" data-type="123">regular-text</a>';
         
    echo '<br>Origin: '. $val; */
    
    /* $css = '<a href="http://www.zend.vn" title="ZendVN Team" data-type="123">regular-text</a>';
    echo '<br>Origin: '. $css;
    echo '<br>Filter: '. esc_attr($css);
    echo '<br>Origin 2: '. $htmlObj->textbox('title', $val, array('class' => $css));;
    echo '<br>Origin 3: '. $htmlObj->textbox('title', esc_html($val), array('class' => esc_attr(sanitize_text_field($css)))); */
    

    /* ==================================
     * Text Nodes || POST - GET - DB
     * ================================== */
    /* $val = '<a href="http://www.zend.vn" title="ZendVN Team" data-type="123">ZendVN&nbsp&nbsp&nbsp Team</a>';
    echo '<br>Origin: '. $val;
    echo '<br>Filter: '. esc_html($val);
    echo '<br>Origin 2: '. $htmlObj->textbox('title', $val, array('class' => 'regular-text'));;
    echo '<br>Origin 3: '. $htmlObj->textbox('title', esc_html($val), array('class' => 'regular-text'));
    echo '<br>Origin 4: '. $htmlObj->textbox('title', sanitize_text_field($val), array('class' => 'regular-text')); */
    

    /* ==================================
     * HTML/XML || POST - GET - DB
     * ================================== */
    $val = '<h3>
                <a href="http://www.zend.vn" title="ZendVN" data-type="123">ZendVN</a>
            </h3>
            <div>
                <strong class="abc">This is ZendVN Test</strong>
            </div>
         ';
    //echo force_balance_tags($val);
    
    $allowed_html = array(
        'a' => array(
            'href' => true,
            'title' => array(),
            'data-type' => false,
        ),
        'strong'    => array(),
        'em'    => array(),
        'br'    => array(),
    );
    $allowed_protocols = array('mailto', 'http', 'https');
    
    //echo '<br>' . wp_kses($val, $allowed_html, $allowed_protocols);
    //echo '<br>' . wp_kses_post($val);
    
    $allowed_html = wp_kses_allowed_html('post');
    
    /* echo '<pre>';
    print_r($allowed_html);
    echo '</pre>'; */


    /* ==================================
     * HTML/XML || POST - GET - DB
     * ================================== */
    $val = '<h3>
                <a href="http://www.zend.vn" title="ZendVN" data-type="123">ZendVN</a>
            </h3>
            <div>
                <strong>This is ZendVN Test</strong>
            </div>   
         ';
    //echo $val;
    
    $allowed_html = array(
            'a' => array(
                'href' => true, 
                'title' => array(),
                'data-type' => false,
            ),
            'strong'    => array(),
            'em'    => array(),
            'br'    => array(),
        );    
    $allowed_protocols = array('mailto', 'http', 'https');
    
    //echo '<br>' . wp_kses($val, $allowed_html, $allowed_protocols);
    //echo '<br>' . wp_kses_post($val);
    
    $allowed_html = wp_kses_allowed_html('post');
    
    /* echo '<pre>';
    print_r($allowed_html);
    echo '</pre>'; */

    /* ==================================
     * Integers
     * ================================== */
    /* $val = 'TienLS123'; //POST - GET
    echo '<br>Origin: ' . $val;
    echo '<br>intval: ' . intval($val);     // Giá trị có âm có dương, nếu là chuỗi trả về 0
    echo '<br>absint: ' . absint($val);     // Giá trị chỉ có dương, nếu là chuỗi trả về 0 */
    
    // ================================== //
    $lbl        = 'Data Filter';    
    //$lbl        = '<script>alert("Hello")</script>';      // Kiểm tra lọc dữ liệu
    
    //$vTitle     = '';
    $vTitle     = 'Tls"/>Password: <input type="password" value="123456"'; 
    
    //$vPicture   = '';
    $vPicture   = "<script>alert('Hello')</script>";        // Kỹ thuật XSS: Tạo sự kiện khi tương tác với ô input nếu không được bắt lỗi kỹ lưỡng
        
    $title      = $htmlObj->textbox('title', @$vTitle, array('class' => 'regular-text'));
    $picture    = $htmlObj->textbox('picture', @$vPicture, array('class' => 'regular-text'));
?>

<div class="wrap">
	<h1><?php echo $lbl;?></h1>
	<form method="post" action="" id="" enctype="multipart/form-data">
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
			</tbody>
		</table>
		<p class="submit">
			<input type="submit" name="submit" id="submit"
				class="button button-primary" value="Save Changes">
		</p>
	</form>
</div>