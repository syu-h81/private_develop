jQuery(function($){

	var pagetop = $('#js-pagetop');
	var request = $('#js-request');	
	var activeClass = 'is-active';

	/**
	 * global nav
	 */
	$('#js-menu-button').click(function() {
		$(this).toggleClass(activeClass);
		$('#js-global-nav').slideToggle();		
		return false;
	});
	$('.menu-item-has-children > a span').click(function() {
		$(this).toggleClass(activeClass).closest('.menu-item-has-children').toggleClass(activeClass);
		$(this).parent('a').next('.sub-menu').slideToggle();
		return false;
	});

	/**
	 * pagetop
	 */
	pagetop.click(function() {
		$('body, html').animate({
			scrollTop: 0
		}, 1000);
		return false;
	});
  $(window).scroll(function() {
  	if ($(this).scrollTop() > 100) {
			pagetop.addClass(activeClass);
    } else {
			pagetop.removeClass(activeClass);
    }   
  }); 

	/**
	 * request
	 */

	if ($('#js-request').length) {
		
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				request.addClass(activeClass);
			} else {
				request.removeClass(activeClass);
			}
		});
		
		$('#js-request__close').click(function(event) {
			event.preventDefault();
			request.hide();
		});

	}

	/**
	 * widget
	 */
	if ($('.p-widget-dropdown').length) {
		$('.p-widget-dropdown__title').click(function() {
			$('.p-widget-dropdown__list').slideToggle();
		});
	}

	//category widget
	if ($('.collapse_category_list').length) {
		$(".collapse_category_list li").hover(function(){
			$(">ul:not(:animated)",this).slideDown("fast");
			$(this).addClass("active");
		}, function(){
			$(">ul",this).slideUp("fast");
			$(this).removeClass("active");
		});
	}

	/**
	 *  comment
	 */
	if ($('#js-comment__tab').length) {
		var commentTab = $('#js-comment__tab');
		commentTab.find('a').click(function() {
			if (!$(this).parent().hasClass(activeClass)) {
				$($('.is-active a', commentTab).attr('href')).animate({opacity: 'hide'}, 0);
				$('.is-active', commentTab).removeClass(activeClass);
				$(this).parent().addClass(activeClass);
				$($(this).attr('href')).animate({opacity: 'show'}, 1000);
			}
			return false;
		});
	}

	/**
	 * plan list
	 */
	var planListNum = plan.listNum;
	if ($('.p-content02').length && $('.p-content02__item').length > planListNum) {
		$('.p-content02').slick({
			//arrows: false,
			arrows: true,
			autoplay: true,
			slidesToShow: planListNum,
			responsive: [
				{
      		breakpoint: 768,
      		settings: 'unslick'
    		}
  		]
		});
		if ($('#js-splash').length) {
			$('.p-content02').slick('slickPause');
		}
    $(window).resize(function() {
      $('.p-content02').slick('resize');
    });
	}

	/**
	 * splash
	 */
	if ($('#js-splash').length) {

		// get display time of the splash page
		// translate the time from seconds into milliseconds
		var loadTime = $('#js-splash').data('display-time') * 1000 + 3500; // 3.5s is for animation of bg image, logo, catch
		var bodyHeight = $('body').height();
		$('#site_wrap').css('display', 'none')
		$('body').height(bodyHeight);

		// Display #site_wrap even if the document loading process is not over
		$(function() {
			setTimeout(function(){
				$('#site_wrap').css('display', 'block');
				if ($('.slick-slider').length) { 
					$('.slick-slider').slick('setPosition').delay(1400).slick('slickPlay'); 
				}
        if ($('#js-hero-header__content1 video').length) {
          $('#js-hero-header__content1 video').delay(1400).get(0).play();
        }
				$('body').height('');
				$('#js-splash').delay(600).fadeOut(800);
		  }, loadTime);
		});
	} else if (! $('#site_loader_overlay').length) {

    // Start playing a video if #js-hero-header__content1 has <video>
    if (! $('#js-splash').length && $('#js-hero-header__content1 video').length) {
      $('#js-hero-header__content1 video').get(0).play();
    }
  }

});	
