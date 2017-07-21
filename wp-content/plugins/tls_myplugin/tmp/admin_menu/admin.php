<?php
    class TlsMpAdmin{
        public function __construct(){
            add_action('admin_menu', array($this, 'addMyDashboard'));
            add_action('admin_menu', array($this, 'addMySetting'));
            //add_action('admin_menu', array($this, 'removeMenuAbout'));
        }

        public function removeMenuAbout(){
            $menuSlug = 'tls-mp-menu-setting';
            remove_submenu_page('upload.php', 'media-new.php');
        }

        public function addMySetting(){
            $menuSlug = 'tls-mp-menu-setting';
            add_object_page('My Setting', 'My setting', 'manage_options', $menuSlug,
                            array($this, 'mySettingPage'), TLS_MP_IMAGES_URL . 'icon-setting16x16.png');

            add_utility_page('My Setting2', 'My setting2', 'manage_options', $menuSlug . '-2',
                            array($this, 'mySettingPage'), TLS_MP_IMAGES_URL . 'icon-setting16x16.png');

            add_submenu_page($menuSlug, 'Add New', 'Add New', 'manage_options', $menuSlug . '-add-new',
                                array($this, 'myAddNewPage'));

            add_submenu_page($menuSlug, 'About', 'About', 'manage_options', $menuSlug . '-about',
                array($this, 'myAboutPage'));
        }

        public function myAboutPage(){
            require TLS_MP_VIEWS_DIR . 'my-post-about.php';
        }

        public function myAddNewPage(){
            echo '<h2>This is my add new page</h2>';
        }

        public function mySettingPage(){
            echo '<h2>This is my setting page</h2>';
        }

        public function addMyDashboard(){
            $menuSlug = 'tls-mp-menu-dashboard';
            add_dashboard_page('My Dashboard', 'My Dashboard', 'manage_options', $menuSlug,
                                    array($this, 'myDashboardPage'));
        }

        public function myDashboardPage(){
            echo '<h2>This is my dashboard page</h2>';
        }
    }
?>