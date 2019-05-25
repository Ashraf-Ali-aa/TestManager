<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Minimal_Blocks
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if (is_single()) {
        $archive_div_class = "single-post";
    } else {
        $archive_div_class = "tm-archive-wrapper";
    } ?>
    <div class="<?php echo esc_attr($archive_div_class); ?>">
        <?php
        if (is_singular()) {
            $image_option = minimal_blocks_get_image_option();
            if ('no-image' != $image_option) {
                if (has_post_thumbnail()) { ?>
                    <div class="featured-img post-thumb">
                        <?php echo(get_the_post_thumbnail(get_the_ID(), $image_option)); ?>
                        <?php $pic_caption = get_the_post_thumbnail_caption();
                        if ($pic_caption) { ?>
                            <div class="img-copyright-info">
                                <p><?php echo esc_html($pic_caption); ?></p>
                            </div>
                            <?php
                        } ?>
                    </div>
                <?php }
            }
            $raw_content = get_the_content();
            $final_content = apply_filters('the_content', $raw_content);

            echo '<div class="entry-content">';
            /*Excerpt*/
            global $post;
            if (!empty($post->post_excerpt)) {
                echo '<div class="prime-excerpt">' . esc_html($post->post_excerpt) . '</div>';
            }
            /**/
            echo $final_content;
            wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'minimal-blocks'),
                'after' => '</div>',
            ));
            echo '</div>';
        } else { ?>
            <div class="entry-content">
                <?php
                if (get_post_gallery()) {
                    echo '<div class="entry-gallery">';
                    echo get_post_gallery();
                    echo '</div>';
                } ?>
                <div class="archive-content-detail">
                    <?php if (true == minimal_blocks_get_archive_meta_option()) { ?>
                        <div class="tm-post-format">
                             <i class="ion-images"></i>
                        </div>
                    <?php } ?>

                    <div class="header-block">
                        <header class="entry-header">
                            <?php if (true == minimal_blocks_get_archive_meta_option()) {
                                minimal_blocks_entry_category();
                            } ?>
                            <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>

                            <?php if (true == minimal_blocks_get_archive_meta_option()) { ?>
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
                            <?php } ?>

                        </header>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php
        if (is_single()) { ?>
            <footer class="entry-footer">
                <div class="entry-meta">
                    <?php minimal_blocks_entry_footer(); ?>
                </div>
            </footer><!-- .entry-footer -->
        <?php } ?>
    </div>
</article>