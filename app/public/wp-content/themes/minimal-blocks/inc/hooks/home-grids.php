<?php

if (!function_exists('minimal_blocks_home_full_blocks_cat')) :
    /**
     * Homepage Full width blocks.
     *
     * @since 1.0.0
     */
    function minimal_blocks_home_full_blocks_cat()
    {
        $enable_footer_recommend_cat = minimal_blocks_get_option('enable_footer_recommend_cat', true);
        if ($enable_footer_recommend_cat):

            $full_width_blocks_cat = minimal_blocks_get_option('full_width_blocks_cat', true);
            if (!empty($full_width_blocks_cat)):

                $no_of_full_width_cat_posts = minimal_blocks_get_option('no_of_full_width_cat_posts', true);
                $enable_full_blocks_meta_info = minimal_blocks_get_option('enable_full_blocks_meta_info', true);

                $post_args = array(
                    'post_type' => 'post',
                    'posts_per_page' => $no_of_full_width_cat_posts,
                    'post_status' => 'publish',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field' => 'term_id',
                            'terms' => $full_width_blocks_cat,
                        ),
                    ),
                );
                $posts = new WP_Query($post_args);
                if ($posts->have_posts()):
                    ?>
                    <div class="recommended-block">
                        <div class="tm-wrapper">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h2 class="block-title block-title-1">
                                        <a href="<?php echo esc_url(get_category_link($full_width_blocks_cat)); ?>">
                                            <?php echo esc_html(minimal_blocks_get_option('footer_recommend_cat_title', true)); ?>
                                        </a>
                                    </h2>
                                </div>
                                <div class="col-sm-12">
                                <?php $rtl_class_c = 'false';
                                if(is_rtl()){ 
                                    $rtl_class_c = 'true';
                                }?>
                                <div class="recommended-slider slide-sm" data-slick='{"rtl": <?php echo($rtl_class_c); ?>}'>
                                    <?php
                                    while ($posts->have_posts()): $posts->the_post();
                                        if (has_post_thumbnail()):
                                            ?>
                                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                                <div class="entry-content">
                                                    <?php
                                                    if(has_post_thumbnail()){
                                                        $image = get_the_post_thumbnail_url(get_the_ID(), 'large');
                                                    } else {
                                                        $image = '';
                                                    }
                                                    ?>
                                                    <div class="recommended-panel" data-mh="recommended-panel">
                                                        <div class="data-bg data-bg-medium post-thumb" data-background="<?php echo esc_url($image); ?>">
                                                            <div class="blocks-item-overlay">
                                                                <a href="<?php the_permalink(); ?>" class="read-more" data-letters="<?php echo __('Read More','minimal-blocks'); ?> "><?php echo __('Read More','minimal-blocks'); ?></a>
                                                            </div>
                                                        </div>
                                                        <div class="post-detail">
                                                            <?php if($enable_full_blocks_meta_info):?>
                                                                <span class="entry-meta meta-categories meta-categories-1">
                                                                    <?php the_category(' ');?>
                                                                </span>
                                                            <?php endif;?>
                                                            <h2 class="entry-title entry-title-small">
                                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                            </h2>
                                                            <?php if($enable_full_blocks_meta_info):?>
                                                                <div class="meta-group">
                                                                    <span class="entry-meta post-author">
                                                                        <span class="author-avatar">
                                                                            <img src="<?php echo get_avatar_url(get_the_author_meta('ID'), 'size = 200'); ?>">
                                                                        </span>
                                                                        <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'), get_the_author_meta('user_nicename'))); ?>">
                                                                            <?php the_author(); ?>
                                                                        </a>
                                                                    </span>
                                                                    <?php minimal_blocks_posted_date_only(); ?>
                                                                </div>
                                                            <?php endif;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                            <?php
                                        endif;
                                    endwhile;
                                    wp_reset_postdata();
                                    ?>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                endif;
            endif;
        endif;
    }
endif;
add_action('minimal_blocks_home_footer_section', 'minimal_blocks_home_full_blocks_cat', 10);