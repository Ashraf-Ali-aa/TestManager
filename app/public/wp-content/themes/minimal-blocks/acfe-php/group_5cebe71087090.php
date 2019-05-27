<?php 

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5cebe71087090',
	'title' => 'Test Suite - MetaBox',
	'fields' => array(
		array(
			'key' => 'field_5cebe7c50ca99',
			'label' => 'Test Cases',
			'name' => 'test_cases',
			'type' => 'relationship',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'acfe_validate' => '',
			'acfe_update' => '',
			'acfe_permissions' => '',
			'post_type' => array(
				0 => 'test_case',
			),
			'taxonomy' => '',
			'filters' => array(
				0 => 'search',
				1 => 'taxonomy',
			),
			'elements' => '',
			'min' => '',
			'max' => '',
			'return_format' => 'object',
			'acfe_bidirectional' => array(
				'acfe_bidirectional_enabled' => '0',
			),
		),
		array(
			'key' => 'field_5cebe812748af',
			'label' => 'Projects',
			'name' => 'projects',
			'type' => 'relationship',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'acfe_validate' => '',
			'acfe_update' => '',
			'acfe_permissions' => '',
			'post_type' => array(
				0 => 'projects',
			),
			'taxonomy' => '',
			'filters' => array(
				0 => 'search',
				1 => 'taxonomy',
			),
			'elements' => '',
			'min' => '',
			'max' => '',
			'return_format' => 'object',
			'acfe_bidirectional' => array(
				'acfe_bidirectional_enabled' => '1',
				'acfe_bidirectional_related' => 'field_5cebe8f2c55c4',
			),
		),
		array(
			'key' => 'field_5cebe95584faf',
			'label' => 'Project Category',
			'name' => 'project_category',
			'type' => 'taxonomy',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'acfe_validate' => '',
			'acfe_update' => '',
			'acfe_permissions' => '',
			'taxonomy' => 'projects',
			'field_type' => 'multi_select',
			'allow_null' => 0,
			'add_term' => 0,
			'save_terms' => 1,
			'load_terms' => 1,
			'return_format' => 'object',
			'acfe_bidirectional' => array(
				'acfe_bidirectional_enabled' => '0',
			),
			'multiple' => 0,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'test_suite',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'seamless',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
	'acfe_display_title' => '',
	'acfe_autosync' => array(
		0 => 'php',
	),
	'acfe_permissions' => '',
	'acfe_note' => '',
	'acfe_meta' => '',
	'modified' => 1558965209,
));

endif;