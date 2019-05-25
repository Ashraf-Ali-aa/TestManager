<?php
if (!function_exists('minimal_blocks_carousel_slider_content')) :
    /**
     * Carousel Slider Content.
     *
     * @since 1.0.0
     */
    function minimal_blocks_carousel_slider_content(){

        $enable_carousel_slider_slider = minimal_blocks_get_option('enable_carousel_slider_posts', true);
        $carousel_slider_section_title = minimal_blocks_get_option('carousel_slider_section_title', true);
        if ($enable_carousel_slider_slider) {

            $carousel_slider_cat = minimal_blocks_get_option('carousel_slider_cat', true);
            if (!empty($carousel_slider_cat)) {

                $no_of_carousel_slider_posts = minimal_blocks_get_option('no_of_carousel_slider_posts', true);
                $enable_carousel_slider_meta_info = minimal_blocks_get_option('enable_carousel_slider_meta_info', true);

                $post_args = array(
                    'post_type' => 'post',
                    'posts_per_page' => $no_of_carousel_slider_posts,
                    'post_status' => 'publish',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field' => 'term_id',
                            'terms' => $carousel_slider_cat,
                        ),
                    ),
                );
                $carousel_slider_post = new WP_Query($post_args);
                if ($carousel_slider_post->have_posts()):
                    ?>
                    <div class="banner-carousel">
                        <div class="tm-wrapper">
                            <div class="block-title-wrapper">
                                <?php if (!empty($carousel_slider_section_title)) { ?>
                                    <h2 class="block-title block-title-2">
                                        <span class="secondary-background">
                                            <i>
                                                <svg xmlns="http://www.w3.org/2000/svg" height="18" version="1.1" viewBox="-22 0 134 134.06032" width="15" fill="currentcolor">
                                                    <g>
                                                    <path d="M 23.347656 134.058594 C 8.445312 84.953125 39.933594 67.023438 39.933594 67.023438 C 37.730469 93.226562 52.621094 113.640625 52.621094 113.640625 C 58.097656 111.988281 68.550781 104.265625 68.550781 104.265625 C 68.550781 113.640625 63.035156 134.046875 63.035156 134.046875 C 63.035156 134.046875 82.34375 119.117188 88.421875 94.320312 C 94.492188 69.523438 76.859375 44.628906 76.859375 44.628906 C 77.921875 62.179688 71.984375 79.441406 60.351562 92.628906 C 60.933594 91.957031 61.421875 91.210938 61.796875 90.402344 C 63.886719 86.222656 67.242188 75.359375 65.277344 50.203125 C 62.511719 14.890625 30.515625 0 30.515625 0 C 33.273438 21.515625 25.003906 26.472656 5.632812 67.3125 C -13.738281 108.144531 23.347656 134.058594 23.347656 134.058594 Z M 23.347656 134.058594 "/>
                                                    </g>
                                                </svg>
                                            </i>
                                            <?php echo esc_html($carousel_slider_section_title); ?>
                                        </span>
                                    </h2>
                                <?php } ?>
                                <?php if ($no_of_carousel_slider_posts > 3) { ?>
                                    <div class='slidernav'>
                                        <div class='tm-slide-icon slide-prev-2'>
                                            <i class='navcontrol-transparent ion-ios-arrow-left'></i>
                                        </div>
                                        <div class='tm-slide-icon slide-next-2'>
                                            <i class='navcontrol-transparent ion-ios-arrow-right'></i>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="tm-wrapper">
                            <?php $rtl_class_c = 'false';
                            if(is_rtl()){ 
                                $rtl_class_c = 'true';
                            }?>
                            <div class="main-carousel slide-hover slide-sm" data-slick='{"rtl": <?php echo($rtl_class_c); ?>}'>
                                <?php
                                while ($carousel_slider_post->have_posts()):$carousel_slider_post->the_post();
                                    $image = '';
                                    ?>
                                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                            <div class="slides-panel">
                                                <?php
                                                if(has_post_thumbnail()){
                                                    $image = get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>
                                                    <a href="<?php the_permalink(); ?>" class="data-bg bg-slides" data-background="<?php echo esc_url($image); ?>"></a>
                                                <?php } ?>
                                                <div class="post-content">
                                                    <header class="entry-header">
                                                        <?php if($enable_carousel_slider_meta_info):?>
                                                            <span class="entry-meta meta-categories">
                                                                <?php the_category(' ');?>
                                                            </span>
                                                        <?php endif;?>
                                                        <h2 class="entry-title">
                                                            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                                                        </h2>

                                                        <?php if($enable_carousel_slider_meta_info):?>
                                                            <?php minimal_blocks_posted_date_only(); ?>
                                                        <?php endif;?>
                                                    </header>
                                                </div>
                                            </div>
                                        </article>
                                <?php endwhile; wp_reset_postdata(); ?>
                            </div>
                        </div>
                    </div>
                <?php endif;
            }
        }
    }
endif;
add_action('minimal_blocks_carousel_slider_section', 'minimal_blocks_carousel_slider_content', 10);
