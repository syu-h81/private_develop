/**
 * front page
 */
var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

var onReadyFlag = false;

var youtube = document.getElementsByClassName('p-hero-header__content-youtube-iframe');

// make a object to store YT.Player objects
var players = {};

function onYouTubeIframeAPIReady() {

	for (var i = 0; i < youtube.length; i++) {
		
		var player;
		var playerId = youtube[i].id;

		players[youtube[i].id] = new YT.Player(playerId, { 
			events: { 
				'onReady': onPlayerReady,
        'onStateChange': onPlayerStateChange
			}
		});

	}

}

function onPlayerReady(event) {

	onReadyFlag = true;	

  // Mute
  event.target.mute();

	if (jQuery('#js-hero-header__content1').find('.p-hero-header__content-youtube').length) {

		playerId = jQuery('#js-hero-header__content1').find('.p-hero-header__content-youtube-iframe').attr('id');
    players[playerId].playVideo();
	}

}

function onPlayerStateChange(event) {
  if (event.data === YT.PlayerState.ENDED) {
    event.target.playVideo();
  }
}

jQuery(function($){

	var playerId;
	var activeClass = 'is-active';

	// hero header
	var heroHeader = $('#js-hero-header');


	$('#js-hero-header__link').click(function(event) {

		event.preventDefault();

		var target = $(this).attr('href');
		var targetPositionTop = $(target).offset().top;
	
		if ($('.l-header--fixed').length) {
			targetPositionTop -= $('.l-header--fixed').height();
		}

		$('body, html').animate({
			scrollTop: targetPositionTop + 'px'
		}, 1000);
		
	});

	$('.p-hero-header__nav-item a').hover(function() {
		
		var timer, video, youTube;
		var parent = $(this).parent();
    
		if (! parent.hasClass(activeClass)) {

			var activeContent = $('.p-hero-header__content.' + activeClass);
			var target = $(this).data('target');

			$('.p-hero-header__nav').find('.' + activeClass).removeClass(activeClass);
			
			// pause video
			if (activeContent.find('.p-hero-header__content-video').length) {

				video = activeContent.find('.p-hero-header__content-video video');

				// use setTimeout for smooth switching
				//timer = setTimeout(function() {
				//	video.get(0).pause();
				//}, 300);

				//heroHeader.data('timer', timer);
				video.get(0).pause();
				
			}

			// pause YouTube
			if (activeContent.find('.p-hero-header__content-youtube').length && onReadyFlag) {
				
				playerId = activeContent.find('.p-hero-header__content-youtube-iframe').attr('id');
        players[playerId].pauseVideo();

			}

			// fade out
			activeContent.stop().fadeOut().removeClass(activeClass);

			parent.addClass(activeClass);

			// play video
			if ($(target).find('.p-hero-header__content-video').length) {

				video = $(target).find('.p-hero-header__content-video video');
				video.get(0).play();

			}

			// play YouTube
			if ($(target).find('.p-hero-header__content-youtube').length && onReadyFlag) {

				playerId = $(target).find('.p-hero-header__content-youtube-iframe').attr('id');
        players[playerId].playVideo();

			}

			// fade in
			$(target).stop().fadeIn().addClass(activeClass);
			
		}
	}, function() {

		//timer = heroHeader.data('timer');
		//clearTimeout(timer);
		//heroHeader.data('timer', null);

	});

	// hero header
	if ($('#js-hero-header__slider').length) {
		$('#js-hero-header__slider').slick({
			autoplay: true,
			slidesToShow: 1,
			arrows: false
		});
		if (parseInt(splash.is_splash)) { // Convert value from character to numeric
			$('#js-hero-header__slider').slick('slickPause');
		}
		$(window).on('resize', function() {
			$('#js-hero-header__slider').slick('setPosition');
		});
	}

	// blog lists
	if ($('.p-content03__blog-list-inner').length) {
    var blogSlickOptions = {
			//arrows: false,
			autoplay: true,
			slidesToShow: 4,
			appendArrows: $('.p-content03__blog-arrows'),
			responsive: [
				{
      		breakpoint: 1450,
      		settings: {
        		slidesToShow: 3
      		}
    		},
				{
      		breakpoint: 1024,
      		settings: {
        		slidesToShow: 2
      		}
    		},
				{
      		breakpoint: 768,
      		settings: 'unslick'
					/*settings: {
						arrows: false,
						autoplay: false,
						centerMode: true,
        		slidesToShow: 2,
						infinite: false,
						slidesToScroll: 1,
						variableWidth: true
					}*/
    		}
  		]
    };
		$('.p-content03__blog-list-inner').slick(blogSlickOptions);
		$(window).on('resize', function() {
      if ($(window).width() > 767) {
        if (! $('.p-content03__blog-list-inner').hasClass('slick-slider')) {
          // スマホ表示に使用しているwidthをautoに戻す
		      $('.p-content03__blog-list-inner').width('auto').slick(blogSlickOptions);
        } else {
			    $('.p-content03__blog-list-inner').slick('setPosition');
        }
      }
		});

		if ($(window).width()	<= 767) {

			$('.p-content03__blog-list-inner').each(function() {

				var listInner = $(this);
				var listItem = listInner.find('.p-content03__blog-list-item');
				var listInnerWidth = 0;
		
				// listInner の width を設定する
				listInnerWidth += 20; // article のfirst-child のみ padding-left: 20px
				listInnerWidth += (120 + 10) * listItem.length; // 1つのarticle がwidth:120px かつ margin-right:10px * 個数
				listInnerWidth += 20; // last-child のみ padding-right: 20px

				listInner.css({'width': listInnerWidth + 'px'});

				listInner.on('touchstart', function() {
				
					// タッチ位置を記録する
					$(this)
						.data('startX', event.touches[0].pageX)	
						.data('startY', event.touches[0].pageY)
						.data('moveX', 0)
						.data('moveY', 0);

					// listInner のマージンを取得
					listInnerMargin = parseInt(listInner.css('margin-left'));

				}).on('touchmove', function() {

					// listInner の横幅がウィンドウ幅より小さい場合、何もしない
					if (listInner.outerWidth < $(window).width()) {

						return false;

					} else {

						$(this)
							.data('moveX', event.touches[0].pageX - $(this).data('startX'))
							.data('moveY', event.touches[0].pageY - $(this).data('startY'));

						//var moveX   = $(this).data('moveX') * 2;
        		//var maxMove = listInner.outerWidth() - $(window).width();  
						var moveX   = $(this).data('moveX');
        		var maxMove = listInner.outerWidth() - $(window).width() - Math.abs(listInnerMargin); // x軸の+方向に動ける長さ

        		if (moveX > Math.abs(listInnerMargin)) { // リストの左端に到達する
          		moveX = Math.abs(listInnerMargin);
        		} else if (moveX < 0 && Math.abs(moveX) > maxMove) { // リストの右側に到達する
          		moveX = - maxMove + 1;
        		} 
			
						listInner.stop().animate({
							'margin-left' : listInnerMargin + moveX + 'px'
						}, 400, 'swing');
					}

				}).on('touchend', function() {

				});
			});
    }
	}

	// gallery contents
	if ($('.p-content04__slider').length) {
		$('.p-content04__slider').slick({
			autoplay: true,
			slidesToShow: 1
		});
		$(window).on('resize', function() {
			$('.p-content04__slider').slick('setPosition');
		});
	}

});	
