<div <?php post_class('border-bottom pb-15') ?>>
     
    <?php 
        $sticky_text = '';
        if(has_post_thumbnail()): ?>
            <div class="card-img-wrap position-relative">
                <?php the_post_thumbnail('post-thumbnail', ['class' => 'img-fluid card-img-top']); ?>
                <div class="card-img-top-content listing-categories small text-uppercase position-absolute start-0 bottom-0 p-30">
                   
                </div>
                <?php
                    if ( is_sticky() ) :
                        $sticky_text = get_theme_mod('sticky_text', 'Featured post');
                        ?>
                        <div class="listing-categories small text-uppercase position-absolute start-0 top-0 p-30">
                            <span class="badge text-bg-secondary d-flex gap-1 align-items-center"><?php echo esc_html( $sticky_text) ?></span>
                        </div>
                <?php endif; ?>
            </div>  
            <?php the_title('<h2 class="post-title my-20"><a href="'.get_permalink().'">', '</a></h2>') ?>         
        <?php else: ?>
            <div class="d-flex flex-wrap gap-2 fw-semibold letter-spacing-2 text-uppercase small">
                <?php
                if ( is_sticky() ) {
                    $sticky_text = get_theme_mod('sticky_text', 'Featured post');
                    echo '<span class="badge text-bg-secondary">'.esc_html( $sticky_text).'</span>';
                } 
                
                ?>
            </div>
            <?php the_title('<h2 class="post-title mb-20"><a href="'.get_permalink().'">', '</a></h2>') ?>
        <?php endif; ?> 
    
    

    <?php if(get_theme_mod('display_excerpt_or_full_post') == 'excerpt'): ?>
        <div class="entry-summary">
            <?php the_excerpt(); ?>
        </div>
    <?php else: ?>
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
    <?php endif; ?>
    <div class="entry-footer d-flex align-items-end justify-content-between gap-10">
        <div class="d-grid">
                
        </div>
        
    </div>
</div>