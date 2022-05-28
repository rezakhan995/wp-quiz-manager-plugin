<?php

namespace QuizManager\Core\Question;

defined( 'ABSPATH' ) || exit;

use QuizManager\Core\Base\Cpt as AbstractCpt;
use QuizManager\Core\Utils\Singleton;

class Cpt extends AbstractCpt {

	use Singleton;

	/**
	 * Custom Post Name
	 *
	 * @override post_name()
	 *
	 * @return string
	 */
	public function post_name() {
		return 'qm-question';
	}

	/**
	 * Configuration For CPT
	 *
	 * @return array
	 */
	public function post_config() {
		$options = $this->user_modifiable_options();

		$labels = array(
			'name'                  => esc_html_x( 'Questions', 'Post Type General Name', 'quiz-manager' ),
			'singular_name'         => $options['singular_name'],
			'menu_name'             => esc_html__( 'Questions', 'quiz-manager' ),
			'name_admin_bar'        => esc_html__( 'Questions', 'quiz-manager' ),
			'archives'              => $options['archive'],
			'attributes'            => esc_html__( 'Questions Attributes', 'quiz-manager' ),
			'parent_item_colon'     => esc_html__( 'Parent Item:', 'quiz-manager' ),
			'all_items'             => $options['all_items'],
			'add_new_item'          => esc_html__( 'Add New Questions', 'quiz-manager' ),
			'add_new'               => esc_html__( 'Add New', 'quiz-manager' ),
			'new_item'              => esc_html__( 'New Questions', 'quiz-manager' ),
			'edit_item'             => esc_html__( 'Edit Questions', 'quiz-manager' ),
			'update_item'           => esc_html__( 'Update Questions', 'quiz-manager' ),
			'view_item'             => esc_html__( 'View Questions', 'quiz-manager' ),
			'view_items'            => esc_html__( 'View Questions', 'quiz-manager' ),
			'search_items'          => esc_html__( 'Search Questions', 'quiz-manager' ),
			'not_found'             => esc_html__( 'Not found', 'quiz-manager' ),
			'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'quiz-manager' ),
			'featured_image'        => esc_html__( 'Featured Image', 'quiz-manager' ),
			'set_featured_image'    => esc_html__( 'Set featured image', 'quiz-manager' ),
			'remove_featured_image' => esc_html__( 'Remove featured image', 'quiz-manager' ),
			'use_featured_image'    => esc_html__( 'Use as featured image', 'quiz-manager' ),
			'insert_into_item'      => esc_html__( 'Insert into Questions', 'quiz-manager' ),
			'uploaded_to_this_item' => esc_html__( 'Uploaded to this Questions', 'quiz-manager' ),
			'items_list'            => esc_html__( 'Questions list', 'quiz-manager' ),
			'items_list_navigation' => esc_html__( 'Questions list navigation', 'quiz-manager' ),
			'filter_items_list'     => esc_html__( 'Filter froms list', 'quiz-manager' ),
		);

		$rewrite = array(
			'slug'       => apply_filters( 'qm_question_slug', $options['slug'] ),
			'with_front' => true,
			'pages'      => true,
			'feeds'      => true,
		);

		$args = array(
			'label'               => esc_html__( 'Questions', 'quiz-manager' ),
			'description'         => esc_html__( 'Questions', 'quiz-manager' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'thumbnail', 'excerpt' ),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_admin_column'   => false,
			'menu_icon'           => 'dashicons-text-page',
			'menu_position'       => 10,
			'show_in_admin_bar'   => false,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'query_var'           => true,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'show_in_rest'        => true,
			'show_in_menu'        => 'qm-parent-menu',
			'rest_base'           => $this->post_name(),
			'capabilities'        => array(
				'create_posts' => true, // Removes support for the "Add New".
			),
			'map_meta_cap'        => true, // Allow edit / delete.
		);

		return $args;
	}

	/**
	 * User Modifiable Options
	 *
	 * @return array
	 */
	private function user_modifiable_options() {
		$options = array(
			'singular_name' => esc_html__( 'Question', 'quiz-manager' ),
			'archive'       => esc_html__( 'Questions Archive', 'quiz-manager' ),
			'all_items'     => esc_html__( 'Questions', 'quiz-manager' ),
			'slug'          => 'qm-question',
		);
		return $options;
	}

}
