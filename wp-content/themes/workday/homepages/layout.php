<?php
include_once get_template_directory() . '/homepages/homepage-class.php';

class WorkdayMinnesota extends Homepage {
	var $name = 'Workday Minnesota';
	var $type = 'workday';
	var $description = 'The homepage for Workday Minnesota.';
	var $sidebars = array(
		'Homepage Sidebar',
		'Homepage Bottom',
	);
	var $rightRail = false;

	public function __construct( $options = array() ) {
		$defaults = array(
			'template' => get_stylesheet_directory() . '/homepages/template.php',
			'assets' => array(
				array(
					'homepage',
					get_stylesheet_directory_uri() . '/homepages/assets/css/homepage.css',
					array(),
					filemtime( get_stylesheet_directory() . '/homepages/assets/css/homepage.css' ),
				),
			),
		);
		$options = array_merge( $defaults, $options );
		$this->load( $options );
	}

}

/**
 * Register this layout with Largo
 */
function workday_homepage_layout() {
	register_homepage_layout( 'WorkdayMinnesota' );
}
add_action( 'init', 'workday_homepage_layout' );
