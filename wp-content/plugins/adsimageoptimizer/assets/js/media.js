
( function( $ ) {

    const actions = {
        'restore'           : 'io_media',
        'minimize'          : 'io_media_minimizing',
        'rebuid-meta'       : 'io_media_rebuid',
        'restore-watermark' : 'io_media_remove_watermark'
    };

    $( document ).on( 'ready', function(){

        $.each( actions, function( index, value ) {
            $( 'body' ).on( 'click', "a[data-action='" + index + "']", function(){
                update( $( this ), value );
                return false;
            });
        });

    });


    function update( elem, handler ){
        var attach_id = elem.attr( 'data-value-id' );
        var button = elem.parent();
        var container = elem.closest( '.io-column' );

        data = {
            'action'    : handler,
            'attach_id' : attach_id
        };

        $.ajax({
            type:"post",
            url: IMAGE_OPTIMIZER_MEDIA.url,
            dataType: 'json',
            data: data,
            beforeSend: function(){
                button.addClass( 'io-disable' );
            },
            complete: function(){
                button.removeClass( 'io-disable' );
            },
            success:function( data ){
                container.html( data.html );

                if( 'title' in data ) {
 
                    $( '#post-' + attach_id ).find( '.title strong a[aria-label]' ).contents().last().replaceWith( data.title );
                }   
            }
        });
    }

})( jQuery );