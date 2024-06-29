<?php
include __DIR__ . '/helper.php';
include __DIR__ . '/plugins.php';
include __DIR__ . '/header-functions.php';
include __DIR__ . '/footer-functions.php';

add_action('wp_enqueue_scripts', 'citykid_enqueue_assets');
if (!function_exists('citykid_enqueue_assets')) {
	function citykid_enqueue_assets()
	{

		wp_register_style('swiper-bundle', get_theme_file_uri('assets/swiper/swiper-bundle.min.css'), false, '8.4.5');
		wp_register_script('swiper-bundle', get_theme_file_uri('assets/swiper/swiper-bundle.min.js'), false, '8.4.5', true);



		$suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style('magnific-popup', get_theme_file_uri('assets/css/magnific-popup.css'), [], '1.0.0');
		wp_enqueue_style('citykid-icons', get_theme_file_uri('assets/css/citykid-icons.css'), [], '1.0.0');
		wp_enqueue_style('citykid', get_theme_file_uri('assets/css/citykid' . $suffix . '.css'), [], '1.0.0');

		wp_enqueue_style('citykid-listings', get_theme_file_uri('assets/css/control-listing.css'), ['contorl-listings-style'], '1.0.0');

		// wp_enqueue_style('leaflet-routing-machine', get_theme_file_uri('assets/css/leaflet-routing-machine.css'), [], '');
		// wp_enqueue_style('leaflet', get_theme_file_uri('assets/css/leaflet.css'), [], '');
		// wp_enqueue_style('animate', get_theme_file_uri('assets/css/animate.css'), [], '');
		// wp_enqueue_style('style', get_theme_file_uri('assets/css/style.css'), [], '');


		wp_enqueue_style('citykid-style', get_stylesheet_uri());


		// Javascripts
		wp_enqueue_script('bootstrap-bundle', get_theme_file_uri('assets/bootstrap/dist/js/bootstrap.bundle.min.js'), [], '5.0.3', true);
		wp_enqueue_script('magnific-popup', get_theme_file_uri('assets/js/jquery.magnific-popup.min.js'), ['jquery'], '5.0.3', true);
		wp_enqueue_script('citykid-main', get_theme_file_uri('assets/js/main.js'), ['jquery', 'jquery-masonry', 'swiper-bundle'], '5.0.0', true);
		wp_enqueue_script('citykid-menu', get_theme_file_uri('assets/js/menu.js'), ['jquery'], '5.0.0', true);

		// wp_enqueue_script('jquery-ajaxchimp-min', get_theme_file_uri('assets/js/jquery.ajaxchimp.min.js'), [], '', true);
		// wp_enqueue_script('jquery-magnific-popup-min', get_theme_file_uri('assets/js/jquery.magnific-popup.min.js'), [], '', true);
		// wp_enqueue_script('jquery-progressScroll-min', get_theme_file_uri('assets/js/jquery.progressScroll.min.js'), [], '', true);
		// wp_enqueue_script('animate', get_theme_file_uri('assets/js/animate.js'), [], '6.5.3', true);
		// wp_enqueue_script('bootstrap', get_theme_file_uri('assets/js/bootstrap.bundle.min.js'), ['jquery'], '6.5.3', true);
		// wp_enqueue_script('countdown', get_theme_file_uri('assets/js/countdown.js'), [], '6.5.3', true);
		// wp_enqueue_script('isotope', get_theme_file_uri('assets/js/isotope.js'), [], '', true);
		// wp_enqueue_script('magnific-popup', get_theme_file_uri('assets/js/jquery.magnific-popup.min.js'), ['jquery'], '6.5.3', true);
		// wp_enqueue_script('wow', get_theme_file_uri('assets/js/wow.min.js'), [], '', true);
		// wp_enqueue_script('leaflet', get_theme_file_uri('assets/js/leaflet.js'), [], '6.5.3', true);
		// wp_enqueue_script('leaflet-routing-machine', get_theme_file_uri('assets/js/leaflet-routing-machine.min.js'), ['leaflet'], '6.5.3', true);
		// wp_enqueue_script('leaflet-scripts', get_theme_file_uri('assets/js/leaflet-scripts.js'), ['leaflet', 'leaflet-routing-machine'], '6.5.3', true);
		// wp_enqueue_script('lazy-image', get_theme_file_uri('assets/js/lazy.image.js'), [], '', true);
		// wp_enqueue_script('politixy-script', get_theme_file_uri('assets/js/script.js'), [], '1.0', true);


		$l10n = [
			'stikyNavbar' => get_theme_mod('sticky_navbar', true),
			'backtoTop' => (bool)get_theme_mod('display_back_to_top', true),
		];
		wp_localize_script('jquery', 'CITYKID', $l10n);
	}
}


/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package 	Citykid
 */

/**
 * Header logo
 *
 * @return string
 */
