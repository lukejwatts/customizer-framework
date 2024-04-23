<?php declare(strict_types=1);

namespace CustomizerFramework\Field;

defined( 'ABSPATH' ) || exit;

use CustomizerFramework\Control\Time_Picker_Control;
use CustomizerFramework\Field\Settings;

/**
 * Field Time Picker.
 *
 * @since   1.0.0
 * @version 1.0.0
 */
final class Field_Time_Picker extends Settings
{
	/**
	 * Validating the default value if its a valid time format.
	 *
	 * @since 1.0.0
	 *
	 * @param  string  $default  Time default.
	 * @param  string  $field    Complete field name.
	 * @return boolean
	 */
	private function is_valid_default( $default, $field )
    {
		if ( ! empty( $default ) ) {
			if ( \CustomizerFramework\is_valid_date( $default, 'H:i' ) == false ) {
				\CustomizerFramework\alert_warning( 'Error 310: default time value '. \CustomizerFramework\code( 'error', $default ) .' is invalid time format in field '. \CustomizerFramework\code( 'info', $field ) .', here is the valid format '. \CustomizerFramework\code( 'success', 'H:i' ) .' EXAMPLE: 01:20.' );

				return false;
			}
		}

		return true;
	}

	/**
	 * Rendering Time Picker.
	 *
	 * @since 1.0.0
	 *
	 * @param object  $wp_customize  Object from WP_Customize_Manager.
	 * @param array   $config 		 List of configuration.
	 */
	public function render( $wp_customize, $config )
    {
		$rules = array(
			'label'			=> array(
				'rule'		=> 'empty',
				'default'	=> 'Time Picker Field',
				'type'		=> 'string'
			),
			'description'	=> array(
				'rule'		=> 'empty',
				'default'	=> '',
				'type'		=> 'string'
			),
			'section'		=> array(
				'rule'		=> 'required',
				'default'	=> '',
				'type'		=> 'string'
			),
			'priority'		=> array(
				'rule'		=> 'empty',
				'default'	=> '',
				'type'		=> 'number'
			),
			'default'		=> array(
				'rule'		=> 'empty',
				'default'	=> '',
				'type'		=> 'string'
			),
			'placeholder'	=> array(
				'rule'		=> 'empty',
				'default'	=> '',
				'type'		=> 'string'
			),
			'military_format'	=> array(
				'rule'		=> 'empty',
				'default'	=> '',
				'type'		=> 'boolean'
			),
			'active_callback' => array(
				'rule'		=> 'empty',
				'default'	=> '',
				'type'		=> 'any'
			)
		);

		$field_name =  \CustomizerFramework\error_field_name( 'time-picker', $config['id'] );
		$args = \CustomizerFramework\sanitize_argument( $field_name, $config, $rules );
		$is_valid_default = $this->is_valid_default( $args['default'], $field_name );

		if ( is_array( $args ) && parent::sanitize_argument( $config, $field_name ) != false && $is_valid_default == true ) {
			$this->init_settings( $wp_customize, $config, $field_name );
			$wp_customize->add_control( new Time_Picker_Control( $wp_customize, $args['id'] . '_field', array(
				'label'			=> esc_html( $args['label'] ),
				'description'	=> esc_html( $args['description'] ),
				'section'		=> $args['section'],
				'settings'		=> $args['id'],
				'priority'		=> $args['priority'],
				'default'		=> $args['default'],
				'placeholder'	=> $args['placeholder'],
				'military_format'	=> $args['military_format'],
				'active_callback' => $args['active_callback']
			)));
		}
	}
}
