<?php
include __DIR__ . '/helper.php';
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
	}
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















