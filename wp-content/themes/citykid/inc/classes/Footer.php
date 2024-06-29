<?php
namespace Citykid;

final class Footer{

    public function __construct() {
        add_action( 'customize_register', array( $this, 'register' ) );
        // add_action('wp_enqueue_scripts', [$this, 'dynamic_css']);
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

        

		// Add "display_footer_top" setting for displaying the footer top section.
		$wp_customize->add_setting(
			'display_footer_top',
			array(
				'capability'        => 'edit_theme_options',
				'default'           => true,
				'sanitize_callback' => array( __NAMESPACE__.'\\Customize', 'sanitize_checkbox' ),
			)
		);

		// Add control for the "display_footer_top" setting.
		$wp_customize->add_control(
			'display_footer_top',
			array(
				'type'    => 'checkbox',
				'section'  => 'footer_settings',
				'label'   => esc_html__( 'Display Footer top section', 'citykid' ),
			)
		);

        // Add "display_back_to_top" setting for displaying the back to top.
		$wp_customize->add_setting(
			'footer_social_nav_title',
			array(
				'capability'        => 'edit_theme_options',
				'default'           => esc_attr__('Follow Us On:', 'citykid'),
				'sanitize_callback' => static function($value){
                    return esc_attr($value);
                },
			)
		);

        $wp_customize->add_control(
			'footer_social_nav_title',
			array(
				'type'    => 'text',
				'section'  => 'footer_settings',
				'label'   => esc_html__( 'Social nav title', 'citykid' ),
                'active_callback' => static function(){
                    return get_theme_mod('display_footer_top', true) && has_nav_menu('footer_social')? true : false;
                }
			)
		);

		$wp_customize->add_setting(
			'display_back_to_top',
			array(
				'sanitize_callback' => array( __NAMESPACE__.'\\Customize', 'sanitize_checkbox' )
			)

		);

		$wp_customize->add_control(
			'display_back_to_top',
			array(
				'type'    => 'checkbox',
				'section'  => 'footer_settings',
				'label'   => esc_html__( 'Display Back to top', 'citykid' ),
			)
		);


		// footer_logo
		$wp_customize->add_setting(
			'footer_logo',
			array(
				'sanitize_callback' => array( __NAMESPACE__.'\\Customize', 'sanitize_attachment' )
			)

		);

		$wp_customize->add_control( new \WP_Customize_Media_Control(
			$wp_customize, 'footer_logo', 
			array( // setting id
				'label'    => esc_attr__( 'Footer logo', 'citykid' ),
				'frame_title' => esc_attr__( 'Select white logo', 'citykid' ),
				'mime_type' => 'image',
				'section'  => 'footer_settings',
				'active_callback' => static function() {
					return get_theme_mod('display_footer_top');
				}
			)
		) );

        // footer_bg_color
		$wp_customize->add_setting(
			'footer_bg_color',
            array(
				'capability'        => 'edit_theme_options',
				'default'           => 'bg-secondary',				
				'sanitize_callback' => static function( $value ) {
					return esc_attr($value);
				}
			)			
		);

		$wp_customize->add_control( 
            'footer_bg_color', 
            array(
                'type'          => 'select',
                'section'       => 'footer_settings',
                'label'   	=> esc_html__( 'Footer background color', 'citykid' ),
				'choices' 	=> array(
					'bg-primary' => 'Primary',
                    'bg-secondary' => 'Secondary',
                    'bg-danger' => 'Danger',
                    'bg-warning' => 'Warning',
                    'bg-info' => 'Info',
                    'bg-light' => 'Light',
                    'bg-dark' => 'Dark',
                    'bg-white' => 'White',
                    'bg-body' => 'Body',
				),
            ) 
        );

        // Footer background
		$wp_customize->add_setting(
			'footer_image',
			array(
				'sanitize_callback' => array( __NAMESPACE__.'\\Customize', 'sanitize_attachment' )
			)
			
		);

		$wp_customize->add_control( new \WP_Customize_Media_Control(
			$wp_customize, 'footer_image', 
			array( // setting id
				'label'         => esc_attr__( 'Footer background image', 'citykid' ),
				'description'   => esc_attr__( 'Every page have own footer settings.', 'citykid' ),
				'frame_title'   => esc_attr__( 'Select footer image', 'citykid' ),
				'mime_type'     => 'image',
                'flex_width'    => true, // Allow any width, making the specified value recommended. False by default.
                'flex_height'   => false, // Require the resulting image to be exactly as tall as the height attribute (default).
                'width'         => 1920,
                'height'        => 1080,
				'section'       => 'footer_settings',
			)
		) );

        // footer_image_position
		$wp_customize->add_setting(
			'footer_image_position',
            array(
				'capability'        => 'edit_theme_options',
				'default'           => 'center center',				
				'sanitize_callback' => static function( $value ) {
					return esc_attr($value);
				},
			)
            
			
		);
		$wp_customize->add_control( 
            'footer_image_position', 
            array(
                'type'          => 'select',
                'section'       => 'footer_settings',
                'label'   	=> esc_html__( 'Footer image position', 'citykid' ),
				'choices' 	=> array(
					'left top' 		=> esc_html__( 'Top Left', 'citykid' ),
					'center top'   => esc_html__( 'Top', 'citykid' ),
					'right top'   => esc_html__( 'Top Right', 'citykid' ),
					'left center'   => esc_html__( 'Left', 'citykid' ),
					'center center'   => esc_html__( 'Center', 'citykid' ),
					'right center'   => esc_html__( 'Right', 'citykid' ),
					'left bottom'   => esc_html__( 'Bottom Left', 'citykid' ),
					'center bottom'   => esc_html__( 'Bottom', 'citykid' ),
					'right bottom'   => esc_html__( 'Bottom Right', 'citykid' ),
				),
                'active_callback' => static function() {
					return get_theme_mod('footer_image', false)? true : false;
				}
            ) 
        );

        // footer_image_opacity
		$wp_customize->add_setting(
			'footer_image_opacity',
			array(
				'capability'        => 'edit_theme_options',
				'default'           => 100,				
				'sanitize_callback' => static function( $value ) {
					return intval($value);
				},
				
			)
		);

		$wp_customize->add_control( 
            'footer_image_opacity', 
            array(
                'type'          => 'range',
                'section'       => 'footer_settings',
                'label'         => esc_attr__( 'Footer image opacity', 'citykid' ),
                'input_attrs'   => array(
                    'min'   => 0,
                    'max'   => 100,
                    'step'  => 1,
                ),
                'active_callback' => static function() {
					return get_theme_mod('footer_image', false)? true : false;
				}
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

        // copyright_bg_color
		$wp_customize->add_setting(
			'copyright_bg_color',
            array(
				'capability'        => 'edit_theme_options',
				'default'           => 'bg-dark',				
				'sanitize_callback' => static function( $value ) {
					return esc_attr($value);
				}
			)			
		);

		$wp_customize->add_control( 
            'copyright_bg_color', 
            array(
                'type'          => 'select',
                'section'       => 'footer_settings',
                'label'   	=> esc_html__( 'Copyright background color', 'citykid' ),
				'choices' 	=> array(
					'bg-tra' => 'Transparent',
					'bg-primary' => 'Primary',
                    'bg-secondary' => 'Secondary',
                    'bg-danger' => 'Danger',
                    'bg-warning' => 'Warning',
                    'bg-info' => 'Info',
                    'bg-light' => 'Light',
                    'bg-dark' => 'Dark',
                    'bg-white' => 'White',
                    'bg-body' => 'Body',
				),
            ) 
        );

	}


    
}