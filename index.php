<?php
/*
Plugin Name: MF vCard
Plugin URI: http://github.com/frostkom/mf_vcard
Description: 
Version: 1.0.9
Author: Martin Fors
Author URI: http://frostkom.se
*/

include_once("include/classes.php");
include_once("include/functions.php");

add_action('widgets_init', 'widgets_vcard');

add_action('admin_init', 'admin_init_vcard');

load_plugin_textdomain('lang_vcard', false, dirname(plugin_basename(__FILE__)).'/lang/');