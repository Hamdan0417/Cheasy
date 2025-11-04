(function($) {

	$(document).on( 'ready', function(){

		$('body').on( 'click', '[data-popup-action-close]', function(){

			$( '#' + $(this).attr('data-popup-action-close' ) ).fadeOut();

			return false;
		});

		$('body').on( 'click', '[data-popup-action-open]', function(){

			$( '#' + $(this).attr('data-popup-action-open' ) ).fadeIn();

			return false;
		});

	});

})(jQuery);