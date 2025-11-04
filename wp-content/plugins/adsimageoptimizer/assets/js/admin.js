
const main_handler = 'IO_ajax';

const options = {
    'optimize' : {
        'selector'   : '#file-optimizing',
        'handler'    : 'get_count_attach_no_min',
        'callback'   : 'process_minimization',
        'additional' : false
    },
    'restore' : {
        'selector'   : '#restore-optimizing',
        'handler'    : 'get_optimize_attachment',
        'callback'   : 'restore_files',
        'additional' : true
    },
    'alt_optimize' : {
        'selector'   : '#tags-optimizing',
        'handler'    : 'get_no_alt_attachment',
        'callback'   : 'alt_optimizing',
        'optional'   : 'Y',
        'additional' : false
    },
    'alt_rebuild' : {
        'selector'   : '#rebuild-alt',
        'handler'    : 'get_no_alt_attachment',
        'callback'   : 'alt_optimizing',
        'optional'   : 'N',
        'additional' : true
    },
    'title_optimize' : {
        'selector'   : '#title-optimizing',
        'handler'    : 'get_no_title_attachment',
        'callback'   : 'title_optimizing',
        'optional'   : 'Y',
        'additional' : false
    },
    'title_rebuild' : {
        'selector'   : '#rebuild-title',
        'handler'    : 'get_no_title_attachment',
        'callback'   : 'title_optimizing',
        'optional'   : 'N',
        'additional' : true
    },
    'watermark-edit' : {
        'selector'   : '#watermark-edit',
        'handler'    : 'count_editing_watermark',
        'callback'   : 'editing_watermark',
        'optional'   : 'Y',
        'additional' : false
    },
    'restore-watermark' : {
        'selector'   : '#restore-watermark',
        'handler'    : 'count_editing_watermark',
        'callback'   : 'restore_watermark',
        'optional'   : 'N',
        'additional' : true
    },
    'remove-backup' : {
        'selector'   : '#remove-backup',
        'handler'    : 'count_processed_images',
        'callback'   : 'remove_backup',
        'optional'   : 'N',
        'additional' : true
    }
};

const settings = {
    'create_backup'   : '#original-backup',
    'automatic_min'   : '#auto-minimization',
    'basic_title'     : '#basic-title',
    'product_title'   : '#product-title',
    'automatic_title' : '#auto-title-create-file',
    'basic_alt'       : '#basic-alt',
    'product_alt'     : '#product-alt',
    'automatic_alt'   : '#auto-alt-create-file',
    'only_var_alt'    : '#only_var_alt',
    'only_var_title'  : '#only_var_title',
    'auto_watermark'  : '#auto_watermark',
    'other_images'    : '#other_images'
};

const args_pattern = {
    'alt'        : '#basic_pattern_alt',
    'prod_alt'   : '#product_pattern_alt',
    'title'      : '#basic_pattern_title',
    'prod_title' : '#product_pattern_title',
};

function message( text, type = false ) {

    var template = function( message ){ 
        return '<div role="alert" class="io-js-message"><i class="io-icon-alert"></i><p class="io-js-message__content">' + message + '</p></div>';
    }

    jQuery( '.wrap.io' ).append( template( text ) );
    var popup = jQuery('div[role="alert"]');
    setTimeout( // Show message
        function(){
            popup.attr( 'action', 'show' );
        },
        100
    );
    setTimeout(
        function(){ // Hide message
            popup.removeAttr( 'action' );
            setTimeout(
                function( popup ){
                    popup.remove();
                },
                1000,
                popup
            );
        },
        3500
    );
}

function show_error_popup( init = false, queue = false ) {
    let popup      = document.querySelector( '.io-event-disable' );
    let generic    = document.querySelector( '.io-event-disable-block-content.generic' );
    let queue_list = document.querySelector( '.io-event-disable-block-content.import' );
    if( init && queue ) {
        if( queue_list )
            queue_list.classList.add( 'hidden' );
        let button = document.getElementById( 'continue_process' );
        if( button )
            button.classList.remove( 'hidden' );
        if( generic )
            generic.classList.remove( 'hidden' );
    } else if( init ) {
        if( popup )
            popup.classList.remove( 'hidden' );
        if( queue_list )
            queue_list.classList.add( 'hidden' );
        let button = document.getElementById( 'continue_process' );
        let button_remove = document.getElementById( 'remove_queue' );
        if( button )
            button.classList.remove( 'hidden' );
        if( button_remove )
            button_remove.classList.add( 'hidden' );
        if( generic )
            generic.classList.remove( 'hidden' );
    }
    cancelProcessEvents
    if( popup )
        popup.classList.remove( 'hidden' );
}

