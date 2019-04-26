<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
	<link rel='shortcut icon' href='favicon.ico' type='image/x-icon' />

</head>
<body <?php body_class(); ?>>
	<header id="mainHdr">
		<div class="container cf">
            <div class="logo-container">
			    <a href="<?php echo esc_url(home_url('/')); ?>" id="logo"><img src="<?php the_field('header_logo','options'); ?>"></a>
            </div>
			<div id="hdrRight" class="right">
				<div id="headerTop" class="cf">
					<div id="contactWrap" class="right">
						<span>HGM Can Help!</span>
						Call Today <a href="tel:<?php the_field('phone_number','options'); ?>"><?php echo get_field('phone_number_display','options') ?: get_field('phone_number','options') ; ?></a>
					</div>
				</div>
				<nav>
					<?php wp_nav_menu( array('menu' => 'Navigation' )); ?>
				</nav>
			</div>
		</div>
	</header>