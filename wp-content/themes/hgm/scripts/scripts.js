function hexToRGB(hex, alpha) {
  var r = parseInt(hex.slice(1, 3), 16),
    g = parseInt(hex.slice(3, 5), 16),
    b = parseInt(hex.slice(5, 7), 16),
    a = alpha
  return "rgba(" + r + ", " + g + ", " + b + ", " + a + ")";
}

jQuery(document).ready(function ($) {

  $("#searchPopUpBtn").click(function () {
    $("#searchPopup").addClass("open");
    $("#searchPopup input").focus();
  });
  $("#searchPopup #searchPopClose").click(function () {
    $("#searchPopup").removeClass("open");
  });

  $(window).scroll(function () {
    if ($(this).scrollTop() > 150) {
      $('#footer-contact-desktop, #footer-contact-mobile').addClass('active');
    } else {
      $('#footer-contact-desktop, #footer-contact-mobile').removeClass('active');
    }
  });

  // Show/hide desktop contact form
  $("#footer-contact-desktop .btn").click(function () {
    $("#popup,#popupmask").fadeIn('fast');
    $("body.home").addClass("noscroll");
    $("#popup-close,#popupmask").on("click", function (e) {
      e.preventDefault();
      $("#popup,#popupmask").fadeOut('fast');
      $("body.home").removeClass("noscroll");
    });
  });

  $('#footer-contact-mobile .btn, #footer-contact-mobile .footer-close-form').click(function () {
    $('#footer-contact-mobile').find('.the-form').slideToggle();
    $("#popup,#popupmask").fadeToggle('fast');

  });

  // Open form from Slider button
  $(".ready-button").click(function(){
    if (jQuery(window).width() > 1020) {
        jQuery('#footer-contact-desktop .btn').click()
    } else {
      jQuery('#footer-contact-mobile .btn').click()
    }
  });

  // Open form from editor button
  $(".red-button.popup").click(function(){
    if (jQuery(window).width() > 1020) {
        jQuery('#footer-contact-desktop .btn').click()
    } else {
      jQuery('#footer-contact-mobile .btn').click()
    }
  });  

  // Close all forms on screen resize
  $( window ).resize(function() {
    $("#popup,#popupmask").fadeOut('fast');
    $('#footer-contact-mobile').find('.the-form').fadeOut('fast');
  });

	$(function () {
		var hash = document.location.hash;
		//document.location.hash = '#';

		var element = $('h2[id="' + hash.slice(1) + '"]');
		if (element.length) {
			var top = element.offset().top;
			$('html,body').animate({ scrollTop: (top - 130) }, 2000);
		}
	});  

});

if (jQuery(window).width() > 1040) {
  jQuery(window).scroll(function ($) {
    var top = jQuery(window).scrollTop();
    if (top < 49) {
      jQuery("header").removeClass("notAtTop");
    } else {
      jQuery("header").addClass("notAtTop");
    }
  });  
}

document.addEventListener('wpcf7submit', function (event) {
  if ('144' == event.detail.contactFormId) {
    jQuery('#mainForm').hide();
    jQuery('#thankYouWrap').show();
    location = '/thank-you';
  }
}, false);

// Gallery
var divisor = document.getElementsByClassName("divisor");
var slider = document.getElementsByClassName("slider");

function moveDivisor() {
  for (i = 0; i < slider.length; i++) {
    divisor[i].style.width = slider[i].value + "%"
  }
}