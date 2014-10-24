/*FbAlbumPreview jQuery Plugin by Mike Dalisay - http://codeofaninja.com/ */
(function ($) {

    $.fn.FbAlbumPreview = function (options) {

        // Create some defaults, extending them with any options that were provided
		// viewSpeed must be greater than fadeSpeed for at least 500 ms
        var settings = $.extend({
            'viewSpeed': 1000,
            'fadeSpeed': 500
        }, options);

        return this.each(function () {

            var t; //for play timeout
			var $fadeSpeed = settings.fadeSpeed;
			
			//to prevent fade on quick hover
			var $played = false;
			
            $(this).hover(function () {

                var $elem = $(this);
				
				t = setInterval( function(){
					
					//show all img
					$elem.find('IMG').show();
					
					var $active = $elem.find('IMG.active');

					if ( $active.length == 0 ){
						$active = $elem.find('IMG:last');
					}

					var $next =  $active.next().length 
						? $active.next()
						: $elem.find('IMG:first');

					$active.addClass('last-active');
						
					$next.css({opacity: 0.0})
						.addClass('active')
						.animate({opacity: 1.0}, $fadeSpeed, function() {
						
							// remove classes
							$active.removeClass('active last-active');
							
							//set played to true
							$played = true;
							
					});
						
				}, settings.viewSpeed );
				
				
            }, function () {
				
				//stopPreview
				clearInterval(t);
				
				if($played==true){
					
					var $elem = $(this);
				
					// hide images so we won't have weird effect
					// it will also make going to the first image (album cover) obvious
					$elem.find('img').hide();
					
					// remove the active class on the current active image
					$elem.find('IMG.active').removeClass('active')
					
					//the first image
					var $first = $elem.find('IMG:first').fadeOut($fadeSpeed).fadeIn($fadeSpeed).addClass('active');
					
					// set to false again
					$played = false;
				}
				
            });

        });

    };
})(jQuery);