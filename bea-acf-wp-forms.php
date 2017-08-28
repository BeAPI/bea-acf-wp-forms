<?php
/*
Plugin Name: Advanced Custom Fields: WP Forms Field
Description: ACF field to select one or many WP Forms
Version: 1.0.0
Author: beapi
Author URI: http://www.beapi.fr
License: MIT
License URI: http://opensource.org/licenses/MIT
*/


function include_field_types_wp_forms( $version ) {
	include_once( 'wp_forms-v5.php' );
}

add_action( 'acf/include_field_types', 'include_field_types_wp_forms' );

//Added to check if WP Forms is installed on activation.
function wpf_activate() {
	if ( class_exists( 'WPForms' ) ) {
		return true;
	} else {
		$html = '<div class="error">';
		$html .= '<p>';
		$html .= _e( 'Warning: WP Forms is not installed or activated. This plugin does not function without WP Forms!' );
		$html .= '</p>';
		$html .= '</div>';
		echo $html;
	}
}

register_activation_hook( __FILE__, 'wpf_activate' );