<?php
/**
 * CSS related hooks.
 *
 * This file contains hook functions which are related to CSS.
 *
 * @package Minimal_Blocks
 */
if (!function_exists('minimal_blocks_inline_css')) :
    /**
     * Output theme custom CSS.
     *
     * @since 1.0.0
     */
    function minimal_blocks_inline_css()
    {
        global $minimal_blocks_google_fonts;
        $minimal_blocks_header_text_color = minimal_blocks_get_option('header_text_color', true);

        $minimal_blocks_body_text_color = minimal_blocks_get_option('body_text_color', true);

        $minimal_blocks_overlay_bg_color = minimal_blocks_get_option('overlay_bg_color', true);

        $minimal_blocks_sitetitle_size = minimal_blocks_get_option('site_title_text_size', true);

        $mailchimp_bg_color = minimal_blocks_get_option('mailchimp_bg_color', true);
        ?>
        <style type="text/css">
            <?php

            if (!empty($minimal_blocks_header_text_color) ){
                ?>
            .aside-panel .site-title a,
            .aside-panel .site-description {
                color: <?php echo esc_html($minimal_blocks_header_text_color); ?>;
            }

            <?php
        }

        if (!empty($minimal_blocks_body_text_color) ){
        ?>
            html body,
            body button,
            body input,
            body select,
            body optgroup,
            body textarea {
                color: <?php echo esc_html($minimal_blocks_body_text_color); ?>;
            }

            <?php
        }

        if (!empty($minimal_blocks_body_text_color) ){
            ?>
            body .trigger-icon .icon-bar {
                background: <?php echo esc_html($minimal_blocks_body_text_color); ?>;
            }

            <?php
        }

        if (!empty($minimal_blocks_overlay_bg_color) ){
            ?>
            body .site .inner-banner .header-image-overlay {
                background: <?php echo esc_html($minimal_blocks_overlay_bg_color); ?>;
            }

            <?php
        }

        if (!empty($mailchimp_bg_color) ){
            ?>
            body .mailchimp-bgcolor {
                background: <?php echo esc_html($mailchimp_bg_color); ?>;
            }

            <?php
        }

           if (!empty($minimal_blocks_sitetitle_size) ){
           ?>
            body .site-title {
                font-size: <?php echo esc_html($minimal_blocks_sitetitle_size); ?>px !important;
            }

            <?php
            }

        ?>
        </style>
        <?php
    }
endif;