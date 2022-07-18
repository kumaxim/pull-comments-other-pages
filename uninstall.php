<?php

defined( 'WP_UNINSTALL_PLUGIN' ) || die( 'Access restricted' );

require_once __DIR__ . '/pull-comments-other-pages.php';

global $wpdb;
$wpdb->query(
	$wpdb->prepare( "DELETE FROM $wpdb->postmeta WHERE meta_key=%s", B2P_POST_META_KEY )
);
