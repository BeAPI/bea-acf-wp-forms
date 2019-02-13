<?php namespace BEA\ACF_WP_Forms;

class Requirements {

	use Singleton;

	/**
	 * All about requirements checks
	 *
	 * @return bool
	 */
	public function check_requirements() {
		if ( ! function_exists( 'acf' ) || ! function_exists( 'wpforms' ) ) {
			$this->display_error( __( 'Advanced Custom Fields and WPForms are required plugins.', 'bea-acf-wp-forms' ) );

			return false;
		}

		if ( '5' > acf()->version ) {
			$this->display_error( __( 'Advanced Custom Fields should be on version 5 or above.', 'bea-acf-wp-forms' ) );

			return false;
		};

		return true;
	}

	// Display message and handle errors
	public function display_error( $message ) {
		trigger_error( $message );

		add_action( 'admin_notices', function () use ( $message ) {
			printf( '<div class="notice error is-dismissible"><p>%s</p></div>', $message );
		} );

		// Deactive self
		add_action( 'admin_init', function () {
			deactivate_plugins( BEA_ACF_WP_FORMS_MAIN_FILE_DIR );
			unset( $_GET['activate'] );
		} );
	}
}
