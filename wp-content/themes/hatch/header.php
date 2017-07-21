<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>

<body class="<?php hybrid_body_class(); ?>">

	<?php do_atomic( 'open_body' ); // hatch_open_body ?>

	<div id="container">
		
		<div class="wrap">

			<?php do_atomic( 'before_header' ); // hatch_before_header ?>
	
			<div id="header">
	
				<?php do_atomic( 'open_header' ); // hatch_open_header ?>
	
					<div id="branding">
						
					<?php the_custom_logo(); ?>
					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                        
					<?php else : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<h2 class="site-description"><?php echo $description; ?></h2>
					<?php endif; ?>
					</div><!-- #branding -->
					
					<?php get_template_part( 'menu', 'primary' ); // Loads the menu-primary.php template. ?>				
	
					<?php do_atomic( 'header' ); // hatch_header ?>
	
				<?php do_atomic( 'close_header' ); // hatch_close_header ?>
	
			</div><!-- #header -->
	
			<?php do_atomic( 'after_header' ); // hatch_after_header ?>
	
			<?php do_atomic( 'before_main' ); // hatch_before_main ?>
	
			<div id="main">
	
				<?php do_atomic( 'open_main' ); // hatch_open_main ?>