<?php
/**
 * Child theme for Workday Minnesota
 *
 */
define( 'SHOW_GLOBAL_NAV', FALSE );

/**
 * Include files that should be included
 */
$includes = array(
	'/inc/drupal-import.php',
	'/homepages/layout.php',
	'/inc/block-color-palette.php',
    '/inc/photo-header-template.php',
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

/**
 * Output the Workday Minnesota theme specific header
 */
function largo_header() {
	
	?>
    <div class="header-container">
        <div class="header-container-inner">
            <div class="nav-left">
                <?php
                /* Check to display Donate Button */
                if ( of_get_option( 'show_donate_button') ) {
                    ?>
                        <a href="<?php echo of_get_option( 'donate_link' ); ?>">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/donate.png" class="donate-icon">
                            <label><?php _e('Donate', 'workday'); ?></label>
                        </a>
                    <?php
                }
                ?>
            </div>
            <div class="nav-center">
				<!-- add an image placeholder, the src is added by largo_header_js() in inc/enqueue.php -->
				<a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="header_img" src="" alt="" /></a>
            </div>
            <div class="nav-right">
                <a href="/?s">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/search.png" class="search-icon">
                    <label><?php _e('Search', 'workday'); ?></label>
                </a>
            <!-- END Header Search -->
            </div>
        </div>
    </div>
	<?php
	
}

/**
 * Register Workday child theme specific widgets
 */
function register_workday_widgets() {

    $register = array(
        'workday_related_posts_widget' => '/inc/widgets/workday-related-posts.php',
    );

	foreach ( $register as $key => $val ) {
		require_once( get_stylesheet_directory() . $val );
		register_widget( $key );
	}

}
add_action( 'widgets_init', 'register_workday_widgets', 1 );

/**
 * Function that allows you to get all of the categories for a specific post
 * with the top term returned as the first item in the array
 * 
 * @param int $post_id The ID of the post to get categories of
 * @return Array of the categories for the specified post
 */
function workday_get_post_categories_with_top_term( $post_id ) {

    $top_term = largo_top_term( $args = 
        array(
            'post' => $post_id,
            'echo' => FALSE,
            'link' => FALSE,
        )
    ); 

    $formatted_categories = array();

    $category_list = get_the_category( $post_id );

    if( !empty ( $top_term ) ) {

        foreach( $category_list as $index => $category ) {

            if( $category->name == strip_tags( $top_term ) ){

                $top_term_index = $category_list[$index];

                unset( $category_list[$index] );

                array_unshift( $category_list, $top_term_index );

            }

        }

    }

    foreach( $category_list as $category ) {

        $category_link = get_category_link( $category->term_id );

        array_push( $formatted_categories, '<h5 class="top-tag"><a href="'.$category_link.'" title="Read posts in the '.$category->name.' category">'.$category->name.'</a><span> | </span></h5>');

    }

    return $formatted_categories;

}