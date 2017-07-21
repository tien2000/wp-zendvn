<div class="wrap">
    <h1>My Ajax Settings</h1>
    <p>This is my Ajax settings page</p>

    <?php
        echo settings_errors( $this->_menuSlug, false, false );
    ?>

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