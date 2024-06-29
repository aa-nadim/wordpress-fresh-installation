<div <?php post_class('overflow-hidden') ?>>
        <?php the_title('<h2 class="banner-title mb-20">', '</h2>') ?>
        
        <div class="entry-content">
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
        <div class="entry-footer text-muted border-top pt-10 mt-30">
        
        </div>
</div>