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
        $image_option = minimal_blocks_get_image_option(); ?>
        <div class="entry-content">
            <?php
            if ('no-image' != $image_option) {
                if (has_post_thumbnail()) {
                    echo '<div class="post-thumb">' . get_the_post_thumbnail(get_the_ID(), $image_option) . '<div class="blocks-item-overlay"><a href="' . esc_url(get_permalink()) . '" class="read-more" data-letters="'. __('Read More','minimal-blocks').'">'. __('Read More','minimal-blocks').'</a></div></div>';
                }
            } ?>
            <div class="archive-content-detail">
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
                <div class='post-content'>
                    <?php
                    if (true == minimal_blocks_get_archive_desc_option()) {
                        the_excerpt(); 
                        $read_more_text = minimal_blocks_get_option('read_more_text',true);
                        ?>
                        <a href="<?php the_permalink(); ?>" class="tm-button">
                            <?php echo esc_html($read_more_text); ?> <i class="ion-android-arrow-forward"></i>
                        </a>
                    <?php }
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'minimal-blocks'),
                        'after' => '</div>',
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>
</article>