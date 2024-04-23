<?php declare(strict_types=1);

namespace CustomizerFramework\Field;

defined( 'ABSPATH' ) || exit;

use CustomizerFramework\Control\Video_Uploader_Control;
use CustomizerFramework\Field\Settings;

/**
 * Field Video Uploader.
 *
 * @since   1.0.0
 * @version 1.0.0
 */
final class Field_Video_Uploader extends Settings
{
	/**
	 * Rendering Video Uploader.
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
				'default'	=> 'Video Field',
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
			'placeholder'	=> array(
				'rule'		=> 'empty',
				'default'	=> '',
				'type'		=> 'string'
			),
			'default'		=> array(
				'rule'		=> 'empty',
				'default'	=> '',
				'type'		=> 'number'
			),
			'extensions'	=> array(
				'rule'		=> 'empty',
				'default'	=> '',
				'type'		=> 'array'
			),
			'active_callback' => array(
				'rule'		=> 'empty',
				'default'	=> '',
				'type'		=> 'any'
			)
		);

		$field_name =  \CustomizerFramework\error_field_name( 'video-uploader', $config['id'] );
		$args = \CustomizerFramework\sanitize_argument( $field_name, $config, $rules );
		$is_valid_extensions = \CustomizerFramework\is_valid_argument_value([
			'value'		=> $args['extensions'],
			'valid'		=> [ 'mp4', 'm4v',  'mov', 'wmv', 'avi', 'mpg', 'ogv', '3gp', '3g2', 'webm', 'mkv' ],
			'field'		=> $field_name,
			'allowed'	=> 'mp4, m4v, mov, wmv, avi, mpg, ogv, 3gp, 3g2, webm, mkv',
			'argument'	=> 'extension'
		]);

		if ( is_array( $args ) && parent::sanitize_argument( $config, $field_name ) != false && $is_valid_extensions == true ) {
			$this->init_settings( $wp_customize, $config, $field_name );
			$wp_customize->add_control( new Video_Uploader_Control( $wp_customize, $args['id'] . '_field', array(
				'label'			=> esc_html( $args['label'] ),
				'description'	=> esc_html( $args['description'] ),
				'section'		=> $args['section'],
				'settings'		=> $args['id'],
				'priority'		=> $args['priority'],
				'placeholder'	=> $args['placeholder'],
				'default'		=> $args['default'],
				'extensions'	=> \CustomizerFramework\unique( $args['extensions'], [] ),
				'active_callback' => $args['active_callback']
			)));
		}
	}
}
