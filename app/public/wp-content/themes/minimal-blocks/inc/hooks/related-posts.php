<?php
if (!function_exists('minimal_blocks_related_posts')) :
    /**
     * Related Posts
     *
     * @since 1.0.0
     */
    function minimal_blocks_related_posts()
    {
        if(is_singular()){
            $show_related_posts = minimal_blocks_get_option('show_related_posts',true);
            if($show_related_posts){
                $related_posts_title = minimal_blocks_get_option('related_posts_title',true);
                $category_ids = array();
                $categories = get_the_category(get_the_ID());
                if (!empty($categories)) {
                    foreach ($categories as $category) {
                        $category_ids[] = $category->term_id;
                    }
                }
                if(!empty($category_ids)){
                    $args = array(
                        'posts_per_page' => 3,
                        'category__in' => $category_ids,
                        'post__not_in' => array(get_the_ID()),
                        'order' => 'ASC',
                        'orderby' => 'rand'
                    );
                    $related_posts = new WP_Query($args);
                    if($related_posts->have_posts()):?>
                        <div id="related-articles">
                            <?php if(!empty($related_posts_title)){
                                ?>
                                <div class="block-title-wrapper">
                                    <h2 class="block-title block-title-2">
                                    <span class="secondary-background">
                                         <?php echo esc_html($related_posts_title); ?>
                                    </span>
                                    </h2>
                                </div>
                                <?php
                            }?>
                            <div class="related-content">
                                <?php while ($related_posts->have_posts()):$related_posts->the_post();?>
                                <div class="related-articles-wrapper">
                                    <div class="row row-sm">
                                        <div class="col-xs-4">
                                            <?php if(has_post_thumbnail()){ ?>
                                                <div class="">
                                                    <a href="<?php the_permalink(); ?>" class="bg-image bg-image-1">
                                                        <?php the_post_thumbnail(get_the_ID(), 'medium'); ?>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-xs-8">
                                            <?php minimal_blocks_entry_category(); ?>
                                            <div class="related-article-title">
                                                <h3 class="entry-title entry-title-medium">
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </h3>
                                            </div>
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
                                        </div>
                                    </div>
                                </div>
                                <?php endwhile;wp_reset_postdata();?>
                            </div>
                        </div>
                    <?php endif;
                }
            }
        }
    }
endif;
add_action('minimal_blocks_before_single_nav', 'minimal_blocks_related_posts', 10 );