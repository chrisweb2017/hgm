//Sliderfy
//Rick Applegarth
//561 Media
//v0.22

/*

8-19-2014
---------------------------------------------------------------------------------------------
- fixed overflow problem when using "slide" effect


7-8-2014
---------------------------------------------------------------------------------------------
- added "pauseOnHover" option. default is true.


6-16-2014
---------------------------------------------------------------------------------------------
- added "slide" function - prev will make it slide "back" and next will make it slide to the "next"


5-15-2014
---------------------------------------------------------------------------------------------
- added 50 pixels because slides were showing at the edge of the screen
- added "prev next button container" option


4-18-2014
---------------------------------------------------------------------------------------------
- made "slideItem" fade in parallax mode incase there is a background image assigned
- fixed slider interval from still running when using arrows keys


02-17-2014
---------------------------------------------------------------------------------------------
- fixed issue where resizing the window would make slides appear off screen by a stupid amount in every mode


02-10-2014
---------------------------------------------------------------------------------------------
- fixed full screen. added "nowidth" setting. added "bg" setting
- nowidth - add to a pItem if you dont' want a width to be assigned (useful for text areas)
- bg	  - add to a pItem if it's the background if using full screen mode.
- fixed thumbContainerWidth to now work


01-30-2014
---------------------------------------------------------------------------------------------
- fixed chrome issue with no being able to read pItem's width. fixed by assigning a width on Init.


12-14-2013
---------------------------------------------------------------------------------------------
- adding Working variable so user cant quickly go through the slides and cause problems


11-20-2013
---------------------------------------------------------------------------------------------
- added easing option


*/

