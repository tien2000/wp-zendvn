<div class="wrap">
    <h1>My Setting</h1>
    <?php
        echo settings_errors( $this->_menuSlug, false, false );
    ?>
    <p>This is my settings page</p>
    <form method="post" action="options.php" id="tls_mp_my_setting_form" enctype="multipart/form-data">
        <?php
            echo settings_fields( 'tls_mp_my_settings_group' );
            echo do_settings_sections( $this->_menuSlug );
        ?>

        <?php
            global $wpdb;
            $table = $wpdb->prefix . 'mp_article';

            $title      = 'This is a test 2';
            $picture    = 'abc2.png';
            $content    = 'This is content 2';
            $status     = 0;

            $query = "INSERT INTO {$table} (`title`, `picture`, `content`, `status`)
                        VALUE (%s, %s, %s, %d) ";

            $info = $wpdb->prepare($query, $title, $picture, $content, $status);
            $query = $wpdb->query($info);

            echo '<pre>';
            print_r($wpdb->users);
            echo '</pre>';
        ?>

        <!--
        <p class="submit">
            <input class="button button-primary" type="submit" name="submitMySettings" value="Save Changes" />
        </p>
        -->
    </form>
</div>
