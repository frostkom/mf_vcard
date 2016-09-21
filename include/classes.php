<?php

class widget_vcard extends WP_Widget
{
	function widget_vcard()
	{
		$widget_ops = array(
			'classname' => 'vcard',
			'description' => __("Display a vCard with custom information", 'lang_vcard')
		);

		$control_ops = array('id_base' => 'widget-vcard');

		$this->__construct('widget-vcard', __("vCard", 'lang_vcard'), $widget_ops, $control_ops);
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
					echo "<p class='tel'>
						<a href='".format_phone_no($instance['vcard_phone'])."' class='value'>"
							.($setting_vcard_icons ? "<i class='fa fa-phone'></i> " : "")
							.$instance['vcard_phone']
						."</a>
					</p>";
				}

				if($instance['vcard_email'] != '')
				{
					echo "<p class='email'>
						<a href='mailto:".$instance['vcard_email']."' class='value'>"
							.($setting_vcard_icons ? "<i class='fa fa-envelope'></i> " : "")
							.$instance['vcard_email']
						."</a>
					</p>";
				}

				if($instance['vcard_form'] != '')
				{
					$form_url = get_form_url($instance['vcard_form']);

					echo "<p>
						<a href='".$form_url."'>"
							.($setting_vcard_icons ? "<i class='fa fa-envelope'></i> " : "")
							.__("E-mail form", 'lang_vcard')
						."</a>
					</p>";
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
		$instance['vcard_company_no'] = strip_tags($new_instance['vcard_company_no']);
		$instance['vcard_address'] = strip_tags($new_instance['vcard_address']);
		$instance['vcard_zipcode'] = strip_tags($new_instance['vcard_zipcode']);
		$instance['vcard_city'] = strip_tags($new_instance['vcard_city']);
		$instance['vcard_country'] = strip_tags($new_instance['vcard_country']);
		$instance['vcard_phone'] = strip_tags($new_instance['vcard_phone']);
		$instance['vcard_email'] = strip_tags($new_instance['vcard_email']);
		$instance['vcard_form'] = strip_tags($new_instance['vcard_form']);

		return $instance;
	}

	function form($instance)
	{
		global $wpdb;

		$current_user = wp_get_current_user();

		$defaults = array(
			'vcard_heading' => "",
			'vcard_name' => $current_user->display_name,
			'vcard_company' => get_bloginfo('name'),
			'vcard_company_no' => "",
			'vcard_address' => "",
			'vcard_zipcode' => "",
			'vcard_city' => "",
			'vcard_country' => "",
			'vcard_phone' => "",
			'vcard_email' => get_bloginfo('admin_email'),
			'vcard_form' => "",
		);

		$instance = wp_parse_args((array)$instance, $defaults);

		echo "<p>"
			.show_textfield(array('name' => $this->get_field_name('vcard_heading'), 'text' => __("Heading", 'lang_vcard'), 'value' => $instance['vcard_heading'], 'xtra' => "class='widefat'"))
		."</p>
		<p>"
			.show_textfield(array('name' => $this->get_field_name('vcard_name'), 'text' => __("Name", 'lang_vcard'), 'value' => $instance['vcard_name'], 'xtra' => "class='widefat'"))
		."</p>
		<p>"
			.show_textfield(array('name' => $this->get_field_name('vcard_company'), 'text' => __("Organization", 'lang_vcard'), 'value' => $instance['vcard_company'], 'xtra' => "class='widefat'"))
		."</p>";

		if($instance['vcard_company'] != '')
		{
			echo "<p>"
				.show_textfield(array('name' => $this->get_field_name('vcard_company_no'), 'text' => __("Organization Number", 'lang_vcard'), 'value' => $instance['vcard_company_no'], 'xtra' => "class='widefat'"))
			."</p>";
		}

		echo "<p>"
			.show_textfield(array('name' => $this->get_field_name('vcard_address'), 'text' => __("Address", 'lang_vcard'), 'value' => $instance['vcard_address'], 'xtra' => "class='widefat'"))
		."</p>
		<p>"
			.show_textfield(array('name' => $this->get_field_name('vcard_zipcode'), 'text' => __("Zip Code", 'lang_vcard'), 'value' => $instance['vcard_zipcode'], 'xtra' => "class='widefat'"))
		."</p>
		<p>"
			.show_textfield(array('name' => $this->get_field_name('vcard_city'), 'text' => __("City", 'lang_vcard'), 'value' => $instance['vcard_city'], 'xtra' => "class='widefat'"))
		."</p>
		<p>"
			.show_textfield(array('name' => $this->get_field_name('vcard_country'), 'text' => __("Country", 'lang_vcard'), 'value' => $instance['vcard_country'], 'xtra' => "class='widefat'"))
		."</p>
		<p>"
			.show_textfield(array('name' => $this->get_field_name('vcard_phone'), 'text' => __("Phone Number", 'lang_vcard'), 'value' => $instance['vcard_phone'], 'xtra' => "class='widefat'"))
		."</p>
		<p>"
			.show_textfield(array('name' => $this->get_field_name('vcard_email'), 'text' => __("Email", 'lang_vcard'), 'value' => $instance['vcard_email'], 'xtra' => "class='widefat'"))
		."</p>";

		if(is_plugin_active("mf_form/index.php"))
		{
			$obj_form = new mf_form();
			$arr_data = $obj_form->get_form_array();

			if(count($arr_data) > 1)
			{
				echo "<p>"
					.show_select(array('data' => $arr_data, 'name' => $this->get_field_name('vcard_form'), 'text' => __("E-mail form", 'lang_vcard'), 'value' => $instance['vcard_form']))
				."</p>";
			}
		}
	}
}