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

		$wp_customize->add_setting(
			'custom_logo_white',
			array(
				'sanitize_callback' => array( __NAMESPACE__.'\\Customize', 'sanitize_attachment' )
			)
			
		);

		$wp_customize->add_control( new \WP_Customize_Media_Control(
			$wp_customize, 'custom_logo_white', 
			array( // setting id
				'label'         => esc_attr__( 'Logo white', 'citykid' ),
				'frame_title'   => esc_attr__( 'Select white logo', 'citykid' ),
				'description'   => esc_attr__( 'Display on dark type(transparent) background', 'citykid' ),
				'mime_type'     => 'image',
				'section'       => 'title_tagline',
				'priority'      => 9,
			)
		) );

        // logo_width
		$wp_customize->add_setting(
			'logo_width',
			array(
				'capability'        => 'edit_theme_options',
				'default'           => 126,				
				'sanitize_callback' => static function( $value ) {
					return intval($value);
				},
			)
		);

		$wp_customize->add_control( 
            'logo_width', 
            array(
                'type'          => 'range',
                'section'       => 'title_tagline',
                'label'         => esc_attr__( 'Logo width', 'citykid' ),
                'input_attrs'   => array(
                    'min'   => 0,
                    'max'   => 400,
                    'step'  => 1,
                    'suffix'=> 'px'
                ),
                'priority'      => 9,
          ) 
        );

		// Add "display_tagline" setting for displaying the tagline.
		$wp_customize->add_setting(
			'display_title_and_tagline',
			array(
				'capability'        => 'edit_theme_options',
				'default'           => true,
				'sanitize_callback' => array( __NAMESPACE__.'\\Customize', 'sanitize_checkbox' ),
			)
		);

		// Add control for the "display_title_and_tagline" setting.
		$wp_customize->add_control(
			'display_title_and_tagline',
			array(
				'type'      => 'checkbox',
				'section'   => 'title_tagline',
				'label'     => esc_html__( 'Display Site Tagline', 'citykid' ),
			)
		);

        $this->settings($wp_customize);
		
	}

    private function settings($wp_customize){    

		$wp_customize->get_section('header_image')->title = __( 'Header Settings', 'citykid' );
       
		// custom nav button
		$wp_customize->add_setting(
			'custom_nav_button',
            array(
				'capability'        => 'edit_theme_options',
				'default'           => true,				
				'sanitize_callback' => array( __NAMESPACE__.'\\Customize', 'sanitize_checkbox' ),
			)			
		);

		$wp_customize->add_control( 
            'custom_nav_button', 
            array(
                'type'    => 'checkbox',
                'section'       => 'header_image',
                'label'   	    => esc_html__( 'Enable custom nav button?', 'citykid' ),
            ) 
        );

		// custom nav button text
		$wp_customize->add_setting(
			'nav_button_text',
			array(
				'capability'        => 'edit_theme_options',
				'default'           => esc_attr__('Subscribe', 'citykid'),				
				'sanitize_callback' => static function( $value ) {
					return esc_attr($value);
				}
			)
		);

		$wp_customize->add_control(
			'nav_button_text',
			array(
				'type'    			=> 'text',
				'section' 			=> 'header_image',
				'label'   			=> esc_html__( 'Button text', 'citykid' ),
				'active_callback' => static function() {
					return get_theme_mod('custom_nav_button')? true : false;
				}		
			)
		);
		// custom nav button text
		$wp_customize->add_setting(
			'nav_button_link',
			array(
				'capability'        => 'edit_theme_options',
				'default'           => '#',				
				'sanitize_callback' => static function( $value ) {
					return esc_attr($value);
				}
			)
		);

		$wp_customize->add_control(
			'nav_button_link',
			array(
				'type'    			=> 'text',
				'section' 			=> 'header_image',
				'label'   			=> esc_html__( 'Button link', 'citykid' ),
				'active_callback' => static function() {
					return get_theme_mod('custom_nav_button')? true : false;
				}		
			)
		);
		

		

		// navbar_style
		$wp_customize->add_setting(
			'navbar_style',
            array(
				'capability'        => 'edit_theme_options',
				'default'           => 'navbar-dark',				
				'sanitize_callback' => static function( $value ) {
					return esc_attr($value);
				}
			)			
		);

		$wp_customize->add_control( 
            'navbar_style', 
            array(
                'type'          => 'radio',
                'section'       => 'header_image',
                'label'   	    => esc_html__( 'Navbar style', 'citykid' ),
				'choices' 	=> array(
					'navbar-light' => 'Light style',
                    'navbar-dark' => 'Dark style'                    
				),
				'active_callback' => static function() {
					return (get_theme_mod('header_bg_color') == 'bg-tra')? true : false;
				}
            ) 
        );
        
		// Add "sticky_navbar" setting to Enable sticky navbar.
		$wp_customize->add_setting(
			'sticky_navbar',
			array(
				'capability'        => 'edit_theme_options',
				'default'           => true,
				'sanitize_callback' => array( __NAMESPACE__.'\\Customize', 'sanitize_checkbox' ),
			)
		);

		// Add control for the "sticky_navbar" setting.
		$wp_customize->add_control(
			'sticky_navbar',
			array(
				'type'    => 'checkbox',
				'section'  => 'header_image',
				'label'   => esc_html__( 'Enable sticky navbar', 'citykid' ),
			)
		);
    
		
		
        return $wp_customize;
    }


}