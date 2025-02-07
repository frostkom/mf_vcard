<?php

class mf_vcard
{
	function __construct(){}

	function block_render_callback($attributes)
	{
		if(!isset($attributes['vcard_heading'])){			$attributes['vcard_heading'] = '';}
		if(!isset($attributes['vcard_name'])){				$attributes['vcard_name'] = '';}
		if(!isset($attributes['vcard_company'])){			$attributes['vcard_company'] = '';}
		if(!isset($attributes['vcard_company_no'])){		$attributes['vcard_company_no'] = '';}
		if(!isset($attributes['vcard_map'])){				$attributes['vcard_map'] = 'no';}
		if(!isset($attributes['vcard_address_link'])){		$attributes['vcard_address_link'] = '';}
		if(!isset($attributes['vcard_address'])){			$attributes['vcard_address'] = '';}
		if(!isset($attributes['vcard_zipcode'])){			$attributes['vcard_zipcode'] = '';}
		if(!isset($attributes['vcard_city'])){				$attributes['vcard_city'] = '';}
		if(!isset($attributes['vcard_country'])){			$attributes['vcard_country'] = '';}
		if(!isset($attributes['vcard_phone'])){				$attributes['vcard_phone'] = '';}
		if(!isset($attributes['vcard_phone_show_number'])){	$attributes['vcard_phone_show_number'] = 'yes';}
		if(!isset($attributes['vcard_icon_shape'])){		$attributes['vcard_icon_shape'] = 'circle';}
		if(!isset($attributes['vcard_email'])){				$attributes['vcard_email'] = '';}
		if(!isset($attributes['vcard_url'])){				$attributes['vcard_url'] = '';}
		if(!isset($attributes['vcard_form'])){				$attributes['vcard_form'] = 0;}
		if(!isset($attributes['vcard_page'])){				$attributes['vcard_page'] = 0;}
		if(!isset($attributes['vcard_facebook'])){			$attributes['vcard_facebook'] = '';}
		if(!isset($attributes['vcard_instagram'])){			$attributes['vcard_instagram'] = '';}
		if(!isset($attributes['vcard_github'])){			$attributes['vcard_github'] = '';}
		if(!isset($attributes['vcard_linkedin'])){			$attributes['vcard_linkedin'] = '';}
		if(!isset($attributes['vcard_twitter'])){			$attributes['vcard_twitter'] = '';}

		$out = "";

		$setting_vcard_icons = get_option('setting_vcard_icons');

		$out .= "<div".parse_block_attributes(array('class' => "widget vcard", 'attributes' => $attributes)).">";

			if($attributes['vcard_heading'] != '')
			{
				$out .= "<h3>".$attributes['vcard_heading']."</h3>";
			}

			$out .= "<div class='section'>";

				if($attributes['vcard_name'] != '')
				{
					$out .= "<p class='fn'>"
						.($setting_vcard_icons ? "<i class='fa fa-user'></i> " : "")
						.$attributes['vcard_name']
					."</p>";
				}

				if($attributes['vcard_company'] != '')
				{
					$out .= "<p class='org'>"
						.($setting_vcard_icons ? "<i class='fa fa-building'></i> " : "")
						.$attributes['vcard_company'];

						if($attributes['vcard_company_no'] != '')
						{
							$out .= " <span>(".$attributes['vcard_company_no'].")</span>";
						}

					$out .= "</p>";
				}

				if($attributes['vcard_address'] != '' || $attributes['vcard_zipcode'] != '' || $attributes['vcard_city'] != '' || $attributes['vcard_country'] != '')
				{
					$out .= "<div class='adr'>";

						if($attributes['vcard_address'] != '')
						{
							$out .= "<p class='street-address'>"
								.($setting_vcard_icons ? "<i class='fa fa-envelope'></i> " : "");

								if($attributes['vcard_map'] == 'yes' && is_plugin_active("mf_maps/index.php") && get_option('setting_gmaps_api') != '')
								{
									$out .= get_toggler_container(array('type' => 'start', 'icon_first' => false, 'text' => $attributes['vcard_address']))
										//.get_map(array('input' => $attributes['vcard_address']." ".$attributes['vcard_city']))
										.apply_filters('get_map', '', array('input' => $attributes['vcard_address']." ".$attributes['vcard_city']))
									.get_toggler_container(array('type' => 'end'));
								}

								else
								{
									if($attributes['vcard_address_link'] != '')
									{
										$out .= "<a href='".$attributes['vcard_address_link']."'>";
									}

										$out .= $attributes['vcard_address'];

									if($attributes['vcard_address_link'] != '')
									{
										$out .= "</a>";
									}
								}

							$out .= "</p>";
						}

						if($attributes['vcard_zipcode'] != '' || $attributes['vcard_city'] != '' || $attributes['vcard_country'] != '')
						{
							$out .= "<p>"
								.($setting_vcard_icons ? "<i class='fa fa-globe'></i> " : "");

								if($attributes['vcard_zipcode'] != '')
								{
									$out .= "<span class='postal-code'>"
										.$attributes['vcard_zipcode']
									."</span>";
								}

								if($attributes['vcard_city'] != '')
								{
									$out .= ($attributes['vcard_zipcode'] != '' ? " " : "")
									."<span class='locality'>"
										.$attributes['vcard_city']
									."</span>";
								}

								if($attributes['vcard_country'] != '')
								{
									$out .= ($attributes['vcard_zipcode'] != '' || $attributes['vcard_city'] != '' ? ", " : "")
									."<span class='country-name'>"
										.$attributes['vcard_country']
									."</span>";
								}

							$out .= "</p>";
						}

					$out .= "</div>";
				}

				if($attributes['vcard_phone'] != '')
				{
					$show_number = $attributes['vcard_phone_show_number'] == 'yes';

					$out .= "<p class='contact tel'>
						<a href='".format_phone_no($attributes['vcard_phone'])."' class='value".($show_number ? "" : " hide_number")."'>"
							.($setting_vcard_icons || !$show_number ? "<i class='fa fa-phone'></i> " : "")
							."<span".($show_number ? "" : " class='hide'").">".$attributes['vcard_phone']."</span>"
							."<span".($show_number ? " class='hide'" : "").">".shorten_text(array('string' => $attributes['vcard_phone'], 'limit' => 5))."</span>"
						."</a>
					</p>";
				}

				if($attributes['vcard_email'] != '')
				{
					$out .= "<p class='contact email'>
						<a href='mailto:".$attributes['vcard_email']."' class='value'>"
							.($setting_vcard_icons ? "<i class='fa fa-envelope'></i> " : "")
							.$attributes['vcard_email']
						."</a>
					</p>";
				}

				if($attributes['vcard_url'] != '')
				{
					$out .= "<p class='contact url'>
						<a href='".$attributes['vcard_url']."' class='value'>"
							.($setting_vcard_icons ? "<i class='fa fa-globe'></i> " : "")
							.remove_protocol(array('url' => $attributes['vcard_url'], 'clean' => true))
						."</a>
					</p>";
				}

				$social_icons_temp = "";

				if($attributes['vcard_form'] > 0 && is_plugin_active('mf_form/index.php'))
				{
					global $obj_form;

					$form_url = $obj_form->get_form_url($attributes['vcard_form']);

					if($form_url != '' && $form_url != '#')
					{
						$social_icons_temp .= "<a href='".$form_url."'><i class='fa fa-envelope'></i></a>";
					}
				}

				if($attributes['vcard_page'] > 0)
				{
					$social_icons_temp .= "<a href='".get_permalink($attributes['vcard_page'])."'><i class='fa fa-envelope'></i></a>";
				}

				if($attributes['vcard_facebook'] != '')
				{
					$social_icons_temp .= "<a href='//facebook.com/".$attributes['vcard_facebook']."'><i class='fab fa-facebook-f'></i></a>";
				}

				if($attributes['vcard_instagram'] != '')
				{
					$social_icons_temp .= "<a href='//instagram.com/".$attributes['vcard_instagram']."'><i class='fab fa-instagram'></i></a>";
				}

				if($attributes['vcard_github'] != '')
				{
					$social_icons_temp .= "<a href='//github.com/".$attributes['vcard_github']."'><i class='fab fa-github'></i></a>";
				}

				if($attributes['vcard_linkedin'] != '')
				{
					$social_icons_temp .= "<a href='//linkedin.com/in/".$attributes['vcard_linkedin']."'><i class='fab fa-linkedin-in'></i></a>";
				}

				if($attributes['vcard_twitter'] != '')
				{
					$social_icons_temp .= "<a href='//twitter.com/".$attributes['vcard_twitter']."'><i class='fab fa-twitter'></i></a>";
				}

				if($social_icons_temp != '')
				{
					$out .= "<p class='social ".$attributes['vcard_icon_shape'].(in_array($attributes['vcard_icon_shape'], array('circle', 'rectangle')) ? " colorize" : "")."'>".$social_icons_temp."</p>";
				}

			$out .= "</div>
		</div>";

		return $out;
	}

