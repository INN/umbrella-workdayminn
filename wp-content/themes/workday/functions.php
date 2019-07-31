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

	$suffix = (LARGO_DEBUG) ? '.min' : '';
	wp_enqueue_style(
		'largo-child-styles',
		get_stylesheet_directory_uri() . '/css/style' . $suffix . '.css',
		array('largo-stylesheet'),
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
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php largo_home_icon( 'icon-white', 'orig' ); ?></a>
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