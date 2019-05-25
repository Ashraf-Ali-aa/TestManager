<?php

add_action( 'acf/include_field_types', function() {
	if ( ! class_exists( 'acf_field' ) ) {
		return;
	}
	require_once( __DIR__ . '/acf-unique-ids.php' );
	new ACF_Field_Unique_ID();
} );
