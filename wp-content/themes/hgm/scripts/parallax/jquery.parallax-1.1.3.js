(function($) {
    $.fn.parallax = function(options) {
        var windowHeight = $(window).height();
        var settings = $.extend({
            speed: 0.15,
            coffset: "0",
            position: "center"
        }, options);
        return this.each(function() {
            var $this = $(this);
            $(document).scroll(function() {
				doP();
            });
			$(document).ready(function() {
                doP();
            });
			
			function doP(){
                var scrollTop = $(window).scrollTop();
				var cOffset = settings.coffset;
                var offset = $this.offset().top;
                var height = $this.outerHeight();
                if (offset + height <= scrollTop || offset >= scrollTop + windowHeight) return;
                var yBgPosition = Math.round((offset - scrollTop) * settings.speed) + parseInt(settings.coffset);
                $this.css('background-position', settings.position + ' ' + yBgPosition + 'px');
			}
        });
    };
}(jQuery));