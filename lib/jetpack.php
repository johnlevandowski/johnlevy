<?php
/**
 * Jetpack plugin customizations.
 */
 
/**
 * Photon
 */

/** Jetpack Photon Text Widgets */
add_filter( 'widget_text', 'johnlevy_photon_text_widget_images' );
function johnlevy_photon_text_widget_images( $content ) {
	if ( class_exists( 'Jetpack_Photon' ) ) {
		$content = Jetpack_Photon::filter_the_content( $content );
	}
	return $content;
}

/** Photon skip certain images */
function johnlevy_photon_exception( $val, $src, $tag ) {
        if ( $src == 'https://card.psnprofiles.com/2/jlevandowski.png' ) {
                return true;
        }
        return $val;
}
add_filter( 'jetpack_photon_skip_image', 'johnlevy_photon_exception', 10, 3 );

/**
 * Related Post
 */
 
/** Jetpack Related Post Remove from Default Location */
function johnlevy_jetpackme_remove_rp() {
	if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
    	$jprp = Jetpack_RelatedPosts::init();
    	$callback = array( $jprp, 'filter_add_target_to_dom' );
    	remove_filter( 'the_content', $callback, 40 );
	}
}
add_filter( 'wp', 'johnlevy_jetpackme_remove_rp', 20 );

/** Add Jetpack Related Posts */
add_action( 'genesis_after_entry_content', 'johnlevy_jetpack_related_posts', 9 );
function johnlevy_jetpack_related_posts() {
	if ( is_single() && class_exists( 'Jetpack_RelatedPosts' ) ) { 
		echo do_shortcode( '[jetpack-related-posts]' );
	}
}

/** Jetpack Related Post Image Size */
function johnlevy_jetpack_relatedposts_filter_thumbnail_size( $size ) {
    $size = array(
        'width'  => get_option( 'thumbnail_size_w' ),
        'height' => get_option( 'thumbnail_size_h' )
    );
 
    return $size;
}
add_filter( 'jetpack_relatedposts_filter_thumbnail_size', 'johnlevy_jetpack_relatedposts_filter_thumbnail_size' );

/** Jet Pack Related Post Headlline */
function johnlevy_jetpack_related_posts_headline( $headline ) {
	$headline = '<h3>Related Posts</h3>';
	return $headline;
}
add_filter( 'jetpack_relatedposts_filter_headline', 'johnlevy_jetpack_related_posts_headline' );

/** Jet Pack Related Post Remove Context */
add_filter( 'jetpack_relatedposts_filter_post_context', '__return_empty_string' );

/**
 * Other
 */

/** Force Login via WordPress.com */
add_filter( 'jetpack_sso_bypass_login_forward_wpcom', '__return_true' );
