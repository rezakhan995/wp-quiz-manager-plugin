<?php

namespace QuizManager\Core\Base;

defined( 'ABSPATH' ) || exit;

abstract class Metabox {

	/**
	 * To Be Overriden
	 */
	public function __construct() {
		$box_id    = $this->box_id();
		$box_title = $this->box_title();
		$post_type = $this->post_type();

		add_action(
			'add_meta_boxes',
			function () use ( $box_id, $box_title, $post_type ) {
				add_meta_box(
					$box_id,
					$box_title,
					array( $this, 'render_metabox' ),
					$post_type,
					'advanced',
					'core'
				);
			}
		);

		add_action( 'save_post', array( $this, 'save' ) );
	}

	abstract public function box_id();
	abstract public function box_title();
	abstract public function render_metabox( $post );
	abstract public function post_type();

}
