<?php
    class Tls_Mp_Article_Caps{
        public function __construct() {
            ;
        }
        
        public function check_cap($cap = null){
            $user = wp_get_current_user();            
            $flag = false;
            
            if($cap != null && $user->has_cap($cap)){
                $flag = true;
            }
            
            return $flag;
        }
        
        public function add_caps_for_role(){
            //echo '<br>' . __METHOD__;
            
            $admin = array(
                'tls_mp_article',
                'tls_mp_article_list',
                'tls_mp_article_add',
                'tls_mp_article_edit',
                'tls_mp_article_delete',
                'tls_mp_article_status'
            );
            $role = get_role('administrator');
            foreach ($admin as $val){
                $role->add_cap($val);
            }
            
            $editor = array(
                'tls_mp_article',
                'tls_mp_article_list',
                'tls_mp_article_add',
                'tls_mp_article_own_edit',
                'tls_mp_article_own_delete',
                'tls_mp_article_own_status'
            );
            $role = get_role('editor');
            foreach ($editor as $val){
                $role->add_cap($val);
            }
            
            $author = array(
                'tls_mp_article',
                //'tls_mp_article_list',
                'tls_mp_article_own_list',
                'tls_mp_article_add',
                'tls_mp_article_own_edit',
                'tls_mp_article_own_status'
            );
            $role = get_role('author');
            foreach ($author as $val){
                $role->add_cap($val);
            }
            
            //$role->remove_cap('tls_mp_article_list');
            
            /* echo '<pre>';
            print_r($role);
            echo '</pre>'; */
        }
        
        private function cap_list(){
            $caps = array(
                'tls_mp_article_list' => 'Hiển thị danh sách bài viết',
                'tls_mp_article_own_list' => 'Hiển thị danh sách bài viết theo tác giả',
                'tls_mp_article_add' => 'Thêm một bài viết',
                'tls_mp_article_edit' => 'Chỉnh sửa một bài viết',
                'tls_mp_article_own_edit' => 'Chỉnh sửa một bài viết theo tác giả',
                'tls_mp_article_delete' => 'Xóa các bài viết',
                'tls_mp_article_own_delete' => 'Xóa các bài viết theo tác giả',
                'tls_mp_article_status' => 'Thay đổi trạng thái bài viết',
                'tls_mp_article_own_status' => 'Thay đổi trạng thái bài viết theo tác giả',  
            );
            
            return $caps;
        }
    }