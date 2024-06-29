<?php
define( 'CITYKID_VERSION', '1.0.4' ); 
define( 'CITYKID_URI', get_template_directory_uri() );
define( 'CITYKID_DIR', get_template_directory() );
define( 'CITYKID_ASSETS', CITYKID_URI.'/assets' );
define( 'CITYKID_ADMIN_ASSETS', CITYKID_URI.'/assets/admin' );

include __DIR__ .'/vendor/autoload.php';

new Citykid\Loader();


if ( ! function_exists( 'citykid_after_setup_theme' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since citykid 1.0.0
	 *
	 * @return void
	 */
	function citykid_after_setup_theme() {

		load_theme_textdomain( 'citykid', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * This theme does not use a hard-coded <title> tag in the document head,
		 * WordPress will provide it for us.
		 */
		add_theme_support( 'title-tag' );		

		/**
		 * Add post-formats support.
		 */
		add_theme_support(
			'post-formats',
			array(
				'link',
				'aside',
				'gallery',
				'image',
				'quote',
				'status',
				'video',
				'audio',
				'chat',
			)
		);

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1400, 9999 );
		add_image_size( 'citykid-360x234-cropped', 360, 234, true );
		add_image_size( 'citykid-390x300-cropped', 390, 300, true );
		add_image_size( 'citykid-400x400-cropped', 400, 400, true );
		add_image_size( 'citykid-450x350-cropped', 450, 350, true );
		add_image_size( 'citykid-750x320-cropped', 750, 320, true );

		register_nav_menus(
			array(
				'topbar' => esc_html__( 'Topbar menu', 'citykid' ),
				'social' => esc_html__( 'Topbar social menu', 'citykid' ),
				'primary' => esc_html__( 'Primary menu', 'citykid' ),
				'footer_social'  => esc_html__( 'Footer social menu', 'citykid' ),
				'footer'  => esc_html__( 'Footer menu', 'citykid' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);

		/*
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		$logo_width  = 139;
		$logo_height = 36;

		add_theme_support(
			'custom-logo',
			array(
				'height'               => $logo_height,
				'width'                => $logo_width,
				'flex-width'           => true,
				'flex-height'          => true,
				'unlink-homepage-logo' => true,
			)
		);


		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for Align Wide.
		add_theme_support( "align-wide" );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add support for custom line height controls.
		add_theme_support( 'custom-line-height' );

		// Add support for experimental link color control.
		add_theme_support( 'experimental-link-color' );

		// Add support for experimental cover block spacing.
		add_theme_support( 'custom-spacing' );

		// Add support for custom units.
		// This was removed in WordPress 5.6 but is still required to properly support WP 5.5.
		add_theme_support( 'custom-units' );

		// Custom plugin support
		add_theme_support( 'woocommerce' );
		add_theme_support( 'control-block-patterns' );

		// Remove feed icon link from legacy RSS widget.
		add_filter( 'rss_widget_feed_link', '__return_false' );

		add_action( 'comment_form_before', 'citykid_enqueue_comments_reply' );

		if ( ! isset( $content_width ) ) $content_width = 1040;

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );
		$editor_stylesheet_path = './assets/css/editor-style.css';



		
		add_theme_support(
			'custom-background',
			array(
				'default-color' => 'f7f7f7',
				'default-image' => '',
			)
		);

		$args = array(
			'flex-width'    => true,
			'flex-height'   => true,
			'default-image' => '',
		);
		add_theme_support( 'custom-header', $args );

		
		
	}
}
add_action( 'after_setup_theme', 'citykid_after_setup_theme' );





function citykid_enqueue_comments_reply() {
	if( get_option( 'thread_comments' ) )  {
		wp_enqueue_script( 'comment-reply' );
	}
}

