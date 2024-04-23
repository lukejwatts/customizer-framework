<?php declare(strict_types=1);

namespace CustomizerFramework\Field;

defined( 'ABSPATH' ) || exit;

use CustomizerFramework\Control\Url_Control;
use CustomizerFramework\Field\Settings;

/**
 * Field Url.
 *
 * @since   1.0.0
 * @version 1.0.0
 */
final class Field_Url extends Settings
{
	/**
	 * Validate the default value if its a valid url.
	 *
	 * @since 1.0.0
	 *
	 * @param  string  $default  Default url.
	 * @param  string  $field 	 Complete name of field.
	 * @return boolean
	 */
	private function is_valid_default( $default, $field )
    {
		if ( ! empty( $default ) ) {
			if ( filter_var( $default, FILTER_VALIDATE_URL ) == false ) {
				\CustomizerFramework\alert_warning( 'Error 314: invalid URL in '. \CustomizerFramework\code( 'error', 'default' ) .' at field '. \CustomizerFramework\code( 'success', $field ) .'.');
				return false;
			}
		}

		return true;
	}

	/**
	 * Rendering URL.
	 *
	 * @since 1.0.0
	 *
	 * @param object  $wp_customize  Object from WP_Customize_Manager.
	 * @param array   $config 		 List of configuration.
	 */
	public function render($wp_customize, $config)
    {
		$rules = array(
			'label'			=> array(
				'rule'		=> 'empty',
				'default'	=> 'URL Field',
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
			'active_callback' => array(
				'rule'		=> 'empty',
				'default'	=> '',
				'type'		=> 'any'
			)
		);

		$field_name =  \CustomizerFramework\error_field_name( 'url', $config['id'] );
		$args = \CustomizerFramework\sanitize_argument( $field_name, $config, $rules );
		if ( empty( $config['default'] ) ) {
			$config['default'] = '';
		}

		$is_valid_default = $this->is_valid_default( $config['default'], $field_name );
		if ( is_array( $args ) && parent::sanitize_argument( $config, $field_name ) != false && $is_valid_default == true ) {
			$new_config = \CustomizerFramework\push_default_validation( $config, [ 'valid_url' ] );
			$this->init_settings( $wp_customize, $new_config, $field_name );
			$wp_customize->add_control( new Url_Control( $wp_customize, $args['id'] . '_field', array(
				'label'			=> esc_html( $args['label'] ),
				'description'	=> esc_html( $args['description'] ),
				'section'		=> $args['section'],
				'settings'		=> $args['id'],
				'priority'		=> $args['priority'],
				'placeholder'	=> $args['placeholder'],
				'active_callback' => $args['active_callback']
			)));
		}
	}
}
