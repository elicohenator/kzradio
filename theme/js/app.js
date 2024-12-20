jQuery(window).load(function () {
	if (jQuery('#wrapper-home #shows-curr-and-next').length && jQuery(window).width() < 767) {
		var headerHeight = jQuery('#header').height();
		var playerHeight = jQuery('.floating-bar > .inner').height();
		jQuery('#wrapper-home #shows-curr-and-next .main-banner').css({
			height: 'calc(100vh - ' + (headerHeight + playerHeight) + 'px)',
		});
	}
});

jQuery(document).ready(function ($) {
	$('#shows-filter').submit(function (e) {
		e.stopPropagation();
		e.preventDefault();
		var filter = $('#shows-filter');
		$.ajax({
			url: filter.attr('action'),
			data: filter.serialize(), // form data
			type: filter.attr('method'), // POST
			beforeSend: function (xhr) {
				filter.find('button').text('מחפש...'); // changing the button label
			},
			success: function (data) {
				filter.find('button').text('חפש'); // changing the button label back
				var result = $(data).find('#response').html();
				$('#response').html(result);
			},
		});
		return false;
	});
	$('#shows-filter').change(function () {
		$('button.search').addClass('cta');
	});
	$('input[type=reset]').click(function () {
		$('button.search').removeClass('cta');
		setTimeout(function () {
			$('#shows-filter').submit();
		}, 100);
	});

	if ($('body.home #decade').length) {
		var wallaLink = $('body.home #decade a').attr('href');
		$('body.home #decade').click(function () {
			var win = window.open(wallaLink, '_blank');
			if (win) {
				//Browser has allowed it to be opened
				win.focus();
			}
		});
	}
	$(document).on('click','.toggle-form', function(e) {
		e.preventDefault();
		if ($(this).hasClass('close')) { 
			$(this).parent().addClass('small');
		} else { 
			$(this).parent().removeClass('small');
		}
	});
	if ($('.nav-magazine-container').length) {
		/*$('.toggle-form').click(function (e) {
			e.preventDefault();
			if ($(this).hasClass('close')) {
				$(this).parent().addClass('small');
			} else {
				$(this).parent().removeClass('small');
			}
		});*/
		// ## function declaration
		function scrollEventThrottle(fn) {
			let last_known_scroll_position = 0;
			let ticking = false;
			window.addEventListener('scroll', function () {
				let previous_known_scroll_position = last_known_scroll_position;
				last_known_scroll_position = window.scrollY;
				if (!ticking) {
					window.requestAnimationFrame(function () {
						fn(last_known_scroll_position, previous_known_scroll_position);
						ticking = false;
					});
					ticking = true;
				}
			});
		}

		// ## function instantiation
		scrollEventThrottle((scrollPos, previousScrollPos) => {
			if (previousScrollPos > scrollPos) {
				$('.nav-magazine-container').removeClass('scrolldown').addClass('scrollup');
			} else {
				$('.nav-magazine-container').removeClass('scrollup').addClass('scrolldown');
			}
		});
		$(window).on('scroll touchmove', function () {
			if ($(window).scrollTop() <= 167) {
				$('.nav-magazine-container').removeClass('fixed');
			} else {
				$('.nav-magazine-container').addClass('fixed');
			}
		});
	}

	if ($('.share').length) {
		$(window).on('scroll', function () {
			if ($('.share .buttons').length) {
				var top = $(window).scrollTop(),
					divBottom = $('.share .buttons').offset().top + $('.share .buttons').outerHeight();
				if (divBottom > top) {
					setTimeout(function () {
						$('.share .buttons a').addClass('animated bounce');
						setTimeout(function () {
							$('.share .buttons a').removeClass('animated bounce');
						}, 2500);
					}, 1500);
				}
			}
		});
	}

	if (jQuery('#content.decade-chart').length) {
		jQuery(window).on('scroll', function () {
			var top = jQuery(window).scrollTop();
			if (top > 500) {
				jQuery('.back-top-top').addClass('active');
			} else {
				jQuery('.back-top-top').removeClass('active');
			}
		});
	}

	jQuery('#content.decade-chart .recommended-shows .tabs li').click(function () {
		if (jQuery(this).hasClass('active')) return false;
		jQuery(this).addClass('active').siblings('li').removeClass('active');
		changeShowsTab(jQuery(this).index());
		return false;
	});

	function changeShowsTab(newTabIndex) {
		var recShows = jQuery('#content.decade-chart .recommended-shows');
		recShows
			.find('.shows-wrapper > div[data-order="' + newTabIndex + '"]')
			.addClass('active')
			.siblings('div')
			.removeClass('active');
		recShows
			.find('.shows-wrapper > div[data-order="' + newTabIndex + '"]')
			.prependTo(recShows.find('.shows-wrapper'));
	}
});
