<?php
/**
 * Template Name:  Login
 */

get_header(); ?>

	<!--Content-->
	<div id="contentWrap">
		<?php require_once("inc_pageTop.php"); ?>
		<div class="container">	
			<div id="loginLeft" class="left loginWrap">
				<h2>Login</h2>
				<?php $sc = get_field('login_shortcode'); echo ( do_shortcode( $sc ) ); ?>
			</div>
			<div id="loginRight" class="right loginWrap">
				<h2>Register</h2>
				<?php $sc2 = get_field('register_shortcode'); echo ( do_shortcode( $sc2 ) ); ?>
			</div>
			<div style="clear:both;"></div>
		</div>
	</div>
	<!--/Content-->
	
<?php
get_footer();
