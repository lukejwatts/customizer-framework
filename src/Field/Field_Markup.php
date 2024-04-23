<?php declare(strict_types=1);

namespace CustomizerFramework\Field;

defined( 'ABSPATH' ) || exit;

use CustomizerFramework\Control\Markup_Control;
use CustomizerFramework\Field\Settings;

/**
 * Field Markup.
 *
 * @since   1.0.0
 * @version 1.0.0
 */
final class Field_Markup extends Settings
{
	/**
	 * Rendering Markup.
	 *
	 * @since 1.0.0
	 *
	 * @param object  $wp_customize  Object from WP_Customize_Manager.
	 * @param array   $config 		 List of configuration.
	 */
	public function render( $wp_customize, $config ) {
		$rules = array(
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
			'html'			=> array(
				'rule'		=> 'required',
				'default'	=> '',
				'type'		=> 'string'
			),
			'active_callback' => array(
				'rule'		=> 'empty',
				'default'	=> '',
				'type'		=> 'any'
			)
		);

		$field_name =  \CustomizerFramework\error_field_name( 'markup', $config['id'] );
		$args = \CustomizerFramework\sanitize_argument( $field_name, $config, $rules );

		if ( is_array( $args ) && parent::sanitize_argument( $config, $field_name ) != false  ) {
			$this->init_settings( $wp_customize, $config, $field_name );
			$wp_customize->add_control( new Markup_Control( $wp_customize, $args['id'] . '_field', array(
				'section'		=> $args['section'],
				'settings'		=> $args['id'],
				'priority'		=> $args['priority'],
				'html'			=> $args['html'],
				'active_callback' => $args['active_callback']
			)));
		}
	}
}
