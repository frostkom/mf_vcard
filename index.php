<?php
/*
Plugin Name: MF vCard
Plugin URI: https://github.com/frostkom/mf_vcard
Description:
Version: 2.5.7
Licence: GPLv2 or later
Author: Martin Fors
Author URI: https://martinfors.se
Text Domain: lang_vcard
Domain Path: /lang

Depends: MF Base
GitHub Plugin URI: frostkom/mf_vcard
*/

if(!function_exists('is_plugin_active') || function_exists('is_plugin_active') && is_plugin_active("mf_base/index.php"))
{
	include_once("include/classes.php");

	$obj_vcard = new mf_vcard();

	if(is_admin())
	{
		register_uninstall_hook(__FILE__, 'uninstall_vcard');

		add_action('admin_init', array($obj_vcard, 'settings_vcard'));
	}

	else
	{
		add_action('wp_head', array($obj_vcard, 'wp_head'), 0);
	}

	add_action('widgets_init', array($obj_vcard, 'widgets_init'));

	load_plugin_textdomain('lang_vcard', false, dirname(plugin_basename(__FILE__))."/lang/");

	function uninstall_vcard()
	{
		mf_uninstall_plugin(array(
			'options' => array('setting_vcard_icons'),
		));
	}
}