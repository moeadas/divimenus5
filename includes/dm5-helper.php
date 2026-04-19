<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class DM5_Helper {

	public static function get_yes_no_options() {
		return array( 'on' => esc_html__( 'Yes', 'divimenus5' ), 'off' => esc_html__( 'No', 'divimenus5' ) );
	}

	public static function get_fonts() {
		return array(
			'Anonymous Pro'       => 'Anonymous Pro',
			'Cousine'            => 'Cousine',
			'Fira Mono'          => 'Fira Mono',
			'Inconsolata'        => 'Inconsolata',
			'Nanum Gothic Coding'=> 'Nanum Gothic Coding',
			'Nova Mono'          => 'Nova Mono',
			'Overpass Mono'      => 'Overpass Mono',
			'Oxygen Mono'        => 'Oxygen Mono',
			'PT Mono'            => 'PT Mono',
			'Roboto Mono'        => 'Roboto Mono',
			'Rubik Mono One'     => 'Rubik Mono One',
			'Share Tech Mono'    => 'Share Tech Mono',
			'Space Mono'         => 'Space Mono',
			'Source Code Pro'    => 'Source Code Pro',
			'Ubuntu Mono'        => 'Ubuntu Mono',
		);
	}

	public static function get_positions( $include_inherit = false ) {
		$p = array();
		if ( $include_inherit ) $p['inherit'] = esc_html__( 'Inherit', 'divimenus5' );
		$p['top']    = esc_html__( 'Top', 'divimenus5' );
		$p['bottom'] = esc_html__( 'Bottom', 'divimenus5' );
		$p['left']   = esc_html__( 'Left', 'divimenus5' );
		$p['right']  = esc_html__( 'Right', 'divimenus5' );
		return $p;
	}

	public static function get_effect_options() {
		return array(
			'none'       => esc_html__( '— None —', 'divimenus5' ),
			'fade'       => esc_html__( 'Fade', 'divimenus5' ),
			'slidedown'  => esc_html__( 'Slide Down', 'divimenus5' ),
			'slideup'    => esc_html__( 'Slide Up', 'divimenus5' ),
			'slideleft'  => esc_html__( 'Slide Left', 'divimenus5' ),
			'slideright' => esc_html__( 'Slide Right', 'divimenus5' ),
		);
	}

	public static function get_char_width( $font ) {
		$map = array(
			'Rubik Mono One' => 0.863, 'Overpass Mono' => 0.616, 'Space Mono' => 0.6125,
			'Fira Mono' => 0.6, 'PT Mono' => 0.6, 'Source Code Pro' => 0.6,
			'Nova Mono' => 0.56, 'Anonymous Pro' => 0.545, 'Share Tech Mono' => 0.54,
			'Inconsolata' => 0.5, 'Nanum Gothic Coding' => 0.5, 'Ubuntu Mono' => 0.5,
		);
		return isset( $map[ $font ] ) ? $map[ $font ] : 0.601;
	}

	public static function get_value( $val, $fallback = 0 ) {
		return ( '' !== $val && false !== $val ) ? $val : $fallback;
	}

	public static function get_image_height( $image, $image_width, $ratio ) {
		$postid = attachment_url_to_postid( $image );
		if ( $postid && $ratio !== 'square' ) {
			$img = wp_get_attachment_image_src( $postid, 'full' );
			if ( $img && $img[1] ) return ( $img[2] * $image_width ) / $img[1];
		} else {
			$size = @getimagesize( $image );
			if ( $size && $ratio !== 'square' && $size[0] ) return ( $size[1] * $image_width ) / $size[0];
		}
		return $image_width;
	}

	public static function set_style( $render_slug, $selector, $declaration, $device = 'd' ) {
		$args = array( 'selector' => $selector, 'declaration' => $declaration );
		if ( $device === 't' ) $args['media_query'] = ET_Builder_Element::get_media_query( '768_980' );
		if ( $device === 'p' ) $args['media_query'] = ET_Builder_Element::get_media_query( 'max_width_767' );
		ET_Builder_Element::set_style( $render_slug, $args );
	}

	public static function get_border_radii( $radii ) {
		$radii = str_replace( array( 'on|', 'off|' ), '', $radii );
		if ( $radii !== '' && strpos( $radii, '|' ) !== false ) {
			$v = explode( '|', $radii );
			return sprintf( '%1$s %2$s %3$s %4$s',
				$v[0] !== '' ? $v[0] : '50%',
				count( $v ) > 1 && $v[1] !== '' ? $v[1] : '50%',
				count( $v ) > 2 && $v[2] !== '' ? $v[2] : '50%',
				count( $v ) > 3 && $v[3] !== '' ? $v[3] : '50%' );
		}
		return '50%';
	}

	public static function get_alignment( $axis, $main, $cross, $dir, $reverse ) {
		if ( ( $axis === 'justify' && $dir !== 'column' ) || ( $axis === 'align' && $dir === 'column' ) ) {
			switch ( $main ) {
				case 'left': case 'top': case 'force_left': return $dir === 'column' ? 'flex-start' : ( $reverse ? 'flex-end' : 'flex-start' );
				case 'justified': return $dir === 'column' ? 'center' : 'space-between';
				case 'bottom': case 'right': return $dir === 'column' ? 'flex-end' : ( $reverse ? 'flex-start' : 'flex-end' );
				default: return 'center';
			}
		}
		if ( $axis === 'align' && $dir !== 'column' ) return $cross;
		return 'center';
	}

	public static function get_flex_dir( $direction, $placement ) {
		if ( $placement === 'first' || $placement === 'left' ) return $direction;
		if ( $placement === 'top' ) return 'column';
		if ( $placement !== 'bottom' && $direction !== 'column' ) return 'row-reverse';
		return 'column-reverse';
	}

	public static function get_menu_item_content_size( $type, $text_size, $icon_size, $image_width, $image_height ) {
		$w = $h = 0;
		if ( $type === 'icon_option' ) { $w = $h = is_numeric( rtrim( $icon_size, 'px' ) ) ? rtrim( $icon_size, 'px' ) : 33; }
		elseif ( $type === 'text_option' ) { $w = $h = is_numeric( rtrim( $text_size, 'px' ) ) ? rtrim( $text_size, 'px' ) : 15; }
		elseif ( $type === 'image_option' ) { $w = is_numeric( rtrim( $image_width, 'px' ) ) ? rtrim( $image_width, 'px' ) : 57; $h = is_numeric( rtrim( $image_height, 'px' ) ) ? rtrim( $image_height, 'px' ) : 57; }
		return array( 'width' => $w, 'height' => $h );
	}

	public static function get_menu_item_padding( $props, $text, $font, $content_size, $padding, $menu_type, $fit_bg, $use_custom ) {
		$lr = $tb = $padding;
		$is_text = $props['menu_item_select'] === 'text_option';
		$should_fit = $menu_type !== 'circular' && ( ( $fit_bg === 'on' && $use_custom !== 'on' ) || ( $props['item_fit_bg'] === 'on' && $use_custom === 'on' ) );
		if ( $is_text ) {
			$lr = ceil( $content_size['width'] * self::get_char_width( $font ) * strlen( utf8_decode( $text ) ) ) + ( $padding * 2 );
			$tb = $should_fit ? $content_size['width'] + ( $padding * 2 ) : $lr;
		}
		return array( 'LR' => $lr, 'TB' => $tb );
	}

	public static function get_menu_item_size( $type, $content_size, $padding, $custom, $use_border, $border_size = '2px' ) {
		$border = $use_border ? intval( $border_size ) : 0;
		$w = $content_size['width'] + ( $padding['LR'] * 2 ) + ( $border * 2 );
		$h = $content_size['height'] + ( $padding['TB'] * 2 ) + ( $border * 2 );
		return array( 'width' => $w, 'height' => $h );
	}

	public static function get_menu_button_content_size( $type, $device, $props ) {
		$w = $h = 0;
		if ( $type === 'central_item_image_option' ) {
			$vals = et_pb_responsive_options()->get_property_values( $props, 'central_item_image_size', $props['central_item_image_size'], true );
			switch ( $device ) {
				case 'tablet': $w = self::get_value( $vals['tablet'] ); $h = self::get_value( $props['central_item_image_height_t'], $w ); break;
				case 'phone': $w = self::get_value( $vals['phone'] ); $h = self::get_value( $props['central_item_image_height_p'], $w ); break;
				default: $w = self::get_value( $vals['desktop'] ); $h = self::get_value( $props['central_item_image_height'], $w );
			}
		} else {
			$field = $type === 'central_item_icon_option' ? 'central_item_icon_font_size' : 'central_item_font_size';
			$vals = et_pb_responsive_options()->get_property_values( $props, $field, $props[ $field ], true );
			switch ( $device ) {
				case 'tablet': $w = $h = self::get_value( $vals['tablet'] ); break;
				case 'phone': $w = $h = self::get_value( $vals['phone'] ); break;
				default: $w = $h = self::get_value( $vals['desktop'] );
			}
		}
		return array( 'width' => $w, 'height' => $h );
	}

	public static function get_menu_button_padding( $props, $text, $font, $content_size, $padding ) {
		$tb = $lr = 0;
		if ( 'on' === $props['central_item_use_circle'] ) {
			$lr = $tb = $padding;
			if ( $props['central_item_select'] === 'central_item_text_option' ) {
				$lr = ceil( $content_size['width'] * strlen( utf8_decode( $text ) ) * self::get_char_width( $font ) ) + ( $padding * 2 );
				$tb = $props['central_item_fit_bg'] === 'on' ? $content_size['width'] + ( $padding * 2 ) : $lr;
				if ( strlen( utf8_decode( $text ) ) === 1 ) $lr = $tb = ceil( $content_size['width'] ) + ( $padding * 2 );
			}
		} elseif ( $props['central_item_select'] === 'central_item_text_option' ) {
			$lr = $content_size['width'] * strlen( utf8_decode( $text ) ) * self::get_char_width( $font );
			$tb = $content_size['height'];
		}
		return array( 'TB' => $tb, 'LR' => $lr );
	}

	public static function get_menu_button_size( $props, $content_size, $padding, $border_size ) {
		$w = (int) $content_size['width'] + ( 'on' === $props['central_item_use_circle'] ? ( (int) $padding['LR'] * 2 ) : 0 );
		$h = (int) $content_size['height'] + ( 'on' === $props['central_item_use_circle'] ? ( (int) $padding['TB'] * 2 ) : 0 );
		if ( $props['central_item_select'] === 'central_item_text_option' ) { $w = (int) $padding['LR']; $h = (int) $padding['TB']; }
		if ( 'on' === $props['central_item_use_circle'] && 'on' === $props['central_item_use_circle_border'] ) {
			$b = is_numeric( rtrim( $border_size, 'px' ) ) ? rtrim( $border_size, 'px' ) * 2 : 4;
			$w += $b; $h += $b;
		}
		return array( 'width' => $w, 'height' => $h, 'circular' => max( $w, $h ) );
	}

	public static function get_image_alt( $props, $image_field, $alt_field ) {
		$alt = isset( $props[ $alt_field ] ) ? $props[ $alt_field ] : '';
		if ( empty( $alt ) && ! empty( $props[ $image_field ] ) ) {
			$id = attachment_url_to_postid( esc_url( $props[ $image_field ] ) );
			$alt = get_post_meta( $id, '_wp_attachment_image_alt', true );
		}
		return $alt;
	}

	public static function get_items_array( $items ) {
		return array(
			'desktop' => array_values( array_filter( $items, function( $i ) { return ! $i['hide_desktop']; } ) ),
			'tablet'  => array_values( array_filter( $items, function( $i ) { return ! $i['hide_tablet']; } ) ),
			'phone'   => array_values( array_filter( $items, function( $i ) { return ! $i['hide_phone']; } ) ),
		);
	}

	public static function get_items_count( $items ) {
		return array( 'desktop' => count( $items['desktop'] ), 'tablet' => count( $items['tablet'] ), 'phone' => count( $items['phone'] ) );
	}

	public static function get_largest_item_size( $items, $device ) {
		$w = $h = 0;
		foreach ( $items as $item ) {
			$s = $device === 'desktop' ? $item['size'] : ( $device === 'tablet' ? $item['size_t'] : $item['size_p'] );
			if ( $s['width'] > $w ) $w = $s['width'];
			if ( $s['height'] > $h ) $h = $s['height'];
		}
		return array( 'width' => $w, 'height' => $h );
	}

	public static function get_largest_padding( $items, $device ) {
		$lr = $tb = 0;
		foreach ( $items as $item ) {
			$hide = $device === 'desktop' ? $item['hide_desktop'] : ( $device === 'tablet' ? $item['hide_tablet'] : $item['hide_phone'] );
			if ( $hide ) continue;
			$p = $device === 'desktop' ? $item['padding'] : ( $device === 'tablet' ? $item['padding_t'] : $item['padding_p'] );
			if ( $p['LR'] > $lr ) $lr = $p['LR'];
			if ( $p['TB'] > $tb ) $tb = $p['TB'];
		}
		return array( 'TB' => $tb, 'LR' => $lr );
	}

	public static function get_largest_menu_size( $mb, $item ) {
		return array( 'width' => max( $mb['width'], $item['width'] ), 'height' => max( $mb['height'], $item['height'] ) );
	}

	public static function has_background( $props ) {
		return ( ! empty( $props['background_color'] ) && $props['background_color'] !== '#ffffff' ) ||
		       ! empty( $props['use_background_color_gradient'] ) && $props['use_background_color_gradient'] === 'on' ||
		       ! empty( $props['background_image'] );
	}

	public static function get_background_padding( $props, $itemsc ) {
		$vals = et_pb_responsive_options()->get_property_values( $props, 'background_padding', $props['background_padding'], true );
		return array(
			'desktop' => self::has_background( $props ) && ! empty( $itemsc['desktop'] ) ? self::get_value( $vals['desktop'] ) : 0,
			'tablet'  => self::has_background( $props ) && ! empty( $itemsc['tablet'] ) ? self::get_value( $vals['tablet'] ) : 0,
			'phone'   => self::has_background( $props ) && ! empty( $itemsc['phone'] ) ? self::get_value( $vals['phone'] ) : 0,
		);
	}

	public static function render_icon( $icon_raw ) {
		if ( empty( $icon_raw ) ) return '';
		if ( function_exists( 'et_pb_extended_process_font_icon' ) ) {
			$icon = et_pb_extended_process_font_icon( $icon_raw );
		} else {
			$icon = html_entity_decode( et_pb_process_font_icon( $icon_raw ) );
		}
		return $icon;
	}

	public static function set_values( &$props ) {
		$r = et_pb_get_responsive_status( $props['central_item_image_size_last_edited'] ?? '' );
		$props['central_item_image_size'] = self::get_value( $props['central_item_image_size'] ?? '', 57 );
		$props['central_item_image_size_tablet'] = self::get_value( $r ? ( $props['central_item_image_size_tablet'] ?? '' ) : $props['central_item_image_size'], $props['central_item_image_size'] );
		$props['central_item_image_size_phone'] = self::get_value( $r ? ( $props['central_item_image_size_phone'] ?? '' ) : $props['central_item_image_size'], $props['central_item_image_size_tablet'] );
		$props['central_item_image_height'] = self::get_image_height( $props['central_item_image'] ?? '', $props['central_item_image_size'], $props['central_item_image_ratio'] ?? 'square' );
		$props['central_item_image_height_t'] = self::get_image_height( $props['central_item_image'] ?? '', $props['central_item_image_size_tablet'], $props['central_item_image_ratio'] ?? 'square' );
		$props['central_item_image_height_p'] = self::get_image_height( $props['central_item_image'] ?? '', $props['central_item_image_size_phone'], $props['central_item_image_ratio'] ?? 'square' );
	}

	public static function get_circle_position( $degrees, $count, $index ) {
		$angle = deg2rad( ( $degrees / $count ) * $index );
		return array( 'cos' => cos( $angle ), 'sin' => sin( $angle ) );
	}

	public static function woocommerce_cart_fragment( $fragments ) {
		if ( ! function_exists( 'WC' ) ) return $fragments;
		$fragments['.dm5-cart-count'] = sprintf( '<span class="dm5-cart-info dm5-cart-count">%d</span>', WC()->cart->get_cart_contents_count() );
		return $fragments;
	}
}