function citykid_header_logo($echo = true)
{

	$blog_info    = get_bloginfo('name');

	$html = '<img class="logo" src="' . get_template_directory_uri() . '/assets/images/logo/logo.png" alt="' . esc_attr($blog_info) . '">
	<img class="logo-white" src="' . get_template_directory_uri() . '/assets/images/logo/logo-white.png" alt="' . esc_attr($blog_info) . '">';

	if (!is_page() && !get_theme_mod('enable_custom_logo', false) && has_custom_logo()) {
		$html = get_custom_logo();
	} else if (is_page() && get_post_meta(get_the_ID(), 'enable_custom_logo', true)) {
		$logo = get_post_meta(get_the_ID(), 'custom_header_logo', true);
		$logo = wp_get_attachment_url($logo);

		$logo_white = get_post_meta(get_the_ID(), 'custom_header_logo_white', true);
		$logo_white = wp_get_attachment_url($logo_white);

		$html = '<img class="logo" src="' . esc_url($logo) . '" alt="' . esc_attr($blog_info) . '">
		<img class="logo-white" src="' . esc_url($logo_white) . '" alt="' . esc_attr($blog_info) . '">';
	} else if (!is_page() && get_theme_mod('enable_custom_logo', false)) {
		$logo = get_theme_mod('custom_header_logo');
		$logo = wp_get_attachment_url($logo);

		$logo_white = get_theme_mod('custom_header_logo_white');
		$logo_white = wp_get_attachment_url($logo_white);

		$html = '<img class="logo" src="' . esc_url($logo) . '" alt="' . esc_attr($blog_info) . '">
		<img class="logo-white" src="' . esc_url($logo_white) . '" alt="' . esc_attr($blog_info) . '">';
	}

	if ($echo) {
		echo citykid_return_data($html);
	} else {
		return $html;
	}
}

function citykid_header_menu()
{
	$menu = '';

	if (is_page()) {
		if (get_post_meta(get_the_ID(), 'enable_custom_menu', true)) {
			$menu = get_post_meta(get_the_ID(), 'custom_header_menu', true);
		}
	} else {
		if (get_theme_mod('enable_custom_menu', false)) {
			$menu = get_theme_mod('custom_header_menu', '');
		}
	}

	return $menu;
}





/**
 * Remove the `no-js` class from body if JS is supported.
 *
 * @return void
 */
function citykid_supports_js()
{
	echo '<script>document.body.classList.remove("no-js");</script>';
}
add_action('wp_footer', 'citykid_supports_js');















/**
 * Filters the list of attachment image attributes.
 *
 * @param 	string[]     	$attr       	Array of attribute values for the image markup, keyed by attribute name.
 *                                 			See wp_get_attachment_image().
 * @param 	WP_Post      	$attachment 	Image attachment post.
 * @param 	string|int[] 	$size       	Requested image size. Can be any registered image size name, or
 *                                 			an array of width and height values in pixels (in that order).
 * @return 	string[] 		The filtered attributes for the image markup.
 */
function citykid_get_attachment_image_attributes($attr, $attachment, $size)
{

	if (is_admin()) {
		return $attr;
	}

	if (isset($attr['class']) && false !== strpos($attr['class'], 'custom-logo')) {
		return $attr;
	}

	$width  = false;
	$height = false;

	if (is_array($size)) {
		$width  = (int) $size[0];
		$height = (int) $size[1];
	} elseif ($attachment && is_object($attachment) && $attachment->ID) {
		$meta = wp_get_attachment_metadata($attachment->ID);
		if (isset($meta['width']) && isset($meta['height'])) {
			$width  = (int) $meta['width'];
			$height = (int) $meta['height'];
		}
	}

	if ($width && $height) {

		// Add style.
		$attr['style'] = isset($attr['style']) ? $attr['style'] : '';
		$attr['style'] = 'width:100%;height:' . round(100 * $height / $width, 2) . '%;max-width:' . $width . 'px;' . $attr['style'];
	}

	return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'citykid_get_attachment_image_attributes', 10, 3);

function citykid_get_navbar_buttons($parts = '')
{
	ob_start();
	get_template_part('template-parts/header/navbar-buttons', $parts);
	return ob_get_clean();
}

/**
 * Calculate classes for the main <html> element.
 *
 * @return void
 */
function citykid_the_html_classes()
{
	/**
	 * Filters the classes for the main <html> element.
	 *
	 * @param string The list of classes. Default empty string.
	 */
	$classes = apply_filters('citykid_html_classes', '');
	if (!$classes) {
		return;
	}
	echo 'class="' . esc_attr($classes) . '"';
}

/**
 * Add "is-IE" class to body if the user is on Internet Explorer.
 *
 * @return void
 */
function citykid_add_ie_class()
{
?>
	<script>
		if (-1 !== navigator.userAgent.indexOf('MSIE') || -1 !== navigator.appVersion.indexOf('Trident/')) {
			document.body.classList.add('is-IE');
		}
	</script>
<?php
}
add_action('wp_footer', 'citykid_add_ie_class');

if (!function_exists('wp_get_list_item_separator')) :
	/**
	 * Retrieves the list item separator based on the locale.
	 *
	 * Added for backward compatibility to support pre-6.0.0 WordPress versions.
	 */
	function wp_get_list_item_separator()
	{
		/* translators: Used between list items, there is a space after the comma. */
		return __(', ', 'citykid');
	}
endif;

if (!function_exists('citykid_return_data')) {
	function citykid_return_data($data)
	{
		return $data;
	}
}


function citykid_get_sidebar()
{
	global $citykid;
	$sidebar = '';
	if (get_post_type() == 'post') {
		$sidebar = 'sidebar-1';
	}

	if (get_post_type() == 'ctrl_listings' && !is_singular()) {
		$sidebar = $citykid->meta['sidebar'];
	}

	if (is_page()) {
		$page_sidebar = get_post_meta(get_the_ID(), 'sidebar', true);
		if (!empty($page_sidebar)) {
			$sidebar = $page_sidebar;
		}
	}
	return apply_filters('citykid_sidebar',  $sidebar);
}













