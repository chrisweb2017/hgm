<?php
/**
 * Template Name:  Before & After Gallery
 */

get_header(); ?>

    <div id="contentWrap">
        <?php require_once("inc_pageTop.php"); ?>
        <div class="container">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
				the_content();
			endwhile; endif; ?>

            <?php if( have_rows('ba_images') ): ?>
                <div id="galleryWrapper">
                    <?php while( have_rows('ba_images') ): the_row(); 
                        $image_title = get_sub_field('image_title');
                        $before_image = get_sub_field('before_image');
                        $after_image = get_sub_field('after_image');
                        $content = get_sub_field('content');
                        ?>
                        <div class="gallery-image">
                            <h3><?php echo $image_title; ?></h3>
                            <div class="flex-wrap">
                                <div class="comparison">
                                    <figure style="background-image: url(<?php echo $before_image['sizes']['ba-gallery']; ?>);">
                                        <div class="divisor" style="background-image: url(<?php echo $after_image['sizes']['ba-gallery']; ?>);"></div>
                                    </figure>
                                    <input type="range" min="0" max="100" value="50" class="slider" oninput="moveDivisor()">
                                </div>
                                <div class="content">
                                    <?php echo $content; ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>            

        </div>
    </div>



    <?php
get_footer();