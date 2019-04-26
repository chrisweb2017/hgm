<?php
/**
 * Template Name:  FAQs
 */

get_header(); ?>

    <!--Content-->
        <div id="contentWrap">

            <?php require_once("inc_pageTop.php"); ?>

            <!--Content-->
                <div class="container">
                    <?php while( have_rows('faqs') ): the_row(); ?>
                        <div class="faqQuestion">
                            <?php the_sub_field('question'); ?>
                        </div>
                        <div class="faqAnswer"><?php the_sub_field('answer'); ?></div>
                    <?php endwhile; ?>
                    <script>
                        jQuery(".faqQuestion").click(function(){
                            if( jQuery(this).hasClass("active") ){
                                jQuery(this).removeClass("active").next().slideUp();
                            } else {
                                jQuery(".faqQuestion.active").removeClass("active").next().slideUp();
                                jQuery(this).addClass("active").next().slideDown();
                            }
                        });
                    </script>
                </div>
            <!--/Content-->
        </div>
    <!--/Content-->
	
<?php
get_footer();
