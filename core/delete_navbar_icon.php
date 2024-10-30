<?php

add_action( 'admin_bar_menu', 'mlchanger_remove_wp_logo', 999 );

function mlchanger_remove_wp_logo( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'wp-logo' );
}