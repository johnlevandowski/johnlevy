<?php
/**
 * Genesis Sample.
 *
 * This file adds functions to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://www.studiopress.com/
 */

// Start the engine.
include_once( get_template_directory() . '/lib/init.php' );

// Setup Theme.
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

// Set Localization (do not remove).
add_action( 'after_setup_theme', 'genesis_sample_localization_setup' );
function genesis_sample_localization_setup(){
	load_child_theme_textdomain( 'genesis-sample', get_stylesheet_directory() . '/languages' );
}

// Child theme (do not remove).
define( 'CHILD_THEME_NAME', 'johnlevy' );
define( 'CHILD_THEME_URL', 'http://johnlevandowski.com/' );
define( 'CHILD_THEME_VERSION', filemtime( CHILD_DIR . '/style.css' ) );

// Enqueue Scripts and Styles.
add_action( 'wp_enqueue_scripts', 'genesis_sample_enqueue_scripts_styles' );
function genesis_sample_enqueue_scripts_styles() {

	wp_enqueue_style( 'genesis-sample-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'genesis-sample-responsive-menu', get_stylesheet_directory_uri() . "/js/responsive-menus{$suffix}.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_localize_script(
		'genesis-sample-responsive-menu',
		'genesis_responsive_menu',
		genesis_sample_responsive_menu_settings()
	);

}

// Define our responsive menu settings.
function genesis_sample_responsive_menu_settings() {

	$settings = array(
		'mainMenu'          => __( 'Menu', 'genesis-sample' ),
		'menuIconClass'     => 'dashicons-before dashicons-menu',
		'subMenu'           => __( 'Submenu', 'genesis-sample' ),
		'subMenuIconsClass' => 'dashicons-before dashicons-arrow-down-alt2',
		'menuClasses'       => array(
			'combine' => array(
				'.nav-primary',
				'.nav-header',
			),
			'others'  => array(),
		),
	);

	return $settings;

}

// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

// Add Accessibility support.
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Add support for 3-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 3 );

// Add Adsense Widget Areas.
include_once( CHILD_DIR . '/lib/adsense-widgetize.php');

// Add Google Custom Search.
include_once( CHILD_DIR . '/lib/google-search.php');

// Add Archive Page Content.
include_once( CHILD_DIR . '/lib/archive-page-content.php');

// Add Jetpack plugin customizations.
include_once( CHILD_DIR . '/lib/jetpack.php');

// Rename primary and secondary navigation menus.
add_theme_support( 'genesis-menus', array( 'primary' => __( 'After Header Menu', 'genesis-sample' ), 'secondary' => __( 'Footer Menu', 'genesis-sample' ) ) );

// Reposition the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

// Reduce the secondary navigation menu to one level depth.
add_filter( 'wp_nav_menu_args', 'genesis_sample_secondary_menu_args' );
function genesis_sample_secondary_menu_args( $args ) {

	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

}

// Modify size of the Gravatar in the author box.
add_filter( 'genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar' );
function genesis_sample_author_box_gravatar( $size ) {
	return 90;
}

// Modify size of the Gravatar in the entry comments.
add_filter( 'genesis_comment_list_args', 'genesis_sample_comments_gravatar' );
function genesis_sample_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;

	return $args;

}

// Customize post info genesis/lib/structure/post.php
add_filter( 'genesis_post_info', 'johnlevy_post_info' );
function johnlevy_post_info($post_info) {
    $post_info = 'Posted on [post_date] [post_edit] [post_comments]';
    return $post_info;
}

// Customize length of post excerpts default is 55.
add_filter( 'excerpt_length', 'johnlevy_excerpt_length' );
function johnlevy_excerpt_length($length) {
    return 60;
}

// Customize more link of post excerpts.
add_filter('excerpt_more', 'johnlevy_excerpt_more');
function johnlevy_excerpt_more($more) {
	return ' &hellip;';
}

// Customize jpeg quality.
add_filter( 'jpeg_quality', 'johnlevy_jpeg_quality' );
add_filter( 'wp_editor_set_quality', 'johnlevy_jpeg_quality' );
function johnlevy_jpeg_quality($quality) {
	return (int)80;
}

// Add read more link to post on all archive pages.
add_action( 'genesis_entry_content', 'johnlevy_read_more_post_content', 15 );
function johnlevy_read_more_post_content() {
	if ( ! is_singular() ) {
	echo '<p class="johnlevy-read-more"><a href="' . get_permalink() . '">Continue Reading &rarr;</a></p>';
	}
}

/* Customize footer genesis/lib/structure/footer.php
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'johnlevy_do_footer' );
function johnlevy_do_footer() {
    ?><p>&copy; Copyright 2010-<?php echo date( 'Y' ); ?> <a title="johnlevandowski.com" href="http://johnlevandowski.com/">johnlevandowski.com</a></p>
	<p>Powered by <a title="Genesis Framework" href="http://johnlevandowski.com/go/genesis/">Genesis</a>, 
	<a title="Namecheap" href="http://johnlevandowski.com/go/namecheap/">Namecheap</a>, 
	and <a title="WordPress" href="http://wordpress.org/">WordPress</a></p>
	<p><a title="Privacy Policy" href="http://johnlevandowski.com/privacy-policy/">Privacy Policy</a> &middot; 
	<a title="Disclaimer" href="http://johnlevandowski.com/disclaimer/">Disclaimer</a> &middot; 
	<a title="FTC Disclosure" href="http://johnlevandowski.com/ftc-disclosure/">FTC Disclosure</a> &middot; 
	<a title="Image Attribution" href="http://johnlevandowski.com/image-attribution/">Image Attribution</a></p>
    <?php
}
*/

// Customize footer genesis/lib/structure/footer.php - use menu for disclaimer et al
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'johnlevy_do_footer' );
function johnlevy_do_footer() {
    ?><p>&copy; Copyright 2010-<?php echo date( 'Y' ); ?> <a title="johnlevandowski.com" href="http://johnlevandowski.com/">johnlevandowski.com</a></p><?php
}
