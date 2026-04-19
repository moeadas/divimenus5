<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class DiviMenus5_Module extends ET_Builder_Module {

	public $slug                     = 'et_pb_divimenus5';
	public $vb_support              = 'partial';
	public $child_slug             = 'et_pb_divimenus5_item';
	public $child_item_text       = esc_html__( 'Menu Item', 'divimenus5' );
	protected $module_uses_wrapper = false;
	protected $is_sticky_module    = false;

	public function init() {
		$this->name       = esc_html__( 'DiviMenu', 'divimenus5' );
		$this->plural     = esc_html__( 'DiviMenus', 'divimenus5' );
		$this->fullname   = 'DiviMenus';
		$this->main_css_element = '%%order_class%%';
		$this->child_item_text = esc_html__( 'Menu Item', 'divimenus5' );
	}

	public function get_fields() {
		return array(
			'menu_type' => array(
				'label'            => esc_html__( 'Menu Shape', 'divimenus5' ),
				'type'             => 'select',
				'options'          => array(
					'circular'   => esc_html__( 'Circular', 'divimenus5' ),
					'horizontal'=> esc_html__( 'Horizontal', 'divimenus5' ),
					'vertical'   => esc_html__( 'Vertical', 'divimenus5' ),
				),
				'default'          => 'horizontal',
				'toggle_slug'      => 'main_content',
			),
			'circular_type' => array(
				'label'            => esc_html__( 'Circular Type', 'divimenus5' ),
				'type'             => 'select',
				'options'          => array(
					'circle'              => esc_html__( 'Full Circle', 'divimenus5' ),
					'semicircle_top'      => esc_html__( 'Semi-Circle Top', 'divimenus5' ),
					'semicircle_bottom'   => esc_html__( 'Semi-Circle Bottom', 'divimenus5' ),
					'semicircle_left'     => esc_html__( 'Semi-Circle Left', 'divimenus5' ),
					'semicircle_right'    => esc_html__( 'Semi-Circle Right', 'divimenus5' ),
				),
				'default'          => 'circle',
				'toggle_slug'      => 'main_content',
				'show_if'          => array( 'menu_type' => 'circular' ),
			),
			'menu_items' => array(
				'label'            => esc_html__( 'Menu Items', 'divimenus5' ),
				'type'             => 'options',
				'options'          => 'DiviMenus5_Module::get_items_array',
				'renderer'         => array( 'DiviMenus5_Module', 'render_items_field' ),
				'hover'            => 'none',
				'toggle_slug'      => 'main_content',
			),
			'central_item_select' => array(
				'label'            => esc_html__( 'Central Item Type', 'divimenus5' ),
				'type'             => 'select',
				'options'          => array(
					'central_item_icon_option'   => esc_html__( 'Icon', 'divimenus5' ),
					'central_item_text_option'  => esc_html__( 'Text', 'divimenus5' ),
					'central_item_image_option' => esc_html__( 'Image', 'divimenus5' ),
				),
				'default'          => 'central_item_icon_option',
				'toggle_slug'      => 'button_settings',
			),
			'central_item_icon' => array(
				'label'               => esc_html__( 'Icon', 'divimenus5' ),
				'type'                => 'icon',
				'icon'                => 'divimenus5-icon-fontawesome',
				'default'             => '&#x33;',
				'toggle_slug'         => 'button_settings',
				'show_if'             => array( 'central_item_select' => 'central_item_icon_option' ),
			),
			'central_item_icon_font_size' => array(
				'label'          => esc_html__( 'Icon Font Size', 'divimenus5' ),
				'type'           => 'skip' ,
				'toggle_slug'    => 'button_settings',
			),
			'central_item_icon_font_size_last_edited' => array( 'type' => 'skip' ),
			'central_item_icon_font_size_tablet' => array( 'type' => 'skip' ),
			'central_item_icon_font_size_phone' => array( 'type' => 'skip' ),
			'central_item_text' => array(
				'label'           => esc_html__( 'Button Text', 'divimenus5' ),
				'type'            => 'text',
				'default'         => '+',
				'toggle_slug'     => 'button_settings',
				'show_if'         => array( 'central_item_select' => 'central_item_text_option' ),
			),
			'central_item_font' => array(
				'label'           => esc_html__( 'Button Font', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'button_settings',
			),
			'central_item_font_size' => array( 'type' => 'skip' ),
			'central_item_font_size_last_edited' => array( 'type' => 'skip' ),
			'central_item_font_size_tablet' => array( 'type' => 'skip' ),
			'central_item_font_size_phone' => array( 'type' => 'skip' ),
			'central_item_text_color' => array(
				'label'        => esc_html__( 'Button Text Color', 'divimenus5' ),
				'type'         => 'color',
				'default'      => '#ffffff',
				'toggle_slug'  => 'button_settings',
				'show_if'      => array( 'central_item_select' => 'central_item_text_option' ),
			),
			'central_item_font_use_size' => array(
				'label'           => esc_html__( 'Use Custom Font Size', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'button_settings',
			),
			'central_item_image' => array(
				'label'           => esc_html__( 'Button Image', 'divimenus5' ),
				'type'            => 'upload',
				'image'           => true,
				'toggle_slug'     => 'button_settings',
				'show_if'         => array( 'central_item_select' => 'central_item_image_option' ),
			),
			'central_item_image_alt' => array(
				'label'           => esc_html__( 'Button Image Alt Text', 'divimenus5' ),
				'type'            => 'text',
				'toggle_slug'     => 'button_settings',
				'show_if'         => array( 'central_item_select' => 'central_item_image_option' ),
			),
			'central_item_image_size' => array( 'type' => 'skip' ),
			'central_item_image_size_last_edited' => array( 'type' => 'skip' ),
			'central_item_image_size_tablet' => array( 'type' => 'skip' ),
			'central_item_image_size_phone' => array( 'type' => 'skip' ),
			'central_item_image_ratio' => array(
				'label'           => esc_html__( 'Image Ratio', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'button_settings',
			),
			'central_item_use_circle' => array(
				'label'           => esc_html__( 'Use Circle Background', 'divimenus5' ),
				'type'            => 'select',
				'options'         => DiviMenusHelper::get_yes_no_options(),
				'default'          => 'on',
				'toggle_slug'      => 'button_settings',
			),
			'central_item_circle_color' => array(
				'label'        => esc_html__( 'Circle Background', 'divimenus5' ),
				'type'         => 'color',
				'default'      => '#2ea3f7',
				'toggle_slug'  => 'button_settings',
				'show_if'      => array( 'central_item_use_circle' => 'on' ),
			),
			'central_item_use_circle_border' => array(
				'label'           => esc_html__( 'Use Circle Border', 'divimenus5' ),
				'type'            => 'select',
				'options'         => DiviMenusHelper::get_yes_no_options(),
				'default'         => 'off',
				'toggle_slug'     => 'button_settings',
				'show_if'         => array( 'central_item_use_circle' => 'on' ),
			),
			'central_item_circle_border_color' => array(
				'label'           => esc_html__( 'Circle Border Color', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'button_settings',
			),
			'central_item_circle_border_size' => array(
				'label'           => esc_html__( 'Circle Border Size', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'button_settings',
			),
			'central_item_fit_bg' => array(
				'label'           => esc_html__( 'Fit Button Background to Content', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'button_settings',
			),
			'central_item_padding' => array(
				'label'           => esc_html__( 'Button Padding', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'button_settings',
			),
			'central_item_scale' => array(
				'label'           => esc_html__( 'Scale Button on Menu Open', 'divimenus5' ),
				'type'            => 'select',
				'options'         => DiviMenusHelper::get_yes_no_options(),
				'default'         => 'off',
				'toggle_slug'     => 'button_settings',
			),
			'menu_alignment' => array(
				'label'           => esc_html__( 'Menu Alignment', 'divimenus5' ),
				'type'            => 'select',
				'options'         => array(
					'left'      => esc_html__( 'Left', 'divimenus5' ),
					'center'    => esc_html__( 'Center', 'divimenus5' ),
					'right'     => esc_html__( 'Right', 'divimenus5' ),
					'justified' => esc_html__( 'Justified', 'divimenus5' ),
				),
				'default'         => 'left',
				'toggle_slug'     => 'main_content',
			),
			'menu_button_show_title' => array(
				'label'           => esc_html__( 'Show Button Title', 'divimenus5' ),
				'type'            => 'select',
				'options'         => DiviMenusHelper::get_yes_no_options(),
				'default'         => 'off',
				'toggle_slug'     => 'main_content',
			),
			'mb_title_use_background' => array(
				'label'           => esc_html__( 'Use Button Title Background', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'main_content',
			),
			'mb_title_background' => array(
				'label'           => esc_html__( 'Button Title Background', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'main_content',
			),
			'mb_title_padding' => array(
				'label'           => esc_html__( 'Button Title Padding', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'main_content',
			),
			'menu_item_show_title' => array(
				'label'           => esc_html__( 'Show Item Titles', 'divimenus5' ),
				'type'            => 'select',
				'options'         => DiviMenusHelper::get_yes_no_options(),
				'default'         => 'on',
				'toggle_slug'     => 'main_content',
			),
			'tooltip_use_background' => array(
				'label'           => esc_html__( 'Use Title Background', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'main_content',
			),
			'tooltip_background' => array(
				'label'           => esc_html__( 'Title Background', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'main_content',
			),
			'title_padding' => array(
				'label'           => esc_html__( 'Title Padding', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'main_content',
			),
			'menu_item_distance' => array(
				'label'            => esc_html__( 'Items Distance', 'divimenus5' ),
				'type'             => 'skip',
				'toggle_slug'      => 'main_content',
			),
			'menu_item_distance_last_edited' => array( 'type' => 'skip' ),
			'menu_item_distance_tablet' => array( 'type' => 'skip' ),
			'menu_item_distance_phone' => array( 'type' => 'skip' ),
			'menu_items_alignment' => array(
				'label'           => esc_html__( 'Items Alignment', 'divimenus5' ),
				'type'            => 'select',
				'options'         => array(
					'top'          => esc_html__( 'Top', 'divimenus5' ),
					'center'       => esc_html__( 'Center', 'divimenus5' ),
					'bottom'       => esc_html__( 'Bottom', 'divimenus5' ),
				),
				'default'         => 'center',
				'toggle_slug'     => 'main_content',
				'show_if'         => array( 'menu_type' => array( 'horizontal', 'vertical' ) ),
			),
			'menu_item_select' => array(
				'label'           => esc_html__( 'Item Type', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'item_settings',
			),
			'menu_item_icon' => array(
				'label'           => esc_html__( 'Item Icon', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'item_settings',
			),
			'menu_item_icon_font_size' => array( 'type' => 'skip' ),
			'menu_item_icon_font_size_last_edited' => array( 'type' => 'skip' ),
			'menu_item_icon_font_size_tablet' => array( 'type' => 'skip' ),
			'menu_item_icon_font_size_phone' => array( 'type' => 'skip' ),
			'menu_item_text' => array(
				'label'           => esc_html__( 'Item Text', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'item_settings',
			),
			'menu_item_font' => array(
				'label'           => esc_html__( 'Item Font', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'item_settings',
			),
			'menu_item_font_size' => array( 'type' => 'skip' ),
			'menu_item_font_size_last_edited' => array( 'type' => 'skip' ),
			'menu_item_font_size_tablet' => array( 'type' => 'skip' ),
			'menu_item_font_size_phone' => array( 'type' => 'skip' ),
			'menu_item_text_color' => array(
				'label'           => esc_html__( 'Item Text Color', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'item_settings',
			),
			'menu_item_image' => array(
				'label'           => esc_html__( 'Item Image', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'item_settings',
			),
			'menu_item_image_alt' => array(
				'label'           => esc_html__( 'Item Image Alt', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'item_settings',
			),
			'menu_item_image_size' => array( 'type' => 'skip' ),
			'menu_item_image_size_last_edited' => array( 'type' => 'skip' ),
			'menu_item_image_size_tablet' => array( 'type' => 'skip' ),
			'menu_item_image_size_phone' => array( 'type' => 'skip' ),
			'menu_item_image_height' => array( 'type' => 'skip' ),
			'menu_item_image_height_t' => array( 'type' => 'skip' ),
			'menu_item_image_height_p' => array( 'type' => 'skip' ),
			'menu_item_image_ratio' => array( 'type' => 'skip' ),
			'menu_item_use_circle' => array(
				'label'           => esc_html__( 'Use Circle Background', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'item_settings',
			),
			'menu_item_circle_color' => array(
				'label'           => esc_html__( 'Circle Background', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'item_settings',
			),
			'menu_item_use_circle_border' => array(
				'label'           => esc_html__( 'Use Circle Border', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'item_settings',
			),
			'menu_item_circle_border_color' => array( 'type' => 'skip' ),
			'menu_item_circle_border_size' => array( 'type' => 'skip' ),
			'menu_item_fit_bg' => array(
				'label'           => esc_html__( 'Fit Background to Content', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'item_settings',
			),
			'menu_item_padding' => array(
				'label'           => esc_html__( 'Item Padding', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'item_settings',
			),
			'menu_item_padding_last_edited' => array( 'type' => 'skip' ),
			'menu_item_padding_tablet' => array( 'type' => 'skip' ),
			'menu_item_padding_phone' => array( 'type' => 'skip' ),
			'menu_item_link_url' => array(
				'label'           => esc_html__( 'Link URL', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'item_settings',
			),
			'menu_item_link_new_window' => array(
				'label'           => esc_html__( 'Open Link in New Window', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'item_settings',
			),
			'popup_type' => array(
				'label'           => esc_html__( 'Popup Type', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'popup_settings',
			),
			'popup_content' => array(
				'label'           => esc_html__( 'Popup Content', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'popup_settings',
			),
			'popup_width' => array(
				'label'           => esc_html__( 'Popup Width', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'popup_settings',
			),
			'popup_height' => array(
				'label'           => esc_html__( 'Popup Height', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'popup_settings',
			),
			'popup_background' => array(
				'label'           => esc_html__( 'Popup Background', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'popup_settings',
			),
			'popup_padding' => array(
				'label'           => esc_html__( 'Popup Padding', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'popup_settings',
			),
			'popup_use_border' => array(
				'label'           => esc_html__( 'Use Popup Border', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'popup_settings',
			),
			'popup_border_color' => array( 'type' => 'skip' ),
			'popup_border_size' => array( 'type' => 'skip' ),
			'popup_border_radius' => array( 'type' => 'skip' ),
			'popup_use_shadow' => array(
				'label'           => esc_html__( 'Use Popup Shadow', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'popup_settings',
			),
			'popup_shadow_values' => array( 'type' => 'skip' ),
			'popup_effect_in' => array(
				'label'           => esc_html__( 'Popup Effect In', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'popup_settings',
			),
			'popup_effect_out' => array(
				'label'           => esc_html__( 'Popup Effect Out', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'popup_settings',
			),
			'popup_effect_ms' => array(
				'label'           => esc_html__( 'Popup Effect Duration', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'popup_settings',
			),
			'popup_show_close' => array(
				'label'           => esc_html__( 'Show Close Icon', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'popup_settings',
			),
			'popup_auto_hide' => array(
				'label'           => esc_html__( 'Auto-hide on Click Outside', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'popup_settings',
			),
			'show_open' => array(
				'label'           => esc_html__( 'Show Open Button', 'divimenus5' ),
				'type'            => 'select',
				'options'         => DiviMenusHelper::get_yes_no_options(),
				'default'         => 'on',
				'toggle_slug'     => 'visibility',
			),
			'hide_button' => array(
				'label'           => esc_html__( 'Hide Button when Menu is Open', 'divimenus5' ),
				'type'            => 'select',
				'options'         => DiviMenusHelper::get_yes_no_options(),
				'default'         => 'off',
				'toggle_slug'     => 'visibility',
			),
			'central_item_inline_menu_position' => array(
				'label'           => esc_html__( 'Button Position in Menu', 'divimenus5' ),
				'type'            => 'select',
				'options'         => array(
					'first'   => esc_html__( 'First', 'divimenus5' ),
					'middle'  => esc_html__( 'Middle', 'divimenus5' ),
					'last'    => esc_html__( 'Last', 'divimenus5' ),
				),
				'default'         => 'first',
				'toggle_slug'     => 'main_content',
			),
			'center_menu_button' => array(
				'label'           => esc_html__( 'Center Menu Button', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'main_content',
			),
			'bg_overflow' => array(
				'label'           => esc_html__( 'Background Overflow', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'background',
			),
			'background_color' => array(
				'label'           => esc_html__( 'Background Color', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'background',
			),
			'use_background_color_gradient' => array(
				'label'           => esc_html__( 'Use Gradient', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'background',
			),
			'background_color_gradient' => array( 'type' => 'skip' ),
			'background_color_gradient_direction' => array( 'type' => 'skip' ),
			'background_image' => array(
				'label'           => esc_html__( 'Background Image', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'background',
			),
			'background_padding' => array(
				'label'           => esc_html__( 'Background Padding', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'background',
			),
			'background_padding_last_edited' => array( 'type' => 'skip' ),
			'background_padding_tablet' => array( 'type' => 'skip' ),
			'background_padding_phone' => array( 'type' => 'skip' ),
			'bg_border_radii' => array(
				'label'           => esc_html__( 'Background Border Radius', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'background',
			),
			'bg_border_radii_last_edited' => array( 'type' => 'skip' ),
			'bg_border_radii_tablet' => array( 'type' => 'skip' ),
			'bg_border_radii_phone' => array( 'type' => 'skip' ),
			'hover_transition_duration' => array(
				'label'           => esc_html__( 'Hover Transition Duration', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'animation',
			),
			'hover_transition_speed_curve' => array(
				'label'           => esc_html__( 'Hover Transition Speed Curve', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'animation',
			),
			'hover_transition_delay' => array(
				'label'           => esc_html__( 'Hover Transition Delay', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'animation',
			),
			'inside_container' => array(
				'label'           => esc_html__( 'Place Inside Module Container', 'divimenus5' ),
				'type'            => 'select',
				'options'         => DiviMenusHelper::get_yes_no_options(),
				'default'         => 'off',
				'toggle_slug'     => 'main_content',
			),
			'adjust_container' => array(
				'label'           => esc_html__( 'Adjust Container when Closed', 'divimenus5' ),
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
			'background'   => array( 'css' => array( 'main' => array( '%%order_class%%' ) ) ),
			'link_options' => array( 'css' => array( 'main' => array( '%%order_class%%' ) ) ),
			'fonts'        => array(
				'menu_item_font' => array(
					'css'          => array( 'main' => '%%order_class%% .dd-menu-item-text' ),
					'font'         => 'ETsans',
					'skip'         => true,
					'toggle_slug'  => 'item_settings',
					'line_height'  => array( 'default' => '1em' ),
					'font_size'    => array( 'default' => '14px' ),
					'letter_spacing' => array( 'default' => '0px' ),
				),
			),
		);
	}

	public function advanced_fields_settings() {
		return array(
			'fonts' => array(),
		);
	}

	public static function get_items_array( $menu_items ) {
		$items = array();
		if ( empty( $menu_items ) ) return $items;
		$parsed = et_builder_parse_form_items( $menu_items );
		foreach ( (array) $parsed as $i => $item ) {
			$items[] = array(
				'menu_item_type'       => $item['menu_item_type'] ?? 'icon_option',
				'menu_item_text'        => $item['menu_item_text'] ?? ( 'Item ' . ( $i + 1 ) ),
				'menu_item_icon'        => $item['menu_item_icon'] ?? '&#x2b;',
				'menu_item_image'       => $item['menu_item_image'] ?? '',
				'menu_item_image_alt'   => $item['menu_item_image_alt'] ?? '',
				'menu_item_title'       => $item['menu_item_title'] ?? '',
				'menu_item_url'        => $item['menu_item_url'] ?? '#',
				'menu_item_link_new_window' => $item['menu_item_link_new_window'] ?? 'off',
				'menu_item_use_circle'  => $item['menu_item_use_circle'] ?? 'off',
				'menu_item_circle_color'=> $item['menu_item_circle_color'] ?? '#2ea3f7',
				'menu_item_padding'     => $item['menu_item_padding'] ?? '',
				'menu_item_padding_tablet' => $item['menu_item_padding_tablet'] ?? '',
				'menu_item_padding_phone' => $item['menu_item_padding_phone'] ?? '',
				'menu_item_font_size'   => $item['menu_item_font_size'] ?? '',
				'menu_item_icon_font_size' => $item['menu_item_icon_font_size'] ?? '',
				'menu_item_image_size'  => $item['menu_item_image_size'] ?? '',
				'menu_item_image_ratio' => $item['menu_item_image_ratio'] ?? 'square',
				'hide_desktop'          => $item['hide_desktop'] ?? 'off',
				'hide_tablet'           => $item['hide_tablet'] ?? 'off',
				'hide_phone'            => $item['hide_phone'] ?? 'off',
				'title_disable'        => $item['title_disable'] ?? 'off',
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
			$type = $item['menu_item_type'] ?? 'icon_option';
			$text = $item['menu_item_text'] ?? ( 'Item ' . ( $key + 1 ) );
			$icon = isset( $item['menu_item_icon'] ) ? DiviMenusHelper::render_icon_only( $item['menu_item_icon'] ) : '+';
			$title = $item['menu_item_title'] ?? '';
			$num = $key + 1;
			$type_icon = $type === 'text_option' ? '<span class="dashicons dashicons-editor-textcolor" style="font-size:14px;width:14px;height:14px;"></span>' :
				( $type === 'image_option' ? '<span class="dashicons dashicons-image" style="font-size:14px;width:14px;height:14px;"></span>' :
				'<span style="font-size:16px;width:16px;height:16px;display:inline-flex;align-items:center;justify-content:center;">' . $icon . '</span>' );
			$output .= sprintf( '<div class="et_pb_option" data-index="%d">', $key );
			$output .= sprintf( '<span class="dm5-item-icon">%s</span>', $type_icon );
			$output .= sprintf( '<span class="dm5-item-label">%s</span>', esc_html( $text ) );
			if ( $title ) $output .= sprintf( '<span class="dm5-item-title" style="color:#999;font-size:11px;margin-left:6px;">— %s</span>', esc_html( $title ) );
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

	protected function _render_menu_button( &$items, $render_slug ) {
		$type = $this->props['central_item_select'];
		$use_circle = $this->props['central_item_use_circle'] === 'on';
		$circle_color = $this->props['central_item_circle_color'] ?: '#2ea3f7';
		$out = sprintf( '<div class="dd-menu-button-content%1$s" aria-pressed="false" %2$s>',
			$use_circle ? ' dd-circular' : '',
			'data-effect-in="fade" data-effect-out="fade" data-effect-ms="300"'
		);
		if ( $type === 'central_item_icon_option' ) {
			$icon = DiviMenusHelper::render_icon_only( $this->props['central_item_icon'] ?: '&#x33;' );
			$out .= sprintf( '<span class="dd-item dd-button-icon dd-icon-fontawesome">%s</span>', $icon );
		} elseif ( $type === 'central_item_text_option' ) {
			$text = et_core_intentionally_unescaped( $this->props['central_item_text'] ?: '+', 'html' );
			$out .= sprintf( '<span class="dd-item dd-button-text" %s>%s</span>',
				'data-desktop="' . esc_attr( $text ) . '"', $text );
		} elseif ( $type === 'central_item_image_option' ) {
			$img = esc_url( $this->props['central_item_image'] ?: DM5_PLACEHOLDER_IMAGE_DATA );
			$alt = DiviMenusHelper::get_image_alt( $this->props, 'central_item_image', 'central_item_image_alt' );
			$out .= sprintf( '<img src="%s" alt="%s" class="dd-item dd-button-image" %s>',
				$img, esc_attr( $alt ), 'data-desktop="' . esc_attr( $img ) . '"' );
		}
		$out .= $this->_render_tooltip( 0, true );
		$out .= '</div>';
		return $out;
	}

	protected function _render_item( $item, $index, &$items ) {
		$type = $item['type'];
		$out = sprintf( '<div class="dd-menu-item-wrapper" data-index="%d">', $index );
		$out .= sprintf( '<a class="dd-menu-item-content%1$s" href="%2$s" %3$s>',
			isset( $item['use_circle'] ) && $item['use_circle'] === 'on' ? ' dd-circular' : '',
			! empty( $item['url'] ) ? esc_url( $item['url'] ) : '#',
			! empty( $item['new_window'] ) && $item['new_window'] === 'on' ? 'target="_blank" rel="noopener"' : ''
		);
		if ( $type === 'icon' ) {
			$icon = DiviMenusHelper::render_icon_only( $item['icon'] ?: '&#x2b;' );
			$out .= sprintf( '<span class="dd-item dd-menu-item-icon">%s</span>', $icon );
		} elseif ( $type === 'text' ) {
			$text = et_core_intentionally_unescaped( $item['text'] ?: 'Item', 'html' );
			$out .= sprintf( '<span class="dd-item dd-menu-item-text" data-desktop="%s">%s</span>', esc_attr( $text ), $text );
		} elseif ( $type === 'image' ) {
			$img = esc_url( $item['image'] ?: DM5_PLACEHOLDER_IMAGE_DATA );
			$alt = $item['image_alt'] ?: '';
			$out .= sprintf( '<img src="%s" alt="%s" class="dd-item dd-menu-item-image" data-desktop="%s">',
				$img, esc_attr( $alt ), esc_url( $img ) );
		}
		$out .= '</a>';
		if ( $this->props['menu_item_show_title'] === 'on' && ! empty( $item['title'] ) && empty( $item['title_disable'] ) ) {
			$out .= sprintf( '<div class="dd-tooltip dd-hover-enabled dd-hover"><span class="dd-title">%s</span></div>',
				et_core_intentionally_unescaped( $item['title'], 'html' ) );
		}
		$out .= '</div>';
		return $out;
	}

	protected function _render_tooltip( $index = 0, $is_button = false ) {
		if ( $is_button && $this->props['menu_button_show_title'] !== 'on' ) return '';
		if ( ! $is_button && $this->props['menu_item_show_title'] !== 'on' ) return '';
		$title = $is_button ? ( $this->props['central_item_text'] ?: '+' ) : ( $this->props['menu_item_text'] ?? '' );
		if ( empty( $title ) ) return '';
		return sprintf( '<div class="dd-tooltip dd-hover-enabled"><span class="dd-title">%s</span></div>',
			et_core_intentionally_unescaped( $title, 'html' ) );
	}

	protected function _get_items_data( $raw_items ) {
		$items = array();
		if ( empty( $raw_items ) ) return $items;
		$parsed = et_builder_parse_form_items( $raw_items );
		foreach ( (array) $parsed as $i => $item ) {
			$items[] = array(
				'type'          => $item['menu_item_type'] ?? 'icon',
				'text'          => $item['menu_item_text'] ?? ( 'Item ' . ( $i + 1 ) ),
				'icon'          => $item['menu_item_icon'] ?? '',
				'image'         => $item['menu_item_image'] ?? '',
				'image_alt'     => $item['menu_item_image_alt'] ?? '',
				'title'         => $item['menu_item_title'] ?? '',
				'url'           => $item['menu_item_url'] ?? '#',
				'new_window'    => $item['menu_item_link_new_window'] ?? 'off',
				'use_circle'    => $item['menu_item_use_circle'] ?? 'off',
				'circle_color'  => $item['menu_item_circle_color'] ?? '#2ea3f7',
				'padding'       => (int) ( $item['menu_item_padding'] ?? 0 ),
				'padding_t'     => (int) ( $item['menu_item_padding_tablet'] ?? 0 ),
				'padding_p'     => (int) ( $item['menu_item_padding_phone'] ?? 0 ),
				'font_size'     => (int) ( $item['menu_item_font_size'] ?? 14 ),
				'font_size_t'   => (int) ( $item['menu_item_font_size_tablet'] ?? 14 ),
				'font_size_p'   => (int) ( $item['menu_item_font_size_phone'] ?? 14 ),
				'icon_size'     => (int) ( $item['menu_item_icon_font_size'] ?? 24 ),
				'icon_size_t'   => (int) ( $item['menu_item_icon_font_size_tablet'] ?? 24 ),
				'icon_size_p'   => (int) ( $item['menu_item_icon_font_size_phone'] ?? 24 ),
				'image_size'    => (int) ( $item['menu_item_image_size'] ?? 57 ),
				'image_size_t'   => (int) ( $item['menu_item_image_size_tablet'] ?? 57 ),
				'image_size_p'   => (int) ( $item['menu_item_image_size_phone'] ?? 57 ),
				'image_ratio'   => $item['menu_item_image_ratio'] ?? 'square',
				'hide_desktop'  => ! empty( $item['hide_desktop'] ) && $item['hide_desktop'] === 'on',
				'hide_tablet'   => ! empty( $item['hide_tablet'] ) && $item['hide_tablet'] === 'on',
				'hide_phone'    => ! empty( $item['hide_phone'] ) && $item['hide_phone'] === 'on',
				'title_disable' => ! empty( $item['title_disable'] ) && $item['title_disable'] === 'on',
			);
		}
		return $items;
	}

	public function render( $attrs, $content, $render_slug ) {
		wp_enqueue_style( 'divimenus5-frontend', DM5_PLUGIN_DIR_URL . 'styles/frontend.css', array(), DM5_VERSION );
		wp_enqueue_script( 'divimenus5-frontend', DM5_PLUGIN_DIR_URL . 'scripts/frontend.js', array( 'jquery' ), DM5_VERSION, true );

		$menu_type = $this->props['menu_type'] ?: 'horizontal';
		$circular_type = $this->props['circular_type'] ?: 'circle';
		$menu_ali = $this->props['menu_alignment'] ?: 'left';

		$items = $this->_get_items_data( $this->props['menu_items'] ?? '' );
		$itemsc = DiviMenusHelper::get_items_count( $items );

		$module_classes = trim( implode( ' ', apply_filters( 'et_builder_module_classes', array( 'et_pb_module', 'et_pb_divimenus', 'et_pb_divimenus5', $this->module_uses_wrapper ? 'et_pb_column_wrapper' : '', $this->get_module_class( $render_slug ) ), $render_slug ) ) );

		$wrapper_atts = $this->_render_module_wrapper( $attrs, $content, true );

		$html = sprintf( '<div%1$s class="%2$s" data-menu-type="%3$s">',
			$wrapper_atts, esc_attr( $module_classes ), esc_attr( $menu_type ) );

		$html .= '<div class="dd-divimenu dd-dm">';
		$html .= '<div class="dd-menu-bg"></div>';
		$html .= $this->_render_menu_button( $items, $render_slug );
		$html .= '<div class="dd-menu-items">';

		foreach ( $items as $i => $item ) {
			$html .= sprintf( '<div class="dd-mi-w dd-mi-%d">', $i );
			$html .= $this->_render_item( $item, $i, $items );
			$html .= '</div>';
		}

		$html .= '</div></div></div>';

		return et_core_intentionally_unescaped( $html, 'html' );
	}
}

class DiviMenus5_Item_Module extends ET_Builder_Module {
	public $slug            = 'et_pb_divimenus5_item';
	public $vb_support      = 'partial';
	public $uses_children   = false;
	public $type            = 'child';

	public function init() {
		$this->name       = esc_html__( 'DiviMenu Item', 'divimenus5' );
		$this->plural     = esc_html__( 'DiviMenu Items', 'divimenus5' );
		$this->fullname   = 'DiviMenu Item';
		$this->main_css_element = '%%order_class%%';
		$this->child_title_var             = 'title';
		$this->advanced_setting_title_text = esc_html__( 'New Menu Item', 'divimenus5' );
		$this->settings_text               = esc_html__( 'Item Settings', 'divimenus5' );
	}

	public function get_fields() {
		return array(
			'menu_item_type' => array(
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
			'menu_item_icon' => array(
				'label'           => esc_html__( 'Icon', 'divimenus5' ),
				'type'            => 'icon',
				'icon'            => 'divimenus5-icon-fontawesome',
				'default'         => '&#x2b;',
				'toggle_slug'     => 'main_content',
				'show_if'         => array( 'menu_item_type' => 'icon_option' ),
			),
			'menu_item_icon_font_size' => array( 'type' => 'skip' ),
			'menu_item_icon_font_size_last_edited' => array( 'type' => 'skip' ),
			'menu_item_icon_font_size_tablet' => array( 'type' => 'skip' ),
			'menu_item_icon_font_size_phone' => array( 'type' => 'skip' ),
			'menu_item_text' => array(
				'label'           => esc_html__( 'Text', 'divimenus5' ),
				'type'            => 'text',
				'default'         => 'Item',
				'toggle_slug'     => 'main_content',
				'show_if'         => array( 'menu_item_type' => 'text_option' ),
			),
			'menu_item_font' => array(
				'label'           => esc_html__( 'Font', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'main_content',
			),
			'menu_item_font_size' => array( 'type' => 'skip' ),
			'menu_item_font_size_last_edited' => array( 'type' => 'skip' ),
			'menu_item_font_size_tablet' => array( 'type' => 'skip' ),
			'menu_item_font_size_phone' => array( 'type' => 'skip' ),
			'menu_item_text_color' => array(
				'label'           => esc_html__( 'Text Color', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'main_content',
			),
			'menu_item_image' => array(
				'label'           => esc_html__( 'Image', 'divimenus5' ),
				'type'            => 'upload',
				'image'           => true,
				'toggle_slug'     => 'main_content',
				'show_if'         => array( 'menu_item_type' => 'image_option' ),
			),
			'menu_item_image_alt' => array(
				'label'           => esc_html__( 'Image Alt Text', 'divimenus5' ),
				'type'            => 'text',
				'toggle_slug'     => 'main_content',
				'show_if'         => array( 'menu_item_type' => 'image_option' ),
			),
			'menu_item_image_size' => array( 'type' => 'skip' ),
			'menu_item_image_size_last_edited' => array( 'type' => 'skip' ),
			'menu_item_image_size_tablet' => array( 'type' => 'skip' ),
			'menu_item_image_size_phone' => array( 'type' => 'skip' ),
			'menu_item_image_height' => array( 'type' => 'skip' ),
			'menu_item_image_ratio' => array( 'type' => 'skip' ),
			'menu_item_url' => array(
				'label'           => esc_html__( 'URL', 'divimenus5' ),
				'type'            => 'text',
				'default'         => '#',
				'toggle_slug'     => 'link',
			),
			'menu_item_link_new_window' => array(
				'label'           => esc_html__( 'Open in New Window', 'divimenus5' ),
				'type'            => 'select',
				'options'         => DiviMenusHelper::get_yes_no_options(),
				'default'         => 'off',
				'toggle_slug'     => 'link',
			),
			'menu_item_title' => array(
				'label'           => esc_html__( 'Tooltip Title', 'divimenus5' ),
				'type'            => 'text',
				'toggle_slug'     => 'main_content',
			),
			'menu_item_use_circle' => array(
				'label'           => esc_html__( 'Use Circle Background', 'divimenus5' ),
				'type'            => 'select',
				'options'         => DiviMenusHelper::get_yes_no_options(),
				'default'         => 'off',
				'toggle_slug'     => 'main_content',
			),
			'menu_item_circle_color' => array(
				'label'           => esc_html__( 'Circle Background', 'divimenus5' ),
				'type'            => 'color',
				'default'         => '#2ea3f7',
				'toggle_slug'     => 'main_content',
				'show_if'         => array( 'menu_item_use_circle' => 'on' ),
			),
			'menu_item_use_circle_border' => array(
				'label'           => esc_html__( 'Use Circle Border', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'main_content',
			),
			'menu_item_circle_border_color' => array( 'type' => 'skip' ),
			'menu_item_circle_border_size' => array( 'type' => 'skip' ),
			'menu_item_fit_bg' => array(
				'label'           => esc_html__( 'Fit Background to Content', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'main_content',
			),
			'menu_item_padding' => array(
				'label'           => esc_html__( 'Padding', 'divimenus5' ),
				'type'            => 'skip',
				'toggle_slug'     => 'main_content',
			),
			'menu_item_padding_last_edited' => array( 'type' => 'skip' ),
			'menu_item_padding_tablet' => array( 'type' => 'skip' ),
			'menu_item_padding_phone' => array( 'type' => 'skip' ),
			'hide_desktop' => array(
				'label'           => esc_html__( 'Hide on Desktop', 'divimenus5' ),
				'type'            => 'select',
				'options'         => DiviMenusHelper::get_yes_no_options(),
				'default'         => 'off',
				'toggle_slug'     => 'visibility',
			),
			'hide_tablet' => array(
				'label'           => esc_html__( 'Hide on Tablet', 'divimenus5' ),
				'type'            => 'select',
				'options'         => DiviMenusHelper::get_yes_no_options(),
				'default'         => 'off',
				'toggle_slug'     => 'visibility',
			),
			'hide_phone' => array(
				'label'           => esc_html__( 'Hide on Phone', 'divimenus5' ),
				'type'            => 'select',
				'options'         => DiviMenusHelper::get_yes_no_options(),
				'default'         => 'off',
				'toggle_slug'     => 'visibility',
			),
			'title_disable' => array(
				'label'           => esc_html__( 'Disable Title Tooltip', 'divimenus5' ),
				'type'            => 'select',
				'options'         => DiviMenusHelper::get_yes_no_options(),
				'default'         => 'off',
				'toggle_slug'     => 'visibility',
			),
		);
	}

	public function get_advanced_fields_config() {
		return array(
			'fonts' => array(
				'menu_item_font' => array(
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
