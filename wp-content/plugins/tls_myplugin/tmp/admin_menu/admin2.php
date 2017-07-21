<?php 
	class TlsMpAdmin{
		public function __construct(){
			add_action('admin_menu', array($this, 'myDashboard'));
			add_action('admin_menu', array($this, 'myPost'));
			add_action('admin_menu', array($this, 'myPage'));
			add_action('admin_menu', array($this, 'removeMenuAbout'));
		}
		
//===========================================================================================//
		//=================================================//
		// 4. Remove About Menu in menu My Page
		//=================================================//
		public function removeMenuAbout(){
			$menuSlug = 'tls-mp-page-menu';
			remove_submenu_page($menuSlug, $menuSlug . '-about');
			remove_menu_page($menuSlug);
			
			remove_menu_page('edit.php');
			remove_submenu_page('edit.php', 'post-new.php');
		}
//===========================================================================================//
		
//===========================================================================================//
		//=================================================//
		// 3. Create myPageMenu into WP_Menu
		//=================================================//
		public function myPage(){
			$menuSlug = 'tls-mp-page-menu';
			add_menu_page('My-Page', 'My Page', 'manage_options', $menuSlug,
							array($this, 'myPagePage'), TLS_MP_IMAGES_URL . 'icon-setting16x16.png', 1);
			add_submenu_page($menuSlug, 'Add New', 'Add New', 'manage_options',
							$menuSlug . '-add-new', array($this, 'myAddNewPage'));
			add_submenu_page($menuSlug, 'About', 'About', 'manage_options',
							$menuSlug . '-about', array($this, 'myAboutPage'));
		}
		
		//=================================================//
		// 3. Create Page into myPageMenu
		//=================================================//
		public function myPagePage(){
			require TLS_MP_VIEWS_URL . 'my-page-page.php';
		}
		
		public function myAddNewPage(){
			echo '<h2>This is my Add New Page</h2>';
		}
		
		public function myAboutPage(){
			echo '<h2>This is my About Page</h2>';
		}
//===========================================================================================//
		
//===========================================================================================//
		//=================================================//
		// 2. Create myPostMenu into WP_Menu
		//=================================================//
		public function myPost(){
			$menuSlug = 'tls-mp-post-menu';
			add_menu_page('My-Post', 'My Post', 'manage_options', $menuSlug,
								array($this, 'myPostPage'), TLS_MP_IMAGES_URL . 'icon-setting16x16.png');
			add_submenu_page($menuSlug, 'Add New', 'Add New', 'manage_options', 
								$menuSlug . '-add-new', array($this, 'myAddNewPost'));
		}
		
		//=================================================//
		// 2. Create Page into myPostMenu
		//=================================================//
		public function myPostPage(){
			require TLS_MP_VIEWS_URL . 'my-post-page.php';
		}
		
		public function myAddNewPost(){
			echo '<h2>This is my Add New Post</h2>';
		}
//===========================================================================================//
		
//===========================================================================================//
		//=================================================//
		// 1. Create Submenu into Dashboard Menu
		//=================================================//
		public function myDashboard(){
			$menuSlug = 'tls-mp-menu';
			add_dashboard_page('My-Dashboard', 'My Dashboard', 'manage_options', $menuSlug, 
								array($this, 'myDashboardPage'));
		}
		
		//=================================================//
		// 1. Create Page into My Dashboard Menu
		//=================================================//
		public function myDashboardPage(){
			echo '<h2>This is my dashboard</h2>';
		}		
//===========================================================================================//
	}
?>