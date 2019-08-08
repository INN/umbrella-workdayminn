<?php
	global $shown_ids;

	$topstory = largo_home_single_top();
	$shown_ids[] = $topstory->ID;
?>

<?php if( get_post_thumbnail_id( $topstory->ID ) ) { ?>
	<div id="topstory" class="" style="background-image:url('<?php echo wp_get_attachment_url( get_post_thumbnail_id( $topstory->ID ) ); ?>');">
		<article <?php post_class( 'clearfix', $topstory ); ?>>
			<div class="topstory-image-wrapper"><img class="topstory-image-container-mobile-image" src="<?php echo wp_get_attachment_url( get_post_thumbnail_id( $topstory->ID ) ); ?>"></div>
<?php } else { ?>
	<div id="topstory" class="topstory-no-photo">
		<article <?php post_class( 'clearfix', $topstory ); ?>>
<?php } ?>
			<h2><a href="<?php echo esc_attr( get_permalink( $topstory ) ); ?>">
				<?php echo get_the_title( $topstory ); ?>
			</a></h2>
			<h5 class="byline"><?php largo_byline( true, true, $topstory ); ?></h5>
		</article>
		<div class="topstory-newsletter-widget">
			<div class="topstory-newsletter-widget-container">
				<div class="topstory-newsletter-widget-content">
					<label><?php _e( 'Story Alerts', 'largo' ); ?></label>
					<p><?php _e( 'The best of Workday Minnesota. We’ll email you when we publish a significant investigation (once every two weeks).', 'largo' ); ?></p>
				</div>
				<div class="topstory-newsletter-widget-form">
					<?php get_template_part( 'partials/mailchimp', 'signup-form' ); ?>
				</div>
				<div class="topstory-newsletter-rss-feed">
					<a href="<?php echo of_get_option( 'rss_link' ) ? esc_url( of_get_option( 'rss_link' ) ) : get_feed_link(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/rss.png"></a>
				</div>
			</div>
		</div>
	</div>

<div id="featured" class="row clearfix">
	<div id="substory" class="span8">
		<?php
			$substories = largo_home_featured_stories( 1 );
			foreach ( $substories as $substory ) {
				$shown_ids[] = $substory->ID;
				?>
					<article <?php post_class( 'clearfix', $substory ); ?>>
						<a href="<?php echo esc_attr( get_permalink( $substory ) ); ?>">
							<?php echo get_the_post_thumbnail( $substory, 'large' ); ?>
						</a>
						<?php largo_maybe_top_term( array( 'post' => $substory->ID ) ); ?>
						<h2><a href="<?php echo esc_attr( get_permalink( $substory ) ); ?>">
							<?php echo get_the_title( $substory ); ?>
						</a></h2>
						<?php largo_excerpt( $substory, 4, false ); ?>
					</article>
				<?php
			}
		?>
	</div>
	<div id="homepage-sidebar" class="span4">
		<?php
			dynamic_sidebar( 'Homepage Sidebar' );
		?>
	</div>
</div>
<div id="widget-area" class="clearfix">
	<?php
		dynamic_sidebar( 'Homepage Bottom' );
	?>
</div>
