<?php 
global $citykid; 
if($citykid->meta['disable_header']) return; 

?>
<header <?php citykid_header_class(); ?>>
  
    <div class="container navbar-section">
      <div <?php citykid_navbar_class('navbar-expand-xl'); ?>>
        
        <?php get_template_part('template-parts/header/site-branding'); ?>

        <div>
        
          <a class="navbar-toggler d-inline-block d-xl-none" data-bs-toggle="offcanvas" href="#navbarOffcanvasXl" aria-controls="navbarOffcanvasLg">
            <span class="navbar-toggler-icon"></span>
          </a>
        </div>


        <div class="offcanvas offcanvas-xl offcanvas-end" tabindex="-1" id="navbarOffcanvasXl" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-brand align-items-center">
          <img src="<?php echo esc_url(citykid_get_logo_uri()); ?>" alt="<?php echo esc_attr(get_bloginfo( 'name', 'display' )) ?>">
        </a></h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>

            <?php  
            // Right navbar
            wp_nav_menu([
                'container_class' => 'offcanvas-body gap-15',
                'menu_class' => 'navbar-nav align-items-xl-center primary-nav ms-xl-auto',
                'theme_location' => 'primary',
                'depth' => 2,
                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>' . $search_icon . $button,
                'fallback_cb'    => 'Citykid\Nav_Walker::fallback',
                'fallback_title'    => esc_attr__('Primary menu', 'citykid'),
                'walker' => new Citykid\Nav_Walker()
            ]);
            ?> 
           
        </div> 
            
        
        
      </div>
    </div>
</header>

