<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>
	<div id="contentWrap">
		<?php require_once("page-templates/inc_pageTop.php"); ?>
		<div class="container">	
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
				the_content();
			endwhile; endif; ?>
		</div>
	</div>
<?php
get_footer();
