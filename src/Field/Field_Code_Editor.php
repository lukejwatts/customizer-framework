<?php declare(strict_types=1);

namespace CustomizerFramework\Field;

defined( 'ABSPATH' ) || exit;

use CustomizerFramework\Control\Code_Editor_Control;
use CustomizerFramework\Field\Settings;
use WP_Customize_Manager;

/**
 * Field Code Editor.
 *
 * @since   1.0.0
 * @version 1.0.0
 */
final class Field_Code_Editor extends Settings
{
	/**
	 * Rendering Code Editor.
	 *
	 * @since 1.0.0
	 *
	 * @param object  $wp_customize  Object from WP_Customize_Manager.
	 * @param array   $config 		 List of configuration.
	 */
	public function render( \WP_Customize_Manager $wp_customize, array $config ) {
		$rules = array(
			'label'			=> array(
				'rule'		=> 'empty',
				'default'	=> 'Code Editor Field',
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
			'language'	=> array(
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

		$field_name =  \CustomizerFramework\error_field_name( 'code-editor', $config['id'] );
		$args = \CustomizerFramework\sanitize_argument( $field_name, $config, $rules );
		$is_valid_language = \CustomizerFramework\is_valid_argument_value([
            'value'		=> $args['language'],
			'valid'		=> [ 'html', 'css', 'javascript', 'php' ],
			'field'		=> $field_name,
			'allowed'	=> 'html, css, javascript, php',
			'argument'	=> 'language'
		]);

		if ( is_array( $args ) && parent::sanitize_argument( $config, $field_name ) && $is_valid_language) {
            $this->init_settings($wp_customize, $config, $field_name);
			$wp_customize->add_control(new Code_Editor_Control($wp_customize, $args['id'] . '_field', array(
				'label'			=> esc_html( $args['label'] ),
				'description'	=> esc_html( $args['description'] ),
				'section'		=> $args['section'],
				'settings'		=> $args['id'],
				'priority'		=> $args['priority'],
				'default'		=> $args['default'],
				'language'		=> $args['language'],
				'active_callback' => $args['active_callback']
			)));
		}
	}
}
