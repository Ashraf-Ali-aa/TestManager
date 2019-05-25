<?php
/**
 * Aside Panel related functions
 *
 * @package Minimal_Blocks
 * @since 1.0.0
 */
?>

<aside id="thememattic-aside" class="aside-panel">
    <div class="menu-mobile">
        <div class="trigger-nav">
            <div class="trigger-icon nav-toogle menu-mobile-toogle">
                <a class="trigger-icon" href="#">
                    <span class="icon-bar top"></span>
                    <span class="icon-bar middle"></span>
                    <span class="icon-bar bottom"></span>
                </a>
            </div>
        </div>
        <div class="trigger-nav-right">
            <ul class="nav-right-options">
                <li>
                    <a class="site-logo site-logo-mobile" href="<?php echo esc_url(get_home_url()); ?>">
                        <i class="thememattic-icon ion-ios-home-outline"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="aside-menu">
        <div class="nav-panel">
            <div class="trigger-nav">
                <div class="trigger-icon trigger-icon-wraper nav-toogle nav-panel-toogle">
                    <a class="trigger-icon" href="#">
                        <span class="icon-bar top"></span>
                        <span class="icon-bar middle"></span>
                        <span class="icon-bar bottom"></span>
                    </a>
                </div>
            </div>
            <div class="asidepanel-icon">
                <?php if ( class_exists( 'WooCommerce' ) ) { ?>
                    <div class="asidepanel-icon-item asidepanel-icon-cart">
                        <?php minimal_blocks_woocommerce_header_cart_number(); ?>
                    </div>
                <?php } ?>
                <?php if (has_nav_menu('social-nav')) { ?>
                    <div class="asidepanel-icon-item asidepanel-social-icon">
                        <div class="social-icons">
                            <?php
                            wp_nav_menu(
                                array('theme_location' => 'social-nav',
                                    'link_before' => '<span>',
                                    'link_after' => '</span>',
                                    'menu_id' => 'social-menu',
                                    'fallback_cb' => false,
                                    'menu_class' => false
                                )); ?>
                        </div>
                    </div>
                <?php } ?>


            </div>
        </div>
        <div class="menu-panel">
            <div class="menu-panel-wrapper">
                <div class="site-branding">
                    <?php
                    the_custom_logo(); ?>
                        <h1 class="site-title">
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                        </h1>

                    <?php $description = get_bloginfo('description', 'display');
                    if ($description || is_customize_preview()) : ?>
                        <p class="site-description">
                            <?php echo $description; ?>
                        </p>
                    <?php
                    endif;
                    ?>
                </div>

                <div class="site-branding-hr"></div>

                <div class="search-bar">
                    <?php get_search_form(); ?>
                </div>

                <div class="thememattic-navigation">
                    <nav id="site-navigation" class="main-navigation">
                            <span class="toggle-menu" aria-controls="primary-menu" aria-expanded="false">
                                 <span class="screen-reader-text">
                                    <?php esc_html_e('Primary Menu', 'minimal-blocks'); ?>
                                </span>
                                <i class="ham"></i>
                            </span>
                        <?php
                        if (has_nav_menu('primary-nav')) {
                            wp_nav_menu(array(
                                'theme_location' => 'primary-nav',
                                'menu_id' => 'primary-menu',
                                'container' => 'div',
                                'container_class' => 'menu-wrapper',
                                'depth' => 3,
                            ));
                        } else {
                            wp_nav_menu(array(
                                'menu_id' => 'primary-menu',
                                'container' => 'div',
                                'container_class' => 'menu-wrapper',
                                'depth' => 3,
                            ));
                        } ?>
                    </nav>

                    <?php if (has_nav_menu('social-nav')) { ?>
                        <div class="navigation-social-icon hidden-md hidden-lg">
                            <div class="social-icons">
                                <?php
                                wp_nav_menu(
                                    array('theme_location' => 'social-nav',
                                        'link_before' => '<span>',
                                        'link_after' => '</span>',
                                        'menu_id' => 'social-menu',
                                        'fallback_cb' => false,
                                        'menu_class' => false
                                    )); ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</aside>


<?php if ( class_exists( 'WooCommerce' ) ): ?>
    <div id="sidr" class="woocommerce-panel">
        <a class="sidr-class-sidr-button-close" href="#sidr-nav">
            <div class="sidr-exit">
                <span></span>
                <span></span>
            </div>
        </a>
        <?php minimal_blocks_woocommerce_header_cart(); ?>
    </div>
<?php endif; ?>