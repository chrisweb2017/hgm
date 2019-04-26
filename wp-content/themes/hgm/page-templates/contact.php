<?php
/**
 * Template Name:  Contact
 */

get_header(); ?>

    <!--Content-->
        <div id="contentWrap">

            <?php require_once("inc_pageTop.php"); ?>

            <!--Content-->
                <div>
                    <div class="container">
                        <?php if ( have_posts() ) : ?>
                            <?php while ( have_posts() ) : the_post();
                                the_content();
                            endwhile; ?>
                            <div style="height:20px;"></div>
                        <?php endif; ?>
                    
                        <div class="contactLeft left">
                            <?php if( have_rows('sections') ): ?>
                                <div>
                                    <?php while( have_rows('sections') ): the_row(); ?>
                                        <div class="sectionWrap">
                                            <h3><?php the_sub_field('section_icon'); ?> <?php the_sub_field('section_title'); ?></h3>
                                            <?php the_sub_field('section_content'); ?>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="contactRight right">
                            <div id="contactForm">
                                <div id="mainForm">
                                    <?php echo do_shortcode('[gravityform id="1" title="false" ajax="true"]'); ?>
                                    <?php //echo do_shortcode('[contact-form-7 id="144" title="Contact Page"]'); ?>
                                    <script>
                                        //Since wordpress has no good way of doing this, and we don't want to fill the site with plugins, we'll use jquery/php
                                        //to get the name of the website and the theme's color.
                                        //jQuery("#contactForm input[name='tfC1']").val('<?php //echo get_bloginfo(); ?>');
                                        //jQuery("#contactForm input[name='tfC2']").val('<?php //the_field('accent_1_color','options'); ?>');
                                    </script>
                                </div>
                                <!-- <div id="thankYouWrap">
                                    <div id="thankYouInner">
                                        <?php the_field('thank_you_message'); ?>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <div style="clear:both; height:30px;"></div>
                    </div>
					<?php if(!get_field('hide_google_map')) : ?>
                    <!--Map-->
                        <div id="mapWrap">
                            <div id="topShadow"></div>
                            <div id="bottomShadow"></div>
                            <div class="mapOverlay" onClick="style.pointerEvents='none'"></div>
                            <?php
                                $addy = urlencode(get_field('your_address'));
                            ?>
                            <iframe src="http://maps.google.com/maps?&amp;q='<?php echo $addy; ?>'&amp;output=embed" width="100%" height="400"></iframe>
                            <style>
                                #contentWrap {
                                    padding-bottom:0px;
                                }
                            </style>
                        </div>
                    <!--/Map-->
					<?php endif; ?>
                </div>
            <!--/Content-->
        </div>
    <!--/Content-->
	
<?php
get_footer();
