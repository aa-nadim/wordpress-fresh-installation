<?php


/**
 * Register widget area.
 *
 * @since citykid 1.0
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @return void
 */
function citykid_widgets_init() {

	register_sidebar(
		array(
			'name'          => esc_html__( 'Main widget area', 'citykid' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'citykid' ),
			'before_widget' => '<div id="%1$s" class="card card-widget %2$s"><div class="card-body widget">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);

    register_sidebar(
		array(
			'name'          => esc_html__( 'Page widget area', 'citykid' ),
			'id'            => 'sidebar-page',
			'description'   => esc_html__( 'Add widgets here to appear in your page sidebar.', 'citykid' ),
			'before_widget' => '<div id="%1$s" class="card card-widget %2$s"><div class="card-body widget">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);
}
add_action( 'widgets_init', 'citykid_widgets_init' );