	function get_icon_shapes_for_select()
	{
		return array(
			'' => "-- ".__("None", 'lang_vcard')." --",
			'circle' => __("Circle", 'lang_vcard'),
			'rectangle' => __("Rectangle", 'lang_vcard'),
		);
	}

	function init()
	{
		load_plugin_textdomain('lang_vcard', false, str_replace("/include", "", dirname(plugin_basename(__FILE__)))."/lang/");

		// Blocks
		#######################
		$plugin_include_url = plugin_dir_url(__FILE__);
		$plugin_version = get_plugin_version(__FILE__);

		wp_register_script('script_vcard_block_wp', $plugin_include_url."block/script_wp.js", array('wp-blocks', 'wp-element', 'wp-components', 'wp-editor', 'wp-block-editor'), $plugin_version, true);

		$arr_data = array();
		get_post_children(array('add_choose_here' => true), $arr_data);

		wp_localize_script('script_vcard_block_wp', 'script_vcard_block_wp', array(
			'block_title' => __("vCard", 'lang_vcard'),
			'block_description' => __("Display a vCard with custom information", 'lang_vcard'),
			'vcard_heading_label' => __("Heading", 'lang_vcard'),
			'vcard_name_label' => __("Name", 'lang_vcard'),
			'vcard_company_label' => __("Organization", 'lang_vcard'),
			'vcard_company_no_label' => __("Organization Number", 'lang_vcard'),
			'vcard_map_label' => __("Show Map", 'lang_vcard'),
			'yes_no_for_select' => get_yes_no_for_select(),
			'vcard_address_link_label' => __("Link", 'lang_vcard'),
			'vcard_address_label' => __("Street Address", 'lang_vcard'),
			'vcard_zipcode_label' => __("Zip Code", 'lang_vcard'),
			'vcard_city_label' => __("City", 'lang_vcard'),
			'vcard_country_label' => __("Country", 'lang_vcard'),
			'vcard_phone_label' => __("Phone Number", 'lang_vcard'),
			'vcard_phone_show_number_label' => __("Show Full Number", 'lang_vcard'),
			'vcard_icon_shape_label' => __("Icon Shape", 'lang_vcard'),
			'vcard_icon_shape' => $this->get_icon_shapes_for_select(),
			'vcard_email_label' => __("E-mail", 'lang_vcard'),
			'vcard_page_label' => __("E-mail Page", 'lang_vcard'),
			'vcard_page' => $arr_data,
			'vcard_url_label' => __("URL", 'lang_vcard'),
			'vcard_facebook_label' => __("Facebook", 'lang_vcard'),
			'vcard_instagram_label' => __("Instagram", 'lang_vcard'),
			'vcard_github_label' => __("GitHub", 'lang_vcard'),
			'vcard_linkedin_label' => __("LinkedIn", 'lang_vcard'),
			'vcard_twitter_label' => __("Twitter", 'lang_vcard'),
		));

		register_block_type('mf/vcard', array(
			'editor_script' => 'script_vcard_block_wp',
			'editor_style' => 'style_base_block_wp',
			'render_callback' => array($this, 'block_render_callback'),
			//'style' => 'style_base_block_wp',
		));
		#######################
	}

