<?php
namespace QuizManager\Core\Base;

defined( 'ABSPATH' ) || exit;

abstract class Cpt {

	/**
	 * To Be Overriden
	 */
	public function __construct() {
		$name = $this->post_name();
		$args = $this->post_config();

		add_action(
			'init',
			function () use ( $name, $args ) {
				register_post_type( $name, $args );
				flush_rewrite_rules();
			}
		);
	}

	abstract public function post_name();
	abstract public function post_config();

}
