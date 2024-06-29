<?php
/*
control header
*/

function citykid_get_custom_logo( $customizer_id = 'custom_logo', $blog_id = 0 ) {
	$html          = '';
	$switched_blog = false;

	if ( is_multisite() && ! empty( $blog_id ) && get_current_blog_id() !== (int) $blog_id ) {
		switch_to_blog( $blog_id );
		$switched_blog = true;
	}

	$has_custom_logo = citykid_get_logo_uri($customizer_id);
	
	if($has_custom_logo){
		$html = sprintf(
			'<img src="%s" alt="%s" width="%s" />',
			citykid_get_logo_uri($customizer_id),
			esc_attr(get_bloginfo( 'name', 'display' )),
			intval(get_theme_mod('logo_width', 126))
		);
	}else{
		$html = sprintf('<span class="text-logo lh-1 fs-1 fw-bold">%s</span>', esc_attr(get_bloginfo( 'name', 'display' )));
	}
	
	

	if ( $switched_blog ) {
		restore_current_blog();
	}

	/**
	 * Filters the custom logo output.
	 *
	 * @param string $html    Custom logo HTML output.
	 * @param int    $blog_id ID of the blog to get the custom logo for.
	 */
	return apply_filters( 'citykid_get_custom_logo', $html, $blog_id );
}

if(!function_exists('citykid_get_logo_uri')):
    function citykid_get_logo_uri($customizer_id = 'custom_logo'){
        $logo_uri = false;
        
        $attachment_id = get_theme_mod( $customizer_id );
        $custom_logo_uri = wp_get_attachment_image_url( $attachment_id , 'full' );

        if(!empty($custom_logo_uri) && !is_wp_error($custom_logo_uri)) {
            $logo_uri = $custom_logo_uri;
        }        
        
        return $logo_uri;
    }
endif;

if(!function_exists('citykid_theme_mod_image_uri')):
    function citykid_theme_mod_image_uri($customizer_id, $static_image = 'assets/images/logo.png', $size='full'){
       
        $image_uri = get_theme_file_uri( $static_image );
        
       
        $custom_image_id = get_theme_mod( $customizer_id );
        $image = wp_get_attachment_image_src( $custom_image_id ,  $size);

        if(empty($image[0]) || is_wp_error($image)) return $image_uri;
        
        $image_uri = $image[0];
        
        return $image_uri;
    }
endif;


function citykid_display_attributes_filter($attribs, $types){
    $extra_attribs = array('class' => array('breadcrumb-item'));

    //For the current item we need to add a little more info
    if(is_array($types) && in_array('current-item', $types)){
        $extra_attribs['class'][] = 'active';
        $extra_attribs['aria-current'] = array('page');
    }

    $atribs_array = array();
    preg_match_all('/([a-zA-Z]+)=["\']([a-zA-Z0-9\-\_ ]*)["\']/i', $attribs, $matches);
    if(isset($matches[1])){
        foreach ($matches[1] as $key => $tag){
            if(isset($matches[2][$key])){
                $atribs_array[$tag] = explode(' ', $matches[2][$key]);
            }
        }
    }

    $merged_attribs = array_merge_recursive($atribs_array , $extra_attribs);
    $output = '';
    foreach($merged_attribs as $tag => $vals){
        $output .= sprintf(' %1$s="%2$s"', $tag, implode(' ', $vals));
    }

    return $output;
}
add_filter('bcn_display_attributes', 'citykid_display_attributes_filter', 10, 2);

/**
 * Retrieves an array of the class names for the header element.
 *
 *
 * @global WP_Query $wp_query WordPress Query object.
 *
 * @param string|string[] $class Space-separated string or array of class names to add to the class list.
 * @return string[] Array of class names.
 */
function citykid_get_header_class( $class = '' ) {
	global $wp_query;
	$classes = array( 'header-section'  );
	
    $tra_header = false;
    $sticky_header = get_theme_mod('sticky_navbar', false);
	if ( is_singular() ) {
		$post_id   = $wp_query->get_queried_object_id();
		$post      = $wp_query->get_queried_object();
        
		if ( is_page() ) {
			$page_id = $wp_query->get_queried_object_id();
            $tra_header = get_post_meta($page_id, 'tra_header', true);
		}
	}

    $classes[] = $tra_header? 'bg-tra' : get_theme_mod('header_bg_color', 'bg-white');	
    $classes[] = $sticky_header? 'sticky-header-on' : 'sticky-header-off';		

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
	 * Filters the list of CSS body class names for the current post or page.
	 *
	 * @param string[] $classes An array of header class names.
	 * @param string[] $class   An array of additional class names added to the header.
	 */
	$classes = apply_filters( 'citykid_header_class', $classes, $class );

	return array_unique( $classes );
}


/**
 * Displays the class names for the header element.
 *
 * @param string|string[] $class Space-separated string or array of class names to add to the class list.
 */
function citykid_header_class( $class = '' ) {
	// Separates class names with a single space, collates class names for header element.
	echo 'class="' . esc_attr( implode( ' ', citykid_get_header_class( $class ) ) ) . '"';
}


/**
 * Retrieves an array of the class names for the navbar element.
 *
 * @global WP_Query $wp_query WordPress Query object.
 *
 * @param string|string[] $class Space-separated string or array of class names to add to the class list.
 * @return string[] Array of class names.
 */
function citykid_get_navbar_class( $class = '' ) {
	global $wp_query;
	$classes = array( 'navbar'  );
	
	$navbar_style = in_array(get_theme_mod('header_bg_color', 'bg-white'), ['bg-dark', 'bg-danger', 'bg-primary', 'bg-secondary'])? 'navbar-dark' : 'navbar-light';

    $classes[] = in_array('bg-tra', citykid_get_header_class())? get_theme_mod('navbar_style', 'navbar-dark') : $navbar_style;	


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
	 * Filters the list of CSS body class names for the current post or page.
	 *
	 * @param string[] $classes An array of navbar class names.
	 * @param string[] $class   An array of additional class names added to the navbar.
	 */
	$classes = apply_filters( 'citykid_navbar_class', $classes, $class );

	return array_unique( $classes );
}


/**
 * Displays the class names for the navbar element.
 *
 * @param string|string[] $class Space-separated string or array of class names to add to the class list.
 */
function citykid_navbar_class( $class = '' ) {
	// Separates class names with a single space, collates class names for navbar element.
	echo 'class="' . esc_attr( implode( ' ', citykid_get_navbar_class( $class ) ) ) . '"';
}





