<?php


namespace KUMaxim\PullCommentsOtherPages;


class CommentsQuery {
	public function change_args( $comment_args ) {
		global $post;

		$additional_posts = get_post_meta( $post->ID, OptionsHolder::get_instance()->get( 'post_meta_key' ), true );

		if ( ! empty( $additional_posts ) && is_array( $additional_posts ) ) {
			unset( $comment_args['post_id'] );
			$comment_args['post__in'] = array_merge( array( $post->ID ), $additional_posts );
		}

		return $comment_args;
	}

	public function total_comments_number( $count, $post_id ) {
		global $wp_query;

		if ( ( $wp_query instanceof \WP_Query ) && property_exists( $wp_query, 'comment_count' ) ) {
			$count = $wp_query->comment_count;
		}

		return $count;
	}
}
