<?php
/**
 * Template Name:  
 */

get_header(); ?>

	<!--Content-->
		<div id="contentWrap">
		<?php require_once("inc_pageTop.php"); ?>
		<div class="container">	
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
				the_content();
			endwhile; endif; ?>
		</div>
		</div>
	<!--/Content-->
	
<?php
get_footer();
