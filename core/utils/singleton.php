<?php
namespace QuizManager\Core\Utils;

defined( 'ABSPATH' ) || exit;

trait Singleton {
	private static $instance;

	/**
	 * Returns Late Static Instance
	 *
	 * @return object
	 */
	public static function instance() {

		if ( null === self::$instance ) {
			self::$instance = new static();
		}

		return self::$instance;
	}

}
