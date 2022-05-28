<form action="" method="post" class="qm-quiz-form">
	<div class="qm-quiz--block-wrapper">
		<?php
		foreach ( $all_questions as $question_key => $question_details ) {
			$id          = $question_details->ID;
			$question    = $question_details->post_title;
			$description = get_the_excerpt( $id );
			$correct_ans = ! empty( get_post_meta( $id, 'qm_question_right_ans', true ) ) ? get_post_meta( $id, 'qm_question_right_ans', true ) : '';
			$wrong_ans   = ! empty( get_post_meta( $id, 'qm_question_wrong_ans', true ) ) ? get_post_meta( $id, 'qm_question_wrong_ans', true ) : array();
			$all_ans     = array(
				'right' => $correct_ans,
			);

			if ( is_array( $wrong_ans ) && ! empty( $wrong_ans ) ) {

				foreach ( $wrong_ans as $key => $single_wrong_ans ) {
					$all_ans[ 'wrong-' . $key ] = $single_wrong_ans;
				}
			}

			$all_ans = shuffle_answers( $all_ans );

			?>
			<div class="qm-quiz-single-block">
				<div class="qm-quiz-question-wrapper">
					<div class="qm-quiz-question">
						<strong><?php echo esc_html( $question ); ?></strong>
						<p><?php echo esc_html( $description ); ?></p>
					</div>
				</div>
				<div class="qm-quiz-answer-wrapper">
					<?php

					foreach ( $all_ans as $ans_key => $ans ) {
						?>
						<div class="qm-quiz-single-answer">
							<input type="radio" name="<?php echo esc_attr( $question_key ); ?>-answers[]" value="<?php echo esc_attr( $ans_key ); ?>" required><?php echo esc_html( $ans ); ?>
						</div>
						<?php
					}

					?>
				</div>
			</div>
			<?php

		}
		?>
		<input type="submit" class="qm-quiz-submit" name="qm-quiz-submit" value="<?php echo esc_attr__( 'submit', 'quiz-manager' ); ?>" >
	</div>

	<div class="qm-quiz-result-wrapper">

	</div>
</form>
