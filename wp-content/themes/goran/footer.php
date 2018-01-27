<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Goran
 */
?>

	</div><!-- #content -->

	<?php get_sidebar( 'footer' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php if ( has_nav_menu( 'footer' ) ) : ?>
			<nav class="footer-navigation" role="navigation">
				<?php
					wp_nav_menu( array(
						'theme_location'  => 'footer',
						'menu_class'      => 'clear',
						'depth'           => 1,
					) );
				?>
			</nav><!-- .footer-navigation -->
		<?php endif; ?>
					<!--
<div class="site-info">
			<a href="<?php echo esc_url( __( '', 'goran' ) ); ?>"><?php printf( __( 'Background by Jialin Yun', 'goran' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( '© 2016 Eric K. Tsai', 'goran' ), 'Goran', '<a href="http://wordpress.com/themes/" rel="designer">WordPress.com</a>' ); ?>	
			
		</div><!-- .site-info -->
ericktsai@cmu.edu | © 2016 Eric K. Tsai

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>