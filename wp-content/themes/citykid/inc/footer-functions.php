<?php
/*
control footer
*/


/**
 * Retrieves an array of the class names for the footer element.
 *
 * @global WP_Query $wp_query WordPress Query object.
 *
 * @param string|string[] $class Space-separated string or array of class names to add to the class list.
 * @return string[] Array of class names.
 */
function citykid_get_footer_class( $class = '' ) {
	$classes = array( 'footer-section', 'has-parallax'  );
	
    $footer_bg_color = get_theme_mod('footer_bg_color', 'bg-secondary');
	
    $classes[] = $footer_bg_color;
    $classes[] = in_array($footer_bg_color, ['bg-dark', 'bg-danger', 'bg-primary', 'bg-secondary'])? 'text-white' : '';		

	if ( ! empty( $class ) ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_merge( $classes, $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	/**
	 * Filters the list of CSS footer class names for the current post or page.
	 *
	 * @param string[] $classes An array of footer class names.
	 * @param string[] $class   An array of additional class names added to the footer.
	 */
	$classes = apply_filters( 'citykid_footer_class', $classes, $class );

	return array_unique( $classes );
}


/**
 * Displays the class names for the footer element.
 *
 * @param string|string[] $class Space-separated string or array of class names to add to the class list.
 */
function citykid_footer_class( $class = '' ) {
	// Separates class names with a single space, collates class names for footer element.
	echo 'class="' . esc_attr( implode( ' ', citykid_get_footer_class( $class ) ) ) . '"';
}

/**
 * Retrieves an array of the class names for the copyright element.
 *
 * @global WP_Query $wp_query WordPress Query object.
 *
 * @param string|string[] $class Space-separated string or array of class names to add to the class list.
 * @return string[] Array of class names.
 */
function citykid_get_copyright_class( $class = '' ) {
	$classes = array( 'copyright-section', 'small'  );
	
    $copyright_bg_color = get_theme_mod('copyright_bg_color', 'bg-dark');
	
    $classes[] = $copyright_bg_color;
    $classes[] = in_array($copyright_bg_color, ['bg-dark', 'bg-danger', 'bg-primary', 'bg-secondary'])? 'text-white' : '';	
	$classes[] = ($copyright_bg_color == 'bg-tra' && in_array('text-white', citykid_get_footer_class()))? 'text-white' : '';	 

	if ( ! empty( $class ) ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_merge( $classes, $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	/**
	 * Filters the list of CSS copyright class names for the current post or page.
	 *
	 * @param string[] $classes An array of copyright class names.
	 * @param string[] $class   An array of additional class names added to the copyright.
	 */
	$classes = apply_filters( 'citykid_copyright_class', $classes, $class );

	return array_unique( $classes );
}


/**
 * Displays the class names for the copyright element.
 *
 * @param string|string[] $class Space-separated string or array of class names to add to the class list.
 */
function citykid_copyright_class( $class = '' ) {
	// Separates class names with a single space, collates class names for copyright element.
	echo 'class="' . esc_attr( implode( ' ', citykid_get_copyright_class( $class ) ) ) . '"';
}