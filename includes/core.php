<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function dm5_admin_init() {
	if ( ! term_exists( 'DiviMenus5', 'layout_category' ) )
		wp_insert_term( 'DiviMenus5', 'layout_category' );
}
add_action( 'admin_init', 'dm5_admin_init' );