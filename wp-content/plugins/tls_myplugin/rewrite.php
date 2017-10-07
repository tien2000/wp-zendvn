<?php 
    /* 
     * add_rewrite_rule($regex, $query): Add rewrite mới vào hệ thống WP.
     * flush_rewrite_rules(): Đưa rewrite mới vào hệ thống WP. 
     *    (true/false): True: Đường dẫn sau khi rewrite sẽ lưu vào file htaccess của WP
     *                  False: Đường dẫn sau khi rewrite sẽ lưu vào database
     *                  
     * insert_query_vars(): add thêm giá trị article vào cuối mảng WP Object
     * 
     * add_rewrite_tag($tag, $regex): Xác định phần tử.
     *  */
?>

<?php
    class Tls_Mp_Rewite{
        public function __construct($options = array()) {
            //echo '<br>' . __METHOD__;
            
            add_action('init', array($this, 'add_rules'));
            add_action('init', array($this, 'add_tags_rules'));
            add_action('init', array($this, 'change_author_permalinks'));
            add_filter('query_vars', array($this, 'insert_query_vars'));
            
            register_deactivation_hook($options['file'], array($this, 'plugin_deactive'));
        }
        
        public function plugin_deactive(){
            flush_rewrite_rules(false);
        }
        
        public function add_tags_rules(){
            $tag = '%tproduct%';
            $regex = '([^/]+)';     // Lấy tất cả ký tự - ký tự "/" | dấu "+" tương ứng từ 1-n lần         
            //  Tương tác vào mảng tproduct
            add_rewrite_tag($tag, $regex);
            
            $name = 'tproduct';
            $struct = 'book-detail/%tproduct%';
            // Rewrite lại đường dẫn
            add_permastruct($name, $struct);
                        
            add_rewrite_tag('%book-category%', '([^/]+)');            
            add_permastruct('book-category', 'chuyen-de/%book-category%');
            
            flush_rewrite_rules(false);
        }
        
        public function change_author_permalinks(){
            global $wp_rewrite;
            
            ///author/%author%
            $wp_rewrite->author_structure = 'tac-gia/%author%';
            
            flush_rewrite_rules(false);
        }
        
        public function add_rules() {
            // Rewrite cho page=article & có phân trang 
            $regex = '([^/]*)/page/?([^/]*)/?';     // Lấy tất cả ký tự - ký tự "/" | dấu "*" tương ứng từ 0-n lần
            $redirect = 'index.php?pagename=$matches[1]&paged=$matches[2]';       //slug            
            add_rewrite_rule($regex, $redirect, 'top');
            
            // Rewrite cho phần chi tiết bài viết
            $regex = '([^/]*)/?([^/]*)/?';
            $redirect = 'index.php?pagename=$matches[1]&article=$matches[2]';       //slug            
            add_rewrite_rule($regex, $redirect, 'top');
            
            flush_rewrite_rules(false);
        }
        
        public function insert_query_vars($vars){
            // Thêm giá trị article vào cuối mảng WP Object
            $vars[] = 'article';
            return $vars;
        }
    }