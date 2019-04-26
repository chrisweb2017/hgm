<?php
/**
 * Template Name:  Services
 */

get_header(); ?>

    <!--Content-->
        <div id="contentWrap">

            <?php require_once("inc_pageTop.php"); ?>

            <!--Content-->
                <div class="container">
                    <?php if( have_rows('services') ): ?>
                        <?php while( have_rows('services') ): the_row(); 
                            $services_image = get_sub_field('services_image');
                            $services_heading = get_sub_field('services_heading');
                            $heading_id = get_sub_field('heading_id');
                            $services_content = get_sub_field('services_content');

                            if( $heading_id )
                                $heading_id = ' id=' . $heading_id;

                            ?>	
                            <div class="service">
                                <?php if( $services_image ) : ?>
                                    <div class="image-wrap">
                                        <img src="<?php echo $services_image['sizes']['ba-gallery']; ?>" alt="<?php echo $services_image['alt']; ?>">
                                    </div>
                                <?php endif; ?>
                                <div class="content-wrap">
                                    <h2<?php echo $heading_id; ?>><?php echo $services_heading; ?></h2>
                                    <?php echo $services_content; ?>
                                </div>
                            </div>                      
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            <!--/Content-->
        </div>
    <!--/Content-->
	
<?php
get_footer();
