<?php
/*
Plugin Name: TIENLS MyPlugin
Plugin URI: http://www.webcuatui.com
Description: Tìm hiểu về cây thư mục của 1 plugin
Author: Tien Le
Version: 1.0
Author URI: http://www.webcuatui.com
*/

$path = dirname(__FILE__) . '/include/admin.php';

//đường dẫn tuyệt đối đến thư mục chứa plugin này.
echo '<br>' . plugin_dir_path(__FILE__);

/*đường dẫn tương đối đến plugins, có 2 tham số, tham số 1 là đường dẫn đến file cần nhúng, tham
số 2 là đường dẫn đến thư mục chứa plugin này.*/
echo '<br>' . plugins_url('/css/abc.css' , __FILE__);

//đường dẫn đến thư mục wp-includes, truyền thêm tham số để dẫn đến các file bên trong.
echo '<br>' . includes_url('/css/buttons-rtl.css');

//tương tự inlcudes_url
echo '<br>' . content_url();

//tương tự includes_url
echo '<br>' . admin_url();

echo '<br>' . site_url();

echo '<br>' . home_url();