<?php
/**
 * Recommended plugins
 *
 * @package minimal-blocks
 */
if ( ! function_exists( 'minimal_blocks_recommended_plugins' ) ) :
	/**
	 * Recommend plugins.
	 *
	 * @since 1.0.0
	 */
	function minimal_blocks_recommended_plugins() {
		$plugins = array(
			array(
				'name'     => esc_html__( 'One Click Demo Import', 'minimal-blocks' ),
				'slug'     => 'one-click-demo-import',
				'required' => false,
			),
            array(
                'name'     => __( 'MailChimp for WordPress', 'minimal-blocks' ),
                'slug'     => 'mailchimp-for-wp',
                'required' => false,
            ),
		);
		tgmpa( $plugins );
	}
endif;
add_action( 'tgmpa_register', 'minimal_blocks_recommended_plugins' );
