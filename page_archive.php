<?php
/**
 * Template Name: Archive
 * Description: Archive
 */

/** Remove standard post content output **/
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs');
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
/** johnlevy_archive_page_content defined in lib/archive-page-content.php */
add_action( 'genesis_entry_content', 'johnlevy_archive_page_content' );

genesis();
