<?php

namespace QuizManager\Core\Blocks\Quiz;

defined( 'ABSPATH' ) || exit;

use QuizManager;
use QuizManager\Core\Utils\Singleton;

class Quiz {

	use Singleton;

	public function init() {
		add_action( 'init', array( $this, 'register_quiz_block' ) );
	}

	public function register_quiz_block() {

		wp_register_script( 'qm-block-script', \QuizManager::plugin_core_url() . 'blocks/quiz/quiz-block-script.js', array( 'wp-blocks', 'wp-element' ), \QuizManager::version(), false );

		register_block_type(
			'quize-manager/quiz-block',
			array(
				'editor_script'   => 'qm-block-script',
				'render_callback' => array( $this, 'quiz_view_callback' ),
			)
		);
	}

	public function quiz_view_callback( $settings ) {

		$all_questions = get_posts(
			array(
				'numberposts' => -1,
				'post_type'   => 'qm-question',
			)
		);

		ob_start();

		if ( file_exists( \QuizManager::plugin_core_dir() . 'blocks/quiz/quiz-template.php' ) ) {
			include \QuizManager::plugin_core_dir() . 'blocks/quiz/quiz-template.php';
		}

		return ob_get_clean();
	}

}
