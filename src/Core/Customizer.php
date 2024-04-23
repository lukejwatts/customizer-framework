<?php declare(strict_types=1);

namespace CustomizerFramework\Core;

defined( 'ABSPATH' ) || exit;

use CustomizerFramework\Field\Field_Audio_Uploader;
use CustomizerFramework\Field\Field_Button_Set;
use CustomizerFramework\Field\Field_Text;
use CustomizerFramework\Field\Field_Select;
use CustomizerFramework\Field\Field_Size;
use CustomizerFramework\Field\Field_Sortable;
use CustomizerFramework\Field\Field_Switch;
use CustomizerFramework\Field\Field_Checkbox;
use CustomizerFramework\Field\Field_Checkbox_Multiple;
use CustomizerFramework\Field\Field_Checkbox_Pill;
use CustomizerFramework\Field\Field_Code_Editor;
use CustomizerFramework\Field\Field_Color;
use CustomizerFramework\Field\Field_Color_Picker;
use CustomizerFramework\Field\Field_Color_Set;
use CustomizerFramework\Field\Field_Content_Editor;
use CustomizerFramework\Field\Field_Date_Picker;
use CustomizerFramework\Field\Field_Dropdown_Custom_Post;
use CustomizerFramework\Field\Field_Dropdown_Page;
use CustomizerFramework\Field\Field_Dropdown_Post;
use CustomizerFramework\Field\Field_Email;
use CustomizerFramework\Field\Field_File_Uploader;
use CustomizerFramework\Field\Field_Image_Checkbox;
use CustomizerFramework\Field\Field_Image_Radio;
use CustomizerFramework\Field\Field_Image_Uploader;
use CustomizerFramework\Field\Field_Markup;
use CustomizerFramework\Field\Field_Numeric;
use CustomizerFramework\Field\Field_Radio;
use CustomizerFramework\Field\Field_Range;
use CustomizerFramework\Field\Field_Tagging;
use CustomizerFramework\Field\Field_Tagging_Select;
use CustomizerFramework\Field\Field_Textarea;
use CustomizerFramework\Field\Field_Time_Picker;
use CustomizerFramework\Field\Field_Toggle;
use CustomizerFramework\Field\Field_Url;
use CustomizerFramework\Field\Field_Video_Uploader;

/**
 * Framework.
 *
 * @since   1.0.0
 * @version 1.0.0
 */
class Customizer
{
	/**
	 * Holds set of arguments.
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	public $config = [];

	/**
	 * Get WP_Customize_Manager.
	 *
	 * @since 1.0.0
	 *
	 * @return object
	 */
	protected function wp_cm()
    {
		global $wp_customize;

		return $wp_customize;
	}


	/**
	 * Adding panel.
	 *
	 * @since 1.0.0
	 *
	 * @param string 	$id 					a unique slug-like string to use as an id
	 * @param array 	$config 				hold the set of arguments
	 * @param string 	$config['title']	    the visible name of the panel
	 * @param string 	$config['description'] 	the discription of the panel
	 * @param int 		$config['priority']		the order of panels appears in the Theme Customizer Sizebar
	 */
	public static function panel( $id ,$config )
    {
		if ( is_customize_preview() ) {
			if ( ! empty( $id ) && ! empty( $config ) ) {
				( new self )->render_panel( $id, $config );
			}
		}
	}

	/**
	 * Rendering Panel.
	 *
	 * @since 1.0.0
	 *
	 * @param string  $id 			 A unique slug-like string to use as an id.
	 * @param array   $config 		 Containing the set of arguments.
	 */
	private function render_panel( $id, $config )
    {
		$rules = array(
			'title'			=> array(
				'rule'		=> 'required',
				'default'	=> '',
				'type'		=> 'string'
			),
			'description'	=> array(
				'rule'		=> 'not',
				'default'	=> '',
				'type'		=> 'string'
			),
			'priority'		=> array(
				'rule'		=> 'not',
				'default'	=> '',
				'type'		=> 'number'
			)
		);

		// sanitizing $config and return sanitized value
		$args = \CustomizerFramework\sanitize_argument( 'panel: '. $id, $config, $rules );

		// creating panel
		if ( $args != false ) {
			$this->wp_cm()->add_panel( $id, $args );
		}
	}

	/**
	 * Adding Section.
	 *
	 * @since 1.0.0
	 *
	 * @param string  $id 	   A unique slug-like string to use as an id.
	 * @param array   $config  Containing the set of arguments.
	 */
	public static function section( $id ,$config )
    {
		if ( is_customize_preview() ) {
			if ( ! empty( $id ) && ! empty( $config ) ) {
				( new self )->render_section( $id, $config );
			}
		}
	}

