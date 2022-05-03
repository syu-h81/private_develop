function init_post_list() {

	var maxPage = infinitescroll.max_num_pages;
	var finishedMsg = infinitescroll.finished_message;
	var imgPath = infinitescroll.image_path;
	var target = jQuery('.p-blog-list__item').length ? '.p-blog-list__item' : '.p-news-list__item';
	var $container = jQuery('#js-infinitescroll');

	$container.imagesLoaded(function(){


		jQuery(target, '#js-infinitescroll').each(function(i){
			jQuery(this).delay(i*150).queue(function(){
				jQuery(this).addClass('is-active').dequeue();
   		});
   	});
		$container.infinitescroll({
			navSelector  : '#js-load-post',
			nextSelector : '#js-load-post a',
			itemSelector : target,
			animate      : true,
			extraScrollPx: 150,
			maxPage: maxPage,
			loading: {
				msgText : 'LOADING...',
				finishedMsg : finishedMsg,
				img: imgPath
			}
		},
		// callback
		function(newElements, opts) {
			
			var $newElems = jQuery(newElements);
			
			$newElems.imagesLoaded(function(){
				$newElems.each(function(i){
					jQuery(this).delay(i*150).queue(function(){
						jQuery(this).fadeTo('slow', 1).dequeue();
					});
				});
			});
			if (opts.maxPage && opts.maxPage <= opts.state.currPage) {
				jQuery(window).off('.infscr');
				jQuery('#js-load-post').remove();
			}
		});
	});
}

jQuery(function($){

	
	if ($('#site_loader_overlay').length) {

		var loadTime = load.loadTime;
		var bodyHeight = $('body').height();
		$('#site_wrap').css('display', 'none');
		$('body').height(bodyHeight);

		// After the document loading process
		$(window).load(function() {

			$('#site_wrap').css('display', 'block');
			if ($('.slick-slider').length) { $('.slick-slider').slick('setPosition'); }
			$('body').height('');
			$('#site_loader_animation').delay(600).fadeOut(400);
			
			// Infinite scroll in archives
			if ($('#js-infinitescroll').length) {
				$('#site_loader_overlay').delay(900).fadeOut(800, function() { init_post_list(); });
			} else {
				$('#site_loader_overlay').delay(900).fadeOut(800);
			}			

      // Start playing a video if #js-hero-header__content1 has <video>
      if ($('#js-hero-header__content1 video').length) {
        $('#js-hero-header__content1 video').get(0).play();
      }
		});

		// Display #site_wrap even if the document loading process is not over
		$(function() {
			setTimeout(function(){
				$('#site_loader_animation').delay(600).fadeOut(400);
				$('#site_loader_overlay').delay(900).fadeOut(800);
				$('#site_wrap').css('display', 'block');
		  }, loadTime);
		});

	} else {
	
    if ($('#js-infinitescroll').length) {
			init_post_list();
		}
	}

});	

