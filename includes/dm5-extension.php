<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class DM5_Extension extends DiviExtension {

	public $gettext_domain = 'divimenus5';
	public $name           = 'DiviMenus5';
	public $version        = DM5_VERSION;

	public function __construct( $name = 'divimenus5', $args = array() ) {
		$this->plugin_dir     = DM5_PLUGIN_DIR_PATH;
		$this->plugin_dir_url = DM5_PLUGIN_DIR_URL;

		parent::__construct( $name, $args );

		$this->_builder_js_data = array(
			'i10n' => array(
				'labels' => array(
					'title_l' => esc_html__( 'Text', 'et_builder' ),
					'title_d' => esc_html__( 'Define the Text for your Menu Item.', 'divimenus5' ),
				),
			),
			'image_data' => ET_BUILDER_PLACEHOLDER_LANDSCAPE_IMAGE_DATA,
		);

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_filter( 'et_core_esc_attr', array( $this, 'core_esc_attr' ) );
	}

	public function core_esc_attr( $allowed_attrs ) {
		if ( ! isset( $allowed_attrs['role'] ) ) {
			$allowed_attrs['role'] = 'esc_attr';
		}
		if ( ! isset( $allowed_attrs['aria-label'] ) ) {
			$allowed_attrs['aria-label'] = 'esc_attr';
		}
		return $allowed_attrs;
	}

	public function enqueue_scripts() {
		wp_register_script( 'divimenus5', $this->plugin_dir_url . 'scripts/frontend.js', array( 'jquery' ), false, true );
		if ( function_exists( 'et_core_is_fb_enabled' ) && et_core_is_fb_enabled() ) {
			wp_enqueue_script( 'divimenus5' );
		}
	}
}

new DM5_Extension();
