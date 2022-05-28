<?php
defined( 'ABSPATH' ) || exit;

/**
 * Plugin Name: Quiz Manager
 * Description: Simple quiz management plugin.
 * Version:     1.0.0
 * Plugin URI:  https://quiz-manager.com
 * Author:      Reza Khan
 * Author URI:  https://profiles.wordpress.org/rezakhan995/
 * Text Domain: quiz-manager
 * Domain Path: /languages
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

/**
 * @package QuizManager
 */
final class QuizManager {

    private static $instance = null;

    /**
     * Initializes QuizManager() class
     * Checks and return an existing instance if found
     *
     * @return QuizManager
     */
    public static function init() {

        if ( null === self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Plugin Instance
     *
     * @return QuizManager()
     */
    private function __construct() {
        $this->define_all_constants();
        add_action( 'init', [$this, 'i18n'] );

        // initializes everything.
        add_action( 'plugins_loaded', [$this, 'initialize_plugin'], 99 );
    }

    public function define_all_constants() {
        // will be implemented later.
    }

    /**
     * Load Plugin Text Domain
     *
     * @return void
     */
    public function i18n() {
        load_plugin_textdomain( 'quiz-manager', false, self::plugin_dir() . 'languages/' );
    }

    /**
     * Handle All Bootstraping
     *
     * @return void
     */
    public function initialize_plugin() {
        do_action( 'qm_before_load' );

        require_once self::plugin_dir() . 'autoloader.php';
        \QuizManager\Core\Bootstrap::instance()->init();

        do_action( 'qm_after_load' );
    }

    /**
     * Current Stable Version
     *
     * @return string
     */
    public static function version() {
        return '1.0.0';
    }

    /**
     * Plugin Base File
     *
     * @return string
     */
    public static function plugin_file() {
        return __FILE__;
    }

    /**
     * Plugin Base Name
     *
     * @return string
     */
    public static function plugins_basename() {
        return plugin_basename( self::plugin_file() );
    }

    /**
     * Plugin Directory Path
     *
     * @return string
     */
    public static function plugin_dir() {
        return trailingslashit( plugin_dir_path( self::plugin_file() ) );
    }

    /**
     * Plugin Directory URL
     *
     * @return string
     */
    public static function plugin_url() {
        return trailingslashit( plugin_dir_url( self::plugin_file() ) );
    }

    /**
     * Plugin Core Directory Path
     *
     * @return string
     */
    public static function plugin_core_dir() {
        return trailingslashit( self::plugin_dir() . 'core' );
    }

    /**
     * Plugin Core Directory URL
     *
     * @return string
     */
    public static function plugin_core_url() {
        return trailingslashit( self::plugin_url() . 'core' );
    }

    /**
     * Assets Directory Url
     *
     * @return string
     */
    public static function assets_url() {
        return trailingslashit( self::plugin_url() . 'assets' );
    }

    /**
     * Assets Folder Directory Path
     *
     * @return string
     */
    public static function assets_dir() {
        return trailingslashit( self::plugin_dir() . 'assets' );
    }

}

/**
 * Flush Re-write On Plugin Activation
 *
 * @return void
 */
function activate_quiz_manager() {
    flush_rewrite_rules();
}

/**
 * Flush Re-write On Plugin Deactivation
 *
 * @return void
 */
function deactivate_quiz_manager() {
    flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'activate_quiz_manager' );
register_deactivation_hook( __FILE__, 'deactivate_quiz_manager' );

/**
 * Load Quiz Manager plugin when everything's loaded
 *
 * @return QuizManager
 */
function quiz_manager() {
    return QuizManager::init();
}

// Let's go...
quiz_manager();

