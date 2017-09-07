<?php
class Tls_Theme_Menu_Color_Section{
	
	private $_theme_mods;
	
	public function __construct($theme_mods = array()){
		$this->_theme_mods = $theme_mods;
		
		add_action('customize_register', array($this,'register'));
		add_action('wp_head', array($this,'css'));
		add_action('customize_preview_init', array($this,'live_preview'));
		/* echo '<pre>';
		print_r($this->_theme_mods);
		echo '</pre>'; */
	}
	
	public function css(){
		$options = @$this->_theme_mods['tls_theme_menu_color'];
		/* echo '<br/>' . __METHOD__;
		echo '<pre>';
		print_r($options);
		echo '</pre>'; */
?>
	<style type="text/css" id="tls-theme-customize">
		<?php foreach ($options as $key => $val):?>
				#site-navigation .<?php echo $key;?>:after{ 
					background-color: <?php echo $val;?>; 
				}
		<?php endforeach;?>
	</style>
<?php 
	}
	
	public function live_preview(){
		
		wp_enqueue_script('tls-theme-customize', 
						TLS_THEME_JS_URL . '/theme-customize.js',
						array('jquery','customize-preview'),
						'1.0.0',
						true
						);	
		add_action('wp_footer', array($this,'jsMenu'),99);
	}
	
	public function jsMenu(){
		echo '<br/>' . __METHOD__;
		$cats = get_categories();
		$jsStr = '';
		foreach ($cats as $key => $info){
			$cat = 'cat-' .  $info->cat_ID;
		$jsStr .= "wp.customize('tls_theme_menu_color[" . $cat . "]', function(value){		
						value.bind(function(newValue){
							var css ='#site-navigation ." . $cat . ":after{ background-color: ' + newValue + '; }';
							$('style#tls-theme-customize').append(css);
						});
					});";
		}
		
		$jsTag = '<script type="text/javascript">' 
				 . '(function($){ '
				 . $jsStr
				 . ' }(jQuery));'
				 . '</script>';
		echo $jsTag;
	}
	
	public function register($wp_customize){
		
		$sectionID = 'tls_theme_menu_color';
		$wp_customize->add_section($sectionID,array(
					'title' => __('Category Color'),
					'description' => 'Hien thi cac phan tu trong Section',
					'priority' => 20
				
			));
		
		//=======================================================
		// Tao top-banner
		//=======================================================
		
		$cats = get_categories();
		/* echo '<pre>';
		print_r($cats);
		echo '</pre>'; */
		foreach ($cats as $key => $info){
			$inputName = 'cat-' . $info->cat_ID;
			$settingID = $sectionID . '[' . $inputName . ']';
			$wp_customize->add_setting($settingID,array(
					'default' 		=> '#979797',
					'capability' 	=>'edit_theme_options',
					'type'			=> 'theme_mod',
					'transport'		=> 'postMessage',
			));
			
			$controlID = 'tls-theme-' . $inputName;
			$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $controlID,array(
					'label' 		=> __($info->name),
					'section' 		=> $sectionID,
					'settings' 		=> $settingID,
			)));
		}
	}
}