	function settings_vcard()
	{
		$options_area = __FUNCTION__;

		add_settings_section($options_area, "", array($this, $options_area.'_callback'), BASE_OPTIONS_PAGE);

		$arr_settings = array(
			'setting_vcard_icons' => __("Display Icons", 'lang_vcard'),
		);

		show_settings_fields(array('area' => $options_area, 'object' => $this, 'settings' => $arr_settings));
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

	function wp_head()
	{
		if(apply_filters('get_block_search', 'mf/vcard') > 0 || !is_plugin_active("mf_widget_logic_select/index.php") || apply_filters('get_widget_search', 'widget-vcard') > 0)
		{
			$plugin_include_url = plugin_dir_url(__FILE__);

			mf_enqueue_style('style_vcard', $plugin_include_url."style.css");
			mf_enqueue_script('script_vcard', $plugin_include_url."script.js");
		}
	}

	function widgets_init()
	{
		register_widget('widget_vcard');
	}
}

class widget_vcard extends WP_Widget
{
	var $widget_ops;
	var $arr_default = array(
		'vcard_heading' => "",
		'vcard_name' => "",
		'vcard_company' => "",
		'vcard_company_no' => "",
		'vcard_map' => 'no',
		'vcard_address_link' => '',
		'vcard_address' => "",
		'vcard_zipcode' => "",
		'vcard_city' => "",
		'vcard_country' => "",
		'vcard_phone' => "",
		'vcard_phone_show_number' => 'yes',
		'vcard_icon_shape' => 'circle',
		'vcard_email' => "",
		'vcard_url' => "",
		'vcard_form' => 0,
		'vcard_page' => 0,
		'vcard_facebook' => "",
		'vcard_instagram' => "",
		'vcard_github' => "",
		'vcard_linkedin' => "",
		'vcard_twitter' => "",
	);

