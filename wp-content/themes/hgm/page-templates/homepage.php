<?php
/**
 * Template Name: Homepage
 */

get_header(); ?>
    <script>
        jQuery(document).ready(function ($) {
            <?php if( wp_is_mobile() ): ?>
            $('#wideBanner').addClass("mobile");
            <?php else: ?>
            if ($(window).width() > 650) {
                $('#wideBanner').parallax({
                    speed: 0.50,
                    coffset: "-50",
                    position: "right"
                });
            }
            <?php endif; ?>
        });
    </script>
    <div id="contentWrap" class="no-margin">
        <div id="sliderWrap" style="height:auto;">
            <div id="bottomShadow"></div>
            <?php echo ( do_shortcode( get_post_meta( $post->ID , 'slider_shortcode' , true ) ) ); ?>            
        </div>
        <div id="collectionsWrap">
            <div class="container">
                <?php if (get_field('collections_title')) : ?>
                    <div class="sectionTitle cf">
                        <h2>
                            <?php the_field('collections_title'); ?>
                        </h2>
                        <a href="#" class="color-1-background color-1-hover-background">
                            <?php the_field('collections_button_text'); ?>
                        </a>                    
                    </div>
                <?php endif; ?>
                <?php if ( have_rows('collection_items') ) : ?>
                    <div class="blocksWrap">
                        <?php
                        while( have_rows('collection_items') ) : the_row(); 
                            $collection_image = get_sub_field('image');
                            $collection_text = get_sub_field('text');
                            $collection_button_text = get_sub_field('button_text'); 
                            $collection_page_link = get_sub_field('page_link'); 
                            $collection_item_link = get_sub_field('item_link');
                            
                            
                            if( $collection_item_link ) {
                                $collection_page_link = $collection_page_link . '/' . $collection_item_link;
                            }
                                                        
                             ?>
                            <div class="halfBlock">
                                <a href="<?php echo $collection_page_link; ?>" class="blockBtn"></a>
                                <div class="imageWrap">
                                    <img src="<?php echo $collection_image['sizes']['collection-wide']; ?>" alt="<?php echo $collection_image['alt']; ?>" title="<?php echo $collection_image['title']; ?>">
                                </div>                                
                                <div class="blockTitle">
                                    <p><?php echo $collection_text; ?></p>
                                    <span class="btnWrap color-1-background color-1-hover-background">
                                        <?php echo $collection_button_text; ?>
                                    </span>                                    
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div id="wideBanner" style="background-image:url(<?php the_field('parallax_background'); ?>);">
            <div class="container">
                <div class="centerAlign">
                    <div class="wideBanner-content">
                        <h3>
                            <span style="color:<?php the_field('heading_one_text_color'); ?>;">
                                <?php the_field('heading_one'); ?>
                            </span>
                        </h3>
                        <p style="color: <?php the_field('heading_two_color'); ?>">
                            <?php the_field('heading_two'); ?>
                        </p>
                        <?php if ( have_rows('section_items') ) : ?>
                            <ul>
                            <?php while( have_rows('section_items') ) : the_row(); ?>
                                <li>
                                    <?php 
                                    $section_text = get_sub_field('section_text');
                                    if( $item_link = get_sub_field('section_link') ) : ?>
                                        <a href="<?php echo $item_link; ?>"><?php echo $section_text; ?></a>
                                    <?php else : ?>                                    
                                        <?php echo $section_text; ?>
                                    <?php endif; ?>                                     
                                </li>
                            <?php endwhile; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                    <?php if( get_field('button_text') && get_field('button_link') ) : ?>
                    <div class="sectionTitle">
                        <a href="<?php the_field('button_link'); ?>" class="color-1-background color-1-hover-background">
                            <?php the_field('button_text'); ?>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?
        $map_embed = false;
        if( $map_embed_code = get_field('map_embed_code','options') )
            $map_embed = true;?>
        <div id="whiteBanner">
            <div class="container">
                <div <?if( $map_embed ) echo'class="col-half"'; ?>
                    <?php if( get_field('small_text') ): ?>
                        <div class="small-text">
                            <h3 style="color: <?php the_field('small_text_color'); ?>;">
                                <?php the_field('small_text'); ?>
                            </h3>
                            <?php if( have_rows('social_icons','options') ): ?>
                                <span class="social-icons">
                                <?php while( have_rows('social_icons', 'options') ): the_row(); ?>
                                    <a href="<?php the_sub_field('social_url'); ?>" target="_blank">
                                        <?php the_sub_field('icon'); ?>
                                    </a>
                                <?php endwhile; ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <?php if( get_field('big_text') ): ?>
                    <h2>
                        <?php if( get_field('big_text_link') ) : ?>
                            <a href="<?php the_field('big_text_link'); ?>" target="_blank"><?php the_field('big_text'); ?></a>
                        <?php else : ?>
                            <?php the_field('big_text'); ?>
                        <?php endif; ?>
                    </h2>
                    <?php endif; ?>
                </div>
            </div>
            <?php if( $map_embed ) : ?>
                <div class="googlemap">
                    <iframe src="<?php echo $map_embed_code; ?>" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php
get_footer();