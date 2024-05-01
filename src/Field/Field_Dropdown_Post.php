<?php declare(strict_types=1);

namespace CustomizerFramework\Field;

defined( 'ABSPATH' ) || exit;

use CustomizerFramework\Control\Dropdown_Post_Control;
use CustomizerFramework\Field\Setting\Orderable_Setting;
use WP_Customize_Manager;

/**
 * Field Dropdown Post.
 *
 * @since   1.0.0
 * @version 1.0.0
 */
final class Field_Dropdown_Post extends Orderable_Setting
{
    protected string $type = 'dropdown-post';

	/**
	 * Rendering Dropdown Post.
	 *
	 * @since 1.0.0
	 *
	 * @param object  $wp_customize  Object from WP_Customize_Manager.
	 * @param array   $args 		 List of configuration.
	 */
	public function render(WP_Customize_Manager $wp_customize, array $args)
    {
		$id = $this->make($wp_customize, $args);
        $wp_customize->add_control(new Dropdown_Post_Control($wp_customize, $id . '_field', $this->args));
	}
}
