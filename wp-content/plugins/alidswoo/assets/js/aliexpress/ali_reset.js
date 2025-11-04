jQuery( function($) {

    let lockBtn = false;

    let resetProduct = ( function(){

        let $this = null,
            con = {
                total   : '#total_item',
                current : '#current_item'
            },
            obj = {
                form     : '#ads_setting-form',
                list     : '#ads_activities-list',
                progress : '#activity-list'
            },
            atc = {
                save   : '#js-saveSettings',
                update : '#js-startNow',
                next   : '#js-getNext'
            },
            $tmpl = {
                settings : $('#ali-update-settings').html(),
                item     : $('#item-product-template').html()
            },
            taskTimer = null;

        function renderSettingForm ( response ) {

            let target = $( obj.form );

            if( response ) {

                if ( response.hasOwnProperty( 'error' ) ) {
                    window.ADS.notify( response.error, 'danger' );
                } else {

                    target.html( window.ADS.objTotmpl( $tmpl.settings, response ) );
                    setTimeout( window.ADS.switchery( target ), 300 );

                    let total   = parseInt( $( con.total ).val() ),
                        current = parseInt( $( con.current ).val() );

                    if( current > 0 && total > 0 ) {
                        window.ADS.progress( $( obj.progress ), total, current );
                    }

                    let select = $('#ads_setting-form [name="applyto"]').val();
                    select = select ? select.split(','): [];

                    $('#ads_setting-form .js-select-cat').find('[multiple="multiple"]').multiselect('select', select);

                    if( response.hasOwnProperty( 'message' ) ){
                        window.ADS.notify(response.message, 'success');
                    }

                    $.event.trigger( {
                        type : "request:done",
                        obj  : '#'+$(obj.form).attr('id')
                    } );
                }
            }
        }

        function request(action, args, callback) {

            args = args !== '' && typeof args === 'object' ? window.ADS.serialize(args) : args;

            $.ajaxQueue({
                url: ajaxurl,
                data: {action: 'ads_reset_product', ads_action: action, args: args},
                type: 'POST',
                dataType: 'json',
                success: callback
            });
        }

        function send(action, args, callback) {

            $.ajaxQueue({
                url: ajaxurl,
                data: {action: 'ads_reset_product', ads_action: action, args: args},
                type: 'POST',
                dataType: 'json',
                success: callback
            });
        }

        function updateActivity( response ) {

            let item = $( obj.list ).find('[data-post_id="' + response.post_id + '"]');
            item.find('.status-message').html( $('<span/>', {class: response.notice_color}).text( response.notice ) );
            let price_item = item.find('.price-item');
            price_item.html( response.html_price );

            if( response.changePrice )
                price_item.addClass( 'price-' + response.changePrice );

            if( response.changeQuantity )
                price_item.addClass( 'quantity-' + response.changeQuantity );

            getNextProduct( response );
        }

        function sendUpdate( e, params ) {

            clearTimeout(taskTimer);
            let post_id = params.post_id;

            let data = {
                post_id: post_id,
                product: e.product,
                code: e.code,
                option: {
                    resetVariantStockPrice  : $('#resetAll').is(':checked'),
                    resetDescription : $('#resetDescription').is(':checked'),
                    resetFeaturedAndGallery    : $('#resetFeaturedAndGallery').is(':checked'),
                }
            };

            send('reset_product', data, updateActivity);
        }

        function getNextProduct( response ) {

            if (response.hasOwnProperty('error')) {

                window.ADS.notify(response.error, 'danger');

                window.ADS.btnUnLock(lockBtn);
                lockBtn = false;
            } else if ( response.hasOwnProperty( 'message' ) ) {

                window.ADS.notify(response.message, 'success');
                window.ADS.progress( $(obj.progress), 10, 10 );

                window.ADS.btnUnLock(lockBtn);
                lockBtn = false;
            } else {

                var $el = $( obj.list );

                if (!$el.find('.table-container').length)
                    $el.html($('<div/>', {class: 'table-container'}));

                $el = $el.find('.table-container');

                window.ADS.progress( $(obj.progress), response.total, response.current );

                var c = $el.find('.review-item');

                if (c.length >= 15) {
                    c.last().remove();
                }
                if(response.row.post_id){
                    $el.prepend( window.ADS.objTotmpl( $tmpl.item, response.row ) );
                }

                $( con.current ).val(response.current);

                //Skip update product from aliexpress.ru
                if(response.hasOwnProperty('row') && response.row.hasOwnProperty('url') && response.row.url){
                    if(response.row.url.includes('aliexpress.ru')){
                        $('[data-post_id="'+response.row.post_id+'"]').find('.status-message').html('');
                        reset(false);
                    }
                }

                if( ! response.row.url ) {
                    if(response.row.post_id)
                        $('[data-post_id="'+response.row.post_id+'"]').find('.status-message').html('');
                    reset(false);
                } else {

                    var params = {
                        post_id : response.row.post_id,
                        url     : response.row.url,
                        product_id : response.row.product_id
                    };

                    let urls = {
                        post_id: response.row.post_id,
                        productUrl : response.row.url,
                        product_id : response.row.product_id,
                    };

                    return new Promise(async function (resolve){

                        let e = await window.ADS.aliExtension.productAli( urls.productUrl);

                        if (e.code === false) {
                            return Promise.reject();
                        }

                        let product = e.product;

                        if (e.code && e.code === 404) {
                            product = {
                                id: urls.product_id,
                            };
                            product.available_product = false;
                        } else {
                            product.description = '';
                            product.available_product = true;
                        }

                        e.product = window.ADS.b64EncodeUnicode(JSON.stringify(product));

                        let args = {
                            post_id: response.row.post_id,
                            product: e.product,
                            code: e.code,
                        };

                        sendUpdate(args, params);
                        resolve();
                    })


                    /*taskTimer = setTimeout(function () {
                        window.ADS.aliExtension.startTask(response.row.url);
                    }, 60000);*/

                }
            }
        }

        function reset( first ) {

            var action = first ? 'first_product' : 'next_product';

            request( action, $( obj.form ), getNextProduct );
        }

        function checkStatus() {
            let inn = $('#interval').parents('.form-group');

            if( $(document).find('#enabled').is(':checked') ) {
                inn.show();
            } else {
                inn.hide();
            }
        }

        return {
            init: function(){

                $this = this;

                window.ADS.aliExtension.sleepTask(1);
                window.ADS.aliExtension.enableAjax();

                request( 'setting_form', '', renderSettingForm );

                $(document).on('click', atc.update, function(e){

                    e.preventDefault();

                    $( obj.list ).html('');
                    $( atc.next ).remove();

                    lockBtn = $(this);
                    window.ADS.btnLock( lockBtn );

                    $( con.current ).val(0);

                    window.ADS.progress( $( obj.progress ), 0, 0 );

                    reset(true);
                });

                $(document).on('click', atc.next, function(e){

                    e.preventDefault();

                    $( obj.list ).html('');
                    $( atc.next ).remove();

                    lockBtn = $(atc.update);
                    window.ADS.btnLock( lockBtn );

                    reset();
                });

                $(document).on('click', atc.save, function(e){
                    //console.log(atc.save);
                    e.preventDefault();

                    lockBtn = $(this);
                    window.ADS.btnLock( lockBtn );

                    request( 'save_form', $(obj.form), renderSettingForm );
                });

                $(document).on('request:done', function(e) {
                    if( e.obj === obj.form ) {
                        checkStatus();
                    }
                });

                $(document).on('click', '#enabled', function(){

                    var interval = $('#interval').parents('.form-group');

                    if( $(this).is(':checked') ) {
                        interval.show();
                    } else {
                        interval.hide();
                    }
                });


            }
        };
    })();

    resetProduct.init();
});