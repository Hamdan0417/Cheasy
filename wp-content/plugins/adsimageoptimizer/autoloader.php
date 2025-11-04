<?php
spl_autoload_register( function( $class_name ) {

    $class_name = ltrim( $class_name, '\\' );

    $file = '';

    if ( strpos( $class_name, IO_PREFIX_CLASS  ) === false ) return;

    if ( $lastNsPos = strrpos( $class_name, '\\' ) ) {
        $namespace = substr( $class_name, 0, $lastNsPos );
        $class_name = substr( $class_name, $lastNsPos + 1 );
        $file = str_replace( '\\', DIRECTORY_SEPARATOR, $namespace ) . DIRECTORY_SEPARATOR;
        $file = str_replace( IO_PREFIX_CLASS, '', $file );
    }

    $file .= "{$class_name}.php";
    $file = __DIR__ . $file;

    if ( file_exists( $file ) ) require_once $file;
} );