/**
 *	Custom jQuery Scripts
 *	
 *	Developed by: Austin Crane	
 *	Designed by: Austin Crane
 */

jQuery(document).ready(function ($) {

	$(".js-select,.address_state select").select2({
		placeholder: "Select...",
	    allowClear: true
	}).on("select2:unselecting", function(e) {
	    $(this).data('state', 'unselected');
	    $('input.allow-reset').val("");
	}).on("select2:open", function(e) {
	    if ($(this).data('state') === 'unselected') {
	        $(this).removeData('state'); 
	        var self = $(this);
	        setTimeout(function() {
	            self.select2('close');
	        }, 1);
	    }    
	});

	/*
	*
	*	Responsive iFrames
	*
	------------------------------------*/
	var $all_oembed_videos = $("iframe[src*='youtube']");
	
	$all_oembed_videos.each(function() {
	
		$(this).removeAttr('height').removeAttr('width').wrap( "<div class='embed-container'></div>" );
 	
 	});
	
	/*
	*
	*	Flexslider
	*
	------------------------------------*/
	$('.slideshow').flexslider({
		animation: "slide",
		selector: ".sliders > li",
		slideshowSpeed: 4800,
		animationSpeed: 600
	}); // end register flexslider
	
	$('.project-slideshow').flexslider({
		animation: "fade",
		selector: ".sliders > li",
	});

	/*
	*
	*	Colorbox
	*
	------------------------------------*/
	$('a.gallery').colorbox({
		rel:'gal',
		width: '80%', 
		height: '80%'
	});

	
	/*
	*
	*	Equal Heights Divs
	*
	------------------------------------*/
	$('.js-blocks').matchHeight();

	/*
	*
	*	Wow Animation
	*
	------------------------------------*/
	new WOW().init();

	$(document).on("click","#toggleMenu",function(e){
		e.preventDefault();
		$(this).toggleClass('open');
		$('.mobile-navigation').toggleClass('open');
		$('body').toggleClass('open-mobile-menu');
		$("#site-navigation").toggleClass('open-menu');
	});

	$(document).on("click","#mobileCatSelect",function(e){
		e.preventDefault();
		$("ul.categories").toggleClass('open');
	});

	if( $("ul.categories ul li.active").length > 0 ) {
		$("ul.categories ul li.active").each(function(){
			$(this).parents('li.catlink').addClass('active');
		});
	}


	/* Careers */
	side_horizontal_line ();
	function side_horizontal_line () {
		if( $(".careers-content").length ) {
			var content_width = $("#content").outerWidth();
			var title_width = $("#titlewrap").outerWidth();
			var cw = parseInt(content_width);
			var tw = parseInt(title_width);
			var remain = cw-tw;
			var side_width = remain/2;
			$(".sidehline").css('width',side_width+'px');

			var video_wrap = $(".video-wrapper").outerHeight();
			var video_width = $("#video").outerHeight();
			var va = parseInt(video_width);
			var vb = parseInt(video_wrap);
			var w1 = va - vb;
			var w2 = w1/2;
			$("#vidwrap").css('top','-'+w2+'px');
		}
	}

	$( window ).resize(function() {
	  side_horizontal_line ();
	});

	$(document).on("click","#menutoggle2",function(e){
		e.preventDefault();
		$("#navi2").toggleClass("open");
	});

	window.onload = function() {
		/* CAREERS MAIN VIDEO */
		if( $('#video').length ) {
			// Video
			var video = document.getElementById("video");
			var playPromise = document.getElementById('video');
			// if (playPromise !== undefined) {
			//     playPromise.then(_ => {
			//       // Automatic playback started!
			//       // Show playing UI.
			//     })
			//     .catch(error => {
			//       // Auto-play was prevented
			//       // Show paused UI.
			//     });
  	// 		}


			// Buttons
			var playButton = document.getElementById("play-pause");

			// Event listener for the play/pause button
			playButton.addEventListener("click", function() {
			  if (video.paused == true) {
			    // Play the video
			    video.play();

			    // Update the button text to 'Pause'
			    playButton.innerHTML = "Pause";
			    playButton.classList.add("pause");
			    playButton.classList.remove("play");
			  } else {
			    // Pause the video
			    video.pause();

			    // Update the button text to 'Play'
			    playButton.innerHTML = "Play";
			    playButton.classList.add("play");
			    playButton.classList.remove("pause");
			  }
			});

		}

		if( $('.locVideo').length ) {
			// var locvideo = document.getElementsByClassName("video");
			// document.getElementById('video').play();
			$('.locVideo').each(function(){
				var vId = $(this).find('.locationvideo').attr("id");
				var ivideo = document.getElementById(vId);
				var iplayBtn = $(this).find(".playpauseBtn");
				iplayBtn.on("click",function(){
					if (ivideo.paused == true) {
						ivideo.play();
						iplayBtn.text('Pause');
						iplayBtn.addClass('pause');
						iplayBtn.removeClass('play');
					} else {
						ivideo.pause();
						iplayBtn.text('Play');
						iplayBtn.addClass('play');
						iplayBtn.removeClass('pause');
					}
				});
			});
		}
	}

	/* Testimonials */
	$('#testimonials').flexslider({
		animation: "slide",
		animationLoop: false,
		directionNav: true,
		itemMargin: 5,
		minItems: 1
	});

	/* Smooth Scrolling */
	$('a[href*="#"]').not('[href="#"]').not('[href="#0"]').click(function(event) {
		if (
		  location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
		  && 
		  location.hostname == this.hostname
		) {
		  // Figure out element to scroll to
		  var headerHeight = parseInt($('#masthead .top-info').outerHeight());
		  var target = $(this.hash);
		  target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
		  // Does a scroll target exist?
		  if (target.length) {
		    // Only prevent default if animation is actually gonna happen
		    //event.preventDefault();
		    $('html, body').animate({
		      scrollTop: target.offset().top
		    }, 1000, function() {
		      // Callback after animation
		      // Must change focus!
		      var $target = $(target);
		      $target.focus();
		      if ($target.is(":focus")) { // Checking if the target was focused
		        return false;
		      } else {
		        $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
		        $target.focus(); // Set focus again
		      };
		    });
		  }
		}
	});

	$(window).on('load', function(){        
      if( location.hash && location.hash.length ) {
        var xhash = location.hash;
        var target = $(xhash);
        var offsetHeight = $('#masthead .top-info').outerHeight();
        if (target.length) {

          $('html, body').animate({
            scrollTop: target.offset().top
          }, 1000, function() {
            var $target = $(target);
            //$target.focus();
            if ($target.is(":focus")) { 
              return false;
            } else {
              $target.attr('tabindex','-1'); 
              //$target.focus(); // Set focus again
            };
          });
        }
      }       
  });

});// END #####################################    END