

(function($) {

	$( document ).on( 'ready', function(){
		
		file_explorer();

		$("html").on("dragover", function() {
			event.preventDefault();  
		    event.stopPropagation();
		    $(this).addClass('io-dragging');
			});

		$("html").on("dragleave", function() {
			event.preventDefault();  
	    	event.stopPropagation();
		    $(this).removeClass('io-dragging');
		});

		$("html").on("drop", function( event ) {
		    event.preventDefault();  
		    event.stopPropagation();
		    upload_file( event );
		    $(this).removeClass('io-dragging');
		});

	});

	var fileobj;

  	function upload_file(e) {
    	e.preventDefault();
    	fileobj = e.originalEvent.dataTransfer.files[0];
    	ajax_file_upload(fileobj);
  	}

  	function file_explorer() {
  		if( input = document.getElementById('io_upload_file') ){
  			input.onchange = function() {
		        fileobj = document.getElementById('io_upload_file').files[0];
		      	ajax_file_upload(fileobj);
	    	};
  		}
    	
  	}
 
  	function ajax_file_upload( file_obj ) {

    	if(file_obj != undefined) {
        	var data = new FormData();                  

        	data.append( 'file', file_obj );
        	data.append( 'IO_handler', 'upload_watermark' );
        	data.append( 'action', main_handler );

	      	$.ajax({
	        	type        : 'POST',
	        	url         : IMAGE_OPTIMIZER_SCRIPT.url,
	        	cache       : false,
            	contentType : false,
            	processData : false,
	        	data        : data,
	        	dataType    : "json",
	        	success:function( data ) {
	        	
	        		if( data.watermark ){
	        			$( '.io-upload-area img' ).attr( 'src', data.watermark );
	        		}
		          	message( data.msg );
		          	
	        	}
	      	});
   		}
  	}
})(jQuery);