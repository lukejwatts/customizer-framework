<?php declare(strict_types=1);

namespace CustomizerFramework\Field;

defined( 'ABSPATH' ) || exit;

use CustomizerFramework\Control\Time_Picker_Control;
use CustomizerFramework\Field\Setting\Time_Picker_Setting;
use WP_Customize_Manager;

final class Field_Time_Picker extends Time_Picker_Setting
{
    /**
     * Render
     *
     * @param object  $wp_customize  Object from WP_Customize_Manager.
     * @param array   $args 		 List of configuration.
     */
    public function render(WP_Customize_Manager $wp_customize, array $args)
    {
        $id = $this->make($wp_customize, $args);
        $wp_customize->add_control(new Time_Picker_Control($wp_customize, $id . '_field', $this->args));
    }
}
