<?php declare(strict_types=1);

namespace CustomizerFramework\Control;

defined( 'ABSPATH' ) || exit;

/**
 * Tagging Select Control.
 *
 * @since   1.0.0
 * @version 1.0.0
 */
final class Tagging_Select_Control extends \WP_Customize_Control
{
	/**
	 * List of choices display in option tag.
	 *
	 * @since 1.0.0
	 *
	 * @var string | number
	 */
	public $choices;


	/**
	 * The maximum tag item.
	 *
	 * @since 1.0.0
	 *
	 * @var number
	 */
	public $maxitem;


	/**
	 * The placeholder of select tag.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $placeholder;


	/**
	 * Adding third party libraries.
	 *
	 * @since 1.0.0
	 */
	public function enqueue() {
		// styles
		if ( wp_style_is( 'customizer-framework--selectize-css', 'enqueued' ) == false ) {
			wp_enqueue_style( 'customizer-framework--selectize-css', \CustomizerFramework\resource_url(). 'assets/selectize/selectize.css' );
		}

		// js
		if ( wp_script_is( 'customizer-framework--selectize-js', 'enqueued' ) == false ) {
			wp_enqueue_script( 'customizer-framework--selectize-js', \CustomizerFramework\resource_url(). 'assets/selectize/selectize.min.js', array(), '1.0', false );
		}
	}


	/**
	 * Finalize the max item.
	 *
	 * @since 1.0.0
	 *
	 * @return number
	 */
	private function final_max_item() {
		if ( isset( $this->maxitem ) ) {
			if ( is_numeric( $this->maxitem ) ) {
				$max = $this->maxitem;
			} else {
				$max = 'none';
			}
		}
		return $max;
	}


	/**
	 * Returns the imploded value whether in "array" or string format.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	private function imploded_value() {
		$output = $this->value();
		if ( is_array( $this->value() ) ) {
			$output = implode( ',', $this->value() );
		}
		return $output;
	}


	/**
	 * Render the tagging select controller and display in frontend.
	 *
	 * @since 1.0.0
	 *
	 * @return html
	 */
	public function render_content() {
	?>
		<div class="customizer-framework--tagging-select-parent">
			<label>
				<?php if ( ! empty( $this->label ) ): ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php endif; ?>

				<?php if ( ! empty( $this->description ) ): ?>
					<span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
				<?php endif; ?>
			</label>

			<select class="customizer-framework--tagging-select-control"
				 	id="<?php echo esc_attr( $this->id ) ?>"
				 	name="<?php echo esc_attr( $this->id ) ?>"
				 	value="<?php echo esc_attr( $this->imploded_value() ) ?>"
				 	placeholder="<?php echo $this->placeholder; ?>"
				 	data-maxitem="<?php echo $this->final_max_item() ?>" <?php $this->link() ?> multiple>

					<?php
					// rendering option
					if ( is_array( $this->choices ) ):
						foreach ( $this->choices as $key => $value ):
							echo '<option value="'. $key .'">'. $value .'</option>';
						endforeach;
					endif; ?>
			</select>
		</div>
	<?php
	}
}
