<?php
/**
 * Template Name: Landing
 * Description: Landing
 */

/** Add custom body class to the head */
add_filter( 'body_class', 'johnlevy_landing_body_class' );
function johnlevy_landing_body_class( $classes ) {
	$classes[] = 'johnlevy-landing';
	return $classes;
}

/** Remove header, navigation, breadcrumbs, adsense widgets, footer widgets */
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
remove_action( 'genesis_header', 'genesis_do_header' );
remove_action( 'genesis_after_header', 'genesis_do_nav' );
remove_action( 'genesis_footer', 'genesis_do_subnav', 5 );
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs');
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
johnlevy_remove_adsense_actions();
add_action( 'genesis_header', 'johnlevy_do_header' );
function johnlevy_do_header() {
	genesis_markup( array(
		'html5'   => '<div %s>',
		'xhtml'   => '<div id="title-area">',
		'context' => 'title-area',
	) );
	do_action( 'genesis_site_title' );
	echo '</div>';
}

genesis();
