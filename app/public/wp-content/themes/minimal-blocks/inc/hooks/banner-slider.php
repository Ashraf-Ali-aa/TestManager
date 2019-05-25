<?php
if (!function_exists('minimal_blocks_banner_slider_content')) :
    /**
     * Banner Slider Content.
     *
     * @since 1.0.0
     */
    function minimal_blocks_banner_slider_content(){

        $enable_banner_slider_slider = minimal_blocks_get_option('enable_banner_slider_posts', true);
        if ($enable_banner_slider_slider) {

            $banner_slider_cat = minimal_blocks_get_option('banner_slider_cat', true);
            if (!empty($banner_slider_cat)) {

                $no_of_banner_slider_posts = minimal_blocks_get_option('no_of_banner_slider_posts', true);
                $enable_banner_slider_meta_info = minimal_blocks_get_option('enable_banner_slider_meta_info', true);

                $post_args = array(
                    'post_type' => 'post',
                    'posts_per_page' => $no_of_banner_slider_posts,
                    'post_status' => 'publish',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field' => 'term_id',
                            'terms' => $banner_slider_cat,
                        ),
                    ),
                );
                $banner_slider_post = new WP_Query($post_args);
                if ($banner_slider_post->have_posts()):
                    ?>
                    <div class="banner-slider">
                        <div class="tm-wrapper">
                            <?php $rtl_class_c = 'false';
                            if(is_rtl()){ 
                                $rtl_class_c = 'true';
                            }?>
                            <div class="main-slider" data-slick='{"rtl": <?php echo($rtl_class_c); ?>}'>
                                <?php
                                while ($banner_slider_post->have_posts()):$banner_slider_post->the_post();
                                    ?>
                                    <div class="featured-item">
                                        <?php
                                        if(has_post_thumbnail()){
                                            $image = get_the_post_thumbnail_url(get_the_ID(), 'full');
                                        } else {
                                            $image = '';
                                        }
                                        ?>
                                        <div class="data-bg-slider data-bg" data-background="<?php echo esc_url($image); ?>"></div>
                                        <div class="slider-content">
                                            <?php if($enable_banner_slider_meta_info):?>
                                                <span class="entry-meta meta-categories meta-categories-1">
                                                    <?php the_category(' ');?>
                                                </span>
                                            <?php endif;?>
                                            <h2 class="entry-title entry-title-big">
                                                <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                                            </h2>
                                                <?php the_excerpt(); ?>
                                                <?php if($enable_banner_slider_meta_info):?>
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
                                <?php endwhile; wp_reset_postdata(); ?>
                            </div>
                            <div class='slidernav'>
                                <div class='tm-slide-icon slide-prev-1'>
                                    <i class='navcontrol-transparent ion-ios-arrow-left'></i>
                                </div>
                                <div class='tm-slide-icon slide-next-1'>
                                    <i class='navcontrol-transparent ion-ios-arrow-right'></i>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endif;
            }
        }
    }
endif;
add_action('minimal_blocks_banner_slider_section', 'minimal_blocks_banner_slider_content', 10);
