<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

	<!--Content-->
		<div id="contentWrap">
			<?php require_once("page-templates/inc_pageTop.php"); ?>
			<div class="container">	
				<div id="blogLeft" class="left">
					<div id="blogInner">
						<div id="blogImg">
							<?php if( wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blog_main' ) ){ ?>
								<img src="<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blog_main' ); echo $image[0]; ?>" />
							<?php }; ?>
						</div>
						<div class="postInfo">
							<i class="fa fa-calendar" aria-hidden="true"></i> <?php the_time('F j, Y'); ?>
							<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ): ?>
							| <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'twentyfourteen' ), __( '1 Comment', 'twentyfourteen' ), __( '% Comments', 'twentyfourteen' ) ); ?></span>
							<?php endif; ?>
						</div>
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
							the_content();
						endwhile; endif; ?>
						<?php
							if ( comments_open() || get_comments_number() ) {
								comments_template();
							};
						?>
					</div>
				</div>
				<div id="blogRight" class="left">
					<?php get_sidebar(); ?>
				</div>
				<div style="clear:both;"></div>
			</div>
		</div>
	<!--/Content-->
<?php
get_footer();
