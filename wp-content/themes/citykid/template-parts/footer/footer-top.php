<?php if ( !get_theme_mod('display_footer_top', true) ) return; ?>
<?php if( empty(get_theme_mod('footer_logo')) &&  !has_nav_menu('footer_social')) return; ?>
<div class="footer-top-section py-30">
    <div class="container d-flex flex-wrap align-items-center justify-content-lg-between">
        <?php if(!empty(get_theme_mod('footer_logo'))):  ?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo align-items-center">
          <img src="<?php echo esc_url(citykid_theme_mod_image_uri('footer_logo', 'assets/images/logo-white.png' )); ?>" width="150" alt="<?php echo esc_attr(get_bloginfo( 'name', 'display' )) ?>">
        </a>
        <?php endif; ?>
        <?php
            if(has_nav_menu('footer_social')):
                // Social links
                echo '<div class="footer-top-social-icons d-flex">';
                printf('<span class="footer-social-nav-title fs-3">'.esc_attr_x('%s', 'Footer social nav title', 'citykid').'</span>', get_theme_mod('footer_social_nav_title', esc_attr__('Follow Us On:', 'citykid')));
                wp_nav_menu(
                    array(                        
                        'container'      => false,
                        'menu_class' => 'nav footer-social-nav',
                        'theme_location' => 'footer_social',
                        'depth'          => 1,
                        'fallback_cb'    => false,
                        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'fallback_cb'    => 'Citykid\Nav_Walker::fallback',
                        'fallback_title'    => esc_attr__('Footer social menu', 'citykid'),
                        'walker' => new Citykid\Nav_Walker()
                    )
                );
                echo '</div>';
            endif;
        ?>
    </div>
</div>