	function __construct()
	{
		$this->widget_ops = array(
			'classname' => 'vcard',
			'description' => __("Display a vCard with custom information", 'lang_vcard'),
		);

		parent::__construct('widget-'.$this->widget_ops['classname'], __("vCard", 'lang_vcard'), $this->widget_ops);
	}

	function widget($args, $instance)
	{
		extract($args);
		$instance = wp_parse_args((array)$instance, $this->arr_default);

		$setting_vcard_icons = get_option('setting_vcard_icons');

		echo apply_filters('filter_before_widget', $before_widget);

			if($instance['vcard_heading'] != '')
			{
				$instance['vcard_heading'] = apply_filters('widget_title', $instance['vcard_heading'], $instance, $this->id_base);

				echo $before_title
					.$instance['vcard_heading']
				.$after_title;
			}

			echo "<div class='section'>";

				if($instance['vcard_name'] != '')
				{
					echo "<p class='fn'>"
						.($setting_vcard_icons ? "<i class='fa fa-user'></i> " : "")
						.$instance['vcard_name']
					."</p>";
				}

				if($instance['vcard_company'] != '')
				{
					echo "<p class='org'>"
						.($setting_vcard_icons ? "<i class='fa fa-building'></i> " : "")
						.$instance['vcard_company'];

						if($instance['vcard_company_no'] != '')
						{
							echo " <span>(".$instance['vcard_company_no'].")</span>";
						}

					echo "</p>";
				}

				if($instance['vcard_address'] != '' || $instance['vcard_zipcode'] != '' || $instance['vcard_city'] != '' || $instance['vcard_country'] != '')
				{
					echo "<div class='adr'>";

						if($instance['vcard_address'] != '')
						{
							echo "<p class='street-address'>"
								.($setting_vcard_icons ? "<i class='fa fa-envelope'></i> " : "");

								if($instance['vcard_map'] == 'yes' && is_plugin_active("mf_maps/index.php") && get_option('setting_gmaps_api') != '')
								{
									echo get_toggler_container(array('type' => 'start', 'icon_first' => false, 'text' => $instance['vcard_address']))
										//.get_map(array('input' => $instance['vcard_address']." ".$instance['vcard_city']))
										.apply_filters('get_map', '', array('input' => $instance['vcard_address']." ".$instance['vcard_city']))
									.get_toggler_container(array('type' => 'end'));
								}

								else
								{
									if($instance['vcard_address_link'] != '')
									{
										echo "<a href='".$instance['vcard_address_link']."'>";
									}

										echo $instance['vcard_address'];

									if($instance['vcard_address_link'] != '')
									{
										echo "</a>";
									}
								}

							echo "</p>";
						}

						if($instance['vcard_zipcode'] != '' || $instance['vcard_city'] != '' || $instance['vcard_country'] != '')
						{
							echo "<p>"
								.($setting_vcard_icons ? "<i class='fa fa-globe'></i> " : "");

								if($instance['vcard_zipcode'] != '')
								{
									echo "<span class='postal-code'>"
										.$instance['vcard_zipcode']
									."</span>";
								}

								if($instance['vcard_city'] != '')
								{
									echo ($instance['vcard_zipcode'] != '' ? " " : "")
									."<span class='locality'>"
										.$instance['vcard_city']
									."</span>";
								}

								if($instance['vcard_country'] != '')
								{
									echo ($instance['vcard_zipcode'] != '' || $instance['vcard_city'] != '' ? ", " : "")
									."<span class='country-name'>"
										.$instance['vcard_country']
									."</span>";
								}

							echo "</p>";
						}

					echo "</div>";
				}

				if($instance['vcard_phone'] != '')
				{
					$show_number = $instance['vcard_phone_show_number'] == 'yes';

					echo "<p class='contact tel'>
						<a href='".format_phone_no($instance['vcard_phone'])."' class='value".($show_number ? "" : " hide_number")."'>"
							.($setting_vcard_icons || !$show_number ? "<i class='fa fa-phone'></i> " : "")
							."<span".($show_number ? "" : " class='hide'").">".$instance['vcard_phone']."</span>"
							."<span".($show_number ? " class='hide'" : "").">".shorten_text(array('string' => $instance['vcard_phone'], 'limit' => 5))."</span>"
						."</a>
					</p>";
				}

				if($instance['vcard_email'] != '')
				{
					echo "<p class='contact email'>
						<a href='mailto:".$instance['vcard_email']."' class='value'>"
							.($setting_vcard_icons ? "<i class='fa fa-envelope'></i> " : "")
							.$instance['vcard_email']
						."</a>
					</p>";
				}

				if($instance['vcard_url'] != '')
				{
					echo "<p class='contact url'>
						<a href='".$instance['vcard_url']."' class='value'>"
							.($setting_vcard_icons ? "<i class='fa fa-globe'></i> " : "")
							.remove_protocol(array('url' => $instance['vcard_url'], 'clean' => true))
						."</a>
					</p>";
				}

				$social_icons_temp = "";

				if($instance['vcard_form'] > 0 && is_plugin_active('mf_form/index.php'))
				{
					global $obj_form;

					$form_url = $obj_form->get_form_url($instance['vcard_form']);

					if($form_url != '' && $form_url != '#')
					{
						$social_icons_temp .= "<a href='".$form_url."'><i class='fa fa-envelope'></i></a>";
					}
				}

				if($instance['vcard_page'] > 0)
				{
					$social_icons_temp .= "<a href='".get_permalink($instance['vcard_page'])."'><i class='fa fa-envelope'></i></a>";
				}

				if($instance['vcard_facebook'] != '')
				{
					$social_icons_temp .= "<a href='//facebook.com/".$instance['vcard_facebook']."'><i class='fab fa-facebook-f'></i></a>";
				}

				if($instance['vcard_instagram'] != '')
				{
					$social_icons_temp .= "<a href='//instagram.com/".$instance['vcard_instagram']."'><i class='fab fa-instagram'></i></a>";
				}

				if($instance['vcard_github'] != '')
				{
					$social_icons_temp .= "<a href='//github.com/".$instance['vcard_github']."'><i class='fab fa-github'></i></a>";
				}

				if($instance['vcard_linkedin'] != '')
				{
					$social_icons_temp .= "<a href='//linkedin.com/in/".$instance['vcard_linkedin']."'><i class='fab fa-linkedin-in'></i></a>";
				}

				if($instance['vcard_twitter'] != '')
				{
					$social_icons_temp .= "<a href='//twitter.com/".$instance['vcard_twitter']."'><i class='fab fa-twitter'></i></a>";
				}

				if($social_icons_temp != '')
				{
					echo "<p class='social ".$instance['vcard_icon_shape'].(in_array($instance['vcard_icon_shape'], array('circle', 'rectangle')) ? " colorize" : "")."'>".$social_icons_temp."</p>";
				}

			echo "</div>"
		.$after_widget;
	}

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

	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$new_instance = wp_parse_args((array)$new_instance, $this->arr_default);

