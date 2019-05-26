<?php

$post_types = array(
	array(
		"name"                => "Projects",
		"singular_name"       => "Project",
		"slug"                => "projects",
		"with_front"          => true,
		"menu_position"		  => 1,
		"show_in_menu"        => "test-management",
		"supports"            => array("title", "editor", "thumbnail"),
		"show_in_graphql"     => true,

	),
	array(
		"name"                => "Requirements",
		"singular_name"       => "Requirement",
		"slug"                => "requirements",
		"with_front"          => true,
		"menu_position"		  => 2,
		"show_in_menu"        => "test-management",
		"supports"            => array("title", "editor", "thumbnail"),
		"show_in_graphql"     => true,
	),
	array(
		"name"                => "Scenarios",
		"singular_name"       => "Scenario",
		"slug"                => "scenarios",
		"with_front"          => true,
		"menu_position"		  => 7,
		"show_in_menu"        => "test-management",
		"supports"            => array("title", "editor", "thumbnail"),
		"show_in_graphql"     => true,
	),
	array(
		"name"                => "Test Suites",
		"singular_name"       => "Test Suite",
		"slug"                => "test_suite",
		"with_front"          => true,
		"menu_position"		  => 8,
		"show_in_menu"        => "test-management",
		"supports"            => array("title", "thumbnail"),
		"show_in_graphql"     => true,
	),
	array(
		"name"                => "Test Cases",
		"singular_name"       => "Test Case",
		"slug"                => "test_case",
		"with_front"          => true,
		"menu_position"		  => 9,
		"show_in_menu"        => "test-management",
		"supports"            => array("title", "editor", "thumbnail"),
		"show_in_graphql"     => true,
	),
	array(
		"name"                => "Results",
		"singular_name"       => "Result",
		"slug"                => "results",
		"with_front"          => true,
		"menu_position"		  => 10,
		"show_in_menu"        => "test-management",
		"supports"            => array("title", "editor", "thumbnail"),
		"show_in_graphql"     => true,
	),
);

/*
* Adding a menu to contain the custom post types for Test Management
*/

function test_management_admin_menu()
{

	add_menu_page(
		'Test Management',
		'Test Management',
		'read',
		'test-management',
		'',
		'dashicons-admin-home',
		4
	);
}

add_action('admin_menu', 'test_management_admin_menu');

function register_custom_post_types()
{
	/**
	 * Post Type
	 */
	global $post_types;
	$themeName = get_template();


	foreach ($post_types as $post_type) {
		$labels = array(
			"name"          => __($post_type["name"], $themeName),
			"singular_name" => __($post_type["singular_name"], $themeName),
		);

		$args = array(
			"label"                 => __($post_type["name"], $themeName),
			"labels"                => $labels,
			"description"           => "",
			"public"                => true,
			"publicly_queryable"    => true,
			"show_ui"               => true,
			"delete_with_user"      => false,
			"show_in_rest"          => true,
			"rest_base"             => "",
			"rest_controller_class" => "WP_REST_Posts_Controller",
			"has_archive"           => false,
			"show_in_menu"          => true,
			"menu_position"         => $post_type["menu_position"],
			"show_in_nav_menus"     => true,
			"show_in_menu"          => $post_type["show_in_menu"],
			"exclude_from_search"   => false,
			"capability_type"       => "post",
			"map_meta_cap"          => true,
			"hierarchical"          => true,
			"slug"                  => array("slug" => $post_type["slug"], "with_front" => $post_type["with_front"]),
			"query_var"             => true,
			"supports"              => array("title", "editor", "thumbnail"),
			"show_in_graphql"       => $post_type["show_in_graphql"],
			"graphql_plural_name"   => $post_type["name"],
			"graphql_single_name"   => $post_type["singular_name"],
		);

		register_post_type($post_type["slug"], $args);
	}
}

add_action("init", "register_custom_post_types");

function cptui_register_my_cpts_options()
{

	/**
	 * Post Type: Options.
	 */
	$themeName = get_template();

	$labels = array(
		"name" => __("Options", $themeName),
		"singular_name" => __("Option", $themeName),
	);

	$args = array(
		"label"                 => __("Options", $themeName),
		"labels"                => $labels,
		"description"           => "",
		"public"                => true,
		"publicly_queryable"    => false,
		"show_ui"               => true,
		"delete_with_user"      => false,
		"show_in_rest"          => false,
		"rest_base"             => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive"           => false,
		"show_in_menu"          => true,
		'menu_icon'             => 'dashicons-admin-settings',
		"show_in_nav_menus"     => false,
		"exclude_from_search"   => false,
		"capability_type"       => "post",
		'capabilities'          => array(
			'create_posts' => 'do_not_allow',
		),
		"map_meta_cap" => false,
		"hierarchical" => false,
		"rewrite"      => array("slug" => "options", "with_front" => true),
		"query_var"    => true,
		"supports"     => array("title", "editor", "thumbnail"),
	);

	register_post_type("options", $args);
}

add_action('init', 'cptui_register_my_cpts_options');