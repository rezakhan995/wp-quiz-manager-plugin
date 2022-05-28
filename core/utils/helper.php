<?php

if ( ! function_exists( 'qm_post_is_secured' ) ) {

	/**
	 * Nonce Checking
	 *
	 * @param [type] $nonce_field
	 * @param [type] $action
	 * @param [type] $post_id
	 * @param array  $post
	 * @return bool
	 */
	function qm_post_is_secured( $nonce_field, $action, $post_id = null, $post = array() ) {

		$nonce = ! empty( $post[ $nonce_field ] ) ? sanitize_text_field( $post[ $nonce_field ] ) : '';

		if ( '' === $nonce ) {
			return false;
		}

		if ( null !== $post_id ) {

			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return false;
			}

			if ( wp_is_post_autosave( $post_id ) ) {
				return false;
			}

			if ( wp_is_post_revision( $post_id ) ) {
				return false;
			}
		}

		if ( ! wp_verify_nonce( $nonce, $action ) ) {
			return false;
		}

		return true;
	}
}

if ( ! function_exists( 'shuffle_answers' ) ) {

	/**
	 * Shuffles values of an array
	 *
	 * @param array $answers
	 * @return array
	 */
	function shuffle_answers( $answers = array() ) {

		if ( empty( $answers ) ) {
			return;
		}

		$keys = array_keys( $answers );
		shuffle( $keys );

		$shuffled_array = array();
		foreach ( $keys as $key ) {
			$shuffled_array[ $key ] = $answers[ $key ];
		}

		return $shuffled_array;
	}
}
