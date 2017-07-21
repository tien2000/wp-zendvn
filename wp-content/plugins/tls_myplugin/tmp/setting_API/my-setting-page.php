<div class="wrap">
    <h1>My Settings</h1>
    <p>This is my settings page</p>
    <form method="post" action="options.php" id="tls_mp_my_setting_form" enctype="multipart/form-data">
        <?php
            echo settings_fields( 'tls_mp_my_settings_group' );
            echo do_settings_sections( $this->_menuSlug );
        ?>
        <p class="submit">
            <input class="button button-primary" type="submit" name="submitMySettings" value="Save Changes" />
        </p>
    </form>
</div>