<?php
/**
 * Template Name:  Testimonials
 */

get_header(); ?>
	<!--Content-->
	<div id="contentWrap">
		<?php require_once("inc_pageTop.php"); ?>
		<div class="container">
			<?php if( have_rows('testimonials') ): ?>
				<div class="testimonialsWrap">
				<?php while( have_rows('testimonials') ): the_row(); ?>
					<div class="testimonialItem">
						<div class="testimonialText"><?php the_sub_field('testimonial_text'); ?></div>
						<div class="testimonialWho"><?php the_sub_field('from_who'); ?></div>
					</div>
				<?php endwhile; ?>
				</div>
			<?php endif; ?>
			<?php if( get_field('view_all_button') ): ?>
				<div style="text-align: center;">
					<a href="<?php the_field('view_all_button'); ?>" class="theme-colored-button" target="_blank">View All Testimonials</a>
				</div>
			<?php endif; ?> 
		</div>
	</div>
	<!--/Content-->
<?php
get_footer();
