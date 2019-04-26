<?php
/**
 * Template Name:  Blog
 */

get_header(); ?>
	
	<?php
        // set up or arguments for our custom query
        $paged = ( get_query_var('paged') ) ? absint( get_query_var( 'paged' ) ) : 1;
        $query_args = array(
            'post_type' => 'post',
            'posts_per_page' 	=> 4,
            'category_name' => 'Blog',
            'paged' => $paged
        );
        // create a new instance of WP_Query
        $the_query = new WP_Query( $query_args );
    ?>
	
	<!--Content-->
		<div id="contentWrap">

			<?php require_once("inc_pageTop.php"); ?>

			<!--Content-->
				<div>
					<div class="container">	

						<?php if ( $the_query->have_posts() ): ?>
							<div id="blogWrap">
								<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
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
								<?php endwhile; ?>
				            </div>
							<?php if ( $the_query->max_num_pages > 1 ): ?>
				                <div style="clear:both;"></div>
				                <nav class="prev-next-posts">
				                    <div>
				                        <?php
				                            global $the_query; 
				                            $big = 999999999; // need an unlikely integer 
				                            echo paginate_links( array( 
				                                 'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ), 
				                                 'format' => '/page/%#%', 
				                                 'current' => max( 1, get_query_var('paged') ), 
				                                 'total' => $the_query->max_num_pages,
				                                 'prev_text'    => __('<div class="prevBtn pnBtn"><i class="fa fa-angle-left" aria-hidden="true"></i></div>'),
				                                 'next_text'    => __('<div class="nextBtn pnBtn"><i class="fa fa-angle-right" aria-hidden="true"></i></div>')
				                            ) );
				                        ?>
				                    </div>
				                </nav>
				            <?php endif; ?>
						<?php else: ?>
							<article>
			                    <h1>Sorry...</h1>
			                    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			                </article>
						<?php endif; ?>

					</div>
				</div>
			<!--/Content-->
		</div>
	<!--/Content-->


<?php
get_footer();
