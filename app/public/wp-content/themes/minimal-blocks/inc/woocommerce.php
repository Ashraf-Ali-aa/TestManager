<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package minimal_blocks
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function minimal_blocks_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'minimal_blocks_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function minimal_blocks_woocommerce_scripts() {
	wp_enqueue_style( 'minimal-blocks-woocommerce-style', get_template_directory_uri() . '/assets/css/woocommerce.css' );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'minimal-blocks-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'minimal_blocks_woocommerce_scripts' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function minimal_blocks_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'minimal_blocks_woocommerce_active_body_class' );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function minimal_blocks_woocommerce_products_per_page() {
	return 12;
}
add_filter( 'loop_shop_per_page', 'minimal_blocks_woocommerce_products_per_page' );

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function minimal_blocks_woocommerce_thumbnail_columns() {
	return 4;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'minimal_blocks_woocommerce_thumbnail_columns' );

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function minimal_blocks_woocommerce_loop_columns() {
	return 3;
}

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function minimal_blocks_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'minimal_blocks_woocommerce_related_products_args' );

if ( ! function_exists( 'minimal_blocks_woocommerce_product_columns_wrapper' ) ) {
	/**
	 * Product columns wrapper.
	 *
	 * @return  void
	 */
	function minimal_blocks_woocommerce_product_columns_wrapper() {
		$columns = minimal_blocks_woocommerce_loop_columns();
		echo '<div class="columns-' . absint( $columns ) . '">';
	}
}
add_action( 'woocommerce_before_shop_loop', 'minimal_blocks_woocommerce_product_columns_wrapper', 40 );

if ( ! function_exists( 'minimal_blocks_woocommerce_product_columns_wrapper_close' ) ) {
	/**
	 * Product columns wrapper close.
	 *
	 * @return  void
	 */
	function minimal_blocks_woocommerce_product_columns_wrapper_close() {
		echo '</div>';
	}
}
add_action( 'woocommerce_after_shop_loop', 'minimal_blocks_woocommerce_product_columns_wrapper_close', 40 );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'minimal_blocks_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function minimal_blocks_woocommerce_wrapper_before() {
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
			<?php
	}
}
add_action( 'woocommerce_before_main_content', 'minimal_blocks_woocommerce_wrapper_before' );

if ( ! function_exists( 'minimal_blocks_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function minimal_blocks_woocommerce_wrapper_after() {
			?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'minimal_blocks_woocommerce_wrapper_after' );


if ( ! function_exists( 'minimal_blocks_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function minimal_blocks_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		minimal_blocks_woocommerce_cart_link();
		$fragments['.cart-total-item'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'minimal_blocks_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'minimal_blocks_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function minimal_blocks_woocommerce_cart_link() {
		?>
		<div class="cart-total-item">
			<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'minimal-blocks' ); ?>">
				<?php
				$item_count_text = sprintf(
					/* translators: number of items in the mini cart. */
					_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'minimal-blocks' ),
					WC()->cart->get_cart_contents_count()
				);
				?>
				<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
			</a>
			<span class="item-count"><?php echo esc_html(WC()->cart->get_cart_contents_count()); ?></span>
		</div>
		<?php
	}
}

if ( ! function_exists( 'minimal_blocks_woocommerce_header_cart()' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function minimal_blocks_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
        <div class="minicart-content">
            <ul class="minicart-ustyled">
                <li class="total-details <?php echo esc_attr( $class ); ?>">
                    <?php minimal_blocks_woocommerce_cart_link() ?>
                </li>
                <li>
                    <?php
                    $instance = array(
                        'title' => '',
                    );

                    the_widget( 'WC_Widget_Cart', $instance );
                    ?>
                </li>
            </ul>
        </div>
		<?php
	}
}

if ( ! function_exists( 'minimal_blocks_woocommerce_header_cart_number()' ) ) {
    /**
     * Display Header Cart.
     *
     * @return void
     */
    function minimal_blocks_woocommerce_header_cart_number() {
        if ( is_cart() ) {
            $class = 'current-menu-item';
        } else {
            $class = '';
        }
        ?>
        <div class="minicart-title-handle">
            <svg width="32.402000427246094" height="24" viewBox="0 0 32.402000427246094 32" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="currentcolor">
                <g>
                    <path d="M 6,30A2,2 1080 1 0 10,30A2,2 1080 1 0 6,30zM 24,30A2,2 1080 1 0 28,30A2,2 1080 1 0 24,30zM-0.058,5c0,0.552, 0.448,1, 1,1L 3.020,6 l 1.242,5.312L 6,20c0,0.072, 0.034,0.134, 0.042,0.204l-1.018,4.58 c-0.066,0.296, 0.006,0.606, 0.196,0.842C 5.41,25.864, 5.696,26, 6,26l 22.688,0 c 0.552,0, 1-0.448, 1-1s-0.448-1-1-1L 7.248,24 l 0.458-2.060C 7.806,21.956, 7.896,22, 8,22l 18.23,0 c 1.104,0, 1.77-0.218, 2.302-1.5l 3.248-9.964C 32.344,8.75, 31.106,8, 30,8L 6,8 C 5.844,8, 5.708,8.054, 5.562,8.088L 4.786,4.772C 4.68,4.32, 4.278,4, 3.812,4L 0.942,4 C 0.388,4-0.058,4.448-0.058,5z M 6.040,10l 23.81,0 l-3.192,9.798c-0.038,0.086-0.070,0.148-0.094,0.19C 26.498,19.994, 26.394,20, 26.23,20L 8,20 L 8,19.802 L 7.962,19.608L 6.040,10z"></path>
                </g>
            </svg>

                <?php minimal_blocks_woocommerce_cart_link() ?>
        </div>
        <?php
    }
}