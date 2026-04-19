<?php
/**
 * Plugin Name:  DiviMenus5
 * Plugin URI:   https://divimenus5.example.com
 * Description:  A powerful circular/horizontal/vertical menu builder for Divi 5 with flyouts, popups, and Visual Builder support. No license required.
 * Version:      1.0.0
 * Author:       DiviMenus5
 * License:      GPL2
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 * Requires at least: 6.0
 * Requires PHP: 7.4
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'DM5_VERSION', '1.0.0' );
define( 'DM5_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'DM5_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'DM5_PLUGIN_PATH', __FILE__ );
define( 'DM5_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'DM5_PLACEHOLDER_IMAGE_DATA', 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iODAwIiBoZWlnaHQ9IjYwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZWRlZWRlIi8+PHJlY3QgeD0iMSUiIHk9IjElIiB3aWR0aD0iMzAlIiBoZWlnaHQ9IjQwJSIgZmlsbD0iI2RkZCIvPjxyZWN0IHg9IjQxJSIgeT0iNSUiIHdpZHRoPSIyNSUiIGhlaWdodD0iMzUlIiBmaWxsPSIjYmRiZGJkIi8+PHJlY3QgeD0iNjglIiB5PSIyNSUiIHdpZHRoPSIyNSUiIGhlaWdodD0iMjUlIiBmaWxsPSIjYmRiZGJkIi8+PC9zdmc+' );

/**
 * Load helper + core early (no Divi dependency).
 */
require_once DM5_PLUGIN_DIR_PATH . 'includes/dm5-helper.php';
require_once DM5_PLUGIN_DIR_PATH . 'includes/core.php';

/**
 * Initialize extension when Divi is ready.
 * Priority 8 = before DiviExtension's default priority 9 in _initialize().
 * This ensures modules are registered before the DiviExtension finishes init.
 */
add_action( 'et_builder_ready', 'dm5_initialize_extension', 8 );

function dm5_initialize_extension() {
	if ( ! class_exists( 'DiviExtension' ) ) return;
	require_once DM5_PLUGIN_DIR_PATH . 'includes/dm5-extension.php';
}

/**
 * Fallback at divi_extensions_init (Divi 4 compatibility path).
 */
add_action( 'divi_extensions_init', 'dm5_initialize_extension', 9 );
