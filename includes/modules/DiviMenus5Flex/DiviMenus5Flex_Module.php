<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class DiviMenus5Flex_Module extends ET_Builder_Module {

	public $slug                     = 'et_pb_divimenus5_flex';
	public $vb_support              = 'partial';
	public $child_slug             = 'et_pb_divimenus5_flex_item';
	public $child_item_text       = esc_html__( 'Menu Item', 'divimenus5' );
	protected $module_uses_wrapper = false;

	public function init() {
		$this->name       = esc_html__( 'DiviMenu Flex', 'divimenus5' );
		$this->plural     = esc_html__( 'DiviMenu Flex', 'divimenus5' );
		$this->fullname   = 'DiviMenu Flex';
		$this->main_css_element = '%%order_class%%';
		$this->child_item_text = esc_html__( 'Menu Item', 'divimenus5' );
	}

	public function get_fields() {
		return array(
			'menu_type' => array(
				'label'            => esc_html__( 'Layout', 'divimenus5' ),
				'type'             => 'select',
				'options'          => array(
					'horizontal' => esc_html__( 'Horizontal', 'divimenus5' ),
					'vertical'   => esc_html__( 'Vertical', 'divimenus5' ),
				),
				'default'          => 'horizontal',
				'toggle_slug'      => 'main_content',
			),
			'items_alignment' => array(
				'label'            => esc_html__( 'Items Alignment', 'divimenus5' ),
				'type'            => 'select',
				'options'         => array(
					'flex-start'    => esc_html__( 'Left / Top', 'divimenus5' ),
					'center'        => esc_html__( 'Center', 'divimenus5' ),
					'flex-end'      => esc_html__( 'Right / Bottom', 'divimenus5' ),
					'space-between' => esc_html__( 'Space Between', 'divimenus5' ),
					'space-around'  => esc_html__( 'Space Around', 'divimenus5' ),
				),
				'default'         => 'flex-start',
				'toggle_slug'     => 'main_content',
			),
			'flex_direction' => array(
				'label'           => esc_html__( 'Direction', 'divimenus5' ),
				'type'            => 'select',
				'options'         => array(
					'row'           => esc_html__( 'Left to Right', 'divimenus5' ),
					'row-reverse'   => esc_html__( 'Right to Left', 'divimenus5' ),
					'column'        => esc_html__( 'Top to Bottom', 'divimenus5' ),
					'column-reverse'=> esc_html__( 'Bottom to Top', 'divimenus5' ),
				),
				'default'         => 'row',
				'toggle_slug'     => 'main_content',
			),
			'logo_image' => array(
				'label'           => esc_html__( 'Logo Image', 'divimenus5' ),
				'type'            => 'upload',
				'image'           => true,
				'toggle_slug'     => 'logo_settings',
			),
			'logo_alt' => array(
				'label'           => esc_html__( 'Logo Alt Text', 'divimenus5' ),
				'type'            => 'text',
				'toggle_slug'     => 'logo_settings',
				'show_if'         => array( 'logo_image!' => '' ),
			),
			'logo_height' => array(
				'label'           => esc_html__( 'Logo Height', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'logo_settings',
			),
			'logo_link' => array(
				'label'           => esc_html__( 'Logo Link', 'divimenus5' ),
				'type'            => 'text',
				'toggle_slug'     => 'logo_settings',
			),
			'source_type' => array(
				'label'           => esc_html__( 'Menu Source', 'divimenus5' ),
				'type'            => 'select',
				'options'         => array(
					'items'       => esc_html__( 'Use Divi Menu Items', 'divimenus5' ),
					'nav_menu'    => esc_html__( 'Use WordPress Navigation Menu', 'divimenus5' ),
				),
				'default'         => 'items',
				'toggle_slug'     => 'main_content',
			),
			'nav_menu' => array(
				'label'           => esc_html__( 'Navigation Menu', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'main_content',
				'show_if'         => array( 'source_type' => 'nav_menu' ),
			),
			'menu_items' => array(
				'label'           => esc_html__( 'Menu Items', 'divimenus5' ),
				'type'            => 'options',
				'options'         => 'DiviMenus5Flex_Module::get_items_array',
				'renderer'        => array( 'DiviMenus5Flex_Module', 'render_items_field' ),
				'toggle_slug'     => 'main_content',
			),
			'item_type' => array(
				'label'           => esc_html__( 'Item Type', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'item_settings',
			),
			'item_icon' => array(
				'label'           => esc_html__( 'Icon', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'item_settings',
			),
			'item_icon_font_size' => array( 'type' => 'skip' ),
			'item_icon_font_size_last_edited' => array( 'type' => 'skip' ),
			'item_icon_font_size_tablet' => array( 'type' => 'skip' ),
			'item_icon_font_size_phone' => array( 'type' => 'skip' ),
			'item_text' => array(
				'label'           => esc_html__( 'Text', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'item_settings',
			),
			'item_font' => array(
				'label'           => esc_html__( 'Font', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'item_settings',
			),
			'item_font_size' => array( 'type' => 'skip' ),
			'item_font_size_last_edited' => array( 'type' => 'skip' ),
			'item_font_size_tablet' => array( 'type' => 'skip' ),
			'item_font_size_phone' => array( 'type' => 'skip' ),
			'item_text_color' => array(
				'label'           => esc_html__( 'Text Color', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'item_settings',
			),
			'item_url' => array(
				'label'           => esc_html__( 'URL', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'link',
			),
			'item_new_window' => array(
				'label'           => esc_html__( 'Open in New Window', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'link',
			),
			'item_image' => array(
				'label'           => esc_html__( 'Image', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'item_settings',
			),
			'item_image_alt' => array(
				'label'           => esc_html__( 'Image Alt', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'item_settings',
			),
			'item_image_size' => array( 'type' => 'skip' ),
			'item_image_size_last_edited' => array( 'type' => 'skip' ),
			'item_image_size_tablet' => array( 'type' => 'skip' ),
			'item_image_size_phone' => array( 'type' => 'skip' ),
			'item_image_height' => array( 'type' => 'skip' ),
			'item_image_ratio' => array( 'type' => 'skip' ),
			'item_use_circle' => array(
				'label'           => esc_html__( 'Use Circle Background', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'item_settings',
			),
			'item_circle_color' => array(
				'label'           => esc_html__( 'Circle Background', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'item_settings',
			),
			'item_use_border' => array(
				'label'           => esc_html__( 'Use Border', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'item_settings',
			),
			'item_border_color' => array( 'type' => 'skip' ),
			'item_border_size' => array( 'type' => 'skip' ),
			'item_padding' => array(
				'label'           => esc_html__( 'Padding', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'item_settings',
			),
			'item_padding_last_edited' => array( 'type' => 'skip' ),
			'item_padding_tablet' => array( 'type' => 'skip' ),
			'item_padding_phone' => array( 'type' => 'skip' ),
			'item_show_sub' => array(
				'label'           => esc_html__( 'Show Sub-Menu', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'item_settings',
			),
			'item_dropdown_direction' => array(
				'label'           => esc_html__( 'Dropdown Direction', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'item_settings',
			),
			'item_sub_content' => array(
				'label'           => esc_html__( 'Sub-Menu Content', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'item_settings',
				'show_if'         => array( 'item_show_sub' => 'on' ),
			),
			'hide_desktop' => array(
				'label'           => esc_html__( 'Hide on Desktop', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'visibility',
			),
			'hide_tablet' => array(
				'label'           => esc_html__( 'Hide on Tablet', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'visibility',
			),
			'hide_phone' => array(
				'label'           => esc_html__( 'Hide on Phone', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'visibility',
			),
			'use_fullwidth' => array(
				'label'           => esc_html__( 'Full Width', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'main_content',
			),
			'background_color' => array(
				'label'           => esc_html__( 'Background Color', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'background',
			),
			'module_padding' => array(
				'label'           => esc_html__( 'Padding', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'background',
			),
			'module_padding_last_edited' => array( 'type' => 'skip' ),
			'module_padding_tablet' => array( 'type' => 'skip' ),
			'module_padding_phone' => array( 'type' => 'skip' ),
			'sticky_position' => array(
				'label'           => esc_html__( 'Sticky Position', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'main_content',
			),
			'bottom_sticky_color' => array(
				'label'           => esc_html__( 'Bottom Sticky Bar Color', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'main_content',
			),
			'bottom_sticky_text_color' => array(
				'label'           => esc_html__( 'Bottom Sticky Text Color', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'main_content',
			),
			'custom_css' => array(
				'label'           => esc_html__( 'CSS', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'custom_css',
			),
		);
	}

	public function get_advanced_fields_config() {
		return array(
			'background' => array( 'css' => array( 'main' => array( '%%order_class%%' ) ) ),
			'link_options' => array(),
			'fonts' => array(
				'item_font' => array(
					'css'         => array( 'main' => '%%order_class%% .dd-flex-item-text' ),
					'toggle_slug' => 'item_settings',
				),
			),
		);
	}

	public static function get_items_array( $menu_items ) {
		$items = array();
		if ( empty( $menu_items ) ) return $items;
		$parsed = et_builder_parse_form_items( $menu_items );
		foreach ( (array) $parsed as $i => $item ) {
			$items[] = array(
				'item_type'       => $item['item_type'] ?? 'icon_option',
				'item_text'        => $item['item_text'] ?? ( 'Item ' . ( $i + 1 ) ),
				'item_icon'        => $item['item_icon'] ?? '&#x2b;',
				'item_image'       => $item['item_image'] ?? '',
				'item_image_alt'   => $item['item_image_alt'] ?? '',
				'item_url'        => $item['item_url'] ?? '#',
				'item_new_window' => $item['item_new_window'] ?? 'off',
				'item_use_circle'  => $item['item_use_circle'] ?? 'off',
				'item_circle_color'=> $item['item_circle_color'] ?? '#2ea3f7',
				'item_padding'     => $item['item_padding'] ?? '',
				'item_padding_tablet' => $item['item_padding_tablet'] ?? '',
				'item_padding_phone' => $item['item_padding_phone'] ?? '',
				'item_font_size'   => $item['item_font_size'] ?? '',
				'item_icon_font_size' => $item['item_icon_font_size'] ?? '',
				'item_image_size'  => $item['item_image_size'] ?? '',
				'item_image_ratio' => $item['item_image_ratio'] ?? 'square',
				'hide_desktop'     => $item['hide_desktop'] ?? 'off',
				'hide_tablet'      => $item['hide_tablet'] ?? 'off',
				'hide_phone'       => $item['hide_phone'] ?? 'off',
				'item_show_sub'   => $item['item_show_sub'] ?? 'off',
				'item_dropdown_direction' => $item['item_dropdown_direction'] ?? 'down',
			);
		}
		return $items;
	}

	public static function render_items_field( $args, $render_slug ) {
		$items = isset( $args['content'] ) ? $args['content'] : array();
		if ( empty( $items ) ) $items = array();
		if ( ! is_array( $items ) ) $items = array();
		$output = '<div class="et_pb_options_bar" data-collapse="on">';
		$output .= sprintf( '<div class="et_pb_options_bar_top">%s</div>',
			'<span class="dashicons dashicons-plus-alt2 dm5-add-item" style="cursor:pointer;margin-right:8px;"></span>' .
			sprintf( '<span class="dm5-items-count">%s %d %s</span>',
				esc_html__( 'Total:', 'divimenus5' ),
				count( $items ),
				count( $items ) === 1 ? esc_html__( 'Item', 'divimenus5' ) : esc_html__( 'Items', 'divimenus5' )
			)
		);
		foreach ( $items as $key => $item ) {
			$type = $item['item_type'] ?? 'icon_option';
			$text = $item['item_text'] ?? ( 'Item ' . ( $key + 1 ) );
			$icon = isset( $item['item_icon'] ) ? DM5_Helper::render_icon( $item['item_icon'] ) : '+';
			$num = $key + 1;
			$type_icon = $type === 'text_option' ? '<span class="dashicons dashicons-editor-textcolor" style="font-size:14px;width:14px;height:14px;"></span>' :
				( $type === 'image_option' ? '<span class="dashicons dashicons-image" style="font-size:14px;width:14px;height:14px;"></span>' :
				'<span style="font-size:16px;width:16px;height:16px;display:inline-flex;align-items:center;justify-content:center;">' . $icon . '</span>' );
			$output .= sprintf( '<div class="et_pb_option" data-index="%d">', $key );
			$output .= sprintf( '<span class="dm5-item-icon">%s</span>', $type_icon );
			$output .= sprintf( '<span class="dm5-item-label">%s</span>', esc_html( $text ) );
			$output .= '</div>';
		}
		if ( empty( $items ) ) {
			$output .= '<div class="et_pb_option" style="padding:15px;text-align:center;color:#999;">';
			$output .= '<span class="dashicons dashicons-info" style="margin-right:6px;"></span>';
			$output .= esc_html__( 'No items yet. Click the + button above to add one.', 'divimenus5' );
			$output .= '</div>';
		}
		$output .= '</div>';
		return et_core_intentionally_unescaped( $output, 'html' );
	}

	protected function _render_flex_item( $item, $index ) {
		$type = $item['type'] ?? 'text';
		$use_circle = ! empty( $item['use_circle'] ) && $item['use_circle'] === 'on';
		$out = sprintf( '<div class="dd-mi dd-flex-item dd-flex-item-%d%2$s">', $index, $use_circle ? ' dd-circular' : '' );

		$url = ! empty( $item['url'] ) ? esc_url( $item['url'] ) : '#';
		$new_window = ! empty( $item['new_window'] ) && $item['new_window'] === 'on' ? 'target="_blank" rel="noopener"' : '';

		$out .= sprintf( '<a class="dd-item dd-flex-item-content" href="%1$s" %2$s>', $url, $new_window );

		if ( $type === 'icon' ) {
			$icon = DM5_Helper::render_icon( $item['icon'] ?? '' );
			$out .= sprintf( '<span class="dd-item-icon">%s</span>', $icon );
		} elseif ( $type === 'text' ) {
			$text = et_core_intentionally_unescaped( $item['text'] ?? 'Item', 'html' );
			$out .= sprintf( '<span class="dd-item-text dd-multi-value" data-desktop="%s">%s</span>', esc_attr( $text ), $text );
		} elseif ( $type === 'image' ) {
			$img = esc_url( $item['image'] ?? DM5_PLACEHOLDER_IMAGE_DATA );
			$alt = $item['image_alt'] ?? '';
			$out .= sprintf( '<img src="%s" alt="%s" class="dd-item-image dd-multi-value" data-desktop="%s">', $img, esc_attr( $alt ), esc_url( $img ) );
		}

		$out .= '</a>';
		$out .= '</div>';
		return $out;
	}

	protected function _get_items_data( $raw_items ) {
		$items = array();
		if ( empty( $raw_items ) ) return $items;
		$parsed = et_builder_parse_form_items( $raw_items );
		foreach ( (array) $parsed as $i => $item ) {
			$items[] = array(
				'type'       => $item['item_type'] ?? 'text',
				'text'       => $item['item_text'] ?? ( 'Item ' . ( $i + 1 ) ),
				'icon'       => $item['item_icon'] ?? '',
				'image'      => $item['item_image'] ?? '',
				'image_alt'  => $item['item_image_alt'] ?? '',
				'url'        => $item['item_url'] ?? '#',
				'new_window' => $item['item_new_window'] ?? 'off',
				'use_circle' => $item['item_use_circle'] ?? 'off',
				'circle_color' => $item['item_circle_color'] ?? '#2ea3f7',
				'padding'   => (int) ( $item['item_padding'] ?? 0 ),
				'padding_t' => (int) ( $item['item_padding_tablet'] ?? 0 ),
				'padding_p' => (int) ( $item['item_padding_phone'] ?? 0 ),
				'font_size'  => (int) ( $item['item_font_size'] ?? 14 ),
				'font_size_t'=> (int) ( $item['item_font_size_tablet'] ?? 14 ),
				'font_size_p'=> (int) ( $item['item_font_size_phone'] ?? 14 ),
				'icon_size'  => (int) ( $item['item_icon_font_size'] ?? 24 ),
				'icon_size_t'=> (int) ( $item['item_icon_font_size_tablet'] ?? 24 ),
				'icon_size_p'=> (int) ( $item['item_icon_font_size_phone'] ?? 24 ),
				'image_size' => (int) ( $item['item_image_size'] ?? 57 ),
				'image_size_t'=> (int) ( $item['item_image_size_tablet'] ?? 57 ),
				'image_size_p'=> (int) ( $item['item_image_size_phone'] ?? 57 ),
				'image_ratio'=> $item['item_image_ratio'] ?? 'square',
				'hide_desktop'=> ! empty( $item['hide_desktop'] ) && $item['hide_desktop'] === 'on',
				'hide_tablet' => ! empty( $item['hide_tablet'] ) && $item['hide_tablet'] === 'on',
				'hide_phone' => ! empty( $item['hide_phone'] ) && $item['hide_phone'] === 'on',
			);
		}
		return $items;
	}

	public function render( $attrs, $content, $render_slug ) {
		wp_enqueue_style( 'divimenus5-frontend', DM5_PLUGIN_DIR_URL . 'styles/frontend.css', array(), DM5_VERSION );
		wp_enqueue_script( 'divimenus5-frontend', DM5_PLUGIN_DIR_URL . 'scripts/frontend.js', array( 'jquery' ), DM5_VERSION, true );

		$menu_type = $this->props['menu_type'] ?? 'horizontal';
		$items_ali = $this->props['items_alignment'] ?? 'flex-start';
		$flex_dir = $this->props['flex_direction'] ?? 'row';

		$items = $this->_get_items_data( $this->props['menu_items'] ?? '' );

		$module_classes = trim( implode( ' ', apply_filters( 'et_builder_module_classes', array( 'et_pb_module', 'et_pb_divimenus_flex', 'dd-flex', $this->get_module_class( $render_slug ) ), $render_slug ) ) );
		$wrapper_atts = $this->_render_module_wrapper( $attrs, $content, true );

		$html = sprintf( '<div%1$s class="%2$s" style="display:flex;flex-direction:%3$s;justify-content:%4$s;align-items:center;flex-wrap:wrap;">',
			$wrapper_atts, esc_attr( $module_classes ), esc_attr( $flex_dir ), esc_attr( $items_ali ) );

		// Logo
		if ( ! empty( $this->props['logo_image'] ) ) {
			$logo_alt = $this->props['logo_alt'] ?? '';
			$logo_link = ! empty( $this->props['logo_link'] ) ? esc_url( $this->props['logo_link'] ) : esc_url( home_url( '/' ) );
			$logo_img = sprintf( '<img src="%s" alt="%s" class="dd-logo-img">',
				esc_url( $this->props['logo_image'] ), esc_attr( $logo_alt ) );
			$html .= sprintf( '<div class="dd-logo">%s</div>', $logo_link !== '#' ? sprintf( '<a href="%s">%s</a>', $logo_link, $logo_img ) : $logo_img );
		}

		// Items
		$html .= '<div class="dd-flex-items" style="display:flex;align-items:center;flex:1;">';
		foreach ( $items as $i => $item ) {
			if ( ( ! empty( $item['hide_desktop'] ) && $item['hide_desktop'] ) ||
			     ( ! empty( $item['hide_tablet'] ) && $item['hide_tablet'] ) ||
			     ( ! empty( $item['hide_phone'] ) && $item['hide_phone'] ) ) continue;
			$html .= $this->_render_flex_item( $item, $i );
		}
		$html .= '</div></div>';

		return et_core_intentionally_unescaped( $html, 'html' );
	}
}

class DiviMenus5Flex_Item_Module extends ET_Builder_Module {

	public $slug          = 'et_pb_divimenus5_flex_item';
	public $vb_support    = 'on';
	public $uses_children = false;
	public $type          = 'child';

	public function init() {
		$this->name       = esc_html__( 'DiviMenu Flex Item', 'divimenus5' );
		$this->plural     = esc_html__( 'DiviMenu Flex Items', 'divimenus5' );
		$this->fullname   = 'DiviMenu Flex Item';
		$this->main_css_element = '%%order_class%%';
		$this->child_title_var             = 'title';
		$this->advanced_setting_title_text = esc_html__( 'New Menu Item', 'divimenus5' );
		$this->settings_text               = esc_html__( 'Item Settings', 'divimenus5' );
	}

	public function get_fields() {
		return array(
			'item_type' => array(
				'label'           => esc_html__( 'Item Type', 'divimenus5' ),
				'type'            => 'select',
				'options'         => array(
					'text_option'  => esc_html__( 'Text', 'divimenus5' ),
					'icon_option'  => esc_html__( 'Icon', 'divimenus5' ),
					'image_option' => esc_html__( 'Image', 'divimenus5' ),
				),
				'default'         => 'icon_option',
				'toggle_slug'     => 'main_content',
			),
			'item_icon' => array(
				'label'           => esc_html__( 'Icon', 'divimenus5' ),
				'type'            => 'icon',
				'icon'            => 'divimenus5-icon-fontawesome',
				'default'         => '&#x2b;',
				'toggle_slug'     => 'main_content',
				'show_if'         => array( 'item_type' => 'icon_option' ),
			),
			'item_icon_font_size' => array( 'type' => 'skip' ),
			'item_icon_font_size_last_edited' => array( 'type' => 'skip' ),
			'item_icon_font_size_tablet' => array( 'type' => 'skip' ),
			'item_icon_font_size_phone' => array( 'type' => 'skip' ),
			'item_text' => array(
				'label'           => esc_html__( 'Text', 'divimenus5' ),
				'type'            => 'text',
				'default'         => 'Item',
				'toggle_slug'     => 'main_content',
				'show_if'         => array( 'item_type' => 'text_option' ),
			),
			'item_font' => array(
				'label'           => esc_html__( 'Font', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'main_content',
			),
			'item_font_size' => array( 'type' => 'skip' ),
			'item_font_size_last_edited' => array( 'type' => 'skip' ),
			'item_font_size_tablet' => array( 'type' => 'skip' ),
			'item_font_size_phone' => array( 'type' => 'skip' ),
			'item_text_color' => array(
				'label'           => esc_html__( 'Text Color', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'main_content',
			),
			'item_image' => array(
				'label'           => esc_html__( 'Image', 'divimenus5' ),
				'type'            => 'upload',
				'image'           => true,
				'toggle_slug'     => 'main_content',
				'show_if'         => array( 'item_type' => 'image_option' ),
			),
			'item_image_alt' => array(
				'label'           => esc_html__( 'Image Alt Text', 'divimenus5' ),
				'type'            => 'text',
				'toggle_slug'     => 'main_content',
				'show_if'         => array( 'item_type' => 'image_option' ),
			),
			'item_image_size' => array( 'type' => 'skip' ),
			'item_image_size_last_edited' => array( 'type' => 'skip' ),
			'item_image_size_tablet' => array( 'type' => 'skip' ),
			'item_image_size_phone' => array( 'type' => 'skip' ),
			'item_image_height' => array( 'type' => 'skip' ),
			'item_image_ratio' => array( 'type' => 'skip' ),
			'item_url' => array(
				'label'           => esc_html__( 'URL', 'divimenus5' ),
				'type'            => 'text',
				'default'         => '#',
				'toggle_slug'     => 'link',
			),
			'item_new_window' => array(
				'label'           => esc_html__( 'Open in New Window', 'divimenus5' ),
				'type'            => 'select',
				'options'         => DM5_Helper::get_yes_no_options(),
				'default'         => 'off',
				'toggle_slug'     => 'link',
			),
			'item_use_circle' => array(
				'label'           => esc_html__( 'Use Circle Background', 'divimenus5' ),
				'type'            => 'select',
				'options'         => DM5_Helper::get_yes_no_options(),
				'default'         => 'off',
				'toggle_slug'     => 'main_content',
			),
			'item_circle_color' => array(
				'label'           => esc_html__( 'Circle Background', 'divimenus5' ),
				'type'            => 'color',
				'default'         => '#2ea3f7',
				'toggle_slug'     => 'main_content',
				'show_if'         => array( 'item_use_circle' => 'on' ),
			),
			'item_use_border' => array(
				'label'           => esc_html__( 'Use Border', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'main_content',
			),
			'item_border_color' => array( 'type' => 'skip' ),
			'item_border_size' => array( 'type' => 'skip' ),
			'item_padding' => array(
				'label'           => esc_html__( 'Padding', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'main_content',
			),
			'item_padding_last_edited' => array( 'type' => 'skip' ),
			'item_padding_tablet' => array( 'type' => 'skip' ),
			'item_padding_phone' => array( 'type' => 'skip' ),
			'item_show_sub' => array(
				'label'           => esc_html__( 'Show Sub-Menu', 'divimenus5' ),
				'type'            => 'select',
				'options'         => DM5_Helper::get_yes_no_options(),
				'default'         => 'off',
				'toggle_slug'     => 'main_content',
			),
			'item_dropdown_direction' => array(
				'label'           => esc_html__( 'Dropdown Direction', 'divimenus5' ),
				'type'            => 'select',
				'options'         => array(
					'down'  => esc_html__( 'Down', 'divimenus5' ),
					'up'    => esc_html__( 'Up', 'divimenus5' ),
					'right' => esc_html__( 'Right', 'divimenus5' ),
					'left'  => esc_html__( 'Left', 'divimenus5' ),
				),
				'default'         => 'down',
				'toggle_slug'     => 'main_content',
				'show_if'         => array( 'item_show_sub' => 'on' ),
			),
			'item_sub_content' => array(
				'label'           => esc_html__( 'Sub-Menu Content', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'main_content',
				'show_if'         => array( 'item_show_sub' => 'on' ),
			),
			'hide_desktop' => array(
				'label'           => esc_html__( 'Hide on Desktop', 'divimenus5' ),
				'type'            => 'select',
				'options'         => DM5_Helper::get_yes_no_options(),
				'default'         => 'off',
				'toggle_slug'     => 'visibility',
			),
			'hide_tablet' => array(
				'label'           => esc_html__( 'Hide on Tablet', 'divimenus5' ),
				'type'            => 'select',
				'options'         => DM5_Helper::get_yes_no_options(),
				'default'         => 'off',
				'toggle_slug'     => 'visibility',
			),
			'hide_phone' => array(
				'label'           => esc_html__( 'Hide on Phone', 'divimenus5' ),
				'type'            => 'select',
				'options'         => DM5_Helper::get_yes_no_options(),
				'default'         => 'off',
				'toggle_slug'     => 'visibility',
			),
		);
	}

	public function get_advanced_fields_config() {
		return array(
			'fonts' => array(
				'item_font' => array(
					'css'         => array( 'main' => '%%order_class%%' ),
					'toggle_slug' => 'main_content',
				),
			),
		);
	}

	public function render( $attrs, $content, $render_slug ) {
		return '';
	}
}
