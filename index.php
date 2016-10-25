<?php
/*
Plugin Name: MF vCard
Plugin URI: https://github.com/frostkom/mf_vcard
Description: 
Version: 1.3.12
Author: Martin Fors
Author URI: http://frostkom.se
Text Domain: lang_vcard
Domain Path: /lang

GitHub Plugin URI: frostkom/mf_vcard
*/

include_once("include/classes.php");
include_once("include/functions.php");

if(is_admin())
{
	register_uninstall_hook(__FILE__, 'uninstall_vcard');

	add_action('admin_init', 'admin_init_vcard');
	add_action('admin_init', 'settings_vcard');
}

add_action('widgets_init', 'widgets_vcard');

load_plugin_textdomain('lang_vcard', false, dirname(plugin_basename(__FILE__)).'/lang/');

function uninstall_vcard()
{
	mf_uninstall_plugin(array(
		'options' => array('setting_vcard_icons'),
	));
}