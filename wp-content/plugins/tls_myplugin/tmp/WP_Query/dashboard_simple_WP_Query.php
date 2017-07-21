<?php
/*
 * Tham khảo https://codex.wordpress.org/Class_Reference/WP_Query
 */

    class Tls_Mp_Dashboard_Widget_Simple{
        public function __construct(){
            add_action( 'wp_dashboard_setup',array($this, 'widget_db'));
        }

        public function widget_db(){
            wp_add_dashboard_widget( 'tls-mp-widget-db-simple', 'My Widget Information',
                                            array($this, 'widget_db_simple_display' ));
        }

        ////////////////////// Cách 1 /////////////////////////////
        public function widget_db_simple_display_1(){
            $wpQuery = new WP_Query('author=1');
            $linkpost = '#';

            if($wpQuery->have_posts()){
                echo '<ul>';
                while ($wpQuery->have_posts()){
                    $wpQuery->the_post();
                    $linkpost = admin_url('post.php?post='. get_the_ID() .'&action=edit');
                    echo '<li><a href="'. $linkpost .'">' . get_the_title() . '</a></li>';
                }
                echo '</ul>';
                wp_reset_postdata();
            }else{
                echo '<p>'. translate('No post found') .'</p>';
            }

            /* echo '<br/>======================';
            echo '<pre>';
            print_r($wpQuery);
            echo '</pre>'; */
        }

        //////////////////////// Cách 2 /////////////////////////////
        public function widget_db_simple_display_2(){
            $wpQuery = new WP_Query('author=1');

            if(count($wpQuery->posts) > 0){
                foreach ($wpQuery->posts as $key => $val){
                    echo '<br/>' . $val->post_title;
                }
            }

            /* echo '<pre>';
            print_r($wpQuery->posts);
            echo '</pre>'; */
        }

        //////////////////////// Lọc theo ID và author của post /////////////////////////////
        public function widget_db_simple_display_3(){
            $wpQueryArr = array(
                'author' => '1',
                'p' => '23'
            );
            $wpQuery = new WP_Query($wpQueryArr);

            echo '<pre>';
            print_r($wpQuery->query);
            echo '</pre>';

            echo '<br>=============== Seperator ================';
            echo '<pre>';
            print_r($wpQuery);
            echo '</pre>';
        }

        //////////////////////// Lọc theo điều kiện /////////////////////////////
        /* $queried_object
        $queried_object_id
        $posts
        $post_count
        $found_posts
        $max_num_pages */

        public function widget_db_simple_display_4(){
            $wpQueryArr = array(
                'author' => '1',
                //'p' => '47'
                //'cat' => '1'
            );
            $wpQuery = new WP_Query($wpQueryArr);

            echo '<pre>';
            print_r($wpQuery->max_num_pages);
            echo '</pre>';

            /* echo '<br>=============== Seperator ================';
             echo '<pre>';
             print_r($wpQuery);
             echo '</pre>'; */
        }

        //////////////////////// $current_post | $post /////////////////////////////
        public function widget_db_simple_display_5(){
            $wpQueryArr = array(
                'author' => '1',
                //'p' => '47'
                //'cat' => '1'
            );
            $wpQuery = new WP_Query($wpQueryArr);

            if($wpQuery->have_posts()){
                 while ($wpQuery->have_posts()){
                 $wpQuery->the_post();
                 echo '<pre>';
                 print_r($wpQuery->post);
                 echo '</pre>';
                 echo '<br>=============== Seperator ================';
                 }
             }

            /* echo '<br>=============== Seperator ================';
             echo '<pre>';
             print_r($wpQuery);
             echo '</pre>'; */
        }

        //////////////////////// $is_admin | $$is_page ... /////////////////////////////
        //////////////////////// Sử dụng kiểm tra ở Front Page /////////////////////////////
        public function widget_db_simple_display_6(){
            $wpQueryArr = array(
                'author' => '1',
                //'p' => '47'
                //'cat' => '1'
            );
            $wpQuery = new WP_Query($wpQueryArr);

            echo '<pre>';
            print_r($wpQuery->is_page);
            echo '</pre>';

            /* echo '<br>=============== Seperator ================';
             echo '<pre>';
             print_r($wpQuery);
             echo '</pre>'; */
        }

        //////////////////////// $parse_query | $$get_posts /////////////////////////////
        public function widget_db_simple_display_7(){
            $wpQueryArr = array(
                'author' => 1,
                'cat' => 9
            );
            $wpQuery = new WP_Query($wpQueryArr);
            // $parse_query: Xóa toàn bộ giá trị truyền vào trước đó và thiết lập lại giá trị mới
            // Đi kèm với $get_post
            $wpQuery->parse_query('cat=1');
            $wpQuery->get_posts();

            echo '<br>=============== Seperator ================';
            echo '<pre>';
            print_r($wpQuery);
            echo '</pre>';
        }

        //////////////////////// $get | $set /////////////////////////////
        public function widget_db_simple_display_8(){
            $wpQueryArr = array(
                'author' => 1,
                'cat' => 9
            );
            $wpQuery = new WP_Query($wpQueryArr);
            //////////////////// $get ////////////////////////
            // $get: Lấy ra giá trị nằm trong mảng [query_vars] thuộc đối tượng WP_Query
            echo '<br/>' . $wpQuery->get('cat', 0);
            echo '<br/>' . $wpQuery->get('comments_per_page', 0);

            ////////////////// $set ////////////////////////
            echo '<br/>' . $wpQuery->set('cat', 1); // $set đi kèm với $get_post
            $wpQuery->get_posts();

            echo '<br>=============== Seperator ================';
            echo '<pre>';
            print_r($wpQuery);
            echo '</pre>';
        }

        //////////////////////// $next_post | $rewind_posts /////////////////////////////
        public function widget_db_simple_display_9(){
            $wpQueryArr = array(
                'author' => 1,
                'cat' => 1,
                'posts_per_page' => 5
            );
            $wpQuery = new WP_Query($wpQueryArr);

            if($wpQuery->have_posts()){
                echo '<ul>';
                while ($wpQuery->have_posts()){
                    $wpQuery->the_post();
                    echo '<li>'. get_the_ID() . ' - ' . get_the_title() . '</li>';
                    // $next_post: Bỏ bài viết liền kề và nhảy đến bài viết tiếp theo.
                    $wpQuery->next_post();
                    // $rewind_posts: Reset lại bài viết hiện thời (Tạo ra vòng lặp vô tận).
                    $wpQuery->rewind_posts();
                }
                echo '</ul>';
                //wp_reset_postdata();
            }else{
                echo '<p>'. translate('No post found') .'</p>';
            }

            echo '<br>=============== Seperator ================';
            echo '<pre>';
            print_r($wpQuery);
            echo '</pre>';
        }

        //////////////////////// $query($query): Xóa thiết lập cũ và thiết lập lại. /////////////////////////////
        public function widget_db_simple_display_10(){
            $wpQueryArr = array(
                'author' => 1,
                'cat' => 1,
                'posts_per_page' => 4
            );
            $wpQuery = new WP_Query($wpQueryArr);
            // $query($query): Xóa thiết lập cũ và thiết lập lại.
            $wpQuery->query('posts_per_page=2');

            if($wpQuery->have_posts()){
                echo '<ul>';
                while ($wpQuery->have_posts()){
                    $wpQuery->the_post();
                    echo '<li>'. get_the_ID() . ' - ' . get_the_title() . '</li>';
                }
                echo '</ul>';
                wp_reset_postdata();
            }else{
                echo '<p>'. translate('No post found') .'</p>';
            }

            echo '<br>=============== Seperator ================';
            echo '<pre>';
            print_r($wpQuery);
            echo '</pre>';
        }

        //////////////////////// $author__in | $author__not_in /////////////////////////////
        ////////////////////// Lưu ý có 2 dấu gạch dưới /////////////////////////////
        public function author(){
            // $author__in: Lọc ra những bài viết của những tác giả được chọn.
            $wpQuery = new WP_Query( array( 'author__in' => array( 2, 3, 4 ) ) );

            // $author__in: Loại bỏ những bài viết của những tác giả được chọn.
            $wpQuery = new WP_Query( array( 'author__not_in' => array( 1, 2, 4 ) ) );

            if($wpQuery->have_posts()){
                echo '<ul>';
                while ($wpQuery->have_posts()){
                    $wpQuery->the_post();
                    echo '<li>'. get_the_ID() . ' - ' . get_the_title() . '</li>';
                }
                echo '</ul>';
                wp_reset_postdata();
            }else{
                echo '<p>'. translate('No post found') .'</p>';
            }
        }

        //////////////////////// $category_name | $category__in | ... /////////////////////////////
        public function category(){
            // 'cat=term_id("1"), term_id("2")': Lọc ra những bài viết nằm trong category được truyền vào.
            $wpQuery = new WP_Query('cat=4, 6' );

            // 'category_in' => 'term_id': Lọc ra những bài viết nằm trong category cha (Không bao gồm 'cat' con).
            $wpQuery = new WP_Query('category__in=4' );

            // cat=term_id: Lọc ra những bài viết của category có id được truyền vào.
            $wpQuery = new WP_Query('cat=3' );

            // 'category_name' => 'slug': Lọc ra những bài viết của category con nằm trong category cha.
            $wpQuery = new WP_Query('category_name=php' );

            if($wpQuery->have_posts()){
                echo '<ul>';
                while ($wpQuery->have_posts()){
                    $wpQuery->the_post();
                    echo '<li>'. get_the_ID() . ' - ' . get_the_title() . '</li>';
                }
                echo '</ul>';
                wp_reset_postdata();
            }else{
                echo '<p>'. translate('No post found') .'</p>';
            }
        }
    }
?>