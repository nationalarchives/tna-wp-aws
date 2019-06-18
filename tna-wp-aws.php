<?php
/**
 * Plugin Name: TNA WordPress for AWS
 * Plugin URI: https://github.com/nationalarchives/tna-wp-aws
 * Description: The National Archives Wordpress for AWS plugin.
 * Version: 1.0
 * Author: The National Archives
 * Author URI: https://github.com/nationalarchives
 * License: GPL2
 */

/* Included functions */
include 'functions.php';
include 'admin-page.php';
include 'restrict-dashboard.php';

/* add_action functions */
add_action( 'admin_init', 'tna_aws_admin_page_settings' );
add_action( 'admin_menu', 'tna_aws_add_menu_item' );
add_action( 'init', 'rd_restrict_dashboard' );
