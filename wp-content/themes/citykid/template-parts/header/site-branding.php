<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-brand align-items-center">
    <?php if(citykid_get_logo_uri('custom_logo')): ?>    
        <picture class="logo logo-dark">
            <?php echo citykid_get_custom_logo(); ?>
        </picture>
    <?php else: ?>
        <?php echo citykid_get_custom_logo(); ?>
    <?php endif; ?>

    <?php if(citykid_get_logo_uri('custom_logo_white')): ?>    
        <picture class="logo logo-white">
            <?php echo citykid_get_custom_logo('custom_logo_white'); ?>
        </picture>   
    <?php endif; ?> 
</a>