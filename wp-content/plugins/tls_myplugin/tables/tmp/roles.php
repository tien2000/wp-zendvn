<?php 
/* 
 * WP_User
 * WP_Role
 * WP_Roles
 * 
 * "$user = wp_get_current_user()" giống với "global $current_user"
 * Ưu tiên sử dụng "global $current_user" (tối ưu hơn)
 * get_current_user_id(): Show thông tin user hiện tại
 * get_user_by($field, $value): Show thông tin user theo điều kiện.
 * get_userdata( $userid ): Show thông tin user theo ID
 * 
 * __set(): Thêm vào mảng data (Không lưu vào db)
 * __get(): Lấy các giá trị nằm trong thuộc tính data (hoặc meta_key trong bảng usermeta)
 * get(): giống __get()
 * __isset(): Kiểm tra sự tồn tại của meta_key trong bảng usermeta thuộc user_id
 * exists(): Kiểm tra User có tồn tại trong hệ thống hay ko.
 * 
 * has_prop($key): Kiểm tra thuộc tính có tồn tại trong bảng user hoặc usermeta hay ko.
 * get_role($role): Show mảng quyền của user (Trong class WP_Role)
 * get_role_caps(): Show mảng allcaps
 * add_role($role): Thêm quyền của user khác vào user hiện tại
 * remove_role($role): Xóa toàn bộ phân quyền của User
 * set_role($role): Gán quyền trực tiếp cho user.
 * add_cap($cap, bool): Thêm quyền cho user.
 * remove_cap($cap): Xóa quyền user
 * remove_all_caps(): Xóa toàn bộ quyền của user
 * has_cap($cap): Kiểm tra quyền có tồn tại hay ko.
 * 
 * global $wp_roles
 *  */
?>

<?php
    new Tls_Mp_Roles();
    
    class Tls_Mp_Roles{
        public function __construct() {
            //echo '<br>' . __METHOD__;
            
            global $wp_roles;
            
            echo '<pre>';
            print_r($wp_roles->get_role('author'));
            echo '</pre>';
            
        }
    }    
?>