function update_options( selector = false, status, callback ){

    data = {
        'action'    : main_handler,
        'IO_handler': 'update_option',
        'key'       : status.key,
        'value'     : status.status,
    };
    jQuery.ajax({
        type:"post",
        url: IMAGE_OPTIMIZER_SCRIPT.url,
        data: data,
        success:function( data ){

            if( callback ){
                callback();
            }
        }
    });

}

(function($) {

    $( document ).on( 'ready', function(){

        io_pattern_field();
        io_accordion();
        io_radio_options();
        buttons_switcher_disabler();
        license_check();
        refreshPreview();
        bar_toggle( 'data-active-panel' );

        initInputNumber( function( value ){
            args = {
                'key'    : 'watermark_size',
                'status' : value
            };
 
            update_options( false, args );
        });

        initSelectInput( 'type_watermark',  false, function( value ){
            args = {
                'key'    : 'type',
                'status' : value
            };

            bar_toggle( 'data-active-panel', value );
            update_options( false, args );
        });

        initSelectInput( 'position_watermark', '[id^="position_watermark"]', function( value ){
            args = {
                'key'    : 'position',
                'status' : value
            };

            update_options( false, args );
        });

        initSelectInput( 'position_watermark_text', '[id^="position_watermark"]', function( value ){
            args = {
                'key'    : 'position',
                'status' : value
            };

            update_options( false, args );
        });

        rangeInput( 'opacity-watermark', '[id^="opacity-watermark"]',  function( value ){
            args = {
                'key'    : 'opacity',
                'status' : value
            };

            update_options( false, args );
        });

        rangeInput( 'opacity-watermark-text', '[id^="opacity-watermark"]', function( value ){
            args = {
                'key'    : 'opacity',
                'status' : value
            };

            update_options( false, args );
        });

        $.each( options, function( index, value ){
            file_process( value.selector, value.handler, value.callback, value.optional ? value.optional : false );
        } );

        $.each( settings, function( index, value ){
            update_checkbox_option( value, index );
        });

        $.each( args_pattern, function( index, value ){
            update_pattern_option( value, index );
        });

        $('.io-question > i').on('click', function(){
            $(this).siblings('.io-answer').toggle();
        });

        $('.io-question .io-answer').on('click', function(){
            $(this).hide();
        });

        $('#auto-minimization').on( 'change', function(){
            if( $(this).prop('checked') ){
                $('.warning-modal').show();
                $('body').prepend('<div class="over"></div>');
            }

        });
        $('.warning-modal').on( 'click', function(){
            $('.warning-modal').hide();
            $('.over').remove();
        });
        $(document).on('click', '.over', function(){
            $('.warning-modal').hide();
            $('.over').remove();
        })
    });

    function get_const_main_handler(){
        return main_handler;
    }

    function error( error ) {

        data = {
            'action' : 'io_error',
            'error'  : error,
        };

        $.ajax({
            type:"post",
            url: IMAGE_OPTIMIZER_SCRIPT.url,
            dataType: 'json',
            data: data,
            success:function( data ){
                message( data );
            }
        });
    }

    function request_options(){

        data = {
            'action'     : main_handler,
            'IO_handler' : 'refresh_table',
            'refresh'    : true,
        };
        var response = $.ajax({
            type:"post",
            url: IMAGE_OPTIMIZER_SCRIPT.url,
            dataType: 'json',
            async:false,
            data: data,
            success:function( data ){
                return data;
            }
        }).responseJSON;

        return response;
    }

    function validate_pattent_type( selector, type ){

        if( type != 'image' ){

            data = {
                'action'     : 'pattern_type_check',
                'selector'   : selector,
                'type'       : type,
            };
            var response = $.ajax({
                type:"post",
                dataType: 'json',
                url: IMAGE_OPTIMIZER_SCRIPT.url,
                async:false,
                data: data,
            }); 

            return response.responseJSON;
        }
    }

    function license_check(){

        var form = $( '#io-license-form' );
        var button = form.find( '.io-buttons a' );
        var input = form.find( '.io-input-text input' );

        button.on( 'click', function(){
            key = input.val();

            data = {
                'action'     : main_handler,
                'IO_handler' : 'save_license_key',
                'key'        : key
            };

            $.ajax({
                type:"post",
                url: IMAGE_OPTIMIZER_SCRIPT.url,
                dataType: 'json',
                data: data,
                success:function( data ){
                    message( data.message );
                }
            });


        });
    }

    function file_process( selector, handler, callback_handler, option = false ){

        $( 'body' ).on( 'click', selector, function(){
            var initData = false;
            var msg = $( '.io-progress-bar-message' );
            var panel = $( '.io-panel' );
            var type_page = panel.attr( 'data-info' );

            if( selector == "#watermark-edit" ) saveStamp();

            if( !validate_pattern_form( type_page ) && ( $(this).attr( 'data-access' ) != '1' ) ){
                error( 'emptyPattern' );

                return false;
            }

            if( $(this).hasClass( 'btn-primary' ) ){
                index_tag = selector.replace( '#','' );

                if( $( 'popup' + index_tag ).length == 0 ){
                    popup_message = validate_pattent_type( index_tag, type_page );

                    if( popup_message.hasOwnProperty( 'html' ) ){
                        $('.wrap.io').after( popup_message.html );
                        return false;
                    } else if ( popup_message.hasOwnProperty( 'status' ) ) {
                        $( 'popup' + index_tag ).remove();
                    }
                }
            }

            msg.text('');
            $('.io-popup-wrap').fadeOut();

            data = {
                'action'    : main_handler,
                'IO_handler': handler,
                'get_data'  : true,
                'optional'  : option,
            };

            $.ajax({
                type:"post",
                url: IMAGE_OPTIMIZER_SCRIPT.url,
                dataType: 'json',
                data: data,
                beforeSend: function(){
                    msg.text( window.io_attr.processing );
                    ajax_event( true );
                },
                complete: function(){
                    msg.text('');
                },
                success:function( data ){

                    if( !data.hasOwnProperty('status') ){
                        data_processing( data, data, callback_handler, option );
                    }
                    else {
                        error( 'notFound' );
                        ajax_event( false );
                        buttons_switcher_disabler();
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });

        });

        return false;
    }

    function data_processing( count, total_count, handler, option = false ) {
       
        if( count > 0 ){
            setTimeout(
                function( total_count ){
                    
                    count--;

                    arg = {
                        'action'    : main_handler,
                        'IO_handler': handler,
                        'offset'    : count,
                        'optional'  : option
                    };

                    $.ajax({
                        type:"post",
                        url: IMAGE_OPTIMIZER_SCRIPT.url,
                        dataType: 'json',
                        data: arg,
                        success:function( data ){

                            progress = io_counter( total_count, count );
                            $( '.io-progress-bar' ).css( 'width', progress + '%' );
                            $( '.io-progress-bar span' ).text( progress + '%' );

                            if(data != null){
                                if( data.hasOwnProperty( 'success' ) && data.success == 'stop' ){
                                    show_error_popup( true );
                                    return;
                                }
                            }

                            data_processing( count, total_count, handler, option );
                        }
                    });
                },
                50,
                total_count
            );
            return;
        }

        $( '.io-progress-bar-message' ).text( window.io_attr.done );
        $( '.io-buttons a' ).each( function(){
            if( $( this ).attr( 'id' ) == 'file-optimizing' ){
                if( $('#optimized').text() != 0 ){
                    $(this).removeClass( 'io-disable' );
                }
                else {
                    $(this).addClass( 'io-disable' );
                }
            }
            if( $( this ).attr( 'id' ) == 'restore-optimizing' ){
                if( $('#to-be-optimized').text() != 0 ){
                    $(this).removeClass( 'io-disable' );
                }
                else {
                    $(this).addClass( 'io-disable' );
                }
            }

        });

        $( '.io-progress-bar' ).css( 'width', 'inherit' );
        $( '.io-progress-bar span' ).text( '' );

        ajax_event( false );
        refresh_table();
    }

    function refresh_table(){
        
        data = {
            'action'     : main_handler, 
            'IO_handler' : 'refresh_table',
            'refresh' : true,
        };
        $.ajax({
            type:"post",
            url: IMAGE_OPTIMIZER_SCRIPT.url,
            dataType: 'json',
            data: data,
            beforeSend: function(){
            },
            complete: function(){
            },
            success:function( data ){
                $('#quantity').text( data.minimization.statistic_min.quantity );
                $('#quantity-meta').text( data.alt_optimization.quantity_meta );

                if( data.alt_optimization.count_alt != null ){
                    count = data.alt_optimization.count_alt;
                }
                else {
                    count = 0;
                }

                $('#optimized-meta').text( count );

                if( data.title_renamer.count_title != null ){
                    count = data.title_renamer.count_title;
                }
                else {
                    count = 0;
                }

                $('#optimized-meta-title').text( count );

                if( data.minimization.statistic_min.count != null ){
                    count = data.minimization.statistic_min.count;
                }
                else {
                    count = 0;
                }

                $('#optimized').text( count );
                $('#to-be-meta-optimized').text( data.alt_optimization.quantity_meta - data.alt_optimization.count_alt );
                $('#to-be-optimized-title').text( data.alt_optimization.quantity_meta - data.title_renamer.count_title );
                $('#to-be-optimized').text( data.minimization.statistic_min.quantity - data.minimization.statistic_min.count );

                if( data.minimization.statistic_min.percent != null ){
                    reduction = data.minimization.statistic_min.percent;
                }
                else {
                    reduction = 0;
                }

                $('#reduction').text( reduction + ' %' );

                if( data.minimization.statistic_min.size != null ){
                    size = data.minimization.statistic_min.size.toFixed(2);
                }
                else {
                    size = 0;
                }

                $('#space').text( size + ' ' + ucFirst( data.minimization.statistic_min.unit ) );

                 buttons_switcher_disabler();
            }
        });
    }

    function refreshPreview() {
        $( '#io-refresh-watermark' ).on( 'click', function(){
            data = {
                'action'    : main_handler,
                'IO_handler': 'generation_preview_watermark',
                'key'       : 'url_preview'
            };

            if( checkTypeWatermark() ) {

                saveStamp( function( data ){
       
                    requestRefreshPreview( data );
                }, data);

            } else {

                requestRefreshPreview( data );
            }
            
            return false;
        });
    }

    function requestRefreshPreview( data ){
    
        $.ajax({
            type:"post",
            url: IMAGE_OPTIMIZER_SCRIPT.url,
            dataType: 'json',
            data: data,
            beforeSend: function(){
                $(this).addClass( 'io-disable' );
            },
            complete: function(){
                $(this).removeClass( 'io-disable' );
            },
            success:function( data ){
              
                if( data.status != "ERROR" ){
                    message( data.msg );
                    $( '.io-preview-container img' ).attr( 'src', '' );
                    $( '.io-preview-container img' ).attr( 'src', data.preview );

                } else {
                    message( data.msg );
                }
            }
        });
    }

    function io_counter( count, current_value ){
        result = ( count - current_value )/count * 100;
        return result.toFixed(2);
    }

    function io_accordion(){
        $('.io-accordion').on('change', function(){
            if($(this).prop('tagName') == 'INPUT' && $(this).attr('type') != 'radio'){
                var target = $(this).attr('id');
                $('[data-collapse=' + target + ']').slideToggle();
            }
        } );
        $('.io-accordion').each(function(){
            if($(this).prop('tagName') == 'INPUT' && $(this).prop('checked')){
                $('[data-collapse=' + $(this).attr('id') + ']').fadeIn(400);
            }
        });
        $('.io-radio-accordion input').on( 'change', function(){
            var target = $(this).attr( 'id' );
            if( $(this).prop('checked') ){
                $('[data-collapse=' + $(this).attr('id') + ']').show(500);

                if( !$(this).hasClass('io-accordion') ){
                    $(this).closest('.io-options').find('[data-collapse]').hide(300);
                }
            }
        });
    }

    function io_pattern_field () {
        $('.io-pattern-items li > a').on('click', function(){
            var elem = $(this).attr('href');
            var field = $(this).closest('.io-pattern').find('.io-text-field');
            field.find('span').hide();
            field.append(' <a title="'+ $(this).closest('.io-pattern-items').attr('data-title') +'" >' + elem + '</a>');
            update_pattern( $(this) );

            return false;
        });
        $('body').on('click', '.io-text-field > a', function(){
            var parent = $(this).closest('.io-text-field');
            $(this).remove();
            update_pattern( parent );

            if( parent.find('a').length == 0 ){
                parent.find('span').show();
            }
        });
    }

    function io_scope_pattern( elem ) {
        var data = elem.closest( '.io-pattern' ).find( '.io-text-field' );
        var result = [];
        elem.find('a').each(function(){
              result.push( $(this).text() );
        });
        return (result.length > 0) ? result : false;
    }

    function update_pattern( elem ){
        var data =  io_scope_pattern( elem.closest( '.io-pattern' ).find( '.io-text-field' ) );
        var input = elem.closest( '.io-options' ).find( 'input[type="hidden"]' );

        if( data ){
            var pattern = io_create_pattern( data );
            input.val( pattern ).trigger( 'change' );
        }
        else {
            input.val('').trigger( 'change' );
        }
    }

    function io_create_pattern( data ){
        var result;
        if(data){
            $.each(data, function( index, value ){
                if( index != 0 ){
                    result += ' ' + value;
                }
                else {
                    result = value;
                }
            });
        }
        return ( result.length > 0 ) ? result : false;
    }

    function io_radio_options(){
        $('.io-options input[type="radio"]').on('change', function(){
            var value = $(this).val();
            var name  = $(this).attr('name');
            $('#rebuild-alt').removeClass( 'io-disable' );

            if( $(this).val() != 'customer' ){
                $('input#' + name).attr( 'customer-active', '0' ).val(value).trigger('change');
            }
            else {
                $('input#' + name).attr( 'customer-active', '1' ).val(value).trigger('change');
            }
        });
    }

    function update_checkbox_option( selector, key ) {
        $( selector ).on( 'click', function(e){
            var status =  status_checkbox_option( selector, key );
            update_options( selector, status );
        });
    }

    function update_pattern_option( selector, key ) {
        $( 'body' ).on( 'change', selector, function(){
            var result;
            window.transferParams = $(this);
            if( $(this).val() != 'customer' ){
                result = {
                    'status' : $(this).val(),
                    'key'    : key,
                };
            }
            else {
                result = {
                    'status' : 1,
                    'key'    : $(this).attr('data-type'),
                };
            }
            update_options( selector, result , function() {
                var elem = window.transferParams;
                if( elem.attr( 'customer-active' )  == 0 ){
                    var res_customer = {
                        'status' : 0,
                        'key'    : elem.attr( 'data-type' ),
                    }
                    update_options( selector, res_customer );
                };
            });
        });
    }

    function status_checkbox_option( elem, key ) {
        var status = $(elem).prop( 'checked' );
        if( status ){
            status = 1;
        }
        else {
            status = 0;
        }
        result = {
            'status' : status,
            'key'    : key,
        };
        return result;
    }

    function ucFirst( string ) {
        return string.charAt(0).toUpperCase() + string.substr(1).toLowerCase();
    }

    function validate_pattern_form( type ){

        if( type == 'image' ){
            return true;
        }

        var options = request_options();

        if( type == 'alt' ){
  
            if( options.alt_optimization.basic_alt != 0 && ( options.alt_optimization.pattern_alt.alt != null && options.alt_optimization.pattern_alt.alt ) ){
                return true;
            }

            if( options.alt_optimization.product_alt != 0 && ( options.alt_optimization.pattern_alt.prod_alt != null && options.alt_optimization.pattern_alt.prod_alt ) ){
                return true;
            }

            return false;

        } else if ( type == 'title' ) {

            if( options.title_renamer.basic_title != 0 && ( options.title_renamer.pattern_title.title != null && options.title_renamer.pattern_title.title ) ){

                return true;
            }

            if( options.title_renamer.product_title != 0 && ( options.title_renamer.pattern_title.prod_title != null && options.title_renamer.pattern_title.prod_title ) ){

                return true;
            }

            return false;
        } 
    }

    function ajax_event( switcher ){
        if( switcher ){
            $( '.io-buttons a' ).each( function(){
                $(this).addClass( 'io-disable' );
            });
        } 
        else {
            $( '.io-buttons a' ).each( function(){
                $(this).removeClass( 'io-disable' );
            });
        }
    }

    function buttons_switcher_disabler(){
        var count = Number( $( '[data-count="not-optimize-count"]' ).text() );
        var optimized = Number( $( '[data-count="optimize-count"]' ).text() );

        if( count !== 'undefined' ){
            $.each( options, function( index, value ){
                if( !value.additional && count <= 0 ){
                    $( value.selector ).addClass( 'io-disable' );
                } else if ( value.additional && optimized <= 0 ){
                    $( value.selector ).addClass( 'io-disable' );
                }
            });
        }
    }

    function bar_toggle( attr, value = false ) {
        elem = $( '[' + attr + ']' );
        if( elem.length > 0 ) {

            status = elem.attr( attr );
            panel = $( '[data-type-panel="' + status + '"]' );

            if( value ){
                if( value != status ) {
                    panel.removeClass( 'active' );
                    $( '[data-type-panel="' + value + '"' ).addClass( 'active' );
                    elem.attr( attr, value );
                }
            } else {
                panel.addClass( 'active' );
            }
        }   
    }

})(jQuery);