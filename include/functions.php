<?php

function admin_init_vcard()
{
	new recommend_plugin(array('path' => "mf_form/index.php", 'name' => "MF Form", 'url' => "//github.com/frostkom/mf_form"));
}

function widgets_vcard()
{
	register_widget('widget_vcard');
}