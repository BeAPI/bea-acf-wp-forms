<?php namespace BEA\ACF_WP_Forms;

class Helpers {

	public static function render( $contact_form ) {
		if ( ! empty( $contact_form ) ) {
			echo do_shortcode( sprintf( '[wpforms id="%d"]', $contact_form ) );
		}
	}
}
