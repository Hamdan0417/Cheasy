
const tools = {
	'bold'          : '#editor-bold',
	'italic'        : '#editor-italic',
	'strikeThrough' : '#editor-strike',
	'underline'     : '#editor-underline',
}

const selects = {
	'fontSize' : '#editor-size select',
	'fontName' : '#editor-fonts select'
}

const iframe = "iframe_editor";

const frameContent = jQuery( '#' + iframe ).contents();

function saveStamp( callback = false, args = false ){

    html2canvas( frameContent.find('body'),{
    	width : frameContent.find('body').width() + 16,
    	height: frameContent.find('body').height() + 16,
		onrendered: (canvas)=>{

			data = {
				'action'     : main_handler,
                'IO_handler' : 'render_text_watermark',
                'image_data' : canvas.toDataURL("image/png", 1.0)
			};

		  	jQuery.ajax({
                type:"post",
                url: IMAGE_OPTIMIZER_SCRIPT.url,
                dataType: 'json',
                data: data,
                success:function( data ){
 
                	if( callback && args ){
                    	callback( args );
                	}
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
		}
	});

	return false;
}

function checkTypeWatermark(){
	elem = jQuery( '[data-selected-option]' );
	if( elem.length > 0 ) {
		if( elem.attr( 'data-selected-option' ) == 'text' ) {

			return true;
		}
	}
	return false;
}

(function($) {

function init(){
	document.getElementById( iframe ).contentWindow.document.designMode = "On";
}

function applyStyle( style, args = null ) {
	document.getElementById( iframe ).contentWindow.document.execCommand(style, false, args);
	updateStamp();
}	

function changeSelect( selector, event ){
	$( selector ).on( 'change', function(){

		applyStyle( event, $( this ).val() );

		return false;
	});
}

function buttons( selector, event ) {
	$( selector + ' button' ).on( 'click', function(){
		applyStyle( event );
		frameContent.focus();

		return false;
	});
}

function onChangeEditor() {
	var container = $( '#' + iframe ).contents();
	container.donetyping( function(){
		updateStamp();
	});
}

function updateStamp(){
	saveText();
	styleEditor();
}

function styleEditor(){
	frameContent.find('body').css( {'display' : 'inline-block', 'min-width' : '50px' } );
}

$.fn.extend({
    donetyping: function(callback,timeout){
        timeout = timeout || 1e3; // 1 second default timeout
        var timeoutReference,
            doneTyping = function( el ){
                if( !timeoutReference ) return;
                timeoutReference = null;
                callback.call( el );
            };
        return this.each(function(i,el){
            var $el = $(el);
            $el.on( 'DOMSubtreeModified' ) && $el.on( 'keyup keypress paste load', function( e ){
                if( e.type=='keyup' && e.keyCode != 8 ) return;
                if( timeoutReference ) clearTimeout( timeoutReference );
                timeoutReference = setTimeout( function(){
                    doneTyping( el );
                }, timeout);
            }).on( 'blur', function(){
                doneTyping( el );
            });
        });
    }
});

function colorPicker(){
	if( $( '#colorpicker' ).length > 0 ) {
	    var colorPicker = new iro.ColorPicker( '#colorpicker', {
	        width : 150,
	        color : '#' + $( '#watermark-color' ).val(),
	    });

	    colorPicker.on( 'color:change', colorPickerChanged );

	    setColor();

	    $('#editor-color > button').on( 'click', function(){
			$('.colorpicker-wrap').toggleClass( 'active' );

			return false;
		});


	    $( '#watermark-color' ).on( 'change', function(){
	        colorPicker.color.hexString = '#' + $(this).val();
	    });
	}
}

function colorPickerChanged( color, changes ) {
    $( '#watermark-color' ).val( color.hexString.replace('#', '') );
}

function setText(){
	frameContent.find('body').html( $('#io-editor-display').html() );
}

function saveText(){
	var text = frameContent.find( 'body' ).html();

	args = {
		'key'    : 'text',
        'status' : text
	};

	update_options( false, args );
}

function setColor(){
	$( 'div.colorpicker-panel button' ).on( 'click', function(){
		color = '#' + $( '#watermark-color' ).val();
		if( color != 'undefined' && color != null ){

			applyStyle( 'foreColor', color );
			$( '#editor-color > button' ).css( 'background', color );
			$( '.colorpicker-wrap' ).removeClass( 'active' );
		
			update_options( false, { 'key' : 'color', 'status' : color } );
		}

		return false;
	});
}

$(document).on( 'ready', function(){

	var panel = $( '.io-panel' );
    var type_page = panel.attr( 'data-info' );

    if( type_page == 'watermark' ) {

		init();
		setText();
		styleEditor();
		colorPicker();
		onChangeEditor();

		$.each( tools, function( index, value ){
			buttons( value, index );
		});

		$.each( selects, function( index, value ){
			changeSelect( value, index );
		});
	}
});


})(jQuery);
