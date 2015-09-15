<?php

function admin_init_vcard()
{
	new recommend_plugin("mf_form/index.php", "MF Form", "//github.com/frostkom/mf_form");
}

function widgets_vcard()
{
	register_widget('widget_vcard');
}