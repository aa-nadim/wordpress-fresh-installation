<div <?php post_class('overflow-hidden') ?>>
    <?php 
    the_content();
    
    wp_link_pages(
        array(
            'before'   => '<nav class="page-links numeric-pagination d-lg-flex gap-10 " aria-label="' . esc_attr__( 'Page', 'citykid' ) . '">',
            'after'    => '</nav>'				
        )
    );
    ?>
</div>