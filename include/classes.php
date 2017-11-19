<?php

class widget_vcard extends WP_Widget
{
	function __construct()
	{
		$widget_ops = array(
			'classname' => 'vcard',
			'description' => __("Display a vCard with custom information", 'lang_vcard')
		);

		$this->arr_default = array(
			'vcard_heading' => "",
			'vcard_name' => "",
			'vcard_company' => "",
			'vcard_company_no' => "",
			'vcard_map' => 'no',
			'vcard_address' => "",
			'vcard_zipcode' => "",
			'vcard_city' => "",
			'vcard_country' => "",
			'vcard_phone' => "",
			'vcard_phone_show_number' => 'yes',
			'vcard_icon_shape' => 'circle',
			'vcard_email' => "",
			'vcard_url' => "",
			'vcard_form' => "",
			'vcard_facebook' => "",
			'vcard_gplus' => "",
			'vcard_instagram' => "",
			'vcard_linkedin' => "",
			'vcard_twitter' => "",
		);

		parent::__construct('widget-vcard', __("vCard", 'lang_vcard'), $widget_ops);
	}

	function widget($args, $instance)
	{
		extract($args);

		$instance = wp_parse_args((array)$instance, $this->arr_default);

		$setting_vcard_icons = get_option('setting_vcard_icons');

		echo $before_widget;

			if($instance['vcard_heading'] != '')
			{
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
								.($setting_vcard_icons ? "<i class='fa fa-envelope-o'></i> " : "");

								if($instance['vcard_map'] == 'yes' && is_plugin_active("mf_maps/index.php"))
								{
									echo get_toggler_container(array('type' => 'start', 'icon_first' => false, 'text' => $instance['vcard_address']))
										.get_map(array('input' => $instance['vcard_address']." ".$instance['vcard_city']))
									.get_toggler_container(array('type' => 'end'));
								}

								else
								{
									echo $instance['vcard_address'];
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
							.mf_clean_url($instance['vcard_url'])
						."</a>
					</p>";
				}

				if($instance['vcard_form'] != '' || $instance['vcard_facebook'] != '' || $instance['vcard_gplus'] != '' || $instance['vcard_instagram'] != '' || $instance['vcard_linkedin'] != '' || $instance['vcard_twitter'] != '')
				{
					echo "<p class='social".($instance['vcard_icon_shape'] != '' ? " ".$instance['vcard_icon_shape'] : "")."'>";

						if($instance['vcard_form'] > 0)
						{
							$form_url = get_form_url($instance['vcard_form']);

							if($form_url != '' && $form_url != '#')
							{
								echo "<a href='".$form_url."' rel='".$instance['vcard_form']."'><i class='fa fa-envelope'></i></a>";
							}
						}

						if($instance['vcard_facebook'] != '')
						{
							echo "<a href='//facebook.com/".$instance['vcard_facebook']."'><i class='fa fa-facebook'></i></a>";
						}

						if($instance['vcard_gplus'] != '')
						{
							echo "<a href='//plus.google.com/".$instance['vcard_gplus']."'><i class='fa fa-google-plus'></i></a>";
						}

						if($instance['vcard_instagram'] != '')
						{
							echo "<a href='//instagram.com/".$instance['vcard_instagram']."'><i class='fa fa-instagram'></i></a>";
						}

						if($instance['vcard_linkedin'] != '')
						{
							echo "<a href='//linkedin.com/in/".$instance['vcard_linkedin']."'><i class='fa fa-linkedin'></i></a>";
						}

						if($instance['vcard_twitter'] != '')
						{
							echo "<a href='//twitter.com/".$instance['vcard_twitter']."'><i class='fa fa-twitter'></i></a>";
						}

					echo "</p>";
				}

			echo "</div>"
		.$after_widget;
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
		$instance['vcard_facebook'] = sanitize_text_field($new_instance['vcard_facebook']);
		$instance['vcard_gplus'] = sanitize_text_field($new_instance['vcard_gplus']);
		$instance['vcard_instagram'] = sanitize_text_field($new_instance['vcard_instagram']);
		$instance['vcard_linkedin'] = sanitize_text_field($new_instance['vcard_linkedin']);
		$instance['vcard_twitter'] = sanitize_text_field($new_instance['vcard_twitter']);

		$instance['vcard_facebook'] = filter_social_url($instance['vcard_facebook']);
		$instance['vcard_gplus'] = filter_social_url($instance['vcard_gplus']);
		$instance['vcard_instagram'] = filter_social_url($instance['vcard_instagram']);
		$instance['vcard_linkedin'] = filter_social_url($instance['vcard_linkedin']);
		$instance['vcard_twitter'] = filter_social_url($instance['vcard_twitter']);

		return $instance;
	}

	function form($instance)
	{
		$instance = wp_parse_args((array)$instance, $this->arr_default);

		echo "<div class='mf_form'>"
			.show_textfield(array('name' => $this->get_field_name('vcard_heading'), 'text' => __("Heading", 'lang_vcard'), 'value' => $instance['vcard_heading']))
			.show_textfield(array('name' => $this->get_field_name('vcard_name'), 'text' => __("Name", 'lang_vcard'), 'value' => $instance['vcard_name']))
			."<div class='flex_flow'>"
				.show_textfield(array('name' => $this->get_field_name('vcard_company'), 'text' => __("Organization", 'lang_vcard'), 'value' => $instance['vcard_company']));

				if($instance['vcard_company'] != '')
				{
					echo show_textfield(array('name' => $this->get_field_name('vcard_company_no'), 'text' => __("Organization Number", 'lang_vcard'), 'value' => $instance['vcard_company_no']));
				}

			echo "</div>";

			$is_toggler_open = $instance['vcard_address'] != '' || $instance['vcard_zipcode'] != '' || $instance['vcard_city'] != '' || $instance['vcard_country'] != '';

			echo get_toggler_container(array('type' => 'start', 'open' => $is_toggler_open, 'text' => __("Address", 'lang_vcard')));

				if(is_plugin_active("mf_maps/index.php"))
				{
					echo show_select(array('data' => get_yes_no_for_select(), 'name' => $this->get_field_name('vcard_map'), 'text' => __("Show Map", 'lang_vcard'), 'value' => $instance['vcard_map']));
				}

				echo show_textfield(array('name' => $this->get_field_name('vcard_address'), 'text' => __("Street Address", 'lang_vcard'), 'value' => $instance['vcard_address']))
				."<div class='flex_flow'>"
					.show_textfield(array('name' => $this->get_field_name('vcard_zipcode'), 'text' => __("Zip Code", 'lang_vcard'), 'value' => $instance['vcard_zipcode']))
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

			$arr_data = array();
			$arr_data['rectangle'] = __("Rectangle", 'lang_vcard');
			$arr_data['circle'] = __("Circle", 'lang_vcard');

			echo show_select(array('data' => $arr_data, 'name' => $this->get_field_name('vcard_icon_shape'), 'text' => __("Icon Shape", 'lang_vcard'), 'value' => $instance['vcard_icon_shape']));

			if(!($instance['vcard_form'] > 0))
			{
				echo show_textfield(array('name' => $this->get_field_name('vcard_email'), 'text' => __("E-mail", 'lang_vcard'), 'value' => $instance['vcard_email']));
			}

			if($instance['vcard_email'] == '' && is_plugin_active("mf_form/index.php"))
			{
				$obj_form = new mf_form();
				$arr_data = $obj_form->get_form_array(array('local_only' => true));

				if(count($arr_data) > 1)
				{
					echo show_select(array('data' => $arr_data, 'name' => $this->get_field_name('vcard_form'), 'text' => __("E-mail form", 'lang_vcard'), 'value' => $instance['vcard_form']));
				}
			}

			echo show_textfield(array('type' => 'url', 'name' => $this->get_field_name('vcard_url'), 'text' => __("URL", 'lang_vcard'), 'value' => $instance['vcard_url']));

			$is_toggler_open = $instance['vcard_facebook'] != '' || $instance['vcard_gplus'] != '' || $instance['vcard_instagram'] != '' || $instance['vcard_linkedin'] != '' || $instance['vcard_twitter'] != '';

			echo get_toggler_container(array('type' => 'start', 'open' => $is_toggler_open, 'text' => __("Social Media", 'lang_vcard')))
				.show_textfield(array('name' => $this->get_field_name('vcard_facebook'), 'text' => __("Facebook", 'lang_vcard'), 'value' => $instance['vcard_facebook']))
				.show_textfield(array('name' => $this->get_field_name('vcard_gplus'), 'text' => __("Google+", 'lang_vcard'), 'value' => $instance['vcard_gplus']))
				.show_textfield(array('name' => $this->get_field_name('vcard_instagram'), 'text' => __("Instagram", 'lang_vcard'), 'value' => $instance['vcard_instagram']))
				.show_textfield(array('name' => $this->get_field_name('vcard_linkedin'), 'text' => __("LinkedIn", 'lang_vcard'), 'value' => $instance['vcard_linkedin']))
				.show_textfield(array('name' => $this->get_field_name('vcard_twitter'), 'text' => __("Twitter", 'lang_vcard'), 'value' => $instance['vcard_twitter']))
			.get_toggler_container(array('type' => 'end'))
		."</div>";
	}
}