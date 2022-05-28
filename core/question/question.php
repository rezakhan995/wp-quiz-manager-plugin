<?php

namespace QuizManager\Core\Question;

defined( 'ABSPATH' ) || exit;

use QuizManager\Core\Utils\Singleton;

class Question {

	use Singleton;

	public $cpt;
	public $metabox;

	/**
	 * Initializes Question Related Modules
	 *
	 * @return void
	 */
	public function init() {
		$this->cpt     = new Cpt();
		$this->metabox = new Question_Meta();
	}
}
