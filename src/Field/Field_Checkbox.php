<?php declare(strict_types=1);

namespace CustomizerFramework\Field;

defined( 'ABSPATH' ) || exit;

use CustomizerFramework\Field\Settings;

/**
 * Field Checkbox.
 *
 * @since   1.0.0
 * @version 1.0.0
 */
final class Field_Checkbox extends Settings
{
	/**
	 * Rendering Checkbox Field
	 *
	 * @access public
	 * @since 1.0.0
	 * @param object 	$wp_customize 	object from WP_Customize_Manager
	 * @param string 	$id 			slug or index id
	 * @param array  	$config 		list of configuration
	 *
	 */
	public function render( $wp_customize, $config ) {
		$rules = array(
			'label'			=> array(
				'rule'		=> 'empty',
				'default'	=> 'Checkbox Field',
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
				'type'		=> 'boolean'
			),
			'active_callback' => array(
				'rule'		=> 'empty',
				'default'	=> '',
				'type'		=> 'any'
			)
		);

		$field_name =  \CustomizerFramework\error_field_name( 'checkbox', $config['id'] );
		$args = \CustomizerFramework\sanitize_argument( $field_name, $config, $rules );
		if ( is_array( $args ) && parent::sanitize_argument( $config, $field_name ) != false ) {
			$this->init_settings( $wp_customize, $config, $field_name );
			$wp_customize->add_control( $args['id'] . '_field', array(
				'type'			=> 'checkbox',
				'label'			=> esc_html( $args['label'] ),
				'description'	=> esc_html( $args['description'] ),
				'section'		=> $args['section'],
				'settings'		=> $args['id'],
				'default' 		=> $args['default'],
				'priority'		=> $args['priority'],
				'active_callback' => $args['active_callback']
			));
		}
	}
}
