<?php
/**
 * TinyMCE Custom Control.
 *
 * @package HfH_Theme
 */

if ( class_exists( 'WP_Customize_Control' ) ) {

	/**
	 * TinyMCE Custom Control
	 *
	 * @author Aurooba Ahmed <https://aurooba.com>, Matthias Nötzli
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 */
	class HfH_Theme_TinyMCE_Custom_Control extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 *
		 * @var string
		 */
		public $type = 'tinymce_editor';
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_script( 'richtext-control', get_template_directory_uri() . '/js/tinymce-custom-control.js', 'jquery', HFH_THEME_VERSION, true );
			wp_enqueue_editor();
		}
		/**
		 * Pass our TinyMCE toolbar config to JavaScript
		 */
		public function to_json() {
			parent::to_json();

			$this->json['hfh_tinymce_toolbar1'] = isset( $this->input_attrs['toolbar1'] ) ? esc_attr( $this->input_attrs['toolbar1'] ) : 'bold italic bullist numlist alignleft aligncenter alignright link';

			$this->json['hfh_tinymce_toolbar2'] = isset( $this->input_attrs['toolbar2'] ) ? esc_attr( $this->input_attrs['toolbar2'] ) : '';

			$this->json['hfh_tinymce_mediabuttons'] = isset( $this->input_attrs['mediaButtons'] ) && ( true === $this->input_attrs['mediaButtons'] ) ? true : false;

			$this->json['hfh_tinymce_height'] = isset( $this->input_attrs['height'] ) ? esc_attr( $this->input_attrs['height'] ) : 200;
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			?>
		<div class="tinymce-control">
			<span class="customize-control-title">
				<?php echo esc_html( $this->label ); ?>
			</span>

			<?php if ( ! empty( $this->description ) ) { ?>
				<span class="customize-control-description">
					<?php echo esc_html( $this->description ); ?>
				</span>
			<?php } ?>

			<textarea id="<?php echo esc_attr( $this->id ); ?>" class="customize-control-tinymce-editor" <?php $this->link(); ?>><?php echo esc_attr( $this->value() ); ?></textarea>
		</div>
			<?php
		}
	}
}
