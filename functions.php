<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'eleven40', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'eleven40' ) );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', __( 'eleven40 Pro Theme', 'eleven40' ) );
define( 'CHILD_THEME_URL', 'http://my.studiopress.com/themes/eleven40/' );
define( 'CHILD_THEME_VERSION', '2.1' );

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'eleven40_enqueue_scripts_styles' );
function eleven40_enqueue_scripts_styles() {

	wp_enqueue_script( 'eleven40-responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0' );

	wp_enqueue_style( 'dashicons' );
	//wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lora:400,700|Oswald:400', array(), PARENT_THEME_VERSION);
    wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Arvo:400,700|Droid+Sans:400,700', array(), PARENT_THEME_VERSION);

}
//fonts.googleapis.com/css?family=Ovo|Muli

//* Add new featured image size
add_image_size( 'grid-featured', 270, 100, TRUE );

//* Add support for custom header
/*
add_theme_support( 'custom-header', array(
	'width'           => 320,
	'height'          => 65,
	'header-selector' => '.site-header .title-area',
	'header-text'     => false
) );
*/

//* Add support for structural wraps
add_theme_support( 'genesis-structural-wraps', array(
	'header',
	'nav',
	'subnav',
	'site-inner',
	'footer-widgets',
	'footer'
) );

//* Hook after post widget after the entry content
add_action( 'genesis_after_entry', 'eleven40_after_entry', 5 );
function eleven40_after_entry() {

	if ( is_singular( 'post' ) )
		genesis_widget_area( 'after-entry', array(
			'before' => '<div class="after-entry widget-area">',
			'after'  => '</div>',
	) );

}

//* Add support for additional color styles
add_theme_support( 'genesis-style-selector', array(
	'eleven40-pro-blue'  => __( 'eleven40 Pro Blue', 'eleven40' ),
	'eleven40-pro-green' => __( 'eleven40 Pro Green', 'eleven40' ),
	'eleven40-pro-red'   => __( 'eleven40 Pro Red', 'eleven40' )
) );


// BRANDING HEADER AREA

function tis_test()
{
echo ('<test>');
}
//add_action( 'genesis_after_header', 'tis_test',2 );

function tis_header_branding_left()
{
echo ('<div class="head-branding"><div class="wrap"><div class="head-branding-left one-half first"><div class="head-branding-logo"></div>');
}
add_action( 'genesis_after_header', 'tis_header_branding_left',2 );

//* Reposition the site title (logo)
remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
add_action( 'genesis_after_header', 'genesis_seo_site_title' ,4);

function tis_header_branding_right()
{
echo ('</div><div class="head-branding-right one-half"><div class="head-contact-info"><p>01484 640 471<br>info@theinsuranceshop.co.uk</p></div>');  
}
add_action( 'genesis_after_header', 'tis_header_branding_right',6 );

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_after_header', 'genesis_do_subnav', 12 );

function tis_header_branding_wrap_end()
{
echo ('</div></div></div>');
}
add_action( 'genesis_after_header', 'tis_header_branding_wrap_end',20 );

//* Reposition the site description
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );
add_action( 'genesis_header', 'genesis_seo_site_description',8 );


//* Unregister the header right widget area
unregister_sidebar( 'header-right' );

//* Remove breadcrumb and navigation meta boxes
add_action( 'genesis_theme_settings_metaboxes', 'eleven40_remove_genesis_metaboxes' );
function eleven40_remove_genesis_metaboxes( $_genesis_theme_settings_pagehook ) {
    remove_meta_box( 'genesis-theme-settings-nav', $_genesis_theme_settings_pagehook, 'main' );
}

//* Reposition the primary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

//* Remove output of primary navigation right extras
remove_filter( 'genesis_nav_items', 'genesis_nav_right', 10, 2 );
remove_filter( 'wp_nav_menu_items', 'genesis_nav_right', 10, 2 );

//* Reduce the secondary navigation menu to one level depth
add_filter( 'wp_nav_menu_args', 'eleven40_secondary_menu_args' );
function eleven40_secondary_menu_args( $args ){

	if( 'secondary' != $args['theme_location'] )
	return $args;

	$args['depth'] = 1;
	return $args;

}

//* Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'eleven40_remove_comment_form_allowed_tags' );
function eleven40_remove_comment_form_allowed_tags( $defaults ) {
	
	$defaults['comment_notes_after'] = '';
	return $defaults;

}

//* Modify the size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'eleven40_author_box_gravatar' );
function eleven40_author_box_gravatar( $size ) {

	return 128;

}

//* Modify the size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', 'eleven40_comments_gravatar' );
function eleven40_comments_gravatar( $args ) {

	$args['avatar_size'] = 96;

	return $args;

}

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'after-entry',
	'name'        => __( 'After Entry', 'eleven40' ),
	'description' => __( 'This is the after entry widget area.', 'eleven40' ),
) );


add_filter( 'genesis_footer_creds_text', 'sp_footer_creds_text' );
function sp_footer_creds_text() {
	echo '<div class="creds"><p>';
	echo 'Copyright &copy; ';
	echo date('Y');
	echo ' &middot; The Insurance Shop 2014';
	echo '</p></div>';
}

//* Redirect non-admins to the homepage after logging into the site.

function tis_login_redirect( $redirect_to, $request, $user  ) {
	return ( is_array( $user->roles ) && in_array( 'administrator', $user->roles ) ) ? admin_url() : site_url();
} 
add_filter( 'login_redirect', 'tis_login_redirect', 10, 3 );