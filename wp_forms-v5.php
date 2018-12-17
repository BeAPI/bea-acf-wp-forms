<?php

class acf_field_wp_forms extends acf_field {


	/*
	*  __construct
	*
	*  This function will setup the field type data
	*
	*  @type  function
	*  @date  5/03/2014
	*  @since 5.0.0
	*
	*  @param n/a
	*  @return  n/a
	*/

	function __construct() {
		// vars
		$this->name     = 'wp_forms_field';
		$this->label    = __( 'WPForms', 'wpforms' );
		$this->category = __( "Relational", 'acf' ); // Basic, Content, Choice, etc
		$this->defaults = array(
			'allow_null' => 0
		);

		if ( function_exists( 'wpforms' ) ) {
			$this->forms = wpforms()->form->get( '' );
		}

		// do not delete!
		parent::__construct();
	}

	/**
	 * Create extra settings for our wpforms field. These are visible when editing a field.
	 *
	 * @param $field
	 */
	public function render_field_settings( $field ) {
		// Render a field setting that will tell us if an empty field is allowed or not.
		acf_render_field_setting( $field, [
			'label'   => __( 'Allow Null?', 'acf' ),
			'type'    => 'radio',
			'name'    => 'allow_null',
			'choices' => [
				1 => __( 'Yes', 'acf' ),
				0 => __( 'No', 'acf' ),
			],
			'layout'  => 'horizontal'
		] );
	}

	/*
	*  render_field()
	*
	*  Create the HTML interface for your field
	*
	*  @param $field (array) the $field being rendered
	*
	*  @type  action
	*  @since 3.6
	*  @date  23/01/13
	*
	*  @param $field (array) the $field being edited
	*  @return  n/a
	*/

	function render_field( $field ) {

		if ( ! empty( $this->forms ) ) {
			echo '<select id="wpforms-modal-select-form" name="' . $field['name'] . '">';
			// Check if we're allowing an empty form. If so, create a default option
			if ( $field['allow_null'] ) {
				echo '<option value="">' . __( '- Select a form -', 'bea-wp-forms' ) . '</option>';
			}
			foreach ( $this->forms as $form ) {
				$selected = '';
				if ( ( is_array( $field['value'] ) && in_array( $form->ID, $field['value'], false ) )
				     || (int) $field['value'] === (int) $form->ID
				) {
					$selected = ' selected';
				}
				printf( '<option value="%d" %s>%s</option>', $form->ID, $selected, esc_html( $form->post_title ) );
			}
			echo '</select><br>';
		} else {
			echo '<p>';
			printf( __( 'Whoops, you haven\'t created a form yet. Want to <a href="%s">give it a go</a>?', 'wpforms' ), admin_url( 'admin.php?page=wpforms-builder' ) );
			echo '</p>';
		}
	}
}

// create field
new acf_field_wp_forms();
