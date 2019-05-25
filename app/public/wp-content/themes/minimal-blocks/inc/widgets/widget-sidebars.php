<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function minimal_blocks_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'minimal-blocks'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Displays items on sidebar.', 'minimal-blocks'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Shop Sidebar', 'minimal-blocks'),
        'id' => 'shop-sidebar',
        'description' => esc_html__('Displays items on sidebar.', 'minimal-blocks'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Column One', 'minimal-blocks'),
        'id' => 'footer-col-one',
        'description' => esc_html__('Displays items on footer first column.', 'minimal-blocks'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Column Two', 'minimal-blocks'),
        'id' => 'footer-col-two',
        'description' => esc_html__('Displays items on footer second column.', 'minimal-blocks'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Column Three', 'minimal-blocks'),
        'id' => 'footer-col-three',
        'description' => esc_html__('Displays items on footer third column.', 'minimal-blocks'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'minimal_blocks_widgets_init');