<?php

\adswth\adsOptions::add_section( 'advanced', [
	'title'       => __( 'Reset Options', 'davinciwoo' ),
	'priority' 	  => 999,
    'description' => __( 'Click the reset button to reset all options to default values.', 'davinciwoo' ),
] );

\adswth\adsOptions::add_field( '', [
    'type'        => 'custom',
    'settings'    => 'custom_title_advanced_reset',
	'section'     => 'advanced',
    'default'     => '<div class="reset-options-container"><button name="Reset" id="adswth-customizer-reset" class="button-primary button" title="Reset Theme Options">' . __( 'Reset Theme Options', 'davinciwoo' ) . '</button></div>',
]);