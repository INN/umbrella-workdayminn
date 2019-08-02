<?php
	global $shown_ids;
?>

<div id="topstory" class="" style="border: 4px solid black; padding: 3em; min-height: 20em;">
	<?php
		$topstory = largo_home_single_top();
		$shown_ids[] = $topstory->ID;
		?>
			<article <?php post_class( 'clearfix', $topstory ); ?>>
				<h2><a href="<?php esc_attr( get_the_permalink( $topstory ) ); ?>">
					<?php echo get_the_title( $topstory ); ?>
				</a></h2>
				<h5 class="byline"><?php largo_byline( true, false, $topstory ); ?></h5>
				<?php largo_excerpt( $topstory, 4, false ); ?>
			</article>
		<?php
	?>
</div>

<div id="featured" class="row">
	<div class="span8">
		<?php
			$substories = largo_home_featured_stories( 1 );
			foreach ( $substories as $substory ) {
				$shown_ids[] = $substory->ID;
				?>
					<article <?php post_class( 'clearfix', $substory ); ?>>
						<h2><a href="<?php esc_attr( get_the_permalink( $substory ) ); ?>">
							<?php echo get_the_title( $substory ); ?>
						</a></h2>
						<h5 class="byline"><?php largo_byline( true, false, $substory ); ?></h5>
						<?php largo_excerpt( $substory, 4, false ); ?>
					</article>
				<?php
			}
		?>
	</div>
	<div class="span4">
	</div>
</div>
<div id="widget-area" class="">
</div>
