<?php
/**
 * Block color palette information
 */

/**
 * Define the block color palette
 *
 * If updating these colors, please update less/vars.less. Slugs should match LESS var names.
 *
 * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/
 * @return Array of Arrays
 */
function workday_block_colors() {
	return array(
		array(
			'name' => __( 'White', 'workday' ),
			'slug' => 'white',
			'color' => 'white',
		),
		array(
			'name' => __( 'Cream', 'workday' ),
			'slug' => 'cream',
			'color' => '#F8F4F2',
		),
		array(
			'name' => __( 'Orange', 'workday' ),
			'slug' => 'orange',
			'color' => '#CA5004',
		),
		array(
			'name' => __( 'Green', 'workday' ),
			'slug' => 'green',
			'color' => '#71E26C',
		),
		array(
			'name' => __( 'Dark Green', 'workday' ),
			'slug' => 'darkgreen',
			'color' => '#16A327',
		),
		array(
			'name' => __( 'Light Gray', 'workday' ),
			'slug' => 'gray',
			'color' => '#ADADAD',
		),
		array(
			'name' => __( 'Dark Gray', 'workday' ),
			'slug' => 'darkgray',
			'color' => '#534B47',
		),
		array(
			'name' => __( 'Black', 'workday' ),
			'slug' => 'black',
			'color' => '#020202',
		),
	);
}

add_theme_support( 'editor-color-palette', workday_block_colors() );

/**
 * Loop over the defined colors and create classes for them
 *
 * @uses workday_block_colors
 * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/
 */
function workday_block_colors_styles() {
	$colors = workday_block_colors();

	if ( is_array( $colors ) && ! empty( $colors ) ) {
		echo '<style type="text/css" id="workday_block_colors_styles">';
		foreach ( $colors as $color ) {
			if (
				is_array( $color )
				&& isset( $color['slug'] )
				&& isset( $color['color'] )
			) {
				printf(
					'.has-%1$s-background-color { background-color: %2$s; }',
					$color['slug'],
					$color['color']
				);
				printf(
					'.has-%1$s-color { color: %2$s; }',
					$color['slug'],
					$color['color']
				);
			}
		}
		echo '</style>';
	}
}
add_action( 'wp_print_styles', 'workday_block_colors_styles' );
