
document.addEventListener( 'DOMContentLoaded', function(){ 
    initToolbar();
    cancelProcessEvents();
    continueProcess();
});

function initToolbar() {
    if( el = document.getElementById( 'wp-admin-bar-seo-optimize' ) ){
        var counter = el.querySelector( 'span[data-count-optimize]' );
        var counter_popup = document.getElementById( 'count_event_processed' );
        var popup = document.querySelector( '.io-event-disable' );
        var val = counter.getAttribute( 'data-count-optimize' );
        if( parseInt( val ) > 0 ) {
            arg = {
                'action'    : 'IO_ajax',
                'IO_handler': 'init_queue',
                'offset'    : val,
            };

            jQuery.ajax({
                type:"post",
                url: IMAGE_OPTIMIZER_EVENTS.url,
                dataType: 'json',
                data: arg,
                success:function( data ){
                    if( data.status != "ERROR" ){
                        if( data.status == 'STOP' ){
                            show_error_popup( er = true, queue = true );
                            return;
                        }
                        counter.setAttribute( 'data-count-optimize', data.count );
                        counter.innerText = data.count;
                        if( counter_popup ) counter_popup.innerText = data.count;
                        if( popup && data.count == 0 ) {
                            popup.classList.add( 'hidden' );
                        } else if( popup ){
                            popup.classList.remove( 'hidden' );
                        }
                        setTimeout(
                            function(){
                                initToolbar();
                            }, 3000
                        );
                    } else {              
                        console.log( data.msg );
                    }
                }
            });
        } 
    }
}

function cancelProcessEvents() {
    if( button = document.getElementById( 'cancel-process' ) ){
        button.addEventListener( 'click', function(){

            arg = {
                'action'    : 'IO_ajax',
                'IO_handler': 'cancel_queue',
                'event'     : 'cancel',
            };

            jQuery.ajax({
                type:"post",
                url: IMAGE_OPTIMIZER_EVENTS.url,
                dataType: 'json',
                data: arg,
                success:function( data ){
                    if( data.status == "ERROR" ){
                        console.log(data);
                    } else {
                        let popup = document.querySelector( '.io-event-disable' );
                        if( popup ){
                            popup.classList.toggle( 'hidden' );
                        }
                    }
                }
            }); 
        });
    }
}

function continueProcess() {
    if( button = document.getElementById( 'continue_process' ) ) {
        button.addEventListener( 'click', function(e) {

            let arg = {
                'action'     : 'IO_ajax',
                'IO_handler' : 'continue_process',
                'event'      : 'continue'
            };

            jQuery.ajax({
                type:"post",
                url: IMAGE_OPTIMIZER_EVENTS.url,
                dataType: 'json',
                data: arg,
                success:function( data ){
                    if( data.status == "ERROR" ){
                        console.log( data.msg );
                    } else {
                        window.location.reload();
                    }
                }
            });

            e.preventDefault();
        });
    }
}