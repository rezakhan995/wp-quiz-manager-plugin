<?php

namespace QuizManager\Core\Question;

defined( 'ABSPATH' ) || exit;

use QuizManager\Core\Base\Metabox;
use QuizManager\Core\Utils\Singleton;

class Question_Meta extends Metabox {

	use Singleton;

	public $cpt         = 'qm-question';
	public $box_id      = 'qm-question-meta';
	public $meta_fields = array(
		'qm_question_right_ans',
		'qm_question_wrong_ans',
	);

	/**
	 * Meta Box Unique Id
	 *
	 * @return string
	 */
	public function box_id() {
		return $this->box_id;
	}

	/**
	 * Meta Box Title
	 *
	 * @return string
	 */
	public function box_title() {
		return __( 'Question Meta', 'quiz-manager' );
	}

	/**
	 * Post Type Name
	 *
	 * @return string
	 */
	public function post_type() {
		return $this->cpt;
	}

	/**
	 * Meta Box Markup
	 *
	 * @param [type] $post
	 * @return void
	 */
	public function render_metabox( $post ): void {

		$right_ans = ! empty( get_post_meta( $post->ID, 'qm_question_right_ans', true ) ) ? get_post_meta( $post->ID, 'qm_question_right_ans', true ) : '';
		$wrong_ans = ! empty( get_post_meta( $post->ID, 'qm_question_wrong_ans', true ) ) ? get_post_meta( $post->ID, 'qm_question_wrong_ans', true ) : array();

		wp_nonce_field( 'qm_question_custom_box', 'qm_question_custom_box_nonce' );
		?>
		<div class="qm-question-right-ans">
			<div class="qm-question-label">
				<label for="right-ans"> <?php echo esc_html__( 'Right Answer: ', 'quiz-manager' ); ?></label>
				<div class="qm-question-desc">  <?php echo esc_html__( 'Enter Right Answer Here. ', 'quiz-manager' ); ?>  </div>
			</div>
			<div class="qm-question-meta">
				<input placeholder="<?php echo __( 'Enter Right Answer Here. ', 'quiz-manager' ); ?>" autocomplete="off" class="qm-question-form-control" type="text" name="qm_question_right_ans" value="<?php echo esc_html( $right_ans ); ?>" />
			</div>
		</div>

		<div>
			<?php

			if ( is_array( $wrong_ans ) && ! empty( $wrong_ans ) ) {

				foreach ( $wrong_ans as $single_wrong_ans ) {
					?>
					<div class="qm-question-wrong-ans">
						<div class="qm-question-label">
							<label for="wrong-ans"> <?php echo esc_html__( 'wrong Answer: ', 'quiz-manager' ); ?></label>
							<div class="qm-question-desc">  <?php echo esc_html__( 'Enter wrong Answer Here. ', 'quiz-manager' ); ?>  </div>
						</div>
						<div class="qm-question-meta">
							<input placeholder="<?php echo __( 'Enter wrong Answer Here. ', 'quiz-manager' ); ?>" autocomplete="off" class="qm-question-form-control" type="text" name="qm_question_wrong_ans[]" value="<?php echo esc_attr( $single_wrong_ans ); ?>"/>
						</div>
					</div>
					<?php
				}
				?>
				<div class='add-wrong-ans'>
					<input class='qm-quiz-meta-button qm-add-more-text-field' data-repeater-create type='button' value='<?php echo esc_html__( 'Add', 'quiz-manager' ); ?>'/>
				</div>
				<?php
			} else {
				?>
				<div class="qm-question-wrong-ans">
					<div class="qm-question-label">
						<label for="wrong-ans"> <?php echo esc_html__( 'wrong Answer: ', 'quiz-manager' ); ?></label>
						<div class="qm-question-desc">  <?php echo esc_html__( 'Enter wrong Answer Here. ', 'quiz-manager' ); ?>  </div>
					</div>
					<div class="qm-question-meta">
						<input placeholder="<?php echo __( 'Enter wrong Answer Here. ', 'quiz-manager' ); ?>" autocomplete="off" class="qm-question-form-control" type="text" name="qm_question_wrong_ans[]" />
					</div>
				</div>
				<div class='add-wrong-ans'>
					<input class='qm-quiz-meta-button qm-add-more-text-field' data-repeater-create type='button' value='<?php echo esc_html__( 'Add', 'quiz-manager' ); ?>'/>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	}

	/**
	 * Save Meta Data
	 *
	 * @param [type] $post_id
	 * @return void
	 */
	public function save( $post_id ) {
		$form_data = filter_input_array( INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS );

		if ( ! \qm_post_is_secured( 'qm_question_custom_box_nonce', 'qm_question_custom_box', $post_id, $form_data ) ) {
			return;
		}

		foreach ( $form_data as $meta_key => $meta_value ) {

			if ( in_array( $meta_key, $this->meta_fields ) ) {
				update_post_meta( get_the_ID(), $meta_key, $meta_value );
			}
		}

	}

}
