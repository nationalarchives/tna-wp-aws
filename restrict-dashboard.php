<?php
/**
 * Plugin Name: TNA Restrict Dashboard
 * Plugin URI: https://github.com/nationalarchives/tna-restrict-dashboard
 * Description: The National Archives Restrict Dashboard Wordpress plugin.
 * Version: 1.0
 * Author: The National Archives
 * Author URI: https://github.com/nationalarchives
 * License: GPL2
 */

/* Included functions */
include 'functions.php';
include 'admin-settings.php';

/* add_action functions */
add_action( 'admin_init', 'dash_admin_page_settings' );
add_action( 'admin_menu', 'dash_add_menu_item' );
add_action( 'init', 'dash_restrict_ip' );
