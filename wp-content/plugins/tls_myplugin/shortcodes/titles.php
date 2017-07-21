<?php
/*
 *
 */
    class Tls_Mp_Sc_Titles{

        public function __construct(){
            add_shortcode('tls_mp_sc_show_titles', array($this, 'showTitles'));
        }

        public function showTitles($attr){
            if(is_single()){
                $pairs = array(
                    'ids' => '43,45,47',
                    'title' => 'Các bài viết khác'
                );
                $attr = shortcode_atts($pairs, $attr, 'tls_mp_sc_show_titles');

                extract($attr);
                $ids = explode(',', $ids);
                if(count($ids) > 0){
                    $args = array(
                        'post_type'             => 'post',
                        'post__in'              => $ids,
                        'post_status'           => 'publish',
                        'ignore_sticky_posts'   => true
                    );

                    $wpQuery = new WP_Query($args);

                    if($wpQuery->have_posts()){
                        $list = '';
                        $list .= '<ul>';
                            while ($wpQuery->have_posts()){
                                $wpQuery->the_post();
                                $lnk = $wpQuery->post->guid;
                                $list .= '<li><a href ="'. $lnk .'"> ' . get_the_title() .' </a></li>';
                            }
                        $list .= '</ul>';
                    }
                    wp_reset_postdata();
                }
                $html = "<div><b><i>{$title}</i></b>{$list}</div>";
                return $html;
            }
        }
    }