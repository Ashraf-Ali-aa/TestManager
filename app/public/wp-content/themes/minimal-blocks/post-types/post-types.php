<?php

function cptui_register_my_cpts() {

    $themeName = get_template();

	/**
	 * Post Type: Projects.
	 */

	$labels = array(
		"name"          => __( "Projects", $themeName ),
		"singular_name" => __( "Project", $themeName ),
	);

	$args = array(
		"label"                 => __( "Projects", $themeName ),
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
		"show_in_nav_menus"     => true,
		"exclude_from_search"   => false,
		"capability_type"       => "post",
		"map_meta_cap"          => true,
		"hierarchical"          => true,
		"rewrite"               => array( "slug" => "projects", "with_front" => true ),
		"query_var"             => true,
		"supports"              => array( "title", "editor", "thumbnail" ),
		"taxonomies"            => array( "category" ),
        "show_in_graphql"       => true,
        "graphql_plural_name"   => "Projects",
		"graphql_single_name"   => "Project",


	);

	register_post_type( "projects", $args );

	/**
	 * Post Type: Test Suites.
	 */

	$labels = array(
		"name"          => __( "Test Suites", $themeName ),
		"singular_name" => __( "Test Suite", $themeName ),
	);

	$args = array(
		"label"                 => __( "Test Suites", $themeName ),
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
		"show_in_nav_menus"     => true,
		"exclude_from_search"   => false,
		"capability_type"       => "post",
		"map_meta_cap"          => true,
		"hierarchical"          => true,
		"rewrite"               => array( "slug" => "test_suite", "with_front" => true ),
		"query_var"             => true,
        "supports"              => array( "title", "thumbnail" ),
        "show_in_graphql"       => true,
        "graphql_plural_name"   => "Test Suites",
		"graphql_single_name"   => "Test Suite",
	);

	register_post_type( "test_suite", $args );

	/**
	 * Post Type: Test Cases.
	 */

	$labels = array(
		"name"          => __( "Test Cases", $themeName ),
		"singular_name" => __( "Test Case", $themeName ),
	);

	$args = array(
		"label"                 => __( "Test Cases", $themeName ),
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
		"show_in_nav_menus"     => true,
		"exclude_from_search"   => false,
		"capability_type"       => "post",
		"map_meta_cap"          => true,
		"hierarchical"          => false,
		"rewrite"               => array( "slug" => "test_case", "with_front" => true ),
		"query_var"             => true,
		"supports"              => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "test_case", $args );

	/**
	 * Post Type: Results.
	 */

	$labels = array(
		"name"          => __( "Results", $themeName ),
		"singular_name" => __( "Result", $themeName ),
	);

	$args = array(
		"label"                 => __( "Results", $themeName ),
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
		"show_in_nav_menus"     => true,
		"exclude_from_search"   => false,
		"capability_type"       => "post",
		"map_meta_cap"          => true,
		"hierarchical"          => false,
		"rewrite"               => array( "slug" => "results", "with_front" => true ),
		"query_var"             => true,
		"supports"              => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "results", $args );

	/**
	 * Post Type: Requirements.
	 */

	$labels = array(
		"name"          => __( "Requirements", $themeName ),
		"singular_name" => __( "Requirement", $themeName ),
	);

	$args = array(
		"label"                 => __( "Requirements", $themeName ),
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
		"show_in_nav_menus"     => true,
		"exclude_from_search"   => false,
		"capability_type"       => "post",
		"map_meta_cap"          => true,
		"hierarchical"          => false,
		"rewrite"               => array( "slug" => "requirements", "with_front" => true ),
		"query_var"             => true,
		"supports"              => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "requirements", $args );

	/**
	 * Post Type: Scenarios.
	 */

	$labels = array(
		"name"          => __( "Scenarios", $themeName ),
		"singular_name" => __( "scenario", $themeName ),
	);

	$args = array(
		"label"                 => __( "Scenarios", $themeName ),
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
		"show_in_nav_menus"     => true,
		"exclude_from_search"   => false,
		"capability_type"       => "post",
		"map_meta_cap"          => true,
		"hierarchical"          => false,
		"rewrite"               => array( "slug" => "scenarios", "with_front" => true ),
		"query_var"             => true,
		"supports"              => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "scenarios", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );
