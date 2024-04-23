<?php declare(strict_types=1);

namespace CustomizerFramework\Control;

defined( 'ABSPATH' ) || exit;

/**
 * Size Control.
 *
 * @since   1.0.0
 * @version 1.0.0
 */
final class Size_Control extends \WP_Customize_Control
{
	/**
	 * List of format allowed.
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	public array $units;


	/**
	 * Holds the placeholder.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public string $placeholder;


	/**
	 * Return unit array to single string.
	 *
	 * @since 1.0.0
     *
	 * @return string
	 */
	private function data_unit() {
		if ( ! empty( $this->units ) ) {
			return implode( ',', $this->units );
		}
	}


	/**
	 * Render the size controller and display in frontend.
	 *
	 * @since 1.0.0
	 *
	 * @return html
	 */
	public function render_content() {
	?>
		<div class="customizer-framework--size-parent">
			<label>
				<?php if ( ! empty( $this->label ) ): ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php endif; ?>

				<?php if ( ! empty( $this->description ) ): ?>
					<span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
				<?php endif; ?>
			</label>

			<input type="hidden"
				   id="<?php echo esc_attr( $this->id ); ?>"
				   class="customizer-framework--size"
				   value="<?php echo esc_attr( $this->value() ); ?>"
				   <?php $this->link(); ?>>

			<input type="text"
				   id="<?php echo esc_attr( $this->id ); ?>-mirror"
				   class="customizer-framework--size-mirror"
				   value="<?php echo esc_attr( $this->value() ); ?>"
				   placeholder="<?php echo esc_attr( $this->placeholder ); ?>"
				   data-units="<?php echo esc_attr( $this->data_unit() ); ?>">

		</div>
	<?php
	}
}
