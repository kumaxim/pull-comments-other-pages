<?php

/**
 * Plugin Name:       Between Pages Comments
 * Plugin URI:        https://github.com/kumaxim/b2p-comments
 * Description:       Allow to display comments from one page to another.
 * Requires at least: 4.9
 * Requires PHP:      7.1
 * Author:            Maxim Kudryavtsev
 * Author URI:        https://k-maxim.ru
 * Version:           1.0.0
 * Text Domain:       b2p-comments
 * Domain Path:       assets/languages
 *
 * Between Pages Comments is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Between Pages Comments is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Between Pages Comments. If not, see <https://www.gnu.org/licenses/>.
 */

defined( 'ABSPATH' ) || die( 'Access restricted' );

define( 'B2P_ASSETS_DIRECTORY_URI', plugin_dir_url( __FILE__ ) . 'assets/' );

define( 'B2P_POST_META_KEY', 'b2p_source_object_id' );

function run_b2p_comments_555790ab17f466dc19563dcf9741509e35201d8f() {
	require_once __DIR__ . '/vendor/autoload.php';

	$metabox = new \B2PComments\AdminMetaBox();
	add_action( 'add_meta_boxes', array( $metabox, 'add_meta_box' ) );
	add_action( 'save_post', array( $metabox, 'save' ), 10, 3 );
	add_action( 'admin_enqueue_scripts', array( $metabox, 'enqueue_scripts' ) );

	$comments_query = new \B2PComments\CommentsQuery();
	add_filter( 'comments_template_query_args', array( $comments_query, 'change_args' ) );
	add_filter( 'get_comments_number', array( $comments_query, 'total_comments_number' ), 10, 2 );
}

run_b2p_comments_555790ab17f466dc19563dcf9741509e35201d8f();
