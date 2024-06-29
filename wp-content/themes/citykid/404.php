<?php 
get_header();

	
	do_action('citykid_content_before');

	// If no content, include the "No posts found" template.
	get_template_part( 'template-parts/content/content-none' );

	do_action('citykid_content_after');
	get_template_part('template-parts/content/after');

get_footer();