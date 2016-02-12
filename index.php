<?php
/*
Plugin Name: MF vCard
Plugin URI: http://github.com/frostkom/mf_vcard
Description: 
Version: 1.2.0
Author: Martin Fors
Author URI: http://frostkom.se
*/

include_once("include/classes.php");
include_once("include/functions.php");

if(is_admin())
{
	add_action('admin_init', 'settings_vcard');
	add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'add_action_vcard');
	add_filter('network_admin_plugin_action_links_'.plugin_basename(__FILE__), 'add_action_vcard');
}

add_action('widgets_init', 'widgets_vcard');

add_action('admin_init', 'admin_init_vcard');

load_plugin_textdomain('lang_vcard', false, dirname(plugin_basename(__FILE__)).'/lang/');