<?php


namespace KUMaxim\PullCommentsOtherPages;


class AdminMetaBox {
	public function add_meta_box() {
		$allowed_screens = get_post_types_by_support( 'comments' );
		$allowed_screens = array_diff( $allowed_screens, array( 'attachment' ) );
		add_meta_box( 'pull-comments-other-pages', __( 'Comments source', 'pull-comments-other-pages' ), array( $this, 'display' ), $allowed_screens, 'normal', 'default', array( $allowed_screens ) );
	}

	public function display( $wp_post, $args ) {
		$post_types = isset( $args['args'] ) && is_array( $args['args'] ) ? array_shift( $args['args'] ) : array();

		$current_sources = get_post_meta( $wp_post->ID, OptionsHolder::get_instance()->get( 'post_meta_key' ), true );
		$current_sources = ! is_array( $current_sources ) ? array() : $current_sources;

		$output = '';

		foreach ( $post_types as $name ) {
			$posts = get_posts( array( 'post_type' => array( $name ) ) );

			$output .= sprintf( '<optgroup label="%s">', ucfirst( $name ) );

			foreach ( $posts as $object ) {
				if ( $object->ID === $wp_post->ID ) {
					continue;
				}

				$output .= sprintf(
					'<option value="%d"%s>%s</option>',
					$object->ID,
					selected(
						in_array( $object->ID, $current_sources, true ),
						true,
						false
					),
					$object->post_title
				);
			}

			$output .= '</optgroup>';
		}

		$output = sprintf(
			'<select name="b2p-source-comments-page[]" multiple="multiple" class="js-example-basic-single js-states form-control" id="b2p-source-comments-page-dropdown">%s</select>',
			$output
		);

		echo sprintf(
			'<div class="b2p-wrap"><label for="b2p-source-comments-page-dropdown">%s: </label>%s<span class="hint">%s</span></div>',
			__( 'Post(page, cpt)', 'pull-comments-other-pages' ),
			$output,
			__( 'Select source page whose comments will be merge with comments one', 'pull-comments-other-pages' )
		);

		wp_nonce_field( 'b2p-save-post-' . $wp_post->ID, 'b2p-save-comments-source' );
	}

	public function save( $post_id, $wp_post, $updated ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! array_key_exists( 'b2p-save-comments-source', $_POST ) || ! wp_verify_nonce( $_POST['b2p-save-comments-source'], 'b2p-save-post-' . $post_id ) ) {
			return;
		}

		if ( ! current_user_can( 'edit_posts' ) ) {
			return;
		}

		if ( ! array_key_exists( 'b2p-source-comments-page', $_POST ) || ! is_array( $_POST['b2p-source-comments-page'] ) ) {
			delete_post_meta( $post_id, OptionsHolder::get_instance()->get( 'post_meta_key' ) );

			return;
		}

		$page_ids = filter_var_array( $_POST['b2p-source-comments-page'], FILTER_VALIDATE_INT );

		if ( 0 === count( $page_ids ) ) {
			delete_post_meta( $post_id, OptionsHolder::get_instance()->get( 'post_meta_key' ) );

			return;
		}

		update_post_meta( $post_id, OptionsHolder::get_instance()->get( 'post_meta_key' ), $page_ids );

	}

	public function enqueue_scripts() {
		$post_types = get_post_types_by_support( 'comments' );
		$post_types = array_diff( $post_types, array( 'attachment' ) );

		global $current_screen;

		if ( ! in_array( $current_screen->post_type, $post_types, true ) ) {
			return;
		}

		wp_enqueue_script( 'select2', OptionsHolder::get_instance()->get( 'assets_uri' ) . 'vendor/select2/js/select2.min.js', array( 'jquery' ), time(), true );
		wp_enqueue_script( 'b2p-bundle', OptionsHolder::get_instance()->get( 'assets_uri' ) . 'bundle.js', array( 'select2' ), time(), true );
		wp_enqueue_style( 'select2', OptionsHolder::get_instance()->get( 'assets_uri' ) . 'vendor/select2/css/select2.min.css', array(), time() );
		wp_enqueue_style( 'b2p-bundle', OptionsHolder::get_instance()->get( 'assets_uri' ) . 'bundle.css', array( 'select2' ), time() );
	}
}
