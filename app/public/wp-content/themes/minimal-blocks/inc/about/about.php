<?php
/**
 * About setup
 *
 * @package Minimal-Blocks
 */

if ( ! function_exists( 'minimal_blocks_about_setup' ) ) :

	/**
	 * About setup.
	 *
	 * @since 1.0.0
	 */
	function minimal_blocks_about_setup() {

		$config = array(
		// Menu name under Appearance.
		'menu_name'               => esc_html__( 'Minimal Blocks Info', 'minimal-blocks' ),
		// Page title.
		'page_name'               => esc_html__( 'Minimal Blocks Info', 'minimal-blocks' ),
		/* translators: Main welcome title */
		'welcome_title'         => sprintf( esc_html__( 'Welcome to %s! - Version ', 'minimal-blocks' ), 'Minimal Blocks' ),
		// Main welcome content
			// Welcome content.
			'welcome_content' => sprintf( esc_html__( '%1$s is now installed and ready to use. We want to make sure you have the best experience using the theme and that is why we gathered here all the necessary information for you. Thanks for using our theme!', 'minimal-blocks' ), 'Minimal Blocks Pro' ),

			// Tabs.
			'tabs' => array(
				'getting_started' => esc_html__( 'Getting Started', 'minimal-blocks' ),
				'recommended_actions' => esc_html__( 'Recommended Actions', 'minimal-blocks' ),
				'useful_plugins'  => esc_html__( 'Useful Plugins', 'minimal-blocks' ),
				'free_pro'  => esc_html__( 'Free Vs Pro', 'minimal-blocks' ),
				),

			// Quick links.
			'quick_links' => array(
                'theme_url' => array(
                    'text' => esc_html__( 'Theme Details', 'minimal-blocks' ),
                    'url'  => 'https://thememattic.com/theme/minimal-blocks/',
                ),
                'demo_url' => array(
                    'text' => esc_html__( 'View Demo', 'minimal-blocks' ),
                    'url'  => 'https://demo.thememattic.com/minimal-blocks/',
                ),
                'documentation_url' => array(
                    'text'   => esc_html__( 'View Documentation', 'minimal-blocks' ),
                    'url'    => 'https://docs.thememattic.com/minimal-blocks/',
                    'button' => 'primary',
                ),
            ),

			// Getting started.
			'getting_started' => array(
				'one' => array(
					'title'       => esc_html__( 'Theme Documentation', 'minimal-blocks' ),
					'icon'        => 'dashicons dashicons-format-aside',
					'description' => esc_html__( 'Please check our full documentation for detailed information on how to setup and customize the theme.', 'minimal-blocks' ),
					'button_text' => esc_html__( 'View Documentation', 'minimal-blocks' ),
					'button_url'  => 'https://docs.thememattic.com/minimal-blocks/',
					'button_type' => 'primary',
					'is_new_tab'  => true,
					),
				'two' => array(
					'title'       => esc_html__( 'Theme Options', 'minimal-blocks' ),
					'icon'        => 'dashicons dashicons-admin-customizer',
					'description' => esc_html__( 'Theme uses Customizer API for theme options. Using the Customizer you can easily customize different aspects of the theme.', 'minimal-blocks' ),
					'button_text' => esc_html__( 'Customize', 'minimal-blocks' ),
					'button_url'  => wp_customize_url(),
					'button_type' => 'primary',
					),
				'three' => array(
					'title'       => esc_html__( 'Demo Content', 'minimal-blocks' ),
					'icon'        => 'dashicons dashicons-layout',
					'description' => sprintf( esc_html__( 'To import sample demo content, %1$s plugin should be installed and activated. After plugin is activated, visit Import Demo Data menu under Appearance.', 'minimal-blocks' ), esc_html__( 'One Click Demo Import', 'minimal-blocks' ) ),
					),
				'four' => array(
				    'title'       => esc_html__( 'Set Widgets', 'minimal-blocks' ),
				    'icon'        => 'dashicons dashicons-tagcloud',
				    'description' => esc_html__( 'Set widgets in your sidebar, Offcanvas as well as footer.', 'minimal-blocks' ),
				    'button_text' => esc_html__( 'Add Widgets', 'minimal-blocks' ),
				    'button_url'  => admin_url().'/widgets.php',
				    'button_type' => 'link',
				    'is_new_tab'  => true,
				),
				'five' => array(
					'title'       => esc_html__( 'Theme Preview', 'minimal-blocks' ),
					'icon'        => 'dashicons dashicons-welcome-view-site',
					'description' => esc_html__( 'You can check out the theme demos for reference to find out what you can achieve using the theme and how it can be customized.', 'minimal-blocks' ),
					'button_text' => esc_html__( 'View Demo', 'minimal-blocks' ),
					'button_url'  => 'https://demo.thememattic.com/minimal-blocks/',
					'button_type' => 'link',
					'is_new_tab'  => true,
					),
                'six' => array(
                    'title'       => esc_html__( 'Contact Support', 'minimal-blocks' ),
                    'icon'        => 'dashicons dashicons-sos',
                    'description' => esc_html__( 'Got theme support question or found bug or got some feedbacks? Best place to ask your query is the dedicated Support forum for the theme.', 'minimal-blocks' ),
                    'button_text' => esc_html__( 'Contact Support', 'minimal-blocks' ),
                    'button_url'  => 'https://thememattic.com/support/',
                    'button_type' => 'link',
                    'is_new_tab'  => true,
                ),
				),

					'useful_plugins'        => array(
						'description' => esc_html__( 'Theme supports some helpful WordPress plugins to enhance your site. But, please enable only those plugins which you need in your site. For example, enable WooCommerce only if you are using e-commerce.', 'minimal-blocks' ),
						'already_activated_message' => esc_html__( 'Already activated', 'minimal-blocks' ),
						'version_label' => esc_html__( 'Version: ', 'minimal-blocks' ),
						'install_label' => esc_html__( 'Install and Activate', 'minimal-blocks' ),
						'activate_label' => esc_html__( 'Activate', 'minimal-blocks' ),
						'deactivate_label' => esc_html__( 'Deactivate', 'minimal-blocks' ),
						'content'                   => array(
							array(
								'slug' => 'one-click-demo-import'
							),
						),
					),
					// Required actions array.
					'recommended_actions'        => array(
						'install_label' => esc_html__( 'Install and Activate', 'minimal-blocks' ),
						'activate_label' => esc_html__( 'Activate', 'minimal-blocks' ),
						'deactivate_label' => esc_html__( 'Deactivate', 'minimal-blocks' ),
						'content'            => array(
							'one-click-demo-import' => array(
								'title'       => 'One Click Demo Import',
								'description' => __( 'It is only recommended when you need the site as like our demos along with the demo content', 'minimal-blocks' ),
								'plugin_slug' => 'one-click-demo-import',
								'id' => 'one-click-demo-import'
							),
						),
					),
			// Free vs pro array.
			'free_pro'                => array(
				'free_theme_name'     => 'Minimal Blocks',
				'pro_theme_name'      => 'Minimal Blocks Pro',
				'pro_theme_link'      => 'https://thememattic.com/themes/minimal-blocks-pro',
				/* translators: View link */
				'get_pro_theme_label' => sprintf( __( 'Get %s', 'minimal-blocks' ), 'Minimal Blocks Pro' ),
				'features'            => array(
					array(
						'title'       => esc_html__( 'Daring Design for Devoted Readers', 'minimal-blocks' ),
						'description' => esc_html__( 'Minimal Blocks\'s design helps you stand out from the crowd and create an experience that your readers will love and talk about. With a flexible home page you have the chance to easily showcase appealing content with ease.', 'minimal-blocks' ),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Mobile-Ready For All Devices', 'minimal-blocks' ),
						'description' => esc_html__( 'Minimal Blocks makes room for your readers to enjoy your articles on the go, no matter the device their using. We shaped everything to look amazing to your audience.', 'minimal-blocks' ),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( '1 Click Demo Import', 'minimal-blocks' ),
						'description' => esc_html__( 'In just a few minutes, your site will be ready with exactly the same layout with the demo. All you need to do is just replace sample content with yours to get started.', 'minimal-blocks' ),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Widgetized Sidebars To Keep Attention', 'minimal-blocks' ),
						'description' => esc_html__( 'Minimal Blocks comes with a widget-based flexible system which allows you to add your favourite widgets over the Sidebar as well as on off-canvas too.', 'minimal-blocks' ),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Light & Dark mode in single click', 'minimal-blocks' ),
						'description' => esc_html__( 'Minimal Blocks pro can be switched to dark mode where as Minimal Blocks free does not has that option', 'minimal-blocks' ),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Multiple Header Layout', 'minimal-blocks' ),
						'description' => esc_html__( 'Minimal Blocks gives you extra ways to showcase your header with miltiple layout option you can change it on the basis of your requirement', 'minimal-blocks' ),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Banner Slider Options', 'minimal-blocks' ),
						'description' => esc_html__( 'Minimal Blocks\'s PRO version comes with more Slider options to display and filter posts. For instance, you can have far more control on setting the source of the posts or how they are displayed, everything to push the content to the right people and promote it by the blink of an eye.', 'minimal-blocks' ),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Flexible Home Page Design', 'minimal-blocks' ),
						'description' => esc_html__( 'Minimal Blocks\'s PRO version has more control available to enable you to place widgets on Footer or Below the Post at the end of your articles.', 'minimal-blocks' ),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Read Time Calculator', 'minimal-blocks' ),
						'description' => esc_html__( 'Minimal Blocks\'s PRO version has a feature to let your viewer know the read time of the standard article you have posted on the basis of words per minute which you can control on your customizer .', 'minimal-blocks' ),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Advance Customizer Options', 'minimal-blocks' ),
						'description' => esc_html__( 'Advance control for each element gives you different way of customization and maintained you site as you like and makes you feel different.', 'minimal-blocks' ),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Advance Pagination', 'minimal-blocks' ),
						'description' => esc_html__( 'Multiple Option of pagination via customizer can be obtained on your site like Infinite scroll, Ajax Button On Click, Number as well as classical option are available.','minimal-blocks' ),
						'is_in_lite'  => 'ture',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Flexible Color Scheme', 'minimal-blocks' ),
						'description' => esc_html__( 'Match your unique style in an easy and smart way by using an intuitive interface that you can fine-tune it until it fully represents you and matches your particular blogging needs.','minimal-blocks' ),
						'is_in_lite'  => 'ture',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Advanced Typography Settings', 'minimal-blocks' ),
						'description' => esc_html__( 'Adjust your fonts by taking advantage of a playground with 600+ fonts varieties you can wisely choose from at any moment.','minimal-blocks' ),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Premium Support and Assistance', 'minimal-blocks' ),
						'description' => esc_html__( 'We offer ongoing customer support to help you get things done in due time. This way, you save energy and time, and focus on what brings you happiness. We know our products inside-out and we can lend a hand to help you save resources of all kinds.','minimal-blocks' ),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Mailchimp Feature', 'minimal-blocks' ),
						'description' => esc_html__( 'Minimal Blocks\'s Pro theme has feature of Mailchimp subscription in your site footer.', 'minimal-blocks' ),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),					
					array(
						'title'       => esc_html__( 'Mailchimp Pop Up and Instagram Feature', 'minimal-blocks' ),
						'description' => esc_html__( 'Minimal Blocks\'s Pro theme has feature of Pop Up Mailchimp subscription as well as displays your instagram feed images in your site footer.', 'minimal-blocks' ),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'No Credit Footer Link', 'minimal-blocks' ),
						'description' => esc_html__( 'You can easily remove the “Theme: Minimal Blocks by thememattic copyright from the footer area and make the theme yours from start to finish.', 'minimal-blocks' ),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
				),
			),

			);

		Minimal_Blocks_About::init( $config );
	}

endif;

add_action( 'after_setup_theme', 'minimal_blocks_about_setup' );
