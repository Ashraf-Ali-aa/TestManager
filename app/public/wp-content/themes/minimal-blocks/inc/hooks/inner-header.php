<?php
if (!function_exists('minimal_blocks_display_inner_header')) :
    /**
     * Inner Pages Header.
     *
     * @since 1.0.0
     */
    function minimal_blocks_display_inner_header()
    { ?>
        <?php
        $header_image = '';
        if (has_header_image()) {
            $header_image = 'data-bg';
        }
        ?>
        <header class="inner-banner <?php echo esc_attr($header_image); ?>" <?php if (has_header_image()) { ?> data-background="<?php echo esc_url(get_header_image()); ?>" <?php }
        ?> >
            <?php if (is_singular()) { ?>
                <div class="thememattic-breadcrumb">
                    <div class="tm-wrapper">
                        <?php
                        /**
                         * Hook - minimal_blocks_display_breadcrumb.
                         *
                         * @hooked minimal_blocks_breadcrumb_content - 10
                         */
                        do_action('minimal_blocks_display_breadcrumb');
                        ?>
                    </div>
                </div>
                <div class="thememattic-header">
                    <div class="tm-wrapper">
                        <div class="meta-categories-1">
                            <?php minimal_blocks_entry_category(); ?>
                        </div>
                        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                        <?php if (!is_page()) {
                            global $post;
                            $author_id = $post->post_author;
                            ?>
                            <div class="entry-header">
                                <div class="meta-group">
                                     <span class="entry-meta post-author">
                                        <span class="author-avatar">
                                            <img src="<?php echo get_avatar_url($author_id, 'size = 200'); ?>">
                                        </span>
                                        <a href="<?php echo esc_url(get_author_posts_url($author_id, get_the_author_meta('user_nicename'))); ?>">
                                            <?php echo esc_html(get_the_author_meta('display_name', $author_id)); ?>
                                        </a>
                                    </span>
                                    <?php minimal_blocks_posted_date_only(); ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } else { ?>
                <div class="thememattic-breadcrumb">
                    <div class="tm-wrapper">
                        <?php
                        /**
                         * Hook - minimal_blocks_display_breadcrumb.
                         *
                         * @hooked minimal_blocks_breadcrumb_content - 10
                         */
                        do_action('minimal_blocks_display_breadcrumb');
                        ?>
                    </div>
                </div>
                <div class="thememattic-header">
                    <div class="tm-wrapper">
                        <?php if (is_404()) { ?>
                            <h1 class="entry-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'minimal-blocks'); ?></h1>
                        <?php } elseif (is_archive()) {
                            the_archive_title('<h1 class="entry-title">', '</h1>');
                            the_archive_description('<div class="taxonomy-description">', '</div>');
                        } elseif (is_search()) { ?>
                            <h1 class="entry-title"><?php printf(esc_html__('Search Results for: %s', 'minimal-blocks'), '<span>' . get_search_query() . '</span>'); ?></h1>
                        <?php } else { ?>
                            <h1 class="entry-title"></h1>
                        <?php }
                        ?>
                    </div>
                </div>
            <?php } ?>
            <?php $enable_header_images = minimal_blocks_get_option('enable_header_overlay', false);
            if ($enable_header_images == false) {
            } else { ?>
                <div class="header-image-overlay"></div>
            <?php }
            ?>
        </header>
    <?php }
endif;
add_action('minimal_blocks_inner_header', 'minimal_blocks_display_inner_header');