(function ($) {
    $.fn.sliderfy = function(options){
       
        //default settings
        var defaults = {
			autoPlay : true,
			pauseOnHover: false,
            width     : "800",
            height     : "340",
			fullScreen : false,
			addThumbContainer : false,
			addPrevNextContainer : false,
			thumbContainerWidth : null,
			prevNextContainerWidth : null,
            sliderInterval : 5000,
			animationInterval : 500,
			effect : "fade",
			thumbsVisible : true,
			slideItemClass : ".slideItem",
			thumbWrap : ".thumbsWrap",
			thumbItemClass : ".thumbItem",
			showThumbText : false,
			showThumbCustomText : false, //this is controlled by adding a data-thumb-text="" to the slideItem div
			showPrevNext: true,
			customPrevNext: false,
			nextClass : ".slNext",
			nextText : "next",
			prevClass : ".slPrev",
			prevText : "prev",
			showPrevNextText : false,
			showSliderBar : false,
			useArrowKeys : true,
			showPrevNextFadeThis: false, //custom.
			debug : false,
			showLoading: false,
			loadingClass: ".slLoading",
			animateFirstSlide:false
        };
       
	   	var settings = $.extend( {}, defaults, options );
       
	   
        return this.each(function(){
				
			var $this 		= $(this);
			var effect 		= settings.effect;
			var slideCount 	= $(this).find(settings.slideItemClass).length;
			var firstSlide	= 0;
			var working		= false;
			var paused 		= false;
			
			//add class to each slider for future
			$(this).addClass("sliderfy");	
			
			//set style
			if( settings.fullScreen ){
				$(this).css({
					width: "100%"
				});
			} else {
				$(this).css({
					width: settings.width + "px"
				});
			};
			
			$(this).css({
				height: settings.height + "px"
			});
			
			//if( settings.containerWidth ){
//				$(this).css({width: settings.containerWidth});
//			};
			
			//set timer
			$(this).prepend('\
				<div class="sl-Timer" style="display:none; border:solid 1px #000000; width:200px; height:10px; background-color: #ffffff; position:absolute; z-index:200; top: 0px;">\
					<div class="sl-TimerBar" style="width: 1px; height: 10px; background-color: #000000;"></div>\
				</div>'
			);
			
			if( settings.showSliderBar ){
				$(this).find(".sl-Timer").css({display: "block"});
			};
						
			//wrap slides
			if( settings.fullScreen ){
				$(this).find(settings.slideItemClass).wrapAll('<div class="slides" style="height:' + settings.height + 'px; width:100%; position:relative; margin: 0 auto;" />');
			} else {
				$(this).find(settings.slideItemClass).wrapAll('<div class="slides" style="height:' + settings.height + 'px; width:' + settings.width + 'px; position:relative; margin: 0 auto;" />');
			};
			
			//give each its own ID
			$(this).find(settings.slideItemClass).each(function(){
				var idN = $(this).index() + 1;
				$(this).attr("id", $this.attr("id") + "-slide-" + idN);
			});
			
			if( settings.effect == "fromRight" || settings.effect == "fromLeft" || settings.effect == "fromTop" || settings.effect == "fromBottom" || settings.effect == "slide" ){
				//console.log("set overflow for " + $(this).attr("id"));
				$(this).find(".slides").css({overflow: "hidden"});
			};
			
			//set slide positions and sizes
			$(this).css({position: "relative"});
			$(this).find(settings.slideItemClass).each(function(){
				if( settings.fullScreen ){
					$(this).css({position: "absolute", top: "0px", left: "0px", width: "100%", height: settings.height + "px"});
				} else {
					$(this).css({position: "absolute", top: "0px", left: "0px", width: settings.width + "px", height: settings.height + "px"});
				};
			});
			
			
			
			if( settings.containerWidth ){
				$(this).css({width: settings.containerWidth});
				$(this).find(".slides").css({width: settings.containerWidth});
				$(this).find(settings.slideItemClass).each(function(){
					$(this).css({width: settings.containerWidth});
				});
			};
			
			//add active to first
			$(this).find(settings.slideItemClass + ":first").addClass("active");
			
			
			//set slide positions/visibility/other options
			if( settings.effect == "fade" ){
				$(this).find(settings.slideItemClass).not($(this).find(settings.slideItemClass + ".active")).fadeTo(0,0).hide();
			
			} else if( settings.effect == "customPlans" ){
				$(this).find(settings.slideItemClass).css({textAlign: "center"});
				$(this).find(settings.slideItemClass).not($(this).find(settings.slideItemClass + ".active")).css({opacity: "0"});
				
			} else if( settings.effect == "fromRight" ){
				$(this).find(settings.slideItemClass).not($(this).find(settings.slideItemClass + ".active")).css({left: settings.width + "px"});
				
			} else if( settings.effect == "slide" ){
				$(this).find(settings.slideItemClass).not($(this).find(settings.slideItemClass + ".active")).css({left: settings.width + "px"});
				
				
			} else if( settings.effect == "parallax" ){
				$(this).find(".pItem").each(function(){
					$(this).attr("data-left", $(this).position().left);
					$(this).attr("data-top", $(this).position().top);
					
					if( !$(this).hasClass("nowidth") ){
						$(this).css({width: $(this).width()+"px"});
					};
					
					//check if full screen and only apply it to a item with bg
					if( settings.fullScreen ){
						if( $(this).hasClass("bg") ){
							$(this).css({width: "100%"});
						};
					};
				});
				$(this).find(".pItem").not($(this).find(settings.slideItemClass + ".active .pItem")).each(function(){
					$(this).css({left: $(window).width()});
					if( $(this).attr("data-effectIn") == "fade" ){
						$(this).fadeTo(0,0);
					};
				});
				
			} else {
				//more here
			};
			
			//build thumbs
			if( settings.addThumbContainer ){
				$(this).prepend('<div style="position:relative; margin: 0 auto; width:'+ settings.thumbContainerWidth +'px;"><div class="' + settings.thumbWrap.substring(1) +'"></div></div>');
			} else {
				$(this).prepend('<div class="' + settings.thumbWrap.substring(1) +'"></div>');
			};
			
			//build loading screen
			if( settings.showLoading ){
				var leftLoading = "-" + ($(window).width() - settings.width) / 2;
				$(this).prepend('<div class="'+ settings.loadingClass.slice(1) +'"></div>');
				$(this).find(settings.loadingClass).css({width: $(window).width(), left: leftLoading+"px"});
			};
			
			
			$(this).find(settings.slideItemClass).each(function(){
				$(this).closest(".sliderfy").find(settings.thumbWrap).prepend('<div class="'+ settings.thumbItemClass.substring(1) +'"></div>');
			});
			
			if( settings.showThumbText ){
				$(this).find(settings.thumbWrap + " " + settings.thumbItemClass).each(function(){
					var number = parseInt($(this).index()) + 1;
					$(this).text(number);
				});
			};
			
			//if custom thumb text
			if( settings.showThumbCustomText ){
				$(this).find(settings.thumbWrap + " " + settings.thumbItemClass).each(function(){
					var index 		= $(this).index();
					var thumbText 	= $this.find(settings.slideItemClass).eq(index).attr("data-thumb-text");
					$(this).text(thumbText);
				});
			};
			
			//give each its own ID (used in Custom effect mode)
			$(this).find(settings.thumbItemClass).each(function(){
				var idN = $(this).index() + 1;
				$(this).attr("id",  $this.attr("id") + "-thumb-" + idN);
			});
			
			
			
			
			//build prev/next
			if( settings.showPrevNext ){
				if( settings.showPrevNextText ){
					$(this).prepend('\
						<div class="' + settings.nextClass.substring(1) + ' pnBtns">' + settings.nextText + '</div>\
						<div class="' + settings.prevClass.substring(1) + ' pnBtns">' + settings.prevText + '</div>\
					');
				} else {
					if( settings.showPrevNextFadeThis ){
						$(this).prepend('\
							<div class="' + settings.nextClass.substring(1) + ' pnBtns fadeThis"><span class="hover" style="opacity: 0;"></span></div>\
							<div class="' + settings.prevClass.substring(1) + ' pnBtns fadeThis"><span class="hover" style="opacity: 0;"></span></div>\
						');
					} else {
						if( settings.addPrevNextContainer ){
							$(this).prepend('\
								<div class="container">\
									<div class="' + settings.nextClass.substring(1) + ' pnBtns"><div class="slNextBtn"></div></div>\
									<div class="' + settings.prevClass.substring(1) + ' pnBtns"><div class="slPrevBtn"></div>\
								</div>\
							');

						} else {
							$(this).prepend('\
								<div class="' + settings.nextClass.substring(1) + ' pnBtns"><div class="slNextBtn"></div></div>\
								<div class="' + settings.prevClass.substring(1) + ' pnBtns"><div class="slPrevBtn"></div>\
							');
						};
					};
				};
				
			};
			
			
			if( settings.customPrevNext ){
				$(".pnBtns").fadeTo(0,.3);
				$(".pnBtns").hover(function(){
					$(this).stop().fadeTo(300,1);
				}, function(){
					$(this).stop().fadeTo(300,.3);
				});
			};
			
			//set active thumb
			$(this).find(settings.thumbWrap + " " + settings.thumbItemClass + ":first").addClass("active");
			
			//hide thumbs?
			if( !settings.thumbsVisible ){$(this).find(settings.thumbWrap).css({display: "none"})};
			
			
			
			//hide others except first (so people can click links and stuff)
			$(this).find(settings.slideItemClass).not($(settings.slideItemClass + ".active")).hide();
			
					
			//pause on hover
			$(this).hover(function(){
				if( settings.pauseOnHover ){
					$(this).find(".sl-Timer .sl-TimerBar").pause();
					if(settings.debug){console.log($(this).attr('class') + " paused")};
				};
				
			}, function(){
				if( settings.pauseOnHover ){
					$(this).find(".sl-Timer .sl-TimerBar").resume();
					if(settings.debug){console.log($(this).attr('class') + " resumed")};
				};
				
			});
			
			
			
			//full screen item testing
			$(this).find(settings.slideItemClass).each(function(){
				var width = $(window).width();
				var left = "-" + (parseInt(width) - parseInt(settings.width)) / 2;
				
				if( $(this).hasClass("active") ){
					$(this).find(".fs").css({left: left + "px"}).attr("data-left", left);
				} else {
					$(this).find(".fs").attr("data-left", left);
				};
				
				$(this).find(".fs img").css({width: width});
			});
			
			$(window).resize(function(){
				$this.find(settings.slideItemClass).each(function(){
					var width = $(window).width();
					var left = "-" + (parseInt(width) - parseInt(settings.width)) / 2;
					
					if( $(this).hasClass("active") ){
						$(this).find(".fs").css({left: left + "px"}).attr("data-left", left);
						$(this).find(".fs").find("img").css({width: width});
					} else {
						$(this).find(".fs").attr("data-left", left);
						$(this).find(".fs").find("img").css({width: width});
					};
				});
				
				if( settings.effect == "parallax" ) {
					$this.find(settings.slideItemClass + " .pItem").not($this.find(settings.slideItemClass +".active .pItem")).each(function(){
						var moveAmount = settings.width + ((parseInt($(window).width()) - parseInt(settings.width)) / 2) + parseInt($(this).width());
						//console.log(moveAmount);
						$(this).css({left: moveAmount + "px"});
					});
				};
				
			});
			
			
			//change slide function
			function changeSlide(which){
				working = true;
				
				var currentSlide 	= $this.find(settings.slideItemClass + ".active");
				var nextSlide 		= $this.find(settings.slideItemClass).eq(which);
				var cI 				= $this.find(settings.slideItemClass).index(currentSlide);
				
				//if( settings.effect == "custom" ){
					//nextSlide = currentSlide.next(settings.slideItemClass)
					//if( nextSlide.length == 0 ){ nextSlide = $this.find(settings.slideItemClass + ":first")};
				//} else {
					if( which == "next" ){nextSlide = currentSlide.next(settings.slideItemClass)}
					if( which == "prev" ){nextSlide = currentSlide.prev(settings.slideItemClass)}
					if( which == "next" ){if( nextSlide.length == 0 ){ nextSlide = $this.find(settings.slideItemClass + ":first")}}
					if( which == "prev" ){if( nextSlide.length == 0 ){ nextSlide = $this.find(settings.slideItemClass + ":last")}}
				//};
				
				var nI = $this.find(settings.slideItemClass).index(nextSlide);
				
				if( firstSlide == 1 ){
					//do nothing
					firstSlide = 0;
				} else {
					$this.find(settings.thumbWrap + " " + settings.thumbItemClass).eq(cI).removeClass("active");
					$this.find(settings.thumbWrap + " " + settings.thumbItemClass).eq(nI).addClass("active");
				};
				
				currentSlide.removeClass("active");
				nextSlide.addClass("active");
				
				$(".slBtn.active").removeClass("active").find("span.hover").stop().fadeTo(300,0);
				$(".btn" + nI).addClass("active").find("span.hover").stop().fadeTo(300,1);
				
				//if fade
				if( settings.effect == "fade" ){
					currentSlide.stop().fadeTo(settings.animationInterval,0, function(){
						$(this).hide();
					});
					
					nextSlide.css({left: "0px"}).fadeTo(0,0).stop().fadeTo(settings.animationInterval,1, function(){
						if(settings.autoPlay){
							startSlider();
						} else {
							working = false;
						};
					});
					
				
				//if fromRight
				} else if( settings.effect == "fromRight" ){
					currentSlide.stop().animate({left: "-" + settings.width + "px"}, settings.animationInterval);
					nextSlide.stop().css({left: settings.width + "px", opacity: "1"}).show().animate({left: "0" + "px"}, settings.animationInterval, function(){
						if(settings.autoPlay){
							startSlider();
						} else {
							working = false;
						};
					});
					
					
				//if fromLeft
				} else if( settings.effect == "fromLeft" ){
					currentSlide.stop().animate({left: settings.width + "px"}, settings.animationInterval);
					nextSlide.stop().css({left: "-" + settings.width + "px", opacity: "1"}).animate({left: "0" + "px"}, settings.animationInterval, function(){
						if(settings.autoPlay){
							startSlider();
						} else {
							working = false;
						};
					});
					
					
				
				//if slide (new!)
				} else if( settings.effect == "slide" ){
					if( which == "prev" ){
						currentSlide.stop().animate({left: settings.width + "px"}, settings.animationInterval);
						nextSlide.stop().css({left: "-" + settings.width + "px", opacity: "1"}).show().animate({left: "0px"}, settings.animationInterval, function(){
							if( settings.autoPlay ){
								startSlider();
							} else {
								working = false;
							};
						});
					} else {
						currentSlide.stop().animate({left: "-" + settings.width + "px"}, settings.animationInterval);
						nextSlide.stop().css({left: settings.width + "px", opacity: "1"}).show().animate({left: "0" + "px"}, settings.animationInterval, function(){
							if(settings.autoPlay){
								startSlider();
							} else {
								working = false;
							};
						});
					};
					
				//if fromTop
				} else if( settings.effect == "fromTop" ){
					currentSlide.stop().animate({top: settings.height + "px"}, settings.animationInterval);
					nextSlide.stop().css({top: "-" + settings.height + "px", left: "0px"}).animate({top: "0px"}, settings.animationInterval, function(){
						if(settings.autoPlay){
							startSlider();
						} else {
							working = false;
						};
					});
					
					
				//if fromBottom
				} else if( settings.effect == "fromBottom" ){
					currentSlide.stop().animate({top: "-" + settings.height + "px"}, settings.animationInterval);
					nextSlide.stop().css({left: "0px", top: settings.height + "px"}).animate({top: "0px"}, settings.animationIterval, function(){
						if(settings.autoPlay){
							startSlider();
						} else {
							working = false;
						};
					});
					
				
				//if custom
				} else if( settings.effect == "custom" ){
					
					if( which == "next" ){
						nextSlide.stop().css({transform: "rotate(-179deg)"}).show();
						currentSlide.stop().animate({transform: "rotate(180deg)"}, function(){
							$(this).hide();
						});
						nextSlide.stop().animate({transform: "rotate(0deg)"}, function(){
							if(settings.autoPlay){
								startSlider();
							} else {
								working = false;
							};
						});
					} else if( which == "prev" ){
						nextSlide.stop().css({transform: "rotate(180deg)"}).show();
						currentSlide.stop().animate({transform: "rotate(-180deg)"}, function(){
							$(this).hide();
						});
						nextSlide.stop().animate({transform: "rotate(0deg)"}, function(){
							if(settings.autoPlay){
								startSlider();
							} else {
								working = false;
							};
						});
					};
					
				
				//if customPlans	
				} else if( settings.effect == "customPlans" ){
					currentSlide.stop().fadeTo(settings.animationInterval,0);
					
					nextSlide.show();
					nextSlide.find("img").css({width: "450px", height: "464px"});
					
					nextSlide.stop().animate({left: "0px", top: "0px", opacity: "1"}, settings.animationInterval, function(){
						if(settings.autoPlay){
								startSlider();
							} else {
								working = false;
							};
					});
					nextSlide.find("img").stop().animate({width: "430px", height: "444px"});
						
					
				
				//if parallax
				} else if( settings.effect == "parallax" ){
					
					currentSlide.find(".pItem").each(function(){
						var delayOut		= $(this).attr("data-delayOut");
						var speed 			= parseInt($(this).attr("data-speedOut"));
						var effectOut		= $(this).attr("data-effectOut");
						var moveAmount 		= (($(window).width() - parseInt(settings.width)) / 2) + $(this).width(); 
						var moveTopAm		= $this.height();
						var resetAmount 	= parseInt(settings.width) + (($(window).width() - parseInt(settings.width)) / 2) + 50;
						//var leftHidePos 	= "-" + (($(window).width() - parseInt(settings.width)) / 2) - $(this).width();
						var leftHidePos		= 0 - (parseInt($(window).width()) + parseInt($(this).width()));
						//console.log(leftHidePos);
						var topHidePos		= "-" + $(this).height();
						var rightHidePos	= parseInt(settings.width) + (($(window).width() - parseInt(settings.width)) / 2) + 50;
						//var rightHidePos	= parseInt($(window).width());
						
						
						//if fade
						if ( effectOut == "fade" ){
							
							$(this).stop().delay(delayOut).fadeTo(speed, 0, function(){
								//to prevent the callback from firing everytime
								//this is fired after every animation in a slide, we add a class 'done' and reset the item
								$(this).addClass("done").css({left: resetAmount + "px"});
								var amount 	= currentSlide.find(".pItem").length;
								var done	= currentSlide.find(".done").length;
								
								//then we count the amount of items 'done' and match it to the total amount of items we needed to animate. if it matches, THEN do the actual callback.
								//there might be a better way to do this, if there is, please email rick@561media.com
								if( done == amount ){
									currentSlide.stop().fadeTo(300,0, function(){
										$(this).hide();
										nextSlideAnimation();
									});
								};
							});
							
						
						//if toBottom
						} else if( effectOut == "toBottom" ){
							$(this).stop().delay(delayOut).animate({top: moveTopAm + "px"}, speed, function(){
								//since this is fired after every animation in a slide, we add a class 'done' and reset the item
								$(this).addClass("done").css({left: resetAmount + "px"});
								var amount 	= currentSlide.find(".pItem").length;
								var done	= currentSlide.find(".done").length;
								
								//then we count the amount of items 'done' and match it to the total amount of items we needed to animate. if it matches, THEN do the actual callback.
								//there might be a better way to do this, if there is, please email rick@561media.com
								if( done == amount ){
									currentSlide.stop().fadeTo(300,0, function(){
										$(this).hide();
										nextSlideAnimation();
									});
								};
							});
							
							
						//if toRight
						} else if( effectOut == "toRight" ){
							$(this).stop().delay(delayOut).animate({left: rightHidePos + "px"}, speed, function(){
								//since this is fired after every animation in a slide, we add a class 'done' and reset the item
								$(this).addClass("done").css({left: resetAmount + "px"});
								var amount 	= currentSlide.find(".pItem").length;
								var done	= currentSlide.find(".done").length;
								
								//then we count the amount of items 'done' and match it to the total amount of items we needed to animate. if it matches, THEN do the actual callback.
								//there might be a better way to do this, if there is, please email rick@561media.com
								if( done == amount ){
									currentSlide.stop().fadeTo(300,0, function(){
										$(this).hide();
										nextSlideAnimation();
									});
								};
							});
							
							
						} else if( effectOut == "toLeft" ){
							$(this).stop().delay(delayOut).animate({left: leftHidePos + "px"}, speed, function(){
								//since this is fired after every animation in a slide, we add a class 'done' and reset the item
								$(this).addClass("done").css({left: resetAmount + "px"});
								var amount 	= currentSlide.find(".pItem").length;
								var done	= currentSlide.find(".done").length;
								
								//then we count the amount of items 'done' and match it to the total amount of items we needed to animate. if it matches, THEN do the actual callback.
								//there might be a better way to do this, if there is, please email rick@561media.com
								if( done == amount ){
									currentSlide.stop().fadeTo(300,0, function(){
										$(this).hide();
										nextSlideAnimation();
									});
								};
							});


						//if toTop						
						} else if( effectOut == "toTop" ){
							$(this).stop().delay(delayOut).animate({top: topHidePos + "px"}, speed, function(){
								//since this is fired after every animation in a slide, we add a class 'done' and reset the item
								$(this).addClass("done");
								var amount 	= currentSlide.find(".pItem").length;
								var done	= currentSlide.find(".done").length;
								
								//then we count the amount of items 'done' and match it to the total amount of items we needed to animate. if it matches, THEN do the actual callback.
								//there might be a better way to do this, if there is, please email rick@561media.com
								if( done == amount ){
									currentSlide.stop().fadeTo(300,0, function(){
										$(this).hide();
										nextSlideAnimation();
									});
								};
							});
							
							
						//if fadeToRight
						} else if( effectOut == "fadeToRight" ){
							
							//$(this).stop().delay(delayOut).animate({});
						};
						
						function nextSlideAnimation(){
							if(settings.debug){console.log("next start")};
							
							//check if fi is there, if so, remove.
						    if ($this.find(".fi").length) {
						        $this.find(".fi").remove();
						    };
							
							
							currentSlide.find(".pItem").removeClass("done");
							//currentSlide.hide();
							nextSlide.stop().fadeTo(300,1, function(){
								nextSlide.find(".pItem").each(function(){
									var delayIn			= $(this).attr("data-delayIn");
									var speed 			= parseInt($(this).attr("data-speedIn"));
									var left			= $(this).attr("data-left");
									var top				= $(this).attr("data-top");
									var effectIn		= $(this).attr("data-effectIn");
									//var leftHidePos 	= "-" + (($(window).width() - parseInt(settings.width)) / 2) - $(this).width();
									//console.log($(this).width());
									var leftHidePos		= 0 - (parseInt($(window).width()) + parseInt($(this).width()));
									//console.log("omg " + $(window).width() + " | " + $(this).width());
									var topHidePos		= "-" + $(this).height();
									var rightHidePos	= parseInt(settings.width) + (($(window).width() - parseInt(settings.width)) / 2) + 50;
									var easing			= $(this).attr("data-easingIn");
									
									//default options if nothing is defined
									if( !delayIn ){delayIn = "0"};
									if( !speed ){speed = "400"};
									if( !easing ){easing = "swing"};
									
									//if fromRight
									if( effectIn == "fromRight" ){
										if( settings.debug ){console.log("from right")};
										
										$(this).css({left: rightHidePos + "px", top: top + "px", opacity: "1"});
										$(this).stop().delay(delayIn).animate({left: left + "px"}, speed, easing, function(){
											$(this).addClass("done");
											var amount 	= nextSlide.find(".pItem").length;
											var done	= nextSlide.find(".done").length;
											if( done == amount ){
												nextSlide.find(".pItem").removeClass("done");
												if(settings.autoPlay){
													startSlider();
												} else {
													working = false;
												};
											};
										});
										
										
									//if fromBottom
									} else if( effectIn == "fromBottom" ){
										if( settings.debug ){console.log("from bottom")};
										
										$(this).css({left: left + "px", top: moveTopAm + "px", opacity: "1"});
										$(this).stop().delay(delayIn).animate({top: top + "px"}, speed, easing, function(){
											$(this).addClass("done");
											var amount 	= nextSlide.find(".pItem").length;
											var done	= nextSlide.find(".done").length;
											if( done == amount ){
												nextSlide.find(".pItem").removeClass("done");
												if(settings.autoPlay){
													startSlider();
												} else {
													working = false;
												};
											};
										});
										
										
									//if fromLeft
									} else if( effectIn == "fromLeft" ){
										if( settings.debug ){console.log("from left")};
										
										$(this).css({left: leftHidePos + "px", top: top + "px", opacity: "1"});
										$(this).stop().delay(delayIn).animate({left: left + "px"}, speed, easing, function(){
											$(this).addClass("done");
											var amount 	= nextSlide.find(".pItem").length;
											var done	= nextSlide.find(".done").length;
											if( done == amount ){
												nextSlide.find(".pItem").removeClass("done");
												if(settings.autoPlay){
													startSlider();
												} else {
													working = false;
												};
											};
										});
										
										
									//if fromTop
									} else if( effectIn == "fromTop" ){
										if( settings.debug ){console.log("from top")};
										
										$(this).css({left: left + "px", top: topHidePos + "px", opacity: "1"});
										$(this).stop().delay(delayIn).animate({top: top + "px"}, speed, easing, function(){
											$(this).addClass("done");
											var amount 	= nextSlide.find(".pItem").length;
											var done	= nextSlide.find(".done").length;
											if( done == amount ){
												nextSlide.find(".pItem").removeClass("done");
												if(settings.autoPlay){
													startSlider();
												} else {
													working = false;
												};
											};
										});
										
										
									//if fade
									} else if( effectIn == "fade" ){
										if( settings.debug ){console.log("fade")};
										
										$(this).css({left: left + "px", top: top + "px", opacity: "0"});
										$(this).stop().delay(delayIn).fadeTo(speed,1, function(){
											$(this).addClass("done");
											var amount 	= nextSlide.find(".pItem").length;
											var done	= nextSlide.find(".done").length;
											if( done == amount ){
												nextSlide.find(".pItem").removeClass("done");
												if(settings.autoPlay){
													startSlider();
												} else {
													working = false;
												};
											};
										});
									};
									
									
								});
							});
							

						};
					});
				};
				
				
			};
			
			//start function
			function startSlider(){
				working = false;
				$this.find(".sl-Timer .sl-TimerBar").css({width: "1px"});
					$this.find(".sl-Timer .sl-TimerBar").stop().animate({width: "200px"}, settings.sliderInterval, "linear", function(){
						changeSlide("next");
					});
				
			};
			
			if( settings.showLoading ){
				var thisIMGs = "#" + $this.attr("id") + " img";
				$(thisIMGs).load(function(){
					$this.find(settings.loadingClass).stop().fadeTo(0,0, function(){
						$(this).remove();
						if( settings.animateFirstSlide ){
							firstSlide = 1;
							animateFirstSlide();
						} else {
							//if(settings.autoPlay){startSlider()};
						};
					});
				});
			} else {
				if( settings.animateFirstSlide ){
					firstSlide = 1;
					animateFirstSlide();
				} else {
					if(settings.autoPlay){
						startSlider();
					} else {
						working = false;
					};
				};
			};
			
			
			
			//animate first Slide
			$this.on('animateFirstSlide', function(e) {
				animateFirstSlide();
			});
			
			$this.on('nextBtn', function () {
				if( !working ){
				    changeSlide("next");
				};
			});
			$this.on('prevBtn', function () {
				if( !working ){
				    changeSlide("prev");
				};
			});
			
			$this.on('pauseSlider', function(e) {
				//$this.find(".sl-Timer .sl-TimerBar").stop().css({width: "1px"});
				$this.find(".sl-Timer .sl-TimerBar").pause();
			});
			$this.on('resumeSlider', function(e) {
				$this.find(".sl-Timer .sl-TimerBar").resume();
			});
			
			//thumbs click
			$(this).find(settings.thumbWrap + " " + settings.thumbItemClass).click(function(){
				if( !working ){
					if( $(this).hasClass("active") ){
						//do nothing
					} else {
						$this.find(".sl-Timer .sl-TimerBar").css({width: "1px"});
						$this.find(settings.thumbItemClass + ".active").removeClass("active");
						//$(this).stop().animate({height: "20px"}).addClass("active");
						var wi = $(this).index()
						changeSlide(wi);
					};
				};
			});
			
			
			
			//prev/next click
			$(this).find(settings.prevClass).click(function(){
				if( !working ){
					changeSlide("prev");
				};
			});
			
			$(this).find(settings.nextClass).click(function(){
				if( !working ){
					changeSlide("next");
				};
			});
			
			
			function animateFirstSlide(){
				 $this.find(settings.slideItemClass + ".active .pItem").each(function () {
			        $(this).css({ left: $(window).width() + "px" });
			    });
			    $this.find(settings.slideItemClass + ".active").removeClass("active");
			    $this.find(".slides").prepend('<div class="' + settings.slideItemClass.slice(1) + ' active fi"><div class="pItem" data-effectIn="fade" data-effectOut="fade" data-delayIn="0" data-delayOut="0" data-speedIn="0" data-speedOut="0"></div></div>');
			    changeSlide("next");
			};
			
			
			//key press events
			if( settings.useArrowKeys ){
				$("body").keyup(function(event){
					//39 = right key
					//37 = left key
					if( event.which == 39 ){
						if( !working ){
							$this.find(".sl-Timer .sl-TimerBar").stop().css({width: "1px"});
							changeSlide("next");
							event.preventDefault();
						};
					};
					if( event.which == 37 ){
						if( !working ){
							$this.find(".sl-Timer .sl-TimerBar").stop().css({width: "1px"});
							changeSlide("prev");
							event.preventDefault();
						};
					};
				});
			};
		});
		
		
    };
}(jQuery));
