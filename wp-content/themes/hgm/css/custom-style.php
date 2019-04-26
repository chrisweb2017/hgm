/* INSTRUCTIONS 
/*
/* To apply the custom color changes, go to the WordPress Dashboard, Appearance, select the colors and Update
/*
*/


/* ||||||||||||||||||||||||||||||||||| Color 1 Accent ||||||||||||||||||||||||||||||||||| */
/* ||||||||||||||||||||||||||||||||||| Color 1 Accent ||||||||||||||||||||||||||||||||||| */
/* ||||||||||||||||||||||||||||||||||| Color 1 Accent ||||||||||||||||||||||||||||||||||| */

/* -------- Color -------- */
.color-1,
.to-color-1:hover,
header#mainHdr #hdrRight #headerTop #socialIconsWrap .fa:hover,
header#mainHdr #hdrRight #headerTop a.phone-link:hover,
header#mainHdr #hdrRight #headerTop #searchWrap #searchSubmit:hover,
#shopWrap #productsList ul li .prodPrice, 
header #hdrRight #headerTop #userLinksWrap a:hover,
#blogWrap .blogItem .blogInfo h2,
#blogWrap .blogItem .blogBtn,
.f561-comment-holder ul.children::before,
.sectionWrap h3 .fa,
#contentWrap h3,
#contentTop h1,
.testimonialsWrap .testimonialItem .testimonialWho,
.contactLeft .sectionWrap .fa {
	color: <?php the_field('accent_1_color','options'); ?>;
}

/* -------- Border -------- */
.color-1-border,
div.swatch-wrapper.selected,
.to-color-1-border:hover,
header#mainHdr #hdrRight #headerTop #userLinksWrap a:hover,
nav.prev-next-posts .page-numbers:hover,
nav.prev-next-posts .page-numbers.current,
#blogRight aside h1.widget-title,
.loginWrap h2,
#categoryListMainAccord.open,
ul.galleryUL li a {
	border-color: <?php the_field('accent_1_color','options'); ?>;
}

/* -------- Background Color -------- */
#contentTop #shoppingRight #viewBtns .viewBtn.active,
#contentTop #shoppingRight #viewBtns .viewBtn:hover,
#blogWrap .blogItem .featuredImage,
nav.prev-next-posts .page-numbers:hover,
nav.prev-next-posts .page-numbers.current,
.comment-respond .form-submit input[type='submit'],
#contactForm input[type='submit'],
.faqQuestion.active,
.cleanlogin-container input[type='submit'],
#searchPopup #searchPopBtn,
#categoryListMainAccord.open,
.reversedColor,
.theme-colored-button,
#wideBanner .leftAlign a.button-link,
#wideBanner .centerAlign a.button-link {
	background-color: <?php the_field('accent_1_color','options'); ?>;
}

/* -------- Color Hovers -------- */
.color-1-hover { 
	color: <?php the_field('accent_1_color_hover','options'); ?>;
}

/* -------- Background Hovers -------*/
.color-1-hover-background:hover,
#blogWrap .blogItem .blogBtn:hover,
.comment-respond .form-submit input[type='submit']:hover,
#contactForm input[type='submit']:hover,
.cleanlogin-container input[type='submit']:hover,
header#mainHdr nav ul li ul.sub-menu li:hover,
.theme-colored-button:hover
 {
	background-color: <?php the_field('accent_1_color_hover','options'); ?>;
}

/* -------- Transparent Background -------- */
header#mainHdr nav ul li ul {
	background-color: <?php echo $transBackground; ?>;
}







/* ||||||||||||||||||||||||||||||||||| Color 2 Accent ||||||||||||||||||||||||||||||||||| */
/* ||||||||||||||||||||||||||||||||||| Color 2 Accent ||||||||||||||||||||||||||||||||||| */
/* ||||||||||||||||||||||||||||||||||| Color 2 Accent ||||||||||||||||||||||||||||||||||| */

#contentWrap h2 {
	color: <?php the_field('accent_2_color','options'); ?>;
}


.color-1-background,
.color-1-background-active.active {
	background-color: <?php the_field('accent_2_color','options'); ?>;
}

/* -------- Color -------- */

/* -------- Background Color -------- */
footer {
	background-color: <?php the_field('footer_background_color','options'); ?>;
}

/* -------- Color Hovers -------- */

/* -------- Background Hovers -------*/

.color-1-background:hover,
.color-1-background-active.active:hover {
	background-color: <?php the_field('accent_2_color_hover','options'); ?>;
}



/* ||||||||||||||||||||||||||||||||||| Specific ||||||||||||||||||||||||||||||||||| */
/* ||||||||||||||||||||||||||||||||||| Specific ||||||||||||||||||||||||||||||||||| */
/* ||||||||||||||||||||||||||||||||||| Specific ||||||||||||||||||||||||||||||||||| */


#responsive-menu-container {
	<?php if( get_field('background_color_choice','options') == "light" ): ?>
		background-color: rgba(255,255,255,0.9);
	<?php elseif( get_field('background_color_choice','options') == "dark" ): ?>
		background-color: rgba(0,0,0,0.9);
	<?php else: ?>
		background-color: <?php echo $responsive_menu; ?>;
	<?php endif; ?>
}

#responsive-menu-container #responsive-menu li.responsive-menu-item a {
	<?php if( get_field('background_color_choice','options') == "light" ): ?>
		color:#000000;
	<?php elseif( get_field('background_color_choice','options') == "dark" ): ?>
		color:#ffffff;
	<?php else: ?>
		color: <?php the_field('link_color','options'); ?>;
	<?php endif; ?>
}



