<?php
    class Tls_Mp_Dashboard_Widget_Simple{
        public function __construct(){
            add_action( 'wp_dashboard_setup',array($this, 'widget_db'));
        }

        public function widget_db(){
            wp_add_dashboard_widget( 'tls-mp-widget-db-simple', 'My Widget Information',
                                            array($this, 'ordering' ));
        }

        public function ordering(){
            $argsOrder = array(
               'orderby'        => 'rand',
               'posts_per_page' => '2',
            );
            $wpQuery = new WP_Query($argsOrder);

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
