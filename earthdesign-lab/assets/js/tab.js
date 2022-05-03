jQuery(function($){

	var activeClass = 'is-active';

	$('.p-tab').each(function() {
	
		var tab = $(this);

		tab.find('.p-tab__content').each(function() {
	
			var tabContentId = $(this).attr('id');

			// Initialize slick
			if ($(this).find('.p-tab__content-img-slider').length) {

				$(this).find('.p-tab__content-img-slider').slick({
					slidesToShow: 1,
					arrows: false,
					autoplay: true,
					asNavFor: '#' + tabContentId + ' .p-tab__content-img-nav',
					responsive: [
						{
      				breakpoint: 768,
      				settings: {
								arrows: true,
      				}
    				}
  				]
				});
				$(this).find('.p-tab__content-img-nav').slick({
					slidesToShow: 1,
					asNavFor: '#' + tabContentId + ' .p-tab__content-img-slider',
					responsive: [
						{
      				breakpoint: 768,
      				settings: {
								arrows: false,
								asNavFor: null
      				}
    				}
  				]
				});
			}

			// YouTube
			
		});
		
		// Tab switching
		tab.find('.p-tab__nav-item a').click(function(event) {

			event.preventDefault();

			var parent = $(this).parent();
			var target = $(this).attr('href');

			if (! parent.hasClass(activeClass)) {

				tab.find('.p-tab__nav .' + activeClass).removeClass(activeClass);
				parent.addClass(activeClass);

				tab.find('.p-tab__content').hide();
				$(target).show();

				// Manually refresh positioning of slick
				if ($(target).find('.p-tab__content-img-slider').length) {

					$(target).find('.p-tab__content-img-slider').slick('setPosition');
					$(target).find('.p-tab__content-img-nav').slick('setPosition');

				}
			}
		});

		// Floor plan switching
		tab.find('.p-tab__content-floor-plan').each(function() {

			var floorPlan = $(this);

			$(this).find('.p-tab__content-pager-item a').click(function(event) {

				event.preventDefault();

				var parent = $(this).parent();
				var target = $(this).attr('href');

				if (! parent.hasClass(activeClass)) {

					floorPlan.find('.p-tab__content-pager .' + activeClass).removeClass(activeClass);
					parent.addClass(activeClass);

					floorPlan.find('.p-tab__content-floor-plan-content').hide();
					$(target).show();
				}
			});
		});
	});
});	
