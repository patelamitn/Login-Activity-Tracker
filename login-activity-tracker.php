<?php
/*
Plugin Name: Login Activity Tracker
Description: Logs login activity, detects suspicious behavior, and provides alerts. Includes GeoIP tracking, exportable logs, admin settings, and IP banning.
Version: 1.2.0
Author: Amit Patel
*/

if (!defined('ABSPATH')) exit;

define('LAT_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('LAT_PLUGIN_URL', plugin_dir_url(__FILE__));

require_once LAT_PLUGIN_DIR . 'includes/class-lat-loader.php';

function lat_run_plugin() {
    $plugin = new LAT_Loader();
    $plugin->run();
}
lat_run_plugin();
