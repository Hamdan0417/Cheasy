
function initInputNumber( callback ){

	jQuery( '.io-input-number > input' ).on( 'change', function(){
		var min = parseInt( jQuery( this ).attr( 'min' ) );
		var max = parseInt( jQuery( this ).attr( 'max' ) );

		if( jQuery( this ).val() < min ){
			jQuery( this ).val( min );
			jQuery( this ).siblings( 'span[data-type="minus"]' ).addClass( 'is-disable' );
		} else {
			jQuery( this ).siblings( 'span[data-type="minus"]' ).removeClass( 'is-disable' );
		}

		if( jQuery( this ).val() > max ){
			jQuery( this ).val( max );
			jQuery( this ).siblings( 'span[data-type="plus"]' ).addClass( 'is-disable' );
		} else {
			jQuery( this ).siblings( 'span[data-type="plus"]' ).removeClass( 'is-disable' );
		}

		if( callback ){
			callback( jQuery( this ).val() );
		}
	});

	jQuery( '.io-input-number > span' ).on( 'click', function() {
		var type = jQuery( this ).attr( 'data-type' );
		var input = jQuery( this ).siblings( 'input' );

		if( type == 'plus' ) {
			input.val( parseInt( input.val() ) + 1 );
		} else {
			input.val( parseInt( input.val() ) - 1 );
		}

		input.trigger( 'change' );
	});
}

function initSelectInput( selector, union = false, callback ) {

	var wrap = '#' + selector;

	getSelect( wrap );
	selectedEvent( wrap, union );
	SelectInput( wrap );
	outElementClick( wrap );

	jQuery( 'body' ).on( 'change',  wrap + ' > select', function(){
		getSelect( wrap );
		SelectInput( wrap );
		callback( jQuery( this ).val() );
	});

	jQuery( wrap )
		.find( 'select > option[value="' + jQuery( wrap ).attr( 'data-selected-option' ) +'"]' )
		.prop( 'selected', 'true' );

	getSelect( wrap );
	
	jQuery( wrap )
		.find( '.io-input-select-display' )
		.on( 'click', function(){
			jQuery( wrap ).toggleClass( 'open' );
		});
}

function SelectInput( selector ) {
	jQuery( selector )
		.find( '.io-input-select-display .list-options' )
		.html( renderSelectInput( selector ) );

	return jQuery( selector );
}

function unionEvent( unionSelector, current, value ){
	jQuery( unionSelector ).not( current ).each( function(){
		selector =  '#' + jQuery( this ).attr( 'id' );
		jQuery( selector ).attr( 'data-selected-option', value );
		jQuery( selector + ' option[value="' + value + '"]' ).prop( 'selected', 'true' );
		getSelect( selector );
	});
}

function renderSelectInput( selector ) {

	output = '';

 	jQuery( selector + ' select > option' ).each( function(){
 		value = jQuery( this ).attr( 'value' );
 		name  = jQuery( this ).text( );
 		selected = ( jQuery( selector).attr( 'data-selected-option' ) == jQuery( this ).attr( 'value' ) ) ? 'class="option-selected"' : '';
 		output += '<li ' + selected + ' data-value="' + value + '" >' + name + '</li>';
 	});

 	return output;
}

function getSelect( selector ) {
	jQuery( selector )
		.find( '.io-input-select-display span' )
		.text( jQuery( selector + ' option:selected' ).text() );
}

function selectedEvent( selector, union ) {
	jQuery( 'body' ).on( 'click', selector + ' .list-options li', function(){
		if( union ) {
			unionEvent( union ,selector, jQuery( this ).attr( 'data-value' ) );
		} 
		jQuery( selector ).attr( 'data-selected-option', jQuery( this ).attr( 'data-value' ) );
		jQuery( selector + ' option[value="' + jQuery( this )
			.attr( 'data-value' ) + '"]' )
			.prop( 'selected', 'true' );
		jQuery( selector + ' select' ).trigger( 'change' );
	});
}

function outElementClick( selector ) {
	jQuery( document ).on( 'click', function( event ){
		elem = jQuery( selector );

		if( event.target != elem[0] && !elem.has( event.target ).length ){ 
			elem.removeClass( 'open' );
		}

		event.stopPropagation();
	});
}

function rangeInput( selector, union, callback ) {

	jQuery( '#' + selector )
		.find( 'input[type="hidden"]' )
		.jRange({
			from : 0,
		    to   : 10,
		    step : 1,
		    onstatechange : function( e ){

		    	jQuery( union ).val( e );
		    	callback( e )
		    }
		});
}