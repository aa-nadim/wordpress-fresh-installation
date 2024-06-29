<?php
namespace Citykid;

final class Header{
    public function __construct() {
        add_action( 'customize_register', array( $this, 'register' ) );

        add_filter('get_the_archive_title', [$this, 'get_the_archive_title']);
        add_filter('get_the_archive_description', [$this, 'get_the_archive_description']);
        add_action('wp_enqueue_scripts', [$this, 'dynamic_css']);
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
        $this->add_partials($wp_customize);
		
	}

    private function settings($wp_customize){    

		$wp_customize->get_section('header_image')->title = __( 'Header Settings', 'citykid' );
        // topbar_bg_color
		$wp_customize->add_setting(
			'topbar_bg_color',
            array(
				'capability'        => 'edit_theme_options',
				'default'           => 'bg-secondary',				
				'sanitize_callback' => static function( $value ) {
					return esc_attr($value);
				}
			)			
		);

		$wp_customize->add_control( 
            'topbar_bg_color', 
            array(
                'type'          => 'select',
                'section'       => 'header_image',
                'label'   	=> esc_html__( 'Topbar background color', 'citykid' ),
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

        // header_bg_color
		$wp_customize->add_setting(
			'header_bg_color',
            array(
				'capability'        => 'edit_theme_options',
				'default'           => 'bg-white',				
				'sanitize_callback' => static function( $value ) {
					return esc_attr($value);
				}
			)			
		);

		$wp_customize->add_control( 
            'header_bg_color', 
            array(
                'type'          => 'select',
                'section'       => 'header_image',
                'label'   	    => esc_html__( 'Navbar background color', 'citykid' ),
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

		// header search icon
		$wp_customize->add_setting(
			'enable_header_search',
            array(
				'capability'        => 'edit_theme_options',
				'default'           => true,				
				'sanitize_callback' => array( __NAMESPACE__.'\\Customize', 'sanitize_checkbox' ),
			)			
		);

		$wp_customize->add_control( 
            'enable_header_search', 
            array(
                'type'    => 'checkbox',
                'section'       => 'header_image',
                'label'   	    => esc_html__( 'Display search icon?', 'citykid' ),
            ) 
        );

		$wp_customize->add_setting(
			'header_search_placeholder',
			array(
				'capability'        => 'edit_theme_options',
				'default'           => esc_attr__('Search and enter', 'citykid'),				
				'sanitize_callback' => static function( $value ) {
					return esc_attr($value);
				}
			)
		);
		// search placeholder
		$wp_customize->add_control(
			'header_search_placeholder',
			array(
				'type'    			=> 'text',
				'section' 			=> 'header_image',
				'label'   			=> esc_html__( 'Placeholder text', 'citykid' ),
				'active_callback' => static function() {
					return get_theme_mod('enable_header_search')? true : false;
				}		
			)
		);

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
		// banner_bg_color
		$wp_customize->add_setting(
			'nav_button_style',
            array(
				'capability'        => 'edit_theme_options',
				'default'           => 'btn-primary',				
				'sanitize_callback' => static function( $value ) {
					return esc_attr($value);
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


        // banner_bg_color
		$wp_customize->add_setting(
			'banner_bg_color',
            array(
				'capability'        => 'edit_theme_options',
				'default'           => 'bg-dark',				
				'sanitize_callback' => static function( $value ) {
					return esc_attr($value);
				}
			)			
		);

		$wp_customize->add_control( 
            'banner_bg_color', 
            array(
                'type'          => 'select',
                'section'       => 'header_image',
                'label'   	=> esc_html__( 'Banner background color', 'citykid' ),
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

        // Banner image
		$wp_customize->add_setting(
			'banner_image',
			array(
				'sanitize_callback' => array( __NAMESPACE__.'\\Customize', 'sanitize_attachment' )
			)
			
		);

		$wp_customize->add_control( new \WP_Customize_Media_Control(
			$wp_customize, 'banner_image', 
			array( // setting id
				'label'         => esc_attr__( 'Banner image', 'citykid' ),
				'description'   => esc_attr__( 'Every page have own banner settings.', 'citykid' ),
				'frame_title'   => esc_attr__( 'Select banner image', 'citykid' ),
				'mime_type'     => 'image',
                'flex_width'    => true, // Allow any width, making the specified value recommended. False by default.
                'flex_height'   => false, // Require the resulting image to be exactly as tall as the height attribute (default).
                'width'         => 1920,
                'height'        => 1080,
				'section'       => 'header_image',
			)
		) );

        // banner_image_position
		$wp_customize->add_setting(
			'banner_image_position',
            array(
				'capability'        => 'edit_theme_options',
				'default'           => 'center center',				
				'sanitize_callback' => static function( $value ) {
					return esc_attr($value);
				},
			)
            
			
		);
		$wp_customize->add_control( 
            'banner_image_position', 
            array(
                'type'          => 'select',
                'section'       => 'header_image',
                'label'   	=> esc_html__( 'Banner image position', 'citykid' ),
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
					return get_theme_mod('banner_image', false)? true : false;
				}
            ) 
        );

        // banner_image_opacity
		$wp_customize->add_setting(
			'banner_image_opacity',
			array(
				'capability'        => 'edit_theme_options',
				'default'           => 25,				
				'sanitize_callback' => static function( $value ) {
					return intval($value);
				},
				
			)
		);

		$wp_customize->add_control( 
            'banner_image_opacity', 
            array(
                'type'          => 'range',
                'section'       => 'header_image',
                'label'         => esc_attr__( 'Banner image opacity', 'citykid' ),
                'input_attrs'   => array(
                    'min'   => 0,
                    'max'   => 100,
                    'step'  => 1,
                ),
				'active_callback' => static function() {
					return get_theme_mod('banner_image', false)? true : false;
				}
          ) 
        );      
		
		
        return $wp_customize;
    }

    public function dynamic_css(){
        $styles = [];
        $attachment_id = get_theme_mod('banner_image');
        if( in_array(get_post_type(), ['page', 'ctrl_listings']) ){
            $page_attachment_id = get_post_meta(citykid_get_the_ID(), 'banner_image', true);
            $attachment_id = (!empty($page_attachment_id) && !is_wp_error($page_attachment_id))? $page_attachment_id : $attachment_id;
        }

        $image_url = wp_get_attachment_image_url($attachment_id, 'full');
        if(!empty($image_url) && !is_wp_error($image_url)){
            $styles[] = '--citykid-parallax-bg: url('.esc_url($image_url).');';                
        }

        $banner_image_opacity = get_theme_mod('banner_image_opacity', 25);
        $styles[] = '--citykid-parallax-opacity: '.($banner_image_opacity/100).';'; 

        $banner_image_position = get_theme_mod('banner_image_position', 'center');
        $styles[] = '--citykid-parallax-bg-position: '.$banner_image_position.';';

        wp_add_inline_style('citykid-style', '.banner-section{'.implode('', $styles).'}');
        
    }
    
    public function get_the_archive_title($title){
		if(is_search()){
			return sprintf( 
				__( 'Search Results for &#8220;%s&#8221;', 'citykid' ), 
				get_search_query() 
			);
		}
		if(get_post_type() == 'post'){
			$title = get_theme_mod('blog_title', esc_attr__('Latest News', 'citykid'));
		}
        elseif(is_singular()){
            $title = get_the_title();
        }
        elseif(is_home()){
            $title = get_theme_mod('blog_title', esc_attr__('Latest News', 'citykid'));  
        }
        
        return $title;
    }

    public function get_the_archive_description($description){
        
        if(is_singular()){
            $subtitle = get_post_meta(get_the_ID(), 'subtitle', true);
            $description = !empty($subtitle)? $subtitle : $description;
        }
        if(is_home()){
            $description = get_theme_mod('blog_subtitle', esc_attr__('Get the latest news, updates and tips', 'citykid'));
        }
        
        return $description;
    }

    private function add_partials($wp_customize){

        // Add partial for header.
		$wp_customize->selective_refresh->add_partial(
			'header_bg_color',
			array(
				'selector'        => '.header-section',
			)
		);

        $wp_customize->selective_refresh->add_partial(
			'banner_image',
			array(
				'selector'        => '.banner-section',
			)
		);
       
        // Add partial for blogname.
		$wp_customize->selective_refresh->add_partial(
			'custom_logo',
			array(
				'selector'        => '.logo-dark',
			)
		);

        $wp_customize->selective_refresh->add_partial(
			'custom_logo_white',
			array(
				'selector'        => '.logo-white',
			)
		);

        // Add partial for blogdescription.
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => array( $this, 'partial_blogdescription' ),
			)
		);

		// Add partial Navmenu.
		$wp_customize->selective_refresh->add_partial(
			'nav_menu_locations[primary]',
			array(
				'selector'        => '.primary-nav',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'nav_menu_locations[topbar]',
			array(
				'selector'        => '.topbar-nav',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'nav_menu_locations[social]',
			array(
				'selector'        => '.social-nav',
			)
		);

        // Change site-title & description to postMessage.
		$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage'; // @phpstan-ignore-line. Assume that this setting exists.
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage'; // @phpstan-ignore-line. Assume that this setting exists.

        return $wp_customize;
    }

    /**
	 * Render the site title for the selective refresh partial.
	 *
	 * @return void
	 */
	public function partial_blogname() {
		bloginfo( 'name' );
	}

	/**
	 * Render the site tagline for the selective refresh partial.
	 *
	 * @return void
	 */
	public function partial_blogdescription() {
		bloginfo( 'description' );
	}

}