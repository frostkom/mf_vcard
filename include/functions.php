<?php

function admin_init_vcard()
{
	new recommend_plugin(array('path' => "mf_form/index.php", 'name' => "MF Form", 'url' => "//github.com/frostkom/mf_form"));
}

function widgets_vcard()
{
	register_widget('widget_vcard');
}

function add_action_vcard($links)
{
	$links[] = "<a href='".admin_url('options-general.php?page=settings_mf_base#settings_vcard')."'>".__("Settings", 'lang_vcard')."</a>";

	return $links;
}

function settings_vcard()
{
	$options_area = "settings_vcard";

	add_settings_section($options_area, "", $options_area.'_callback', BASE_OPTIONS_PAGE);

	$arr_settings = array(
		"setting_vcard_icons" => __("Show icons", 'lang_vcard'),
	);

	foreach($arr_settings as $handle => $text)
	{
		add_settings_field($handle, $text, $handle."_callback", BASE_OPTIONS_PAGE, $options_area);

		register_setting(BASE_OPTIONS_PAGE, $handle);
	}
}

function settings_vcard_callback()
{
	echo settings_header('settings_vcard', __("vCard", 'lang_vcard'));
}

function setting_vcard_icons_callback()
{
	global $wpdb;

	$option = get_option('setting_vcard_icons');

	echo show_checkbox(array('name' => 'setting_vcard_icons', 'value' => '1', 'compare' => $option));
}