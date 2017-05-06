<?php
/** Remove default loop **/
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
johnlevy_remove_adsense_actions();
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'johnlevy_404' );
function johnlevy_404() { ?>

	<article class="entry">

		<h1 class="entry-title"><?php _e( 'Page Not Found', 'genesis' ); ?></h1>
		<div class="entry-content">
			<p>The page you are looking for no longer exists. Perhaps you can try searching for it or use one of the following links.</p>

			<?php get_search_form(); ?>

			<br />

<?php
			/** johnlevy_archive_page_content defined in lib/archive-page-content.php */
			johnlevy_archive_page_content();
?>

		</div><!-- end .entry-content -->

	</article>

<?php
}

genesis();
