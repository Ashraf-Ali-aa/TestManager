<?php

$taxonomies = array(
    array(
        "name"                => "Platform",
        "singular_name"       => "Platform",
        "slug"                => "platform",
        "with_front"          => true,
        "supported_post_type" => array(
            "projects", "test_suite", "test_case", "results", "scenarios"
        )
    ),
    array(
        "name"                => "Territories",
        "singular_name"       => "Territory",
        "slug"                => "territory",
        "with_front"          => true,
        "supported_post_type" => array(
            "projects", "test_suite", "test_case", "results", "scenarios"
        )
    ),
    array(
        "name"                => "Supported Devices",
        "singular_name"       => "Supported Device",
        "slug"                => "supported_device",
        "with_front"          => true,
        "supported_post_type" => array(
            "projects", "test_suite", "test_case", "results", "scenarios"
        )
    ),
    array(
        "name"                => "Projects",
        "singular_name"       => "Project",
        "slug"                => "projects",
        "with_front"          => true,
        "supported_post_type" => array(
            "projects", "test_suite", "test_case", "results", "scenarios"
        )
    ),
    array(
        "name"                => "Status",
        "singular_name"       => "Status",
        "slug"                => "status",
        "with_front"          => true,
        "supported_post_type" => array(
            "projects", "test_suite", "test_case", "results", "scenarios"
        )
    ),
    array(
        "name"                => "Testing Type",
        "singular_name"       => "Testing Type",
        "slug"                => "testing_type",
        "with_front"          => true,
        "supported_post_type" => array(
            "test_case", "results"
        )
    ),
);

function register_custom_taxonomies()
{
    /**
     * Taxonomies
     */
    global $taxonomies;
    $themeName = get_template();

    foreach ($taxonomies as $taxonomy) {
        $labels = array(
            "name"          => __($taxonomy["name"], $themeName),
            "singular_name" => __($taxonomy["singular_name"], $themeName),
        );

        $args = array(
            "label"                 => __($taxonomy["name"], $themeName),
            "labels"                => $labels,
            "public"                => true,
            "publicly_queryable"    => true,
            "hierarchical"          => false,
            "show_ui"               => true,
            "show_in_menu"          => true,
            "show_in_nav_menus"     => true,
            "query_var"             => true,
            "slug"                  => array('slug' => $taxonomy["slug"], 'with_front' => $taxonomy["with_front"]),
            "show_admin_column"     => false,
            "show_in_rest"          => true,
            "rest_base"             => $taxonomy["slug"],
            "rest_controller_class" => "WP_REST_Terms_Controller",
            "show_in_quick_edit"    => false,
        );

        array_push($taxonomy["supported_post_type"], "options");

        register_taxonomy($taxonomy["slug"], $taxonomy["supported_post_type"], $args);
    }
}

add_action('init', 'register_custom_taxonomies');