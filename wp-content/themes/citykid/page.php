<?php 
get_header();

	do_action('citykid_content_before');

	if ( have_posts() ):
		
		// Load posts loop.
		while ( have_posts() ) {
			the_post();
			
			get_template_part( 'template-parts/content/content-page' );
			
		}
		

	else:

		// If no content, include the "No posts found" template.
		get_template_part( 'template-parts/content/content-none' );

	endif;

	do_action('citykid_content_after');
	get_template_part('template-parts/content/after');

get_footer();