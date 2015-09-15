<?php
/*
Plugin Name: MF vCard
Plugin URI: www.github.com/frostkom/mf_vcard
Version: 1.0.2
Author: Martin Fors
Author URI: www.frostkom.se
*/

add_action('widgets_init', 'widgets_vcard');

load_plugin_textdomain('lang_vcard', false, dirname(plugin_basename(__FILE__)).'/lang/');

include("include/classes.php");
include("include/functions.php");