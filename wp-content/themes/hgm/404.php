<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header();?>

	<!--Content-->
		<div id="contentWrap">
			<?php require_once "page-templates/inc_pageTop.php";?>
			<div class="container">
				<?php echo the_field('404_message', 'options'); ?>

				<p><a href="<?php echo home_url(); ?>" class="back-to-home-btn">Back to Homepage</a></p>
			</div>
		</div>
	<!--/Content-->

<?php
get_footer();
