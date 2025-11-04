( function( $ ) {
    'use strict';

    $(document).on('wc-password-strength-added', function (e) {
        var meter = $('.nicelabel .woocommerce-password-strength');
        var wrapper = meter.parent();
        var field = wrapper.find('input[type=password]');
        var label = wrapper.find('label');
        field.after(label);

    })
})( jQuery );
