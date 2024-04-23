<?php declare(strict_types=1);

namespace CustomizerFramework\Field;

defined( 'ABSPATH' ) || exit;

use CustomizerFramework\Control\Toggle_Control;
use CustomizerFramework\Field\Settings;

/**
 * Field Toggle.
 *
 * @since   1.0.0
 * @version 1.0.0
 */
final class Field_Toggle extends Settings
{
	/**
	 * Rendering Toggle.
	 *
	 * @since 1.0.0
	 *
	 * @param object  $wp_customize  Object from WP_Customize_Manager.
	 * @param array   $config 		 List of configuration.
	 */
	public function render($wp_customize, $config)
    {
		$rules = [
            'label'			=> [
                'rule'		=> 'empty',
				'default'	=> 'Toggle Field',
				'type'		=> 'string'
            ],
			'description'	=> [
                'rule'		=> 'empty',
				'default'	=> '',
				'type'		=> 'string'
            ],
			'section'		=> [
                'rule'		=> 'required',
				'default'	=> '',
				'type'		=> 'string'
            ],
			'priority'		=> [
                'rule'		=> 'empty',
				'default'	=> '',
				'type'		=> 'number'
            ],
			'default'		=> [
                'rule'		=> 'empty',
				'default'	=> '',
				'type'		=> 'boolean'
            ],
			'active_callback' => [
                'rule'		=> 'empty',
				'default'	=> '',
				'type'		=> 'any'
            ]
        ];

		$field_name =  \CustomizerFramework\error_field_name('toggle', $config['id']);
		$args = \CustomizerFramework\sanitize_argument($field_name, $config, $rules);

		if (is_array($args) && parent::sanitize_argument($config, $field_name) != false) {
			$this->init_settings($wp_customize, $config, $field_name);
			$wp_customize->add_control(new Toggle_Control($wp_customize, $args['id'] . '_field', array(
				'label'			=> esc_html( $args['label'] ),
				'description'	=> esc_html( $args['description'] ),
				'section'		=> $args['section'],
				'settings'		=> $args['id'],
				'priority'		=> $args['priority'],
				'default'		=> $args['default'],
				'active_callback' => $args['active_callback']
			)));
		}
	}
}
