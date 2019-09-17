<?php
/*
Plugin Name: MF vCard
Plugin URI: https://github.com/frostkom/mf_vcard
Description: 
Version: 2.4.33
Licence: GPLv2 or later
Author: Martin Fors
Author URI: https://frostkom.se
Text Domain: lang_vcard
Domain Path: /lang

Depends: MF Base
GitHub Plugin URI: frostkom/mf_vcard
*/

include_once("include/classes.php");
include_once("include/functions.php");

$obj_vcard = new mf_vcard();

if(is_admin())
{
	register_uninstall_hook(__FILE__, 'uninstall_vcard');

	add_action('admin_init', 'settings_vcard');
}

else
{
	add_action('wp_head', array($obj_vcard, 'wp_head'), 0);
}

add_action('widgets_init', 'widgets_vcard');

load_plugin_textdomain('lang_vcard', false, dirname(plugin_basename(__FILE__)).'/lang/');

function uninstall_vcard()
{
	mf_uninstall_plugin(array(
		'options' => array('setting_vcard_icons'),
	));
}