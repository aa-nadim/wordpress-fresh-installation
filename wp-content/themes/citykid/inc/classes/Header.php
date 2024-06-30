<?php
namespace Citykid;

final class Header{
    public function __construct() {
        add_action( 'customize_register', array( $this, 'register' ) );
	}

    /**
	 * Register customizer options.
	 *
	 * @param 	WP_Customize_Manager 	$wp_customize Theme Customizer object.
	 * @return 	void
	 */
	public function register( $wp_customize ) {

		$wp_customize->add_section(
			'header_settings',
			array(
				'title'    => esc_html__( 'Header Settings', 'citykid' ),
				'priority' => 150,
			)
		); 
		
	}



}