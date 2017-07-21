<?php
/**
 * Footer Template
 *
 * The footer template is generally used on every page of your site. Nearly all other
 * templates call it somewhere near the bottom of the file. It is used mostly as a closing
 * wrapper, which is opened with the header.php file. It also executes key functions needed
 * by the theme, child themes, and plugins. 
 *
 * @package Hatch
 * @subpackage Template
 */
?>
				<?php get_sidebar( 'primary' ); // Loads the sidebar-primary.php template. ?>

				<?php do_atomic( 'close_main' ); // hatch_close_main ?>

		</div><!-- #main -->

		<?php do_atomic( 'after_main' ); // hatch_after_main ?>

		<?php get_sidebar( 'subsidiary' ); // Loads the sidebar-subsidiary.php template. ?>		

		<?php do_atomic( 'before_footer' ); // hatch_before_footer ?>

		<div id="footer">

			<?php do_atomic( 'open_footer' ); // hatch_open_footer ?>

			<div class="footer-content">
			
                
                <p class="copyright">Copyright &#169; <?php echo date('Y'); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<p class="credit">Powered by <a href="http://wordpress.org">WordPress</a> and <a href="http://alienwp.com">Hatch</a></p>

				<?php do_atomic( 'footer' ); // hatch_footer ?>

			</div>

			<?php do_atomic( 'close_footer' ); // hatch_close_footer ?>

		</div><!-- #footer -->

		<?php do_atomic( 'after_footer' ); // hatch_after_footer ?>
		
		</div><!-- .wrap -->

	</div><!-- #container -->

	<?php do_atomic( 'close_body' ); // hatch_close_body ?>
	
	<?php wp_footer(); // wp_footer ?>

</body>
</html>