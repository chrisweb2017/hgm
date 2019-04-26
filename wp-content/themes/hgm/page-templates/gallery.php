<?php
/**
 * Template Name:  Gallery
 */

get_header(); ?>

	<div id="contentWrap">
		<?php require_once("inc_pageTop.php"); ?>
		<div class="container">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
				the_content();
			endwhile; endif; ?>

			<?php $images = get_field('gallery_images'); ?>
			<?php if( $images ): ?>
			<ul class="galleryUL">
				<?php foreach( $images as $image ): ?>
				<li>
					<a href="<?php echo $image['url']; ?>" rel="gal">
						<img src="<?php echo $image['sizes']['ba-gallery']; ?>" alt="<?php echo $image['alt']; ?>" />
					</a>
					<p>
						<?php echo $image['caption']; ?>
					</p>
				</li>
				<?php endforeach; ?>
			</ul>
			<?php endif; ?>
		</div>
	</div>

	<?php
get_footer();