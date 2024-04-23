<?php declare(strict_types=1);

namespace CustomizerFramework\Control;

defined( 'ABSPATH' ) || exit;

use CustomizerFramework\Attachment\Attachment;

/**
 * Audio Uploader Control.
 *
 * @since   1.0.0
 * @version 1.0.0
 */
final class Audio_Uploader_Control extends \WP_Customize_Control
{
	/**
	 * List of valid extensions [ 'mp3', 'm4a', 'ogg', 'wav', 'mpg' ].
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	public $extensions;


	/**
	 * Holds the placeholder.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $placeholder;


	/**
	 * Instantiating Attachment
	 * and return object attachment.
	 *
	 * @since 1.0.0
	 *
	 * @return object
	 */
	private function attachment() {
		$attachment = new Attachment( [
			'type'			=> 'audio',
			'id'			=> $this->id,
			'label'			=> $this->label,
			'description'	=> $this->description,
			'placeholder'	=> $this->placeholder,
			'extensions'	=> $this->extensions,
			'value'			=> $this->value()
		]);
		return $attachment;
	}


	/**
	 * Render the audion uploader controller and display in frontend.
	 *
	 * @since 1.0.0
	 *
	 * @return html    control in customizer page
	 */
	public function render_content() {
		$this->attachment()->create();
	}
}