	/**
	 * Rendering Section.
	 *
	 * @since 1.0.0
	 *
	 * @param string  $id 	   A unique slug-like string to use as an id.
	 * @param array   $config  Hold the set of arguments.
	 */
	private function render_section( $id, $config )
    {
		$rules = array(
			'title'			=> array(
				'rule'		=> 'required',
				'default'	=> '',
				'type'		=> 'string'
			),
			'description'	=> array(
				'rule'		=> 'not',
				'default'	=> '',
				'type'		=> 'string'
			),
			'panel'			=> array(
				'rule'		=> 'not',
				'default'	=> '',
				'type'		=> 'string'
			),
			'priority'		=> array(
				'rule'		=> 'not',
				'default'	=> '',
				'type'		=> 'number'
			)
		);

		// sanitizing $config and return sanitized value
		$args = \CustomizerFramework\sanitize_argument( 'section:'. $id, $config, $rules );

		// creating section
		if ( $args != false ) {
			$this->wp_cm()->add_section( $id, $args );
		}
	}

	/**
	 * Adding Field.
	 *
	 * @since 1.0.0
	 *
	 * @param string  $id 	   A unique slug-like string to use as an id.
	 * @param array   $config  Hold the set of arguments for specific field.
	 */
	public static function field( $type, $config )
    {
		if ( is_customize_preview() ) {
			if ( ! empty( $type ) && ! empty( $config ) ) {
				(new self)->render_field( $type, $config );
			}
		}
	}

	/**
	 * Rendering Field.
	 *
	 * @since 1.0.0
	 *
	 * @param string  $type    The type of field.
	 * @param array   $config  Hold the set of arguments for specific field.
	 */
	private function render_field(string $type, array $config): void
    {
		switch ( $type ) {
			case 'audio-uploader':
				(new Field_Audio_Uploader)->render( $this->wp_cm(), $config );
				break;
			case 'button-set':
				(new Field_Button_Set)->render( $this->wp_cm(), $config );
				break;
			case 'text':
				(new Field_Text)->render( $this->wp_cm(), $config );
				break;
			case 'select':
				(new Field_Select)->render( $this->wp_cm(), $config );
				break;
			case 'size':
				(new Field_Size)->render( $this->wp_cm(), $config );
				break;
			case 'sortable':
				(new Field_Sortable)->render( $this->wp_cm(), $config );
				break;
			case 'switch':
				(new Field_Switch)->render( $this->wp_cm(), $config );
				break;
			case 'checkbox':
				(new Field_Checkbox)->render( $this->wp_cm(), $config );
				break;
			case 'checkbox-multiple':
				(new Field_Checkbox_Multiple)->render( $this->wp_cm(), $config );
				break;
			case 'checkbox-pill':
				(new Field_Checkbox_Pill)->render( $this->wp_cm(), $config );
				break;
			case 'code-editor':
				(new Field_Code_Editor)->render( $this->wp_cm(), $config );
				break;
			case 'color':
				(new Field_Color)->render( $this->wp_cm(), $config );
				break;
			case 'color-picker':
				(new Field_Color_Picker)->render( $this->wp_cm(), $config );
				break;
			case 'color-set':
				(new Field_Color_Set)->render( $this->wp_cm(), $config );
				break;
			case 'content-editor':
				(new Field_Content_Editor)->render( $this->wp_cm(), $config );
				break;
			case 'date-picker':
				(new Field_Date_Picker)->render( $this->wp_cm(), $config );
				break;
			case 'dropdown-custom-post':
				(new Field_Dropdown_Custom_Post)->render( $this->wp_cm(), $config );
				break;
			case 'dropdown-page':
				(new Field_Dropdown_Page)->render( $this->wp_cm(), $config );
				break;
			case 'dropdown-post':
				(new Field_Dropdown_Post)->render( $this->wp_cm(), $config );
				break;
			case 'email':
				(new Field_Email)->render( $this->wp_cm(), $config );
				break;
			case 'file-uploader':
				(new Field_File_Uploader)->render( $this->wp_cm(), $config );
				break;
			case 'image-checkbox':
				(new Field_Image_Checkbox)->render( $this->wp_cm(), $config );
				break;
			case 'image-radio':
				(new Field_Image_Radio)->render( $this->wp_cm(), $config );
				break;
			case 'image-uploader':
				(new Field_Image_Uploader)->render( $this->wp_cm(), $config );
				break;
			case 'markup':
				(new Field_Markup)->render( $this->wp_cm(), $config );
				break;
			case 'numeric':
				(new Field_Numeric)->render( $this->wp_cm(), $config );
				break;
			case 'radio':
				(new Field_Radio)->render( $this->wp_cm(), $config );
				break;
			case 'range':
				(new Field_Range)->render( $this->wp_cm(), $config );
				break;
			case 'tagging':
				(new Field_Tagging)->render( $this->wp_cm(), $config );
				break;
			case 'tagging-select':
				(new Field_Tagging_Select)->render( $this->wp_cm(), $config );
				break;
			case 'textarea':
				(new Field_Textarea)->render( $this->wp_cm(), $config );
				break;
			case 'time-picker':
				(new Field_Time_Picker)->render( $this->wp_cm(), $config );
				break;
			case 'toggle':
				(new Field_Toggle)->render( $this->wp_cm(), $config );
				break;
			case 'url':
				(new Field_Url)->render( $this->wp_cm(), $config );
				break;
			case 'video-uploader':
				(new Field_Video_Uploader)->render( $this->wp_cm(), $config );
				break;
		}
	}
}
