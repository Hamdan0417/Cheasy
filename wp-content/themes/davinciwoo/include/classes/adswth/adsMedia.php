<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 03.12.2018
 * Time: 16:39
 */

namespace adswth;

class adsMedia extends Ads {

	public function __construct() {
		parent::__construct();
		global $wpdb;
		$this->wpdb = $wpdb;
	}

	public function action_save_image_blob( $post ) {

		$imageBlob = isset($_FILES[ 'file_blob' ]) ? $_FILES[ 'file_blob' ] : false ;

		$imgUrl = $post[ 'src' ];

		$pr = isset( $post[ 'crop_name' ] ) && $post[ 'crop_name' ] ? basename( $post[ 'crop_name' ] ) : 'cropped';

		$ext = $this->getExtUrlImg( $imgUrl );

		return $this->attachmentImageBlob( $pr, $imageBlob, $ext, false );
	}

	public function attachmentImageBlob( $post_id, $blob, $ext, $name = false ) {

		if( $name ){
			list( $name ) = explode( '.', $name );
		}else{
			$name = wp_generate_password( 6, false, false );
		}

		$filename    = $post_id . '-' . $this->hashName( $name ) . '.' . $ext;
		$wp_filetype = wp_check_filetype( $filename );

		if( ! $wp_filetype ) {
			return [
				'error' => 'error: file_type',
				'url' => false,
				'id'  => false
			];
		}

		$attach_id = $this->loadImages( $post_id, $blob, $filename, basename( $filename ), true );

		if(!$attach_id){
			return [
				'error' => 'error: not attach_id',
				'url' => false,
				'id'  => false
			];
		}

		return [
			'url' => $this->getImageById( $attach_id, 'full' ),
			'id'  => $attach_id
		];
	}

	private function hashName( $name ){
		$a = substr( md5( $name ), 0, 6 );
		return $a;
	}

	public function getImageById( $id, $size = 'thumbnail' ) {

		$img = wp_get_attachment_image_src( $id, $size, false );

		if ( $img ) {
			return $img[ 0 ];
		}

		return false;
	}

	private function loadImages( $post_id, $data , $filename, $name, $replace = false) {

		$uploaddir  = wp_upload_dir();
		$uploadfile = $uploaddir[ 'path' ] . '/' . $filename;

		if ( ! file_exists( $uploadfile ) || $replace ) {

			if( isset( $data[ 'tmp_name' ] ) ) {
				if( !move_uploaded_file( $data[ 'tmp_name' ], $uploadfile ) ) {
					return false;
				}
			}else{
				$contents = $this->getContentData( $data );

				if( $contents == false )
					return false;

				$savefile = @fopen( $uploadfile, 'w' );

				if( $savefile ) {

					fwrite( $savefile, $contents );
					fclose( $savefile );
				} else {
					return false;
				}
			}

		}


		if ( !file_exists( $uploadfile ) ) {
			return false;
		}

		if ( filesize( $uploadfile ) == 0 ) {
			unlink( $uploadfile );
			return false;
		}

		$wp_filetype = wp_check_filetype( basename( $filename ), null );
		$name        = apply_filters( 'media_attachment_title', $name, $post_id );

		$attachment_data = [
			'post_mime_type' => $wp_filetype[ 'type' ],
			'post_title'     => $name,
			'post_content'   => '',
			'post_status'    => 'inherit'
		];

		$attach_id    = wp_insert_attachment( $attachment_data, $uploadfile, $post_id );
		$imagenew     = get_post( $attach_id );
		$fullsizepath = get_attached_file( $imagenew->ID );

		if( !function_exists( 'wp_generate_attachment_metadata' ) ){
			include( ABSPATH . 'wp-admin/includes/image.php' );
		}


		$attach_data = \wp_generate_attachment_metadata( $attach_id, $fullsizepath );

		$attach_data[ 'image_meta' ][ 'title' ] = $name;

		\wp_update_attachment_metadata( $attach_id, $attach_data );

		update_post_meta( $attach_id, '_wp_attachment_image_alt', $name );

		return $attach_id;
	}

	private function getContentData( $data ){

		if( substr( $data, 0, 2 ) == '//' ){
			$data = 'http:'. $data;
		}

		if( substr( $data, 0, 2 ) == '//' ){
			$data = 'http:'. $data;
		}

		if( substr( $data, 0, 4 ) == 'http' ){
			return $this->file_get_contents( $data );
		}

		return base64_decode( $data );
	}

	private function file_get_contents( $file ){

		$response = wp_remote_get( $file, [	'timeout' => 15, 'sslverify' => false ]	);

		if ( ! is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) === 200 ){
			return $response[ 'body' ];
		}

		return false;
	}

	private function getPathAttachByUrl( $url ) {

		return preg_replace( '/(^.*uploads\/)/', '', $url );
	}

	private function urlToDirImg( $imgUrl ) {

		$file    = $this->getPathAttachByUrl( $imgUrl );
		$uploads = wp_get_upload_dir();

		return $uploads[ 'basedir' ] . '/' . $file;
	}

	private function getExtUrlImg( $url ){
		$parsed = parse_url( $url );
		$filename = basename( $parsed[ 'path' ] );
		$ext = explode( '.', $filename );
		$ext = $ext ? array_pop( $ext ) : '';
		return $ext;
	}
}