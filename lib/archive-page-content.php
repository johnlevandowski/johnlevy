<?php
/**
 * Archive Page Content
 * Displays on Archive and 404 pages
 */

/**
 * Get a page's ID from it's slug
 */

function johnlevy_get_page_ID_by_slug( $slug ) {
    $page = get_page_by_path( $slug );
    if ( $page ) {
        return $page->ID;
    }
    else {
        return null;
    }
}

function johnlevy_archive_page_content() { ?>

<div class="one-half first">

	<h2><?php _e( 'Posts:', 'genesis' ); ?></h2>
	<ul>
		<?php wp_get_archives( 'type=postbypost' ); ?>
	</ul>

</div><!-- end .archive-page-->

<div class="one-half">

	<h2><?php _e( 'Pages:', 'genesis' ); ?></h2>
	<ul>
		<?php wp_list_pages( 'exclude='.johnlevy_get_page_ID_by_slug('google-cse').'&title_li=' ); ?>
	</ul>

	<h2><?php _e( 'Categories:', 'genesis' ); ?></h2>
	<ul>
		<?php wp_list_categories( 'title_li=' ); ?>
	</ul>

	<h2><?php _e( 'Tags:', 'genesis' ); ?></h2>
		<?php wp_tag_cloud(); ?>

</div><!-- end .archive-page-->

<?php
}
