<?php

/*
 * Uninstall Support Ticket plugin.
 *
 * @package SupportTicket
 */

!defined('WP_UNINSTALL_PLUGIN') or die;

global $wpdb;

// Get the table prefix.
$table_prefix = $wpdb->prefix;

// Run the deletion queries.
$wpdb->query('DELETE FROM ' . $table_prefix . 'posts WHERE post_type = \'ticket\'');
$wpdb->query('DELETE FROM ' . $table_prefix . 'postmeta WHERE post_id NOT IN (SELECT id FROM ' . $table_prefix . 'posts)');
$wpdb->query('DELETE FROM ' . $table_prefix . 'term_relationships WHERE post_id NOT IN (SELECT id FROM ' . $table_prefix . 'posts)');
