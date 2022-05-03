jQuery(document).ready(function($){

	// mobile タブクリック
	$('.pb_staff_list-mobile .pb_staff_list-tab li a').click(function(){
		if ($(this).closest('li').hasClass('active')) return false;
		$(this).closest('.pb_staff_list-mobile').find('.active').removeClass('active');
		$(this).closest('li').addClass('active');
		$(this).closest('.pb_staff_list-mobile').find($(this).attr('href')).addClass('active');
		return false;
	});

});
