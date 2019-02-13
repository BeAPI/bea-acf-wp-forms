<?php namespace BEA\ACF_WP_Forms;

class Main {
	/**
	 * Use the trait
	 */
	use Singleton;

	protected function init() {
		// Plugin's own translations
		add_action( 'init', [ $this, 'init_translations' ] );

		// Register ACF fields
		add_action( 'acf/include_field_types', [ $this, 'register_field_v5' ] );
	}

	/**
	 * Load the plugin translation
	 */
	public function init_translations() {
		// Load translations
		load_plugin_textdomain( 'bea-acf-wp-forms', false, BEA_ACF_WP_FORMS_PLUGIN_DIRNAME . '/languages' );
	}

	/**
	 * Register WP Forms for ACF v5
	 */
	public function register_field_v5() {
		new Field();
	}
}
