<?php
/**
 * The template for displaying content in the single.php template
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'hnews item' ); ?> itemscope itemtype="https://schema.org/Article">

    <?php do_action('largo_before_post_header'); ?>
    
    <?php 
    
    add_filter( 'body_class', function( $classes ) {
        $classes[] = 'photo-header';
        return $classes;
    } );
    
    workday_photo_header_tag( get_post_thumbnail_id() ); 

    ?>
        <div class="featured-image-bg-layer">
        </div>
        <div class="featured-image-container-content">
            <?php

            if( get_post_thumbnail_id() ) {
                echo '<div class="featured-image-wrapper"><img class="featured-image-container-mobile-image" src="'.wp_get_attachment_url( get_post_thumbnail_id() ).'"></div>';
            }

            ?>
            <?php largo_maybe_top_term(); ?>
            <h1 class="entry-title" itemprop="headline"><?php the_title(); ?></h1>
            <h5 class="byline"><?php largo_byline( true, true, get_the_ID() ); ?></h5>

            <?php if ( ! of_get_option( 'single_social_icons' ) == false ) { ?>
                <ul class="photo-header-social-links">
                    <?php largo_post_social_links(); ?>
                </ul>
            <?php } ?>
        </div>

<?php largo_post_metadata( $post->ID ); ?>

	</header><!-- / entry header -->

	<?php
		do_action('largo_after_post_header');

		do_action('largo_after_hero');
	?>

	<?php get_sidebar(); ?>

	<section class="entry-content clearfix" itemprop="articleBody">
		
		<?php largo_entry_content( $post ); ?>
		
	</section>

	<?php do_action('largo_after_post_content'); ?>

</article>
