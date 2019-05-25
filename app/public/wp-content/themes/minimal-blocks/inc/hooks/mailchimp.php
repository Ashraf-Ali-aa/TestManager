<?php
if (!function_exists('minimal_blocks_mailchimp_form')) :
    /**
     * Mailchimp Form
     *
     * @since 1.0.0
     */
    function minimal_blocks_mailchimp_form()
    {
        $enable_mailchimp = minimal_blocks_get_option('enable_mailchimp',true);
        if($enable_mailchimp){
            $mailchimp_title = esc_html(minimal_blocks_get_option('mailchimp_title',true));
            $mailchimp_sub_title = esc_html(minimal_blocks_get_option('mailchimp_sub_title',true));
            $mailchimp_shortcode = wp_kses_post(minimal_blocks_get_option('mailchimp_shortcode',true));
            ?>
            <div class="mailchimp-bgcolor">
                <h2 class="block-title block-title-3">
                    <?php echo esc_html($mailchimp_title); ?>
                </h2>
                <div class="mailchim-sub-content">
                    <?php echo esc_html($mailchimp_sub_title); ?>
                </div>
                <?php echo do_shortcode($mailchimp_shortcode);?>
            </div>
            <?php
        }
    }
endif;
add_action('minimal_blocks_mailchimp_footer', 'minimal_blocks_mailchimp_form', 20);