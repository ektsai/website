<?php
/**
 * WordPress.com-specific functions and definitions.
 *
 * This file is centrally included from `wp-content/mu-plugins/wpcom-theme-compat.php`.
 *
 * @package Goran
 */

/**
 * Adds support for wp.com-specific theme functions.
 *
 * @global array $themecolors
 */
function goran_wpcom_setup() {
	global $themecolors;

	// Set theme colors for third party services.
	$themecolors = array(
		'bg'     => 'ffffff',
		'border' => 'd2cfcf',
		'text'   => '242424',
		'link'   => '339d41',
		'url'    => '339d41',
	);
}
add_action( 'after_setup_theme', 'goran_wpcom_setup', 11 );

/**
 * Enqueue wp.com-specific styles
 */
function goran_wpcom_styles() {
	wp_enqueue_style( 'goran-wpcom', get_stylesheet_directory_uri() . '/inc/style-wpcom.css', '20140815' );
}
add_action( 'wp_enqueue_scripts', 'goran_wpcom_styles', 11 );

/**
 * De-queue Google fonts if custom fonts are being used instead.
 */
function goran_dequeue_fonts() {
	if ( class_exists( 'TypekitData' ) && class_exists( 'CustomDesign' ) && CustomDesign::is_upgrade_active() ) {
		$customfonts = TypekitData::get( 'families' );

		if ( $customfonts['headings']['id'] && $customfonts['body-text']['id'] ) {
			wp_dequeue_style( 'goran-noto-sans' );
			wp_dequeue_style( 'goran-noto-serif' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'goran_dequeue_fonts' );
