<?php
/**
 * Displays the footer widget area.
 *
 * @since citykid 1.0
 */


if ( is_active_sidebar( $sidebar ) ) : ?>

    <div class="col-lg-4 sidebar-column">
      <div  id="sidebar" class="widget-area position-sticky d-grid gap-30">
		    <?php dynamic_sidebar( $sidebar ); ?>
      </div>
    </div><!-- .widget-area -->

<?php endif; ?>