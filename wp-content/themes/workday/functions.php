<?php
/**
 * Child theme for Workday Minnesota
 *
 */

/**
 * Include files that should be included
 */
$includes = array(
	'/inc/drupal-import.php',
);
foreach ( $includes as $include ) {
	if ( 0 === validate_file( get_stylesheet_directory() . $include ) ) {
		require_once( get_stylesheet_directory() . $include );
	}
}

/**
 * Child styles include
 */
function workday_stylesheets() {
	wp_dequeue_style( 'largo-child-styles' );
	wp_deregister_style( 'largo-child-styles' );

	// https://fonts.adobe.com/my_fonts?project_id=xio4whb#web_projects-section
	wp_enqueue_style(
		'workday-minnesota-adobe-fonts',
		'https://use.typekit.net/xio4whb.css'
	);

	$suffix = (LARGO_DEBUG) ? '.min' : '';
	wp_enqueue_style(
		'largo-child-styles',
		get_stylesheet_directory_uri() . '/css/style' . $suffix . '.css',
		array( 'largo-stylesheet', 'workday-minnesota-adobe-fonts' ),
		filemtime( get_stylesheet_directory() . '/css/style' . $suffix . '.css' )
	);

}
add_action( 'wp_enqueue_scripts', 'workday_stylesheets', 20 );
