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
