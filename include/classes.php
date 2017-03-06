<?php

class widget_vcard extends WP_Widget
{
	function __construct()
	{
		$widget_ops = array(
			'classname' => 'vcard',
			'description' => __("Display a vCard with custom information", 'lang_vcard')
		);

		$control_ops = array('id_base' => 'widget-vcard');

		parent::__construct('widget-vcard', __("vCard", 'lang_vcard'), $widget_ops, $control_ops);
	}

	function widget($args, $instance)
	{
		global $wpdb;

		extract($args);

		$setting_vcard_icons = get_option('setting_vcard_icons');

		echo $before_widget;

			if($instance['vcard_heading'] != '')
			{
				echo $before_title
					.$instance['vcard_heading']
				.$after_title;
			}

			echo "<div class='vcard'>";

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

						if(isset($instance['vcard_company_no']) && $instance['vcard_company_no'] != '')
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
								.($setting_vcard_icons ? "<i class='fa fa-envelope-o'></i> " : "")
								.$instance['vcard_address']
							."</p>";
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
					echo "<p class='contact tel'>
						<a href='".format_phone_no($instance['vcard_phone'])."' class='value'>"
							.($setting_vcard_icons ? "<i class='fa fa-phone'></i> " : "")
							.$instance['vcard_phone']
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

				if($instance['vcard_form'] != '' || $instance['vcard_facebook'] != '' || $instance['vcard_gplus'] != '' || (isset($instance['vcard_instagram']) && $instance['vcard_instagram'] != '') || $instance['vcard_linkedin'] != '' || $instance['vcard_twitter'] != '')
				{
					echo "<p class='social".(isset($instance['vcard_icon_shape']) ? " ".$instance['vcard_icon_shape'] : "")."'>";

						if($instance['vcard_form'] != '')
						{
							$form_url = get_form_url($instance['vcard_form']);

							echo "<a href='".$form_url."'><i class='fa fa-envelope'></i></a>";
						}

						if(isset($instance['vcard_facebook']) && $instance['vcard_facebook'] != '')
						{
							echo "<a href='//facebook.com/".$instance['vcard_facebook']."'><i class='fa fa-facebook'></i></a>";
						}

						if(isset($instance['vcard_gplus']) && $instance['vcard_gplus'] != '')
						{
							echo "<a href='//plus.google.com/".$instance['vcard_gplus']."'><i class='fa fa-google-plus'></i></a>";
						}

						if(isset($instance['vcard_instagram']) && $instance['vcard_instagram'] != '')
						{
							echo "<a href='//instagram.com/".$instance['vcard_instagram']."'><i class='fa fa-instagram'></i></a>";
						}

						if(isset($instance['vcard_linkedin']) && $instance['vcard_linkedin'] != '')
						{
							echo "<a href='//linkedin.com/in/".$instance['vcard_linkedin']."'><i class='fa fa-linkedin'></i></a>";
						}

						if(isset($instance['vcard_twitter']) && $instance['vcard_twitter'] != '')
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

		$instance['vcard_heading'] = strip_tags($new_instance['vcard_heading']);
		$instance['vcard_name'] = strip_tags($new_instance['vcard_name']);
		$instance['vcard_company'] = strip_tags($new_instance['vcard_company']);
		$instance['vcard_company_no'] = isset($new_instance['vcard_company_no']) ? strip_tags($new_instance['vcard_company_no']) : "";
		$instance['vcard_address'] = strip_tags($new_instance['vcard_address']);
		$instance['vcard_zipcode'] = isset($new_instance['vcard_zipcode']) ? strip_tags($new_instance['vcard_zipcode']) : "";
		$instance['vcard_city'] = isset($new_instance['vcard_city']) ? strip_tags($new_instance['vcard_city']) : "";
		$instance['vcard_country'] = isset($new_instance['vcard_country']) ? strip_tags($new_instance['vcard_country']) : "";
		$instance['vcard_phone'] = strip_tags($new_instance['vcard_phone']);
		$instance['vcard_icon_shape'] = isset($new_instance['vcard_icon_shape']) ? strip_tags($new_instance['vcard_icon_shape']) : "";
		$instance['vcard_email'] = isset($new_instance['vcard_email']) ? strip_tags($new_instance['vcard_email']) : "";
		$instance['vcard_form'] = isset($new_instance['vcard_form']) ? strip_tags($new_instance['vcard_form']) : "";
		$instance['vcard_facebook'] = strip_tags($new_instance['vcard_facebook']);
		$instance['vcard_gplus'] = strip_tags($new_instance['vcard_gplus']);
		$instance['vcard_instagram'] = isset($new_instance['vcard_instagram']) ? strip_tags($new_instance['vcard_instagram']) : "";
		$instance['vcard_linkedin'] = strip_tags($new_instance['vcard_linkedin']);
		$instance['vcard_twitter'] = strip_tags($new_instance['vcard_twitter']);

		return $instance;
	}

	function form($instance)
	{
		global $wpdb;

		$defaults = array(
			'vcard_heading' => "",
			'vcard_name' => "",
			'vcard_company' => "",
			'vcard_company_no' => "",
			'vcard_address' => "",
			'vcard_zipcode' => "",
			'vcard_city' => "",
			'vcard_country' => "",
			'vcard_phone' => "",
			'vcard_icon_shape' => 'circle',
			'vcard_email' => "",
			'vcard_form' => "",
			'vcard_facebook' => "",
			'vcard_gplus' => "",
			'vcard_instagram' => "",
			'vcard_linkedin' => "",
			'vcard_twitter' => "",
		);

		$instance = wp_parse_args((array)$instance, $defaults);

		echo "<div class='mf_form'>"
			.show_textfield(array('name' => $this->get_field_name('vcard_heading'), 'text' => __("Heading", 'lang_vcard'), 'value' => $instance['vcard_heading'], 'xtra' => "class='widefat'"))
			.show_textfield(array('name' => $this->get_field_name('vcard_name'), 'text' => __("Name", 'lang_vcard'), 'value' => $instance['vcard_name'], 'xtra' => "class='widefat'"))
			.show_textfield(array('name' => $this->get_field_name('vcard_company'), 'text' => __("Organization", 'lang_vcard'), 'value' => $instance['vcard_company'], 'xtra' => "class='widefat'"));

			if($instance['vcard_company'] != '')
			{
				echo show_textfield(array('name' => $this->get_field_name('vcard_company_no'), 'text' => __("Organization Number", 'lang_vcard'), 'value' => $instance['vcard_company_no'], 'xtra' => "class='widefat'"));
			}

			echo show_textfield(array('name' => $this->get_field_name('vcard_address'), 'text' => __("Address", 'lang_vcard'), 'value' => $instance['vcard_address'], 'xtra' => "class='widefat'"));

			if($instance['vcard_address'] != '')
			{
				echo "<div class='flex_flow'>"
					.show_textfield(array('name' => $this->get_field_name('vcard_zipcode'), 'text' => __("Zip Code", 'lang_vcard'), 'value' => $instance['vcard_zipcode'], 'xtra' => "class='widefat'"))
					.show_textfield(array('name' => $this->get_field_name('vcard_city'), 'text' => __("City", 'lang_vcard'), 'value' => $instance['vcard_city'], 'xtra' => "class='widefat'"))
				."</div>"
				.show_textfield(array('name' => $this->get_field_name('vcard_country'), 'text' => __("Country", 'lang_vcard'), 'value' => $instance['vcard_country'], 'xtra' => "class='widefat'"));
			}

			echo show_textfield(array('name' => $this->get_field_name('vcard_phone'), 'text' => __("Phone Number", 'lang_vcard'), 'value' => $instance['vcard_phone'], 'xtra' => "class='widefat'"));

			$arr_data = array();
			//$arr_data[''] = "-- ".__("Choose here", 'lang_vcard')." --";
			$arr_data['rectangle'] = __("Rectangle", 'lang_vcard');
			$arr_data['circle'] = __("Circle", 'lang_vcard');

			echo show_select(array('data' => $arr_data, 'name' => $this->get_field_name('vcard_icon_shape'), 'text' => __("Icon Shape", 'lang_vcard'), 'value' => $instance['vcard_icon_shape']));

			if(!($instance['vcard_form'] > 0))
			{
				echo show_textfield(array('name' => $this->get_field_name('vcard_email'), 'text' => __("Email", 'lang_vcard'), 'value' => $instance['vcard_email'], 'xtra' => "class='widefat'"));
			}

			if($instance['vcard_email'] == '' && is_plugin_active("mf_form/index.php"))
			{
				$obj_form = new mf_form();
				$arr_data = $obj_form->get_form_array();

				if(count($arr_data) > 1)
				{
					echo show_select(array('data' => $arr_data, 'name' => $this->get_field_name('vcard_form'), 'text' => __("E-mail form", 'lang_vcard'), 'value' => $instance['vcard_form']));
				}
			}
			
			echo show_textfield(array('name' => $this->get_field_name('vcard_facebook'), 'text' => __("Facebook", 'lang_vcard'), 'value' => $instance['vcard_facebook'], 'xtra' => "class='widefat'"))
			.show_textfield(array('name' => $this->get_field_name('vcard_gplus'), 'text' => __("Google+", 'lang_vcard'), 'value' => $instance['vcard_gplus'], 'xtra' => "class='widefat'"))
			.show_textfield(array('name' => $this->get_field_name('vcard_instagram'), 'text' => __("Instagram", 'lang_vcard'), 'value' => $instance['vcard_instagram'], 'xtra' => "class='widefat'"))
			.show_textfield(array('name' => $this->get_field_name('vcard_linkedin'), 'text' => __("LinkedIn", 'lang_vcard'), 'value' => $instance['vcard_linkedin'], 'xtra' => "class='widefat'"))
			.show_textfield(array('name' => $this->get_field_name('vcard_twitter'), 'text' => __("Twitter", 'lang_vcard'), 'value' => $instance['vcard_twitter'], 'xtra' => "class='widefat'"))
		."</div>";
	}
}