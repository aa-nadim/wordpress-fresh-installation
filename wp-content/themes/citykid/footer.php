<?php
/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Citykid
 * @since Citykid 1.0
 */

?>

	</main>
	
	<footer <?php citykid_footer_class(); ?>>
		<?php get_template_part( 'template-parts/footer/footer-top' ); ?>
		<?php get_template_part( 'template-parts/footer/copyright-bar' ); ?>
		<div class="parallax"></div>
	</footer>


<?php wp_footer(); ?>

</body>
</html>
