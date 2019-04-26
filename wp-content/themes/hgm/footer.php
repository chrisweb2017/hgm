<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

	<footer>
		<div class="container">
			<div id="footerColumns">
			    <?php if (have_rows('social_icons', 'options')): ?>
				<div class="f-column">
					<h4><?php the_field('col1_heading', 'options');?></h4>
					<ul>
					<?php while (have_rows('social_icons', 'options')): the_row();?>
						<li>
							<a href="<?php the_sub_field('social_url');?>" target="_blank">
								<?php the_sub_field('icon');?> <?php the_sub_field('social_name');?>
							</a>
						</li>
					<?php endwhile;?>
					</ul>
				</div>
				<?php endif;?>
				<div class="f-column company-column">
					<h4><?php the_field('col2_heading', 'options');?></h4>
					<?php the_field('col2_menu', 'options');?>
				</div>			    
			</div>
			<div id="footerLogo">
				<img src="<?php the_field('footer_logo', 'options');?>">
			</div>
			<div class="phone-link">
				Call Today <a href="tel:<?php the_field('phone_number', 'options');?>"><?php echo get_field('phone_number_display', 'options') ?: get_field('phone_number', 'options'); ?></a>
			</div>
			<div id="footerSmall">
				<?php wp_nav_menu(array('menu' => 'Mini Footer Links'));?>
				<span class="nowrap">&copy;
				<script type="text/javascript">
					var d = new Date(); document.write(d.getFullYear());
				</script>
				</span>
				<?php echo the_field('copyright','options'); ?>
				<p class="developer">
					<?php echo the_field('custom_website_design','options'); ?> <a href="https://www.561media.com/" target="_blank">561Media.com</a>
				</p>
			</div>
		</div>
		<?php if( get_field('enable_popup_forms', 'options' ) ) : ?>
		<style>footer{padding-bottom:80px</style>
		<div id="footer-forms">
			<div id="footer-contact-desktop" class="footer-form">
				<img src="<?php bloginfo('template_directory'); ?>/images/gd_three-borders.png" alt="">
				<div class="the-form-wrap">
					<div class="form-text">
						<?php // the_field('desktop_popup_label','options'); ?>
						<div class="btn btn-primary"><?php the_field('desktop_button_text', 'options');?></div>
					</div>
				</div>
				<div id="footer-contact-form">
					<div id="popup" class="popup">
						<div id="popupwrap">
							<div id="popup-title" class="layout-title">
								<?php the_field('desktop_popup_title', 'options');?>
							</div>
							<div id="popup-content">
								<div id="popup-content-wrapper">
									<?php the_field('desktop_popup_text', 'options');?>
								</div>
								<div id="popup-form-wrapper">
									<?php the_field('desktop_shortcode', 'options');?>
								</div>
							</div>
							<div id="popup-close">
								<i class="fa fa-times"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="footer-contact-mobile">
				<div class="the-form-wrap">
					<div class="form-text">
						<?php // the_field('mobile_label','options'); ?>
						<div class="btn btn-primary"><?php the_field('mobile_button_text', 'options');?></div>
					</div>
					<div class="the-form">
						<i class="footer-close-form fa fa-times"></i>
						<?php the_field('mobile_shortcode', 'options');?>
					</div>
				</div>
			</div>
			<div id="popupmask"></div>
		</div>
		<?php endif; ?>
	</footer>

	<?php wp_footer();?>
</body>
</html>