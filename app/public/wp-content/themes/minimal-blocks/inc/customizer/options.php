<?php

/*Get default values to set while building customizer elements*/
$default_options = minimal_blocks_get_default_customizer_values();

/*Get image sizes*/
$image_sizes = minimal_blocks_get_all_image_sizes(true);
/* ========== Site title text size option added to default Site Identity section ========== */
$wp_customize->add_setting(
    'theme_options[header_text_color]',
    array(
        'default'           => $default_options['header_text_color'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control ( new WP_Customize_Color_Control( $wp_customize, 'theme_options[header_text_color]',
    array(
        'label'    => __( 'Site Title/Tagline Color', 'minimal-blocks' ),
        'section'  => 'title_tagline',
        'type'     => 'color',
    )
) );




$wp_customize->add_setting(
    'theme_options[enable_header_overlay]',
    array(
        'default'           => $default_options['enable_header_overlay'],
        'sanitize_callback' => 'minimal_blocks_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'theme_options[enable_header_overlay]',
    array(
        'label'    => __( 'Enable Header Overlay', 'minimal-blocks' ),
        'section'  => 'header_image',
        'type'     => 'checkbox',
    )
);

$wp_customize->add_setting(
    'theme_options[overlay_bg_color]',
    array(
        'default'           => $default_options['overlay_bg_color'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control ( new WP_Customize_Color_Control( $wp_customize, 'theme_options[overlay_bg_color]',
    array(
        'label'    => __( 'Banner Overlay Color', 'minimal-blocks' ),
        'section'  => 'header_image',
        'type'     => 'color',
    )
) );

/*Site title text size*/
$wp_customize->add_setting(
    'theme_options[site_title_text_size]',
    array(
        'default' => $default_options['site_title_text_size'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control(
    'theme_options[site_title_text_size]',
    array(
        'label' => __('Site Title Text Size', 'minimal-blocks'),
        'section' => 'title_tagline',
        'type' => 'number',
        'input_attrs' => array('min' => 1, 'max' => 100, 'style' => 'width: 150px;'),
    )
);
/**/

/* ========== Color Options added to default color section ========== */

/*Body Text Color*/
$wp_customize->add_setting(
    'theme_options[body_text_color]',
    array(
        'default' => $default_options['body_text_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control ( new WP_Customize_Color_Control( $wp_customize, 'theme_options[body_text_color]',
    array(
        'label'    => __( 'Body Text Color', 'minimal-blocks' ),
        'section'  => 'colors',
        'type'     => 'color',
    )
) );

/* ========== Color Options Close ========== */

/*Add Home Page Options Panel.*/
$wp_customize->add_panel(
    'theme_home_option_panel',
    array(
        'title' => __( 'Front Page Options', 'minimal-blocks' ),
        'description' => __( 'Contains all front page settings', 'minimal-blocks')
    )
);
/**/


/*Add Home Page Options Panel.*/
$wp_customize->add_panel(
    'theme_home_option_panel',
    array(
        'title' => __( 'Home/Front Page Sections Settings', 'minimal-blocks' ),
        'description' => __( 'Contains all front page settings', 'minimal-blocks')
    )
);
/**/


/* ========== Home Page Slider Section ========== */
$wp_customize->add_section(
    'home_banner_slider_options' ,
    array(
        'title' => __( 'Banner Slider Options', 'minimal-blocks' ),
        'panel' => 'theme_home_option_panel',
    )
);

/*Enable Banner Section*/
$wp_customize->add_setting(
    'theme_options[enable_banner_slider_posts]',
    array(
        'default'           => $default_options['enable_banner_slider_posts'],
        'sanitize_callback' => 'minimal_blocks_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'theme_options[enable_banner_slider_posts]',
    array(
        'label'    => __( 'Enable Banner Slider', 'minimal-blocks' ),
        'section'  => 'home_banner_slider_options',
        'type'     => 'checkbox',
    )
);
/**/

/*Banner Category.*/
$wp_customize->add_setting(
    'theme_options[banner_slider_cat]',
    array(
        'default'           => $default_options['banner_slider_cat'],
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control(
    new Minimal_Blocks_Dropdown_Taxonomies_Control(
        $wp_customize,
        'theme_options[banner_slider_cat]',
        array(
            'label'    => __( 'Choose Banner Slider category', 'minimal-blocks' ),
            'section'  => 'home_banner_slider_options',
        )
    )
);

/*Number of Banner Posts.*/
$wp_customize->add_setting(
    'theme_options[no_of_banner_slider_posts]',
    array(
        'default'           => $default_options['no_of_banner_slider_posts'],
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control(
    'theme_options[no_of_banner_slider_posts]',
    array(
        'label'    => __( 'No Of Posts For Banner Slider', 'minimal-blocks' ),
        'section'  => 'home_banner_slider_options',
        'type'     => 'number',
        'input_attrs' => array('min' => 1, 'max' => 3, 'style' => 'width: 150px;'),
    )
);
/**/

/*Enable Slider Meta Info*/
$wp_customize->add_setting(
    'theme_options[enable_banner_slider_meta_info]',
    array(
        'default'           => $default_options['enable_banner_slider_meta_info'],
        'sanitize_callback' => 'minimal_blocks_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'theme_options[enable_banner_slider_meta_info]',
    array(
        'label'    => __( 'Enable Category Info', 'minimal-blocks' ),
        'section'  => 'home_banner_slider_options',
        'type'     => 'checkbox',
    )
);
/**/


/* ========== Home Page Slider Section Close ========== */



/* ========== Home Page Slider Section ========== */
$wp_customize->add_section(
    'home_carousel_slider_options' ,
    array(
        'title' => __( 'Carousel Slider Options', 'minimal-blocks' ),
        'panel' => 'theme_home_option_panel',
    )
);

/*Enable Carousel Section*/
$wp_customize->add_setting(
    'theme_options[enable_carousel_slider_posts]',
    array(
        'default'           => $default_options['enable_carousel_slider_posts'],
        'sanitize_callback' => 'minimal_blocks_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'theme_options[enable_carousel_slider_posts]',
    array(
        'label'    => __( 'Enable Carousel Slider', 'minimal-blocks' ),
        'section'  => 'home_carousel_slider_options',
        'type'     => 'checkbox',
    )
);
/**/

/*Enable Carousel Section*/
$wp_customize->add_setting(
    'theme_options[carousel_slider_section_title]',
    array(
        'default'           => $default_options['carousel_slider_section_title'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'theme_options[carousel_slider_section_title]',
    array(
        'label'    => __( 'Carousel Section Title', 'minimal-blocks' ),
        'section'  => 'home_carousel_slider_options',
        'type'     => 'text',
    )
);
/**/

/*Carousel Category.*/
$wp_customize->add_setting(
    'theme_options[carousel_slider_cat]',
    array(
        'default'           => $default_options['carousel_slider_cat'],
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control(
    new Minimal_Blocks_Dropdown_Taxonomies_Control(
        $wp_customize,
        'theme_options[carousel_slider_cat]',
        array(
            'label'    => __( 'Choose Carousel Slider category', 'minimal-blocks' ),
            'section'  => 'home_carousel_slider_options',
        )
    )
);

/*Number of Carousel Posts.*/
$wp_customize->add_setting(
    'theme_options[no_of_carousel_slider_posts]',
    array(
        'default'           => $default_options['no_of_carousel_slider_posts'],
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control(
    'theme_options[no_of_carousel_slider_posts]',
    array(
        'label'    => __( 'No of Posts for Carousel Slider', 'minimal-blocks' ),
        'section'  => 'home_carousel_slider_options',
        'type'     => 'number',
        'input_attrs' => array('min' => 1, 'max' => 6, 'style' => 'width: 150px;'),
    )
);
/**/

/*Enable Slider Meta Info*/
$wp_customize->add_setting(
    'theme_options[enable_carousel_slider_meta_info]',
    array(
        'default'           => $default_options['enable_carousel_slider_meta_info'],
        'sanitize_callback' => 'minimal_blocks_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'theme_options[enable_carousel_slider_meta_info]',
    array(
        'label'    => __( 'Enable Category Info', 'minimal-blocks' ),
        'section'  => 'home_carousel_slider_options',
        'type'     => 'checkbox',
    )
);
/**/


/* ========== Home Page Slider Section Close ========== */

/* ========== Home Page Full Width Blocks Section ========== */
$wp_customize->add_section(
    'home_footer_recommend_cat_options' ,
    array(
        'title' => __( 'Footer Recommendation Options', 'minimal-blocks' ),
        'panel' => 'theme_home_option_panel',
    )
);

/*Enable Full Width Blocks Category Section*/
$wp_customize->add_setting(
    'theme_options[enable_footer_recommend_cat]',
    array(
        'default'           => $default_options['enable_footer_recommend_cat'],
        'sanitize_callback' => 'minimal_blocks_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'theme_options[enable_footer_recommend_cat]',
    array(
        'label'    => __( 'Enable Recommended Post', 'minimal-blocks' ),
        'section'  => 'home_footer_recommend_cat_options',
        'type'     => 'checkbox',
    )
);
$wp_customize->add_setting(
    'theme_options[footer_recommend_cat_title]',
    array(
        'default'           => $default_options['footer_recommend_cat_title'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'theme_options[footer_recommend_cat_title]',
    array(
        'label'       => __( 'Related Posts title', 'minimal-blocks' ),
        'section'     => 'home_footer_recommend_cat_options',
        'type'        => 'text',
        'active_callback'  => 'minimal_blocks_is_full_blocks_enabled',
    )
);

/*Full Width Blocks Category.*/
$wp_customize->add_setting(
    'theme_options[full_width_blocks_cat]',
    array(
        'default'           => $default_options['full_width_blocks_cat'],
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control(
    new Minimal_Blocks_Dropdown_Taxonomies_Control(
        $wp_customize,
        'theme_options[full_width_blocks_cat]',
        array(
            'label'    => __( 'Choose Recommended Post', 'minimal-blocks' ),
            'section'  => 'home_footer_recommend_cat_options',
            'active_callback'  => 'minimal_blocks_is_full_blocks_enabled',
        )
    )
);

/*Number of Category Posts.*/
$wp_customize->add_setting(
    'theme_options[no_of_full_width_cat_posts]',
    array(
        'default'           => $default_options['no_of_full_width_cat_posts'],
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control(
    'theme_options[no_of_full_width_cat_posts]',
    array(
        'label'    => __( 'No of Posts', 'minimal-blocks' ),
        'section'  => 'home_footer_recommend_cat_options',
        'type'     => 'number',
        'input_attrs' => array('min' => 1, 'max' => 6, 'style' => 'width: 150px;'),
        'active_callback'  => 'minimal_blocks_is_full_blocks_enabled',
    )
);
/**/

/*Enable Full Width Blocks Meta Info*/
$wp_customize->add_setting(
    'theme_options[enable_full_blocks_meta_info]',
    array(
        'default'           => $default_options['enable_full_blocks_meta_info'],
        'sanitize_callback' => 'minimal_blocks_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'theme_options[enable_full_blocks_meta_info]',
    array(
        'label'    => __( 'Enable Meta Info', 'minimal-blocks' ),
        'section'  => 'home_footer_recommend_cat_options',
        'type'     => 'checkbox',
        'active_callback'  => 'minimal_blocks_is_full_blocks_enabled',
    )
);
/**/

/* ========== Home Page Full Width Blocks Close ========== */

/* ========== Home Page Layout Section ========== */
$wp_customize->add_section(
    'home_page_layout_options',
    array(
        'title'      => __( 'Front Page Layout Options', 'minimal-blocks' ),
        'panel'      => 'theme_home_option_panel',
    )
);

/* Home Page Layout */
$wp_customize->add_setting(
    'theme_options[home_page_layout]',
    array(
        'default'           => $default_options['home_page_layout'],
        'sanitize_callback' => 'minimal_blocks_sanitize_select',
    )
);
$wp_customize->add_control(
    'theme_options[home_page_layout]',
    array(
        'label'       => __( 'Front Page Layout', 'minimal-blocks' ),
        'section'     => 'home_page_layout_options',
        'type'        => 'select',
        'choices'     => array(
            'right-sidebar' => __( 'Content - Primary Sidebar', 'minimal-blocks' ),
            'left-sidebar' => __( 'Primary Sidebar - Content', 'minimal-blocks' ),
            'no-sidebar' => __( 'No Sidebar', 'minimal-blocks' )
        ),
    )
);

/* ========== Home Page Layout Section Close ========== */

/*Add Theme Options Panel.*/
$wp_customize->add_panel(
    'theme_option_panel',
    array(
        'title' => __( 'Theme Options', 'minimal-blocks' ),
        'description' => __( 'Contains all theme settings', 'minimal-blocks')
    )
);
/**/

/* ========== Preloader Section  ========== */
$wp_customize->add_section(
    'preloader_options',
    array(
        'title'      => __( 'Preloader Options', 'minimal-blocks' ),
        'panel'      => 'theme_option_panel',
    )
);
/*Enable Preloader*/
$wp_customize->add_setting(
    'theme_options[enable_preloader]',
    array(
        'default'           => $default_options['enable_preloader'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'minimal_blocks_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'theme_options[enable_preloader]',
    array(
        'label'    => __( 'Enable Preloader', 'minimal-blocks' ),
        'section'  => 'preloader_options',
        'type'     => 'checkbox',
    )
);

/* ========== Preloader Section Close ========== */

/* ========== Layout Section ========== */
$wp_customize->add_section(
    'layout_options',
    array(
        'title'      => __( 'Layout Options', 'minimal-blocks' ),
        'panel'      => 'theme_option_panel',
    )
);

/**/

/*Masonry Animation*/
$wp_customize->add_setting(
    'theme_options[masonry_animation]',
    array(
        'default'           => $default_options['masonry_animation'],
        'sanitize_callback' => 'minimal_blocks_sanitize_select',
    )
);
$wp_customize->add_control(
    'theme_options[masonry_animation]',
    array(
        'label'       => __( 'Masonry Animation', 'minimal-blocks' ),
        'section'     => 'layout_options',
        'type'        => 'select',
        'choices'     => array(
            'none' => __( 'None', 'minimal-blocks' ),
            'default' => __( 'Default', 'minimal-blocks' ),
            'slide-up' => __( 'Slide Up', 'minimal-blocks' ),
            'slide-down' => __( 'Slide Down', 'minimal-blocks' ),
            'zoom-out' => __( 'Zoom Out', 'minimal-blocks' )
        ),
    )
);


/* Global Layout*/
$wp_customize->add_setting(
    'theme_options[global_layout]',
    array(
        'default'           => $default_options['global_layout'],
        'sanitize_callback' => 'minimal_blocks_sanitize_select',
    )
);
$wp_customize->add_control(
    'theme_options[global_layout]',
    array(
        'label'       => __( 'Global Layout', 'minimal-blocks' ),
        'section'     => 'layout_options',
        'type'        => 'select',
        'choices'     => array(
            'right-sidebar' => __( 'Content - Primary Sidebar', 'minimal-blocks' ),
            'left-sidebar' => __( 'Primary Sidebar - Content', 'minimal-blocks' ),
            'no-sidebar' => __( 'No Sidebar', 'minimal-blocks' )
        ),
    )
);

/* Image in Archive Page */
$wp_customize->add_setting(
    'theme_options[archive_image]',
    array(
        'default'           => $default_options['archive_image'],
        'sanitize_callback' => 'minimal_blocks_sanitize_select',
    )
);
$wp_customize->add_control(
    'theme_options[archive_image]',
    array(
        'label'       => __( 'Image in Archive Page', 'minimal-blocks' ),
        'section'     => 'layout_options',
        'type'        => 'select',
        'choices'     => $image_sizes,
    )
);

/* Image in Single Post*/
$wp_customize->add_setting(
    'theme_options[single_post_image]',
    array(
        'default'           => $default_options['single_post_image'],
        'sanitize_callback' => 'minimal_blocks_sanitize_select',
    )
);
$wp_customize->add_control(
    'theme_options[single_post_image]',
    array(
        'label'       => __( 'Image in Single Posts', 'minimal-blocks' ),
        'section'     => 'layout_options',
        'type'        => 'select',
        'choices'     => $image_sizes,
    )
);

/* Image in Single Page*/
$wp_customize->add_setting(
    'theme_options[single_page_image]',
    array(
        'default'           => $default_options['single_page_image'],
        'sanitize_callback' => 'minimal_blocks_sanitize_select',
    )
);
$wp_customize->add_control(
    'theme_options[single_page_image]',
    array(
        'label'       => __( 'Image in Single Page', 'minimal-blocks' ),
        'section'     => 'layout_options',
        'type'        => 'select',
        'choices'     => $image_sizes,
    )
);

/* ========== Layout Section Close ========== */

/* ========== Pagination Section ========== */
$wp_customize->add_section(
    'pagination_options',
    array(
        'title'      => __( 'Pagination Options', 'minimal-blocks' ),
        'panel'      => 'theme_option_panel',
    )
);

/*Pagination Type*/
$wp_customize->add_setting( 
    'theme_options[pagination_type]',
    array(
        'default'           => $default_options['pagination_type'],
        'sanitize_callback' => 'minimal_blocks_sanitize_select',
    )
);
$wp_customize->add_control( 
    'theme_options[pagination_type]',
    array(
        'label'       => __( 'Pagination Type', 'minimal-blocks' ),
        'section'     => 'pagination_options',
        'type'        => 'select',
        'choices'     => array(
            'default' => esc_html__( 'Default (Older / Newer Post)', 'minimal-blocks' ),
            'numeric' => esc_html__( 'Numeric', 'minimal-blocks' ),
            'button_click_load' => esc_html__( 'Button Click Ajax Load', 'minimal-blocks' ),
            'infinite_scroll_load' => esc_html__( 'Infinite Scroll Ajax Load', 'minimal-blocks' ),
        ),
    )
);
/* ========== Pagination Section Close========== */

/* ========== Breadcrumb Section ========== */
$wp_customize->add_section(
    'breadcrumb_options',
    array(
        'title'      => __( 'Breadcrumb Options', 'minimal-blocks' ),
        'panel'      => 'theme_option_panel',
    )
);

/* Breadcrumb Type*/
$wp_customize->add_setting(
    'theme_options[breadcrumb_type]',
    array(
        'default'           => $default_options['breadcrumb_type'],
        'sanitize_callback' => 'minimal_blocks_sanitize_select',
    )
);
$wp_customize->add_control(
    'theme_options[breadcrumb_type]',
    array(
        'label'       => __( 'Breadcrumb Type', 'minimal-blocks' ),
        'description' => sprintf( esc_html__( 'Advanced: Requires %1$sBreadcrumb NavXT%2$s plugin', 'minimal-blocks' ), '<a href="https://wordpress.org/plugins/breadcrumb-navxt/" target="_blank">','</a>' ),
        'section'     => 'breadcrumb_options',
        'type'        => 'select',
        'choices'     => array(
            'disabled' => __( 'Disabled', 'minimal-blocks' ),
            'simple' => __( 'Simple', 'minimal-blocks' ),
            'advanced' => __( 'Advanced', 'minimal-blocks' ),
        ),
    )
);
/* ========== Breadcrumb Section Close ========== */

/* ========== Single Posts Section ========== */
$wp_customize->add_section(
    'single_posts_options',
    array(
        'title'      => __( 'Single Post Options', 'minimal-blocks' ),
        'panel'      => 'theme_option_panel',
    )
);

/*Show Related Posts*/
$wp_customize->add_setting(
    'theme_options[show_related_posts]',
    array(
        'default'           => $default_options['show_related_posts'],
        'sanitize_callback' => 'minimal_blocks_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'theme_options[show_related_posts]',
    array(
        'label'    => __( 'Show related Posts', 'minimal-blocks' ),
        'section'  => 'single_posts_options',
        'type'     => 'checkbox',
    )
);
/**/

/* Related Post Title */
$wp_customize->add_setting(
    'theme_options[related_posts_title]',
    array(
        'default'           => $default_options['related_posts_title'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'theme_options[related_posts_title]',
    array(
        'label'       => __( 'Related Posts title', 'minimal-blocks' ),
        'section'     => 'single_posts_options',
        'type'        => 'text',
        'active_callback'  => 'minimal_blocks_is_related_posts_enabled',
    )
);
/**/
/* ========== Single Posts Section Close ========== */

/* ========== Archive Section ========== */
$wp_customize->add_section(
    'archive_options',
    array(
        'title'      => __( 'Archive Options', 'minimal-blocks' ),
        'panel'      => 'theme_option_panel',
    )
);

/*Show Description on archive pages*/
$wp_customize->add_setting(
    'theme_options[show_desc_archive_pages]',
    array(
        'default'           => $default_options['show_desc_archive_pages'],
        'sanitize_callback' => 'minimal_blocks_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'theme_options[show_desc_archive_pages]',
    array(
        'label'    => __( 'Show Description on Archive Pages', 'minimal-blocks' ),
        'section'  => 'archive_options',
        'type'     => 'checkbox',
    )
);
/**/

/*Show Meta Info on archive pages*/
$wp_customize->add_setting(
    'theme_options[show_meta_archive_pages]',
    array(
        'default'           => $default_options['show_meta_archive_pages'],
        'sanitize_callback' => 'minimal_blocks_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'theme_options[show_meta_archive_pages]',
    array(
        'label'    => __( 'Show Meta Info on Archive Pages', 'minimal-blocks' ),
        'section'  => 'archive_options',
        'type'     => 'checkbox',
    )
);

$wp_customize->add_setting(
    'theme_options[read_more_text]',
    array(
        'default' => $default_options['read_more_text'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'theme_options[read_more_text]',
    array(
        'label' => __('Read More Text Archive', 'minimal-blocks'),
        'section' => 'archive_options',
        'type' => 'text',
    )
);

/**/

/* ========== Archive Section Close ========== */

/* ========== Excerpt Section ========== */
$wp_customize->add_section(
    'excerpt_options',
    array(
        'title'      => __( 'Excerpt Options', 'minimal-blocks' ),
        'panel'      => 'theme_option_panel',
    )
);

/* Excerpt Length */
$wp_customize->add_setting(
    'theme_options[excerpt_length]',
    array(
        'default'           => $default_options['excerpt_length'],
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control(
    'theme_options[excerpt_length]',
    array(
        'label'       => __( 'Excerpt Length', 'minimal-blocks' ),
        'section'     => 'excerpt_options',
        'type'        => 'number',
    )
);
/**/

/* ========== Excerpt Section Close ========== */


/* ========== Mailchimp Section  ========== */
$wp_customize->add_section(
    'mailchimp_options',
    array(
        'title'      => __( 'Mailchimp Options', 'minimal-blocks' ),
        'capability' => 'edit_theme_options',
        'panel'      => 'theme_option_panel',
    )
);

/*Enable Mailchimp*/
$wp_customize->add_setting(
    'theme_options[enable_mailchimp]',
    array(
        'default'           => $default_options['enable_mailchimp'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'minimal_blocks_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'theme_options[enable_mailchimp]',
    array(
        'label'    => __( 'Enable Mailchimp Subscription', 'minimal-blocks' ),
        'section'  => 'mailchimp_options',
        'type'     => 'checkbox',
    )
);

/*Mailchimp title*/
$wp_customize->add_setting(
    'theme_options[mailchimp_title]',
    array(
        'default'           => $default_options['mailchimp_title'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'theme_options[mailchimp_title]',
    array(
        'label'    => __( 'Mailchimp Title', 'minimal-blocks' ),
        'section'  => 'mailchimp_options',
        'type'     => 'text',
        'active_callback' => 'minimal_blocks_is_mailchimp_enabled',
    )
);

/*Mailchimp sub title*/
$wp_customize->add_setting(
    'theme_options[mailchimp_sub_title]',
    array(
        'default'           => $default_options['mailchimp_sub_title'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    )
);
$wp_customize->add_control(
    'theme_options[mailchimp_sub_title]',
    array(
        'label'    => __( 'Mailchimp Sub Title', 'minimal-blocks' ),
        'section'  => 'mailchimp_options',
        'type'     => 'textarea',
        'active_callback' => 'minimal_blocks_is_mailchimp_enabled',
    )
);

/*Mailchimp Shortcode*/
$wp_customize->add_setting(
    'theme_options[mailchimp_shortcode]',
    array(
        'default'           => $default_options['mailchimp_shortcode'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'theme_options[mailchimp_shortcode]',
    array(
        'label'    => __( 'Mailchimp Subscription Form Shortcode', 'minimal-blocks' ),
        'section'  => 'mailchimp_options',
        'type'     => 'text',
        'active_callback' => 'minimal_blocks_is_mailchimp_enabled',
    )
);

/*Mailchimp Background Color */
$wp_customize->add_setting(
    'theme_options[mailchimp_bg_color]',
    array(
        'default'           => $default_options['mailchimp_bg_color'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    'theme_options[mailchimp_bg_color]',
    array(
        'label'    => __( 'Mailchimp Background Color', 'minimal-blocks' ),
        'section'  => 'mailchimp_options',
        'type'     => 'color',
        'active_callback' => 'minimal_blocks_is_mailchimp_enabled',
    )
);

/* ========== Mailchimp Section Close ========== */

/* ========== Footer Section ========== */
$wp_customize->add_section(
    'footer_options' ,
    array(
        'title' => __( 'Footer Options', 'minimal-blocks' ),
        'panel' => 'theme_option_panel',
    )
);
/*Copyright Text.*/
$wp_customize->add_setting(
    'theme_options[copyright_text]',
    array(
        'default'           => $default_options['copyright_text'],
        'sanitize_callback' => 'sanitize_text_field',
        'transport'           => 'postMessage',
    )
);
$wp_customize->add_control(
    'theme_options[copyright_text]',
    array(
        'label'    => __( 'Copyright Text', 'minimal-blocks' ),
        'section'  => 'footer_options',
        'type'     => 'textarea',
    )
);
/* ========== Footer Section Close========== */
