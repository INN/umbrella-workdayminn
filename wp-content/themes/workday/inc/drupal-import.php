<?php
/**
 * Functions written by Gravity Switch to facilitate the import of this site from Drupal.
 *
 * These functions were copied from wdm-largo/functions.php, which is a modified Largo theme.
 * They have not been modified otherwise.
 */

function custom_check_if_types_group_exist( $title ) {
  global $wpdb;
  $return = $wpdb->get_row( "SELECT ID FROM $wpdb->posts WHERE post_title = '" . $title . "' && post_status = 'publish' && post_type = 'wp-types-group' ", 'ARRAY_N' );
  if( empty( $return ) ) {
      return false;
  } else {
      return true;
  }
}
add_action('fgd2wp_post_import', 'wdmimport_massage_data');

function wdmimport_massage_data () {
	// delete the unnecessary-deemed gallery items and prev imported content blocks
	$media_gallery_items = get_posts( array('post_type'=>['gallery_item','content-block'],'numberposts'=>-1, 'post_status' => 'any') );
	foreach ($media_gallery_items as $item) {
		wp_delete_post( $item->ID, true );
	}
	// convert blog items to native wp posts
	$blog_items = get_posts( array('post_type'=>'blog','numberposts'=>-1, 'post_status' => 'any') );
	foreach ($blog_items as $item) {
		$item->post_type = "post";
		wp_update_post( $item );
	}


	// scan the blocks of active drupal themes
	$wdm_active_themes = array("workdayminnesota","zen");
	$drupaldb = new wpdb(DB_USER, DB_PASSWORD,'wdmdev_import','localhost');
	//$blocks = $drupaldb->get_results("SELECT * from blocks WHERE theme IN ".implode(',', $wdm_active_themes)."AND pages <> ''", ARRAY_A);
	//$boxes = $drupaldb->get_results("SELECT * from boxes", ARRAY_A);
	$content_blocks = $drupaldb->get_results("SELECT * from boxes", ARRAY_A);

	foreach ($content_blocks as $block) :
		$block_info = $drupaldb->get_results("SELECT * from blocks WHERE module = 'block' AND visiblity = 1 AND theme IN ".implode(',', $wdm_active_themes)." AND delta = {$block['bid']} LIMIT 1", ARRAY_A);
		//var_dump($block_info);
		wp_insert_post(array(
			"post_title" => $block["info"],
			"post_type" => "content-block",
			"post_content" => $block["body"],
			"meta_input" => array(
				"pages" => $block_info["pages"]
			)
		));

	endforeach;
}


