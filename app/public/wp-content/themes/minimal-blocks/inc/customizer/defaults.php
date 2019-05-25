<?php
/**
 * Default customizer values.
 *
 * @package Minimal_Blocks
 */
if ( ! function_exists( 'minimal_blocks_get_default_customizer_values' ) ) :
	/**
	 * Get default customizer values.
	 *
	 * @since 1.0.0
	 *
	 * @return array Default customizer values.
	 */
	function minimal_blocks_get_default_customizer_values() {

	$defaults = array();
        $defaults['header_text_color'] = '#666666';
        $defaults['overlay_bg_color'] = '#000';
        $defaults['enable_banner_slider_posts'] = true;
        $defaults['banner_slider_cat'] = 1;
        $defaults['enable_banner_slider_meta_info'] = true;
        $defaults['no_of_banner_slider_posts'] = 3;

        $defaults['enable_carousel_slider_posts'] = false;
        $defaults['carousel_slider_section_title'] = __( 'Hot Topics' , 'minimal-blocks');
        $defaults['carousel_slider_cat'] = 1;
        $defaults['enable_carousel_slider_meta_info'] = true;
        $defaults['no_of_carousel_slider_posts'] = 6;

        $defaults['enable_header_overlay'] = false;
        
        $defaults['enable_footer_recommend_cat'] = false;
        $defaults['footer_recommend_cat_title'] = __( 'You Might Have Missed' , 'minimal-blocks');
        $defaults['full_width_blocks_cat'] = 1;
        $defaults['no_of_full_width_cat_posts'] = 6;
        $defaults['enable_full_blocks_meta_info'] = true;

        // Front Page Layout
        $defaults['home_page_layout'] = 'no-sidebar';

        /* Preloader */
        $defaults['enable_preloader'] = true;

        /* Font and Colors */
        $defaults['body_text_color'] = '#000';
        $defaults['primary_font'] = 'Source+Sans+Pro:300,400,400i,700,700i';
        $defaults['secondary_font'] = 'Oswald:400,300,700';
        $defaults['tertiary_font'] = 'Playfair+Display:400,400i,700,700i';
        $defaults['site_title_text_size'] = 34;


        // Global Layout
        $defaults['enable_masonry_post_archive'] = true;
        $defaults['masonry_animation'] = 'default';
        $defaults['relayout_masonry'] = true;
        $defaults['global_layout'] = 'right-sidebar';
        $defaults['archive_image'] = 'full';
        $defaults['read_more_text'] = __( 'Read More' , 'minimal-blocks');
        $defaults['single_post_image'] = 'full';
        $defaults['single_page_image'] = 'full';

        //Pagination
        $defaults['pagination_type'] = 'infinite_scroll_load';

        //BreadCrumbs
        $defaults['breadcrumb_type'] = 'simple';

        //Single Posts Section
        $defaults['show_related_posts'] = true;
        $defaults['related_posts_title'] = __( 'Related Articles' , 'minimal-blocks');

        //Archive Section
        $defaults['show_desc_archive_pages'] = true;
        $defaults['show_meta_archive_pages'] = true;

        //Excerpt
        $defaults['excerpt_length'] = 20;
	// Footer.
        $defaults['copyright_text'] = esc_html__( 'Copyright &copy; All rights reserved.', 'minimal-blocks' );
        $defaults['enable_footer_credit'] = true;

        //Mailchimp
        $defaults['enable_mailchimp']    = false;
        $defaults['mailchimp_title']     = __( 'Subscribe To  Our Newsletter', 'minimal-blocks' );
        $defaults['mailchimp_sub_title']     = '';
        $defaults['mailchimp_shortcode']  = '';
        $defaults['mailchimp_bg_color']  = '#000';


		$defaults = apply_filters( 'minimal_blocks_default_customizer_values', $defaults );
		return $defaults;
	}
endif;
