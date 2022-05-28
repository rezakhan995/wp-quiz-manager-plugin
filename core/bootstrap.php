<?php

namespace QuizManager\Core;

defined( 'ABSPATH' ) || exit;

use QuizManager\Core\Utils\Singleton;

class Bootstrap {

	use Singleton;

	/**
	 * Bootstrap Class Instance
	 * Returns Existing Instance If Found
	 *
	 * @return void
	 */
	public function init() {

		include_once \QuizManager::plugin_core_dir() . 'utils/helper.php';
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_enqueue_scripts' ) );
		add_action( 'admin_menu', array( $this, 'register_admin_menu' ) );
		\QuizManager\Core\Question\Question::instance()->init();
		\QuizManager\Core\Blocks\Quiz\Quiz::instance()->init();
	}

	/**
	 * Enqueue Admin Scripts
	 *
	 * @return void
	 */
	public function admin_enqueue_scripts() {
		wp_enqueue_script( 'qm-admin-script', \QuizManager::assets_url() . 'js/qm-admin-script.js', array( 'jquery' ), \QuizManager::version(), true );
	}

	/**
	 * Enqueue Front-end Scripts
	 *
	 * @return void
	 */
	public function frontend_enqueue_scripts() {
		wp_enqueue_style( 'qm-front-script', \QuizManager::assets_url() . 'css/qm-front-style.css', array(), \QuizManager::version(), 'all' );
		wp_enqueue_script( 'qm-front-script', \QuizManager::assets_url() . 'js/qm-front-script.js', array( 'jquery' ), \QuizManager::version(), true );
	}

	/**
	 * Register Admin Menu
	 *
	 * @return void
	 */
	public function register_admin_menu() {

		if ( current_user_can( 'manage_options' ) ) {
			add_menu_page(
				__( 'Quiz Manager', 'quiz-manager' ),
				__( 'Quiz Manager', 'quiz-manager' ),
				'read',
				'qm-parent-menu',
				'',
				'dashicons-welcome-write-blog',
				10
			);
		}

	}

}
