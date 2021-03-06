<?php

function filter_social_url($in)
{
	if(preg_match("/\//", $in))
	{
		$arr_url = explode("/", trim($in, "/"));

		$in = $arr_url[count($arr_url) - 1];
	}

	if(substr($in, 0, 1) == "@")
	{
		$in = substr($in, 1);
	}

	return $in;
}

function widgets_vcard()
{
	register_widget('widget_vcard');
}

function settings_vcard()
{
	$options_area = __FUNCTION__;

	add_settings_section($options_area, "", $options_area.'_callback', BASE_OPTIONS_PAGE);

	$arr_settings = array(
		'setting_vcard_icons' => __("Display Icons", 'lang_vcard'),
	);

	show_settings_fields(array('area' => $options_area, 'settings' => $arr_settings));
}

function settings_vcard_callback()
{
	$setting_key = get_setting_key(__FUNCTION__);

	echo settings_header($setting_key, __("vCard", 'lang_vcard'));
}

function setting_vcard_icons_callback()
{
	$setting_key = get_setting_key(__FUNCTION__);
	$option = get_option($setting_key);

	echo show_select(array('data' => get_yes_no_for_select(array('return_integer' => true)), 'name' => $setting_key, 'value' => $option, 'suffix' => __("Phone Number, Email, URL etc.", 'lang_vcard')));
}