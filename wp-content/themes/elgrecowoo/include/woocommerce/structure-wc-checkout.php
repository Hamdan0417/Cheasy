<?php
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_output_all_notices', 10 );
add_action( 'woocommerce_before_checkout_form', 'woocommerce_output_all_notices', 5 );

function adswth_before_login_checkout_form(){
	echo '<div class="row">';
}
add_action( 'woocommerce_before_checkout_form', 'adswth_before_login_checkout_form', 8 );

function adswth_after_login_checkout_form(){
	echo '</div>';
}
add_action( 'woocommerce_before_checkout_form', 'adswth_after_login_checkout_form', 15 );

function adswth_form_field_args( $args, $key, $value = null ) {
    /*********************************************************************************************/
    /** This is not meant to be here, but it serves as a reference
    /** of what is possible to be changed. /**

    $defaults = array(
    'type'              => 'text',
    'label'             => '',
    'description'       => '',
    'placeholder'       => '',
    'maxlength'         => false,
    'required'          => false,
    'id'                => $key,
    'class'             => array(),
    'label_class'       => array(),
    'input_class'       => array(),
    'return'            => false,
    'options'           => array(),
    'custom_attributes' => array(),
    'validate'          => array(),
    'default'           => '',
    );
    /*********************************************************************************************/
    // Start field type switch case
    switch ( $args['id'] ) {

        case "billing_first_name" :
        case "billing_address_1" :
            $args['class'][] = 'col-12 col-md-6';
            $args['input_class'] = array('form-control', 'w-100');
            $args['label_class'] = array('control-label', 'w-100');
            break;

        case "billing_last_name" :
        case "billing_address_2" :
            $args['class'][] = 'col-12 col-md-6';
            $args['input_class'] = array('form-control', 'w-100');
            $args['label_class'] = array('control-label', 'w-100');
            break;

        case "billing_company" :
        case "billing_country" :
        case "billing_city" :
        case "billing_state" :
        case "billing_postcode" :
        case "billing_phone" :
        case "billing_email" :
        case "order_comments" :
            $args['class'][] = 'col-12';
            $args['input_class'] = array('form-control', 'w-100');
            $args['label_class'] = array('control-label', 'w-100');
            break;

        default :
            $args['class'][] = 'col-12';
            $args['input_class'] = array('form-control', 'w-100');
            $args['label_class'] = array('control-label', 'w-100');
            break;
    }

    return $args;
}
/*	$foo = [
		'billing_first_name' => [
			'class'       => [ 'col-12', 'col-md-6' ],
			'input_class' => [ 'w-100' ],
			'label_class' => [ 'w-100' ]
		],
		'billing_last_name' => [
			'class'       => [ 'col-12', 'col-md-6' ],
			'input_class' => [ 'w-100' ],
			'label_class' => [ 'w-100' ]
		],
		'billing_company' => [
			'class'       => [ 'col-12' ],
			'input_class' => [ 'w-100' ],
			'label_class' => [ 'w-100' ]
		],
		'billing_country' => [
			'class'       => [ 'col-12' ],
			'input_class' => [ 'w-100' ],
			'label_class' => [ 'w-100' ]
		],
		'billing_address_1' => [
			'class'       => [ 'col-12', 'col-md-6' ],
			'input_class' => [ 'w-100' ],
			'label_class' => [ 'w-100' ]
		],
		'billing_address_2' => [
			'class'       => [ 'col-12', 'col-md-6' ],
			'input_class' => [ 'w-100' ],
			'label_class' => [ 'w-100' ]
		],
		'billing_city' => [
			'class'       => [ 'col-12' ],
			'input_class' => [ 'w-100' ],
			'label_class' => [ 'w-100' ]
		],
		'billing_state' => [
			'class'       => [ 'col-12' ],
			'input_class' => [ 'w-100' ],
			'label_class' => [ 'w-100' ]
		],
		'billing_postcode' => [
			'class'       => [ 'col-12' ],
			'input_class' => [ 'w-100' ],
			'label_class' => [ 'w-100' ]
		],
		'billing_phone' => [
			'class'       => [ 'col-12', 'col-md-6' ],
			'input_class' => [ 'w-100' ],
			'label_class' => [ 'w-100' ]
		],
		'billing_email' => [
			'class'       => [ 'col-12', 'col-md-6' ],
			'input_class' => [ 'w-100' ],
			'label_class' => [ 'w-100' ]
		],

		'order_comments' => [
			'class'       => [ 'col-12' ],
			'input_class' => [ 'w-100' ],
			'label_class' => [ 'w-100' ]
		],

		'shipping_first_name' => [
			'class'       => [ 'col-12', 'col-md-6' ],
			'input_class' => [ 'w-100' ],
			'label_class' => [ 'w-100' ]
		],
		'shipping_last_name' => [
			'class'       => [ 'col-12', 'col-md-6' ],
			'input_class' => [ 'w-100' ],
			'label_class' => [ 'w-100' ]
		],
		'shipping_company' => [
			'class'       => [ 'col-12' ],
			'input_class' => [ 'w-100' ],
			'label_class' => [ 'w-100' ]
		],
		'shipping_country' => [
			'class'       => [ 'col-12' ],
			'input_class' => [ 'w-100' ],
			'label_class' => [ 'w-100' ]
		],
		'shipping_address_1' => [
			'class'       => [ 'col-12', 'col-md-6' ],
			'input_class' => [ 'w-100' ],
			'label_class' => [ 'w-100' ]
		],
		'shipping_address_2' => [
			'class'       => [ 'col-12', 'col-md-6' ],
			'input_class' => [ 'w-100' ],
			'label_class' => [ 'w-100' ]
		],
		'shipping_city' => [
			'class'       => [ 'col-12' ],
			'input_class' => [ 'w-100' ],
			'label_class' => [ 'w-100' ]
		],
		'shipping_state' => [
			'class'       => [ 'col-12' ],
			'input_class' => [ 'w-100' ],
			'label_class' => [ 'w-100' ]
		],
		'shipping_postcode' => [
			'class'       => [ 'col-12' ],
			'input_class' => [ 'w-100' ],
			'label_class' => [ 'w-100' ]
		]
	];*/



add_filter( 'woocommerce_form_field_args', 'adswth_form_field_args', 10, 3 );

