
var slider = $("#slider");
    var thumb = $("#thumbs");
    var slidesPerPage = 4; //globaly define number of elements per page
    var syncedSecondary = true;

    slider.owlCarousel({
        items: 1,
        slideSpeed: 2000,
        nav: false,
        autoplay: false, 
        dots: false,
        center: true,
        margin: 0,
        responsiveClass: true,
        rtl: true,
        loop: true,
        responsiveRefreshRate: 200
    }).on('changed.owl.carousel', syncPosition);

    thumb
        .on('initialized.owl.carousel', function() {
            thumb.find(".owl-item").eq(0).addClass("current");
            thumb.find(".owl-item .thumb").eq(0).addClass("active");
        })

        .owlCarousel({
            items: slidesPerPage,
            dots: false,
            nav: true,
            responsiveClass: true,
            rtl: true,
            item: 4,
            smartSpeed: 200,
            slideSpeed: 500,
            slideBy: slidesPerPage, 
            mouseDrag: false,
            navText: ['<svg width="18px" height="18px" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 2px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>', 
            '<svg width="25px" height="25px" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 2px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>'],
            responsiveRefreshRate: 100
        })
          
        function syncPosition(el) 
        {
            var count = el.item.count - 1;
            var current = Math.round(el.item.index - (el.item.count / 2) - .5);
            if (current < 0) {
                current = count;
            }
            if (current > count) {
                current = 0;
            }
            thumb
                .find(".owl-item")
                .removeClass("current")
                .eq(current)
                .addClass("current")
            ;
            thumb.find(".owl-item .thumb").removeClass("active");
            thumb.find(".owl-item .thumb").eq(current).addClass("active");

            var onscreen = thumb.find('.owl-item.active').length - 1;
            var start = thumb.find('.owl-item.active').first().index();
            var end = thumb.find('.owl-item.active').last().index();
   
            if (current > end) {
                    thumb.data('owl.carousel').to(current, 100, true);
            }
            if (current < start) {
                thumb.data('owl.carousel').to(current - onscreen, 100, true);
            }

        }

        thumb.on("click", ".owl-item", function(e) {          
            e.preventDefault();
            var number = $(this).index();
            slider.data('owl.carousel').to(number, 300, true);
       }) 
    ;

    
/* */
    $('.product-image .image')
    .on('mouseover', function() {
      $(this).css('transform', 'scale(2)');
    })
    .on('mouseout', function() {
      $(this).css('transform', 'scale(1.0)');
    })
    .on('mousemove', function(e){
        $(this).css({'transform-origin': ((e.pageX - $(this).offset().left) / $(this).width()) * 50 + '% ' + ((e.pageY - $(this).offset().top) / $(this).height()) * 50 +'%'});
     });

/* */

/** */


$('.input-cart-number').on('keyup change', function(){
    $t = $(this);
    
    if ($t.val().length > 3) {
      $t.next().focus();
    }
    
    var card_number = '';
    $('.input-cart-number').each(function(){
      card_number += $(this).val() + ' ';
      if ($(this).val().length == 4) {
        $(this).next().focus();
      }
    })
    
    $('.credit-card-box .number').html(card_number);
  });
  
  $('#card-holder').on('keyup change', function(){
    $t = $(this);
    $('.credit-card-box .card-holder div').html($t.val());
  });
  
  $('#card-holder').on('keyup change', function(){
    $t = $(this);
    $('.credit-card-box .card-holder div').html($t.val());
  });
  
  $('#card-expiration-month, #card-expiration-year').change(function(){
    m = $('#card-expiration-month option').index($('#card-expiration-month option:selected'));
    m = (m < 10) ? '0' + m : m;
    y = $('#card-expiration-year').val().substr(2,2);
    $('.card-expiration-date div').html(m + '/' + y);
  })
  
  $('#card-ccv').on('focus', function(){
    $('.credit-card-box').addClass('hover');
  }).on('blur', function(){
    $('.credit-card-box').removeClass('hover');
  }).on('keyup change', function(){
    $('.ccv div').html($(this).val());
  });
  
  
  /*--------------------
  CodePen Tile Preview
  --------------------*/
  setTimeout(function(){
    $('#card-ccv').focus().delay(1000).queue(function(){
      $(this).blur().dequeue();
    });
  }, 500);
  
  /*function getCreditCardType(accountNumber) {
    if (/^5[1-5]/.test(accountNumber)) {
      result = 'mastercard';
    } else if (/^4/.test(accountNumber)) {
      result = 'visa';
    } else if ( /^(5018|5020|5038|6304|6759|676[1-3])/.test(accountNumber)) {
      result = 'maestro';
    } else {
      result = 'unknown'
    }
    return result;
  }
  
  $('#card-number').change(function(){
    console.log(getCreditCardType($(this).val()));
  })*/

/** */



/*
var $sliderSlides = $('.slider-photos .slides.owl-carousel'),
	$sliderThumbs = $('.slider-photos .slider-thumbs.owl-carousel'),
	speed = 700,
	activeClass = 'active';

	// Start Carousel
	$sliderSlides.owlCarousel({
			loop: true,
			items : 1,
			margin:0,
			nav : true,
			smartSpeed: speed
		})
		.on('click', '.owl-prev', function() {
			var i = $(this).index();
			var activeThumb = $sliderThumbs.find('.slide.active').parent();
			var all = $sliderThumbs.find('.owl-item').length - 1;

			if( activeThumb.prev().length ) {
				activeThumb.find('.slide').removeClass(activeClass);
				activeThumb.prev().find('.slide').addClass(activeClass);
				$sliderThumbs.trigger('to.owl.carousel', [i, speed, true]);
			} else {
				$sliderThumbs.find('.owl-item').eq(all).find('.slide').addClass(activeClass);
				$sliderThumbs.trigger('to.owl.carousel', [all, speed, true]);
			}

		})
		.on('click', '.owl-next', function() {
			var i = $(this).index();
			var activeThumb = $sliderThumbs.find('.slide.active').parent();

			if( activeThumb.next().length ) {
				activeThumb.find('.slide').removeClass(activeClass);
				activeThumb.next().find('.slide').addClass(activeClass);
				$sliderThumbs.trigger('to.owl.carousel', [i, speed, true]);
			} else {
				$sliderThumbs.find('.owl-item').eq(0).find('.slide').addClass(activeClass);
				$sliderThumbs.trigger('to.owl.carousel', [0, speed, true]);
			}
		});

	$sliderThumbs
		.owlCarousel({
			loop: true,
			margin: 0,
			items: 5,
			nav: true,
			smartSpeed: speed
		})
		.on('click', '.owl-item', function() {
			var i = $(this).index();

			$sliderThumbs.trigger('to.owl.carousel', [i, speed, true]);
			$sliderSlides.trigger('to.owl.carousel', [i, speed, true]);
		})

		// If the loop is disabled
		// .on('click', '.owl-next.disabled', function() {
		// 	$sliderThumbs.trigger('to.owl.carousel', [0, speed, true]);
		// })
		// .on('click', '.owl-prev.disabled', function() {
		// 	var last = $sliderThumbs.find('.owl-item').length;
		// 	$sliderThumbs.trigger('to.owl.carousel', [last, speed, true]);
		// })

		$('.slider-photos .counter .all').text( $('.slider-photos .slider-thumbs .slide').length );

		$sliderThumbs.find('.slide').on('click', function(event) {
			event.preventDefault();

			$sliderThumbs.find('.slide.active').removeClass(activeClass);
			$(this).addClass(activeClass);
		});
*/