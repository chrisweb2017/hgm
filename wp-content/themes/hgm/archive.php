<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Fourteen
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

	<!--Content-->
		<div id="contentWrap">

			<?php require_once("page-templates/inc_pageTop.php"); ?>

			<!--Content-->
				<div>
					<div class="container">	
		
			<div id="blogWrap">
			<?php
				if( have_posts() ):
					// Start the Loop.
					while ( have_posts() ) : the_post();

						/*
						 * Include the post format-specific template for the content. If you want to
						 * use this in a child theme, then include a file called called content-___.php
						 * (where ___ is the post format) and that will be used instead.
						 */
						?>
							<div class="blogItem">
										<div class="featuredImage">
											<a href="<?php the_permalink(); ?>">
												<?php if( wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blog_archive' ) ){ ?>
					                                <img src="<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blog_archive' ); echo $image[0]; ?>" />
					                            <?php } else { ?>
					                                <?php echo main_image(); ?>
					                            <?php }; ?>
				                            </a>
										</div>
										<div class="blogInfo">
											<h2><?php the_title(); ?></h2>
                            				<div class="postDate">
                            				<i class="fa fa-calendar" aria-hidden="true"></i> <?php the_time('F j, Y'); ?>
								<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ): ?>
								| <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'twentyfourteen' ), __( '1 Comment', 'twentyfourteen' ), __( '% Comments', 'twentyfourteen' ) ); ?></span>
								<?php endif; ?></div>
                            				<div class="excerptWrap">
                            					<?php my_excerpt(); ?>
                            				</div>
										</div>
										<a href="<?php the_permalink(); ?>" class="blogBtn">Read Full Article <i class="fa fa-angle-right" aria-hidden="true"></i></a>
									</div>
						<?php

					endwhile;
					// Previous/next page navigation.
					twentyfourteen_paging_nav();

				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );

				endif;
			?>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_footer();
