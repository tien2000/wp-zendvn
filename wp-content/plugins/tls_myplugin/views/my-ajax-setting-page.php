<div class="wrap">
    <h1>My Settings</h1>
    <?php
        echo settings_errors( $this->_menuSlug, false, false );
    ?>
    <p>This is my settings page</p>
    <form method="post" action="options.php" id="<?php echo $this->_menuSlug; ?>" enctype="multipart/form-data">
        <?php
            echo settings_fields( $this->_menuSlug );
            echo do_settings_sections( $this->_menuSlug );
        ?>
        <p class="submit">
            <input id="btn-saveChange" class="button button-primary" type="submit" name="submitMySettings" value="Save Changes" />
        </p>
    </form>
</div>