<?php declare(strict_types=1);

namespace CustomizerFramework\Field;

defined( 'ABSPATH' ) || exit;

use CustomizerFramework\Control\Checkbox_Multiple_Control;
use CustomizerFramework\Field\Settings;

/**
 * Field Checkbox Multiple.
 *
 * @since   1.0.0
 * @version 1.0.0
 */
final class Field_Checkbox_Multiple extends Settings
{
	/**
	 * Rendering Checkbox Multiple.
	 *
	 * @since 1.0.0
	 *
	 * @param object  $wp_customize  Object from WP_Customize_Manager.
	 * @param array   $config 		 List of configuration.
	 */
	public function render( $wp_customize, $config ) {
		$rules = array(
			'label'			=> array(
				'rule'		=> 'empty',
				'default'	=> 'Checkbox Multiple Field',
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
				'type'		=> 'array'
			),
			'choices'		=> array(
				'rule'		=> 'required',
				'default'	=> '',
				'type'		=> 'array'
			),
			'active_callback' => array(
				'rule'		=> 'empty',
				'default'	=> '',
				'type'		=> 'any'
			)
		);

		$field_name =  \CustomizerFramework\error_field_name( 'checkbox-multiple', $config['id'] );
		$args = \CustomizerFramework\sanitize_argument( $field_name, $config, $rules );
		$is_valid_default = \CustomizerFramework\is_valid_argument_value([
			'value'		=> $args['default'],
			'valid'		=> $args['choices'],
			'field'		=> $field_name,
			'allowed'	=> \CustomizerFramework\get_keys_imploded( $args['choices'] ),
			'type'		=> 'key',
			'argument'	=> 'default'
		]);

		if ( is_array( $args ) && parent::sanitize_argument( $config, $field_name ) != false && $is_valid_default == true ) {
			$this->init_settings( $wp_customize, $config, $field_name );
			$wp_customize->add_control( new Checkbox_Multiple_Control( $wp_customize, $args['id'] . '_field', array(
				'label'			=> esc_html( $args['label'] ),
				'description'	=> esc_html( $args['description'] ),
				'section'		=> $args['section'],
				'settings'		=> $args['id'],
				'priority'		=> $args['priority'],
				'default'		=> $args['default'],
				'choices'		=> $args['choices'],
				'active_callback' => $args['active_callback']
			)));
		}
	}
}
