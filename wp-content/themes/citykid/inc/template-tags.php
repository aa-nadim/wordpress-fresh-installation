<?php


/**
 * Custom template tags for this theme
 *
 * @package 	WordPress
 * @subpackage 	Citykid
 */


if ( ! function_exists( 'citykid_posted_by' ) ) {
	/**
	 * Prints HTML with meta information about theme author.
	 *
	 * @return void
	 */
	function citykid_posted_by($class='') {
		$displayed = (is_single() && get_the_author_meta( 'description' ))? false : true;
		if ( $displayed && post_type_supports( get_post_type(), 'author' ) ) {
			echo '<span class="byline '.esc_attr($class).'">';
			printf(
				/* translators: %s: Author name. */
				esc_html__( 'By %s', 'citykid' ),
				'<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" rel="author">' . esc_html( get_the_author() ) . '</a>'
			);
			echo '</span>';
		}
	}
}

if ( ! function_exists( 'citykid_entry_meta_header' ) ) {
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 * Footer entry meta is displayed differently in archives and single posts.
	 *
	 * @return void
	 */
	function citykid_entry_meta_header() {

		// Early exit if not a post.
		if ( 'post' !== get_post_type() ) {
			return;
		}
		
		echo '<div class="entry-meta-header default-max-width d-flex flex-wrap gap-1 mb-10">';
		
		if ( is_sticky() ) {
			$sticky_text = get_theme_mod('sticky_text', 'Featured post');
			echo '<span class="badge bg-dark bg-opacity-10 text-dark">' . esc_html( $sticky_text) . '</span>';
		}
		

		if ( has_category() || has_tag() ) {

			
			$categories_list = '<span class="post-categories">'.get_the_category_list( '' ).'</span>';
			if ( $categories_list ) {
				printf($categories_list);
			}
			
			
		}

		echo '</div>';
		
	}
}






if ( ! function_exists( 'citykid_the_posts_navigation' ) ) {
	/**
	 * Print the next and previous posts navigation.
	 *
	 * @return void
	 */
	function citykid_the_posts_navigation() {
		the_posts_pagination(
			array(
				'before_page_number' => '',
				'mid_size'           => 2,
				'prev_text'          => sprintf(
					'<span class="nav-prev-text">previous</span>',
					wp_kses(
						get_theme_mod('pagination_prev_text', 'Older posts'),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					)
				),
				'next_text'          => sprintf(
					'<span class="nav-next-text">next</span>',
					wp_kses(
						get_theme_mod('pagination_next_text', 'Newer posts'),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					)
				),
			)
		);
	}
}

add_filter('navigation_markup_template', function($template){
	$template = '
	<nav class="navigation %1$s" aria-label="%4$s">
		<h2 class="screen-reader-text">%2$s</h2>
		<div class="nav-links numeric-pagination d-lg-flex gap-10 justify-content-lg-between">%3$s</div>
	</nav>';
	return $template;
});

function citykid_my_account_links(){
	if(!function_exists('control_listings_user_dashboard_url')) return;
	
	
	if(!is_user_logged_in()){
		$link_options = [
			[
				'text' => esc_attr__('Sign up', 'citykid'),
				'url' => '#citikidRegisterModal',
				'class' => '',
				'attributes' => ['data-bs-toggle="modal"'] 
			],
			[
				'text' => esc_attr__('Login', 'citykid'),
				'url' => '#citikidLoginModal',
				'class' => 'text-primary',
				'attributes' => ['data-bs-toggle="modal"']
			],
		];
	}else{
		$link_options = [
			[
				'text' => esc_attr__('My Account', 'citykid'),
				'url' => '',
				'class' => ''
			],
			[
				'text' => esc_attr__('Log Out', 'citykid'),
				'url' => wp_logout_url(get_permalink()),
				'class' => ''
			]
		];
	}
	$args = [
		'options' => $link_options,
	];
	return citykid_formatting_list_html($args);
	
}

