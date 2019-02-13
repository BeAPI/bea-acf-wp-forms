<?php
/*
 Plugin Name: Advanced Custom Fields: WP Forms Field
 Version: 1.1.0
 Plugin URI: https://github.com/BeAPI/bea-acf-wp-forms
 Description: ACF field to select one or many WP Forms.
 Author: Be API Technical team
 Author URI: https://beapi.fr
 Contributors: Maxime Culea, Léonard Phoumpakka
 ----
 Copyright 2018 Be API Technical team (human@beapi.fr)
 This program is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.
 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.
 You should have received a copy of the GNU General Public License
 along with this program; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// Plugin constants
define( 'BEA_ACF_WP_FORMS_VER_VERSION', '1.1.0' );
define( 'BEA_ACF_WP_FORMS_VER_MIN_PHP_VERSION', '5.6' );

// Plugin URL and PATH
define( 'BEA_ACF_WP_FORMS_URL', plugin_dir_url( __FILE__ ) );
define( 'BEA_ACF_WP_FORMS_DIR', plugin_dir_path( __FILE__ ) );
define( 'BEA_ACF_WP_FORMS_MAIN_FILE_DIR', __FILE__ );
define( 'BEA_ACF_WP_FORMS_PLUGIN_DIRNAME', basename( rtrim( dirname( __FILE__ ), '/' ) ) );

// Check PHP min version
if ( version_compare( PHP_VERSION, BEA_ACF_WP_FORMS_VER_MIN_PHP_VERSION, '<' ) ) {
	require_once( BEA_ACF_WP_FORMS_DIR . 'compat.php' );
	// possibly display a notice, trigger error
	add_action( 'admin_init', array( 'Compatibility', 'admin_init' ) );
	// stop execution of this file
	return;
}

/** Autoload all the things \o/ */
require_once BEA_ACF_WP_FORMS_DIR . 'autoload.php';

add_action( 'plugins_loaded', 'bea_acf_wp_forms_load', 100 );
function bea_acf_wp_forms_load() {
	$requirements = \BEA\ACF_WP_Forms\Requirements::get_instance();
	if ( ! $requirements->check_requirements() ) {
		return;
	}

	\BEA\ACF_WP_Forms\Main::get_instance();
}
