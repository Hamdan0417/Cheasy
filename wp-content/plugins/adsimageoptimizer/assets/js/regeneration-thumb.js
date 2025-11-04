document.addEventListener("DOMContentLoaded", function(event) {
    new regenerationThumb( 'regeneration_thumb' );
});

class regenerationThumb {
    constructor( selector ) {
        this.button = document.getElementById( selector );
        this.init();
    }

    init() {
        this.eventClick();
    }

    eventClick() {
        if( this.button ) {
            this.button.addEventListener( 'click', ( function( e ) {
                this.regeneration();
                e.preventDefault();
            }).bind( this ) );
        }
    }

    regeneration() {
        let count = this.getCount();
        this.process( count );
    }

    process( count ) {
        --count;
        let id = this.getIdAttachment( count );
        console.log( id, count );
        if( id && count > 0 ){
            if( this.generationThumb( id ) )
                this.process( count );
        } else {
            console.log( 'end', count );
        }
    }

    getCount() {
        let data = {
            'action'     : 'IO_ajax',
            'IO_handler' : 'get_all_attachment_count',
            'count'      : true,
        };

        let response = jQuery.ajax({
            type:"post",
            url : REGENERATION_THUMB.url,
            data: data,
            dataType: 'json',
            async:false
        }).responseJSON;

        return ( response.status == 'SUCCESS' ) ? response.result : 0;
    }

    getIdAttachment( offset ) {
        let data = {
            'action'     : 'IO_ajax',
            'IO_handler' : 'get_id_from_attachment',
            'offset'     : offset,
        };
        let response = jQuery.ajax({
            type:"post",
            url : REGENERATION_THUMB.url,
            data: data,
            dataType: 'json',
            async:false
        }).responseJSON;

        return ( response.status == 'SUCCESS' ) ? response.result : false;
    }

    generationThumb( id ) {
        let data = {
            'action'     : 'IO_ajax',
            'IO_handler' : 'generate_thumb',
            'id_attach'  : id
        };

        let response = jQuery.ajax({
            type:"post",
            url : REGENERATION_THUMB.url,
            data: data,
            dataType: 'json',
            async:false
        }).responseJSON;

        return response;
    }
}