<?php
$taxonomy_terms = array(
    // Platforms
    array("term" => "iOS",         "taxonomy" => "platform", "description" => "", "slug" => ""),
    array("term" => "Android",     "taxonomy" => "platform", "description" => "", "slug" => ""),
    array("term" => "Amazon Fire", "taxonomy" => "platform", "description" => "", "slug" => ""),

    // Territories
    array("term" => "United Kingdom",      "taxonomy" => "territory", "description" => "", "slug" => ""),
    array("term" => "Italy",               "taxonomy" => "territory", "description" => "", "slug" => ""),
    array("term" => "Germany",             "taxonomy" => "territory", "description" => "", "slug" => ""),
    array("term" => "Republic of Ireland", "taxonomy" => "territory", "description" => "", "slug" => ""),

    // Supported devices
    array("term" => "Phone",  "taxonomy" => "supported_device", "description" => "", "slug" => ""),
    array("term" => "Tablet", "taxonomy" => "supported_device", "description" => "", "slug" => ""),
    array("term" => "TV",     "taxonomy" => "supported_device", "description" => "", "slug" => ""),

    // Status
    array("term" => "Blocked",          "taxonomy" => "current_status", "description" => "", "slug" => ""),
    array("term" => "Work in progress", "taxonomy" => "current_status", "description" => "", "slug" => ""),
    array("term" => "Pending",          "taxonomy" => "current_status", "description" => "", "slug" => ""),
    array("term" => "Approved",         "taxonomy" => "current_status", "description" => "", "slug" => ""),

    // Testing Type
    array("term" => "Unit",        "taxonomy" => "testing_type", "description" => "", "slug" => ""),
    array("term" => "Integration", "taxonomy" => "testing_type", "description" => "", "slug" => ""),
    array("term" => "UI",          "taxonomy" => "testing_type", "description" => "", "slug" => ""),
    array("term" => "Snapshot",    "taxonomy" => "testing_type", "description" => "", "slug" => ""),
    array("term" => "End to End",  "taxonomy" => "testing_type", "description" => "", "slug" => ""),
    array("term" => "Manual",      "taxonomy" => "testing_type", "description" => "", "slug" => ""),
    array("term" => "Regression",  "taxonomy" => "testing_type", "description" => "", "slug" => ""),

    // Features
    array("term" => "Video Player", "taxonomy" => "features", "description" => "", "slug" => ""),
);

// Register Custom Taxonomy
function add_custom_taxonomy()
{
    global $taxonomy_terms;

    foreach ($taxonomy_terms as $item) {
        if (!term_exists($item["term"], $item["taxonomy"])) {
            wp_insert_term(
                $item["term"],
                $item["taxonomy"],
                array(
                    'description' => $item["description"],
                    'slug'        => $item["slug"]
                )
            );
        }
    }
}

// Hook into the 'init' action
add_action('init', 'add_custom_taxonomy');