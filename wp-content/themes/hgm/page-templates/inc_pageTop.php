
<script>
	jQuery(document).ready(function($) {
		$('.pt-par').parallax({speed : -0.50, coffset: "50"});
    });
</script>

<?php 
	$page_banner = get_field('page_banner','options'); 
	$page_banner_mobile = get_field('page_banner_mobile','options'); 
?>

<!--Page Top-->
	<div id="pageTop" style="background-image:url(<?php echo $page_banner['url']; ?>);"></div>

	<div id="pageTop" class="page-banner-mobile" style="background-image:url(<?php echo $page_banner_mobile['url']; ?>);"></div>

<!--/Page Top-->


<!--Content Top-->
	<div id="contentTop" class="container cf">
		<h1>
		<?php
			if ( is_day() ) :
				printf( __( 'Daily Archives: %s', 'twentyfourteen' ), get_the_date() );

			elseif ( is_month() ) :
				printf( __( 'Monthly Archives: %s', 'twentyfourteen' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'twentyfourteen' ) ) );

			elseif ( is_year() ) :
				printf( __( 'Yearly Archives: %s', 'twentyfourteen' ), get_the_date( _x( 'Y', 'yearly archives date format', 'twentyfourteen' ) ) );
			elseif ( is_404() ) :
				printf( __( 'Page Not Found' ) );
			else : ?>
			<?php the_title(); ?>
			<?php 
			endif;
		?>
		</h1>
	</div>
<!--/Content Top-->