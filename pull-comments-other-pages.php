<?php

/**
 * Plugin Name:       Pull Comments From Other Page(s)
 * Plugin URI:        https://github.com/kumaxim/pull-comments-other-pages
 * Description:       Allow to display comments from one page to another.
 * Requires at least: 5.9
 * Requires PHP:      7.3
 * Author:            Maxim Kudryavtsev
 * Author URI:        https://k-maxim.ru
 * Version:           1.0.0
 * Text Domain:       pull-comments-other-pages
 * Domain Path:       resources/languages
 *
 * Pull Comments From Other Page(s) is free software: you can redistribute it and/or modify
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

define( 'B2P_LANGUAGES_DIRECTORY_PATH', dirname( plugin_basename( __FILE__ ) ) . '/resources/languages' );

define( 'B2P_POST_META_KEY', 'b2p_source_object_id' );

function run_b2p_comments_555790ab17f466dc19563dcf9741509e35201d8f() {
	require_once __DIR__ . '/vendor/autoload.php';

	$metabox = new \KUMaxim\PullCommentsOtherPages\AdminMetaBox();
	add_action( 'add_meta_boxes', array( $metabox, 'add_meta_box' ) );
	add_action( 'save_post', array( $metabox, 'save' ), 10, 3 );
	add_action( 'admin_enqueue_scripts', array( $metabox, 'enqueue_scripts' ) );

	$comments_query = new \KUMaxim\PullCommentsOtherPages\CommentsQuery();
	add_filter( 'comments_template_query_args', array( $comments_query, 'change_args' ) );
	add_filter( 'get_comments_number', array( $comments_query, 'total_comments_number' ), 10, 2 );

	$lang_loader = new \KUMaxim\PullCommentsOtherPages\LanguageLoader();
	add_action( 'plugin_loaded', array( $lang_loader, 'load_text_domain' ) );
}

run_b2p_comments_555790ab17f466dc19563dcf9741509e35201d8f();