		$instance['vcard_heading'] = sanitize_text_field($new_instance['vcard_heading']);
		$instance['vcard_name'] = sanitize_text_field($new_instance['vcard_name']);
		$instance['vcard_company'] = sanitize_text_field($new_instance['vcard_company']);
		$instance['vcard_company_no'] = sanitize_text_field($new_instance['vcard_company_no']);
		$instance['vcard_map'] = sanitize_text_field($new_instance['vcard_map']);
		$instance['vcard_address_link'] = sanitize_text_field($new_instance['vcard_address_link']);
		$instance['vcard_address'] = sanitize_text_field($new_instance['vcard_address']);
		$instance['vcard_zipcode'] = sanitize_text_field($new_instance['vcard_zipcode']);
		$instance['vcard_city'] = sanitize_text_field($new_instance['vcard_city']);
		$instance['vcard_country'] = sanitize_text_field($new_instance['vcard_country']);
		$instance['vcard_phone'] = sanitize_text_field($new_instance['vcard_phone']);
		$instance['vcard_phone_show_number'] = sanitize_text_field($new_instance['vcard_phone_show_number']);
		$instance['vcard_icon_shape'] = sanitize_text_field($new_instance['vcard_icon_shape']);
		$instance['vcard_email'] = sanitize_text_field($new_instance['vcard_email']);
		$instance['vcard_url'] = sanitize_text_field($new_instance['vcard_url']);
		$instance['vcard_form'] = sanitize_text_field($new_instance['vcard_form']);
		$instance['vcard_page'] = sanitize_text_field($new_instance['vcard_page']);
		$instance['vcard_facebook'] = sanitize_text_field($new_instance['vcard_facebook']);
		$instance['vcard_instagram'] = sanitize_text_field($new_instance['vcard_instagram']);
		$instance['vcard_github'] = sanitize_text_field($new_instance['vcard_github']);
		$instance['vcard_linkedin'] = sanitize_text_field($new_instance['vcard_linkedin']);
		$instance['vcard_twitter'] = sanitize_text_field($new_instance['vcard_twitter']);

