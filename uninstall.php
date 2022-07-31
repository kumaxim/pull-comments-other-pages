<?php

defined( 'WP_UNINSTALL_PLUGIN' ) || die( 'Access restricted' );

require_once __DIR__ . '/vendor/autoload.php';

$pcop1_plugin_file = __DIR__ . '/pull-comments-other-pages.php';
KUMaxim\PullCommentsOtherPages\OptionsHolder::init( $pcop1_plugin_file );
$pcop1_post_meta_key = KUMaxim\PullCommentsOtherPages\OptionsHolder::get_instance()->get( 'post_meta_key' );

global $wpdb;

$wpdb->query(
	$wpdb->prepare( "DELETE FROM $wpdb->postmeta WHERE meta_key=%s", $pcop1_post_meta_key )
);
