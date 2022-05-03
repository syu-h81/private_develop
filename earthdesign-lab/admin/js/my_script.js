jQuery(document).ready(function($){

	// Meta title and meta description(seo.php)
	if ($('#tcd-w_meta_description').length) {
		countField('#tcd-w_meta_description');
	}

	// アコーディオンの開閉
	$('.theme_option_field').on('click', '.theme_option_subbox_headline', function(){
  	$(this).parent('.sub_box').toggleClass('active');
   	return false;
  });

  // Googleマップ
  $("#gmap_marker_type_button_type2").click(function () {
    $("#gmap_marker_type2_area").show();
  });
  $("#gmap_marker_type_button_type1").click(function () {
    $("#gmap_marker_type2_area").hide();
  });
  $("#gmap_custom_marker_type_button_type1").click(function () {
    $("#gmap_custom_marker_type1_area").show();
    $("#gmap_custom_marker_type2_area").hide();
  });
  $("#gmap_custom_marker_type_button_type2").click(function () {
    $("#gmap_custom_marker_type1_area").hide();
    $("#gmap_custom_marker_type2_area").show();
  });

	// custom fields
	$('.postbox').on('click', '.theme_option_subbox_headline', function(){
  	$(this).parent('.sub_box').toggleClass('active');
   	return false;
  });

  // theme option tab
	if ($('#my_theme_option').length) {

  	$('#my_theme_option').cookieTab({
  		tabMenuElm: '#theme_tab',
   		tabPanelElm: '#tab-panel'
  	});

		$('.cb-plan-notice').click(function(event) {

			event.preventDefault();

			// URL から #tab-content〜の箇所を取得
			var target = $(this).attr('href');

			// タブコンテンツ切り替え後の表示位置を取得するためのターゲット要素を取得
			var position = $(this).data('position');
			
			if ($(target).length) {

				if ('none' === $(target).css('display')) {
					
					// 右カラムのタブコンテンツを切り替える
					$($('#tab-panel')).children().hide();
					$(target).show();

					// 左カラムのメニューのカレント表示を切り替える
					$('#theme_tab').children('.current').removeClass('current');
					$('#theme_tab').children().eq($(target).index()).addClass('current');
	
					// ページの表示位置をターゲット要素の位置にする
					position = $(position).offset().top - 32; // 32px は管理バー（#wpadminbar）の高さ
					$('html,body').scrollTop(position);

				}
			}	
		});
	}

	// radio button for page custom fields
  $(".ml_custom_fields_select .template li label").click(function() {
  	$(".ml_custom_fields_select .template li label").removeClass('active');
    $(this).addClass('active');
  });

  $(".ml_custom_fields_select .side_content li label").click(function () {
  	$(".ml_custom_fields_select .side_content li label").removeClass('active');
   	$(this).addClass('active');
  });

  // custom field repeater add row
  $(".field-repeater a.button-add-row").click(function(){
  	var clone = $(this).attr("data-clone");
  	var $parent = $(this).closest(".field-repeater");
  	if (clone && $parent.size()) {
    	$parent.find("table.cf_repeater tbody").append(clone);
  	}
  	return false;
  });

  // custom field repeater delete row
  $("table.cf_repeater").on("click", ".button-delete-row", function(){
  	var del = true;
  	var confirm_message = $(this).closest("table.cf_repeater").attr("data-delete-confirm");
  	if (confirm_message) {
    		del = confirm(confirm_message);
  	}
  	if (del) {
    		$(this).closest("tr").remove();
  	}
  	return false;
  });

  // theme option repeater sortable
  $('.topt_repeater').sortable({
  	placeholder: 'sortable-placeholder',
  	helper: "clone",
  	forceHelperSize: true,
  	forcePlaceholderSize: true
	});
	
  // theme option header content
	var header_content_slider = $("#header_content_slider");
	var header_content_video = $("#header_content_video");
	var header_content_youtube = $("#header_content_youtube");
  var header_content_video_catch = $("#header_content_video_catch");
  $("#header_content_button_type1").click(function() {
  	header_content_slider.show();
  	header_content_video.hide();
  	header_content_youtube.hide();
    header_content_video_catch.hide();
  });
  $("#header_content_button_type2").click(function() {
  	header_content_slider.hide();
  	header_content_video.show();
  	header_content_youtube.hide();
    header_content_video_catch.show();
  });
  $("#header_content_button_type3").click(function() {
  	header_content_slider.hide();
  	header_content_video.hide();
  	header_content_youtube.show();
    header_content_video_catch.show();
  });

  // ヘッダーコンテンツ　動画のボタン
  $(".show_video_catch_button input:checkbox").click(function(event) {
   if ($(this).is(":checked")) {
    $(this).parents('.show_video_catch_button').next().show();
   } else {
    $(this).parents('.show_video_catch_button').next().hide();
   }
  });

	// color picker
	$('.c-color-picker').wpColorPicker();

	/**
	 * theme options
	 */

	// logo
	$('#header_use_logo_image_type1').click(function() {
		$('#header-logo-text-area').show();
    $('#header-logo-image-area').hide();
	});
	$('#header_use_logo_image_type2').click(function() {
		$('#header-logo-text-area').hide();
    $('#header-logo-image-area').show();
	});
	$('#footer_use_logo_image_type1').click(function() {
		$('#footer-logo-text-area').show();
    $('#footer-logo-image-area').hide();
	});
	$('#footer_use_logo_image_type2').click(function() {
		$('#footer-logo-text-area').hide();
    $('#footer-logo-image-area').show();
	});

	// hero header
	$('.hero-header-type1').click(function() {
		var parent = $(this).parents('.sub_box_content');
		parent.find('.hero-header-type1-content').show();
		parent.find('.hero-header-type2-content').hide();
		parent.find('.hero-header-type3-content').hide();
	});
	$('.hero-header-type2').click(function() {
		var parent = $(this).parents('.sub_box_content');
		parent.find('.hero-header-type1-content').hide();
		parent.find('.hero-header-type2-content').show();
		parent.find('.hero-header-type3-content').hide();
	});
	$('.hero-header-type3').click(function() {
		var parent = $(this).parents('.sub_box_content');
		parent.find('.hero-header-type1-content').hide();
		parent.find('.hero-header-type2-content').hide();
		parent.find('.hero-header-type3-content').show();
	});

	// splash page
	$('.splash_content_type1').click(function() {
		$(this).parents('.sub_box_content')
			.find('.splash-img').show()
			.end()
			.find('.splash-text').hide();
	});
	$('.splash_content_type2').click(function() {
		$(this).parents('.sub_box_content')
			.find('.splash-img').hide()
			.end()
			.find('.splash-text').show();
	});

	// submit by AJAX
	if ($('#myOptionsForm').length) {
		var $button = $('#myOptionsForm .button-ml');

		$button.on('click', function(event) {
			event.preventDefault();

			if (window.tinyMCE) {
				tinyMCE.triggerSave();//tinymceを利用しているフィールドのデータを保存
			}

			$('#myOptionsForm').ajaxSubmit({
				beforeSend: function() {
					$('#saving_data').show();
					$button.attr('disabled', true); // ボタンを無効化し、二重送信を防止
				},
				complete: function() {
					$('#saving_data').hide();
					$button.attr('disabled', false); // ボタンを有効化し、送信を許可
				},
				success: function(){
					$('#saving_data').hide();
					$('#saved_data').html('<div id="saveMessage" class="successModal"></div>');
					$('#saveMessage').append('<p>' + ajax_submit.success + '</p>').show();

					setTimeout(function() {
						$('#saveMessage:not(:hidden, :animated)').fadeOut();
					}, 3000);
				},
				error: function() {
					alert(ajax_submit.error);
				},
				timeout: 10000
			});
		});

		// 保存メッセージクリックで非表示
		$(document).on('click', '#saved_data', function(event) {
			$('#saveMessage:not(:hidden, :animated)').fadeOut(300);
		});
	}

	// custom fields
	if ($('[name^="splash_content_type"]').length) {
		$('[name^="splash_content_type"]').parents('.sub_box').each(function() {
			var sub_box = $(this);
			if ('type1' === sub_box.find('[name^="splash_content_type"]:checked').val()) {
				sub_box.find('.splash-text').hide();
			} else if ('type2' === sub_box.find('[name^="splash_content_type"]:checked').val()) {
				sub_box.find('.splash-img').hide();
			}
			sub_box.find('[class^="splash_content_type"]').click(function() {
				if ('type1' === $(this).find('[name^="splash_content_type"]').val()) {
					sub_box.find('.splash-img').show();
					sub_box.find('.splash-text').hide();
				} else if ('type2' === $(this).find('[name^="splash_content_type"]').val()) {
					sub_box.find('.splash-img').hide();
					sub_box.find('.splash-text').show();
				}
			});
		});
	}

});

	function countField(target) {
		jQuery(target).after('<span class="word_counter" style="display:block; margin:0 15px 0 0; font-weight:bold;"></span>');
		jQuery(target).bind({
    	keyup: function() {
      	setCounter();
   	 	},
  	 	change: function() {
  	 		setCounter();
   	 	}
	  });
  	setCounter();
  	function setCounter(){
    	jQuery('span.word_counter').text(translation.word_counter+jQuery(target).val().length);
  	};
	}