		$instance['vcard_facebook'] = $this->filter_social_url($instance['vcard_facebook']);
		$instance['vcard_instagram'] = $this->filter_social_url($instance['vcard_instagram']);
		$instance['vcard_github'] = $this->filter_social_url($instance['vcard_github']);
		$instance['vcard_linkedin'] = $this->filter_social_url($instance['vcard_linkedin']);
		$instance['vcard_twitter'] = $this->filter_social_url($instance['vcard_twitter']);

		return $instance;
	}

	function get_icon_shapes_for_select()
	{
		return array(
			'' => "-- ".__("None", 'lang_vcard')." --",
			'circle' => __("Circle", 'lang_vcard'),
			'rectangle' => __("Rectangle", 'lang_vcard'),
		);
	}

	function form($instance)
	{
		$instance = wp_parse_args((array)$instance, $this->arr_default);

		echo "<div class='mf_form'>"
			.show_textfield(array('name' => $this->get_field_name('vcard_heading'), 'text' => __("Heading", 'lang_vcard'), 'value' => $instance['vcard_heading'], 'xtra' => " id='".$this->widget_ops['classname']."-title'"))
			.show_textfield(array('name' => $this->get_field_name('vcard_name'), 'text' => __("Name", 'lang_vcard'), 'value' => $instance['vcard_name']))
			."<div class='flex_flow'>"
				.show_textfield(array('name' => $this->get_field_name('vcard_company'), 'text' => __("Organization", 'lang_vcard'), 'value' => $instance['vcard_company']));

				if($instance['vcard_company'] != '')
				{
					echo show_textfield(array('name' => $this->get_field_name('vcard_company_no'), 'text' => __("Organization Number", 'lang_vcard'), 'value' => $instance['vcard_company_no']));
				}

			echo "</div>"
			.get_toggler_container(array('type' => 'start', 'open' => ($instance['vcard_address'] != '' || $instance['vcard_zipcode'] != '' || $instance['vcard_city'] != '' || $instance['vcard_country'] != ''), 'text' => __("Address", 'lang_vcard')));

				if(is_plugin_active("mf_maps/index.php") && get_option('setting_gmaps_api') != '')
				{
					echo show_select(array('data' => get_yes_no_for_select(), 'name' => $this->get_field_name('vcard_map'), 'text' => __("Show Map", 'lang_vcard'), 'value' => $instance['vcard_map']));
				}

				else if($instance['vcard_address'] != '')
				{
					echo show_textfield(array('type' => 'url', 'name' => $this->get_field_name('vcard_address_link'), 'text' => __("Link", 'lang_vcard'), 'value' => $instance['vcard_address_link']));
				}

				echo show_textfield(array('name' => $this->get_field_name('vcard_address'), 'text' => __("Street Address", 'lang_vcard'), 'value' => $instance['vcard_address']))
				."<div class='flex_flow'>"
					.show_textfield(array('type' => 'number', 'name' => $this->get_field_name('vcard_zipcode'), 'text' => __("Zip Code", 'lang_vcard'), 'value' => $instance['vcard_zipcode']))
					.show_textfield(array('name' => $this->get_field_name('vcard_city'), 'text' => __("City", 'lang_vcard'), 'value' => $instance['vcard_city']))
				."</div>";

				if($instance['vcard_city'] != '')
				{
					echo show_textfield(array('name' => $this->get_field_name('vcard_country'), 'text' => __("Country", 'lang_vcard'), 'value' => $instance['vcard_country']));
				}

			echo get_toggler_container(array('type' => 'end'))
			.show_textfield(array('name' => $this->get_field_name('vcard_phone'), 'text' => __("Phone Number", 'lang_vcard'), 'value' => $instance['vcard_phone']));

			if($instance['vcard_phone'] != '')
			{
				echo show_select(array('data' => get_yes_no_for_select(), 'name' => $this->get_field_name('vcard_phone_show_number'), 'text' => __("Show Full Number", 'lang_vcard'), 'value' => $instance['vcard_phone_show_number']));
			}

			echo show_select(array('data' => $this->get_icon_shapes_for_select(), 'name' => $this->get_field_name('vcard_icon_shape'), 'text' => __("Icon Shape", 'lang_vcard'), 'value' => $instance['vcard_icon_shape']));

			if(!($instance['vcard_form'] > 0) && !($instance['vcard_page'] > 0))
			{
				echo show_textfield(array('name' => $this->get_field_name('vcard_email'), 'text' => __("E-mail", 'lang_vcard'), 'value' => $instance['vcard_email']));
			}

			if($instance['vcard_email'] == '' && is_plugin_active("mf_form/index.php"))
			{
				global $obj_form;

				if(!isset($obj_form))
				{
					$obj_form = new mf_form();
				}

				$arr_data = $obj_form->get_for_select();

				if(count($arr_data) > 1)
				{
					echo show_select(array('data' => $arr_data, 'name' => $this->get_field_name('vcard_form'), 'text' => __("E-mail Form", 'lang_vcard'), 'value' => $instance['vcard_form']));
				}

				else
				{
					$arr_data = array();
					get_post_children(array('add_choose_here' => true), $arr_data);

					echo show_select(array('data' => $arr_data, 'name' => $this->get_field_name('vcard_page'), 'text' => __("E-mail Form", 'lang_vcard'), 'value' => $instance['vcard_page']));
				}
			}

			echo show_textfield(array('type' => 'url', 'name' => $this->get_field_name('vcard_url'), 'text' => __("URL", 'lang_vcard'), 'value' => $instance['vcard_url']))
			.get_toggler_container(array('type' => 'start', 'open' => ($instance['vcard_facebook'] != '' || $instance['vcard_instagram'] != '' || $instance['vcard_github'] != '' || $instance['vcard_linkedin'] != '' || $instance['vcard_twitter'] != ''), 'text' => __("Social Media", 'lang_vcard')))
				.show_textfield(array('name' => $this->get_field_name('vcard_facebook'), 'text' => "Facebook", 'value' => $instance['vcard_facebook']))
				.show_textfield(array('name' => $this->get_field_name('vcard_instagram'), 'text' => "Instagram", 'value' => $instance['vcard_instagram']))
				.show_textfield(array('name' => $this->get_field_name('vcard_github'), 'text' => "GitHub", 'value' => $instance['vcard_github']))
				.show_textfield(array('name' => $this->get_field_name('vcard_linkedin'), 'text' => "LinkedIn", 'value' => $instance['vcard_linkedin']))
				.show_textfield(array('name' => $this->get_field_name('vcard_twitter'), 'text' => "Twitter", 'value' => $instance['vcard_twitter']))
			.get_toggler_container(array('type' => 'end'))
		."</div>";
	}
}