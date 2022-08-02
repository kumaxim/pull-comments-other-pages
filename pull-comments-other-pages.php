<?php

/**
 * Plugin Name:       Pull Comments From Other Page(s)
 * Version:           1.0.1
 * Plugin URI:        https://github.com/kumaxim/pull-comments-other-pages
 * Description:       Allow to display comments from one page to another.
 * Tested up to:      6.0
 * Requires at least: 5.4
 * Requires PHP:      7.3
 * Author:            Maxim Kudryavtsev
 * Author URI:        https://k-maxim.ru
 * Text Domain:       pull-comments-other-pages
 * Domain Path:       assets/languages
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

function pcop1_plugin_bootstrap() {
	require_once __DIR__ . '/vendor/autoload.php';

	KUMaxim\PullCommentsOtherPages\OptionsHolder::init( __FILE__ );

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

pcop1_plugin_bootstrap();
