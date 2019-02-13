<?php namespace BEA\ACF_WP_Forms;

class Helpers {
	/**
	 * Display the form on front page.
	 *
	 * @param $contact_form_id
	 */
	public static function render( $contact_form_id ) {
		if ( ! empty( $contact_form_id ) ) {
			echo do_shortcode( sprintf( '[wpforms id="%d"]', $contact_form_id ) );
		}
	}
}
