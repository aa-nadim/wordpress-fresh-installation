<?php
namespace Citykid;

final class Footer{

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

		/**
		 * Add footer settings to customizer
		 */
		$wp_customize->add_section(
			'footer_settings',
			array(
				'title'    => esc_html__( 'Footer Settings', 'citykid' ),
				'priority' => 150,
			)
		);     

		$wp_customize->add_setting(
			'copyright_text',
			array(
				'capability'        => 'edit_theme_options',
				'default'           => 'Copyright '. date('Y').' Citykid. All right reserved',
				'sanitize_callback' => static function( $value ) {
					$value = str_replace('[date]', date('Y'), $value);
					return wp_kses_post($value);
				},
			)
		);

		$wp_customize->add_control(
			'copyright_text',
			array(
				'type'    => 'textarea',
				'section' => 'footer_settings',
				'label'   => esc_html__( 'Copyright text', 'citykid' ),		
				'description' => 	esc_html__( 'Use [date] for current year', 'citykid' ),		
			)
		);

       

	}


    
}