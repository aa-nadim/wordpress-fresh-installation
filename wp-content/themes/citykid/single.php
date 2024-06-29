<?php 
get_header();

	do_action('citykid_content_before');

	if ( have_posts() ):
		echo '<div class="d-grid gap-50">';
		// Load posts loop.
		while ( have_posts() ) {
			the_post();
			get_template_part( 'template-parts/content/content-single');
		
			// If comments are open or there is at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		
		}
		
		echo '</div>';

	else:

		// If no content, include the "No posts found" template.
		get_template_part( 'template-parts/content/content-none' );

	endif;

	do_action('citykid_content_after');
	get_template_part('template-parts/content/after');

get_footer();