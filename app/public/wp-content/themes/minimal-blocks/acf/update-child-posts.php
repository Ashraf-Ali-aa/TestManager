<?php
function get_term_id($term)
{
    return $term->term_id;
}

add_action('acf/save_post', 'update_child_taxonomy', 20);
function update_child_taxonomy($post_id)
{
    $project_taxonomy = "projects";

    if (get_post_type($post_id) != $project_taxonomy) {
        return;
    }

    $project_taxonomy_acf_key = "field_5cebc49cd3a90";

    $requirement_acf_key  = "field_5cdeb5c813d58";
    $test_suites_acf_key  = "field_5cebe8f2c55c4";

    $requirement_posts = get_field($requirement_acf_key, $post_id);
    $test_suites_posts = get_field($test_suites_acf_key, $post_id);
    $post_term_ids     = get_post_term_ids($project_taxonomy_acf_key, $post_id);

    if ($requirement_posts) {
        set_post_terms($requirement_posts, $post_term_ids, $project_taxonomy);
    }

    if ($test_suites_posts) {
        set_post_terms($test_suites_posts, $post_term_ids, $project_taxonomy);
    }
}

function set_post_terms($posts, $term_ids, $taxonomy)
{
    foreach ($posts as $related_post) {
        if (!has_term($term_ids, $related_post->ID)) {
            wp_set_post_terms($related_post->ID, $term_ids, $taxonomy);
        }
    }
}

function get_post_term_ids($acf_key, $post_id)
{
    $post_terms = get_field($acf_key, $post_id);

    return array_map(function ($key) {
        return $key->term_id;
    }, $post_terms);
}