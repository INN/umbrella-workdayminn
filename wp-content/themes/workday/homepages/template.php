<?php
	global $shown_ids;

	$topstory = largo_home_single_top();
	$shown_ids[] = $topstory->ID;
?>

<div id="topstory" class="" style="background-image:url('<?php echo wp_get_attachment_url( get_post_thumbnail_id( $topstory->ID ) ); ?>');">
	<article <?php post_class( 'clearfix', $topstory ); ?>>
		<?php
			if( get_post_thumbnail_id() ) {
                echo '<div class="topstory-image-wrapper"><img class="topstory-image-container-mobile-image" src="'.wp_get_attachment_url( get_post_thumbnail_id( $topstory->ID ) ).'"></div>';
			}
		?>
		<h2><a href="<?php echo esc_attr( get_permalink( $topstory ) ); ?>">
			<?php echo get_the_title( $topstory ); ?>
		</a></h2>
		<h5 class="byline"><?php largo_byline( true, true, $topstory ); ?></h5>
	</article>
	<div class="topstory-newsletter-widget">
		<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
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
