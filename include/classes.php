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
					echo "<p class='fn'>".$instance['vcard_name']."</p>";
				}

				if($instance['vcard_company'] != '')
				{
					echo "<p class='org'>"
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
							echo "<p class='street-address'>".$instance['vcard_address']."</p>";
						}

						if($instance['vcard_zipcode'] != '' || $instance['vcard_city'] != '' || $instance['vcard_country'] != '')
						{
							echo "<p>";

								if($instance['vcard_zipcode'] != '')
								{
									echo "<span class='postal-code'>".$instance['vcard_zipcode']."</span>";
								}

								if($instance['vcard_city'] != '')
								{
									echo ($instance['vcard_zipcode'] != '' ? " " : "")
										."<span class='locality'>".$instance['vcard_city']."</span>";
								}

								if($instance['vcard_country'] != '')
								{
									echo ($instance['vcard_zipcode'] != '' || $instance['vcard_city'] != '' ? ", " : "")
										."<span class='country-name'>".$instance['vcard_country']."</span>";
								}

							echo "</p>";
						}

					echo "</div>";
				}

				if($instance['vcard_phone'] != '')
				{
					echo "<p class='tel'>
						<a href='".format_phone_no($instance['vcard_phone'])."' class='value'>".$instance['vcard_phone']."</a>
					</p>";
				}

				if($instance['vcard_email'] != '')
				{
					echo "<p class='email'>
						<a href='mailto:".$instance['vcard_email']."' class='value'>".$instance['vcard_email']."</a>
					</p>";
				}
				
				if($instance['vcard_form'] != '')
				{
					$form_url = get_form_url($instance['vcard_form']);

					echo "<p>
						<a href='".$form_url."'>".__("E-mail form", 'lang_vcard')."</a>
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

		$is_super_admin = current_user_can('update_core');

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

		echo "<p>
			<label for='".$this->get_field_id('vcard_heading')."'>".__("Heading", 'lang_vcard')."</label>
			<input type='text' name='".$this->get_field_name('vcard_heading')."' value='".$instance['vcard_heading']."' class='widefat'>
		</p>
		<p>
			<label for='".$this->get_field_id('vcard_name')."'>".__("Name", 'lang_vcard')."</label>
			<input type='text' name='".$this->get_field_name('vcard_name')."' value='".$instance['vcard_name']."' class='widefat'>
		</p>
		<p>
			<label for='".$this->get_field_id('vcard_company')."'>".__("Organization", 'lang_vcard')."</label>
			<input type='text' name='".$this->get_field_name('vcard_company')."' value='".$instance['vcard_company']."' class='widefat'>
		</p>";

		if($instance['vcard_company'] != '')
		{
			echo "<p>
				<label for='".$this->get_field_id('vcard_company_no')."'>".__("Organization no", 'lang_vcard')."</label>
				<input type='text' name='".$this->get_field_name('vcard_company_no')."' value='".$instance['vcard_company_no']."' class='widefat'>
			</p>";
		}

		echo "<p>
			<label for='".$this->get_field_id('vcard_address')."'>".__("Address", 'lang_vcard')."</label>
			<input type='text' name='".$this->get_field_name('vcard_address')."' value='".$instance['vcard_address']."' class='widefat'>
		</p>
		<p>
			<label for='".$this->get_field_id('vcard_zipcode')."'>".__("Zip code", 'lang_vcard')."</label>
			<input type='text' name='".$this->get_field_name('vcard_zipcode')."' value='".$instance['vcard_zipcode']."' class='widefat'>
		</p>
		<p>
			<label for='".$this->get_field_id('vcard_city')."'>".__("City", 'lang_vcard')."</label>
			<input type='text' name='".$this->get_field_name('vcard_city')."' value='".$instance['vcard_city']."' class='widefat'>
		</p>
		<p>
			<label for='".$this->get_field_id('vcard_country')."'>".__("Country", 'lang_vcard')."</label>
			<input type='text' name='".$this->get_field_name('vcard_country')."' value='".$instance['vcard_country']."' class='widefat'>
		</p>
		<p>
			<label for='".$this->get_field_id('vcard_phone')."'>".__("Phone number", 'lang_vcard')."</label>
			<input type='text' name='".$this->get_field_name('vcard_phone')."' value='".$instance['vcard_phone']."' class='widefat'>
		</p>
		<p>
			<label for='".$this->get_field_id('vcard_email')."'>".__("E-mail", 'lang_vcard')."</label>
			<input type='text' name='".$this->get_field_name('vcard_email')."' value='".$instance['vcard_email']."' class='widefat'>
		</p>";

		if(is_plugin_active('mf_form/index.php'))
		{
			$result = $wpdb->get_results("SELECT queryID, queryName FROM ".$wpdb->base_prefix."query WHERE queryDeleted = '0'".($is_super_admin ? "" : " AND (blogID = '".$wpdb->blogid."' OR blogID IS null)")." ORDER BY queryCreated DESC");

			if($wpdb->num_rows > 0)
			{
				$arr_data = array();

				$arr_data[]	= array("", "-- ".__("Choose here", 'lang_vcard')." --");

				foreach($result as $r)
				{
					$form_page = get_page_from_form($r->queryID);

					if(count($form_page) > 0)
					{
						$arr_data[]	= array($r->queryID, $r->queryName);
					}
				}

				if(count($arr_data) > 1)
				{
					echo show_select(array('data' => $arr_data, 'name' => $this->get_field_name('vcard_form'), 'text' => __("E-mail form", 'lang_vcard'), 'compare' => $instance['vcard_form'], 'xtra' => "class='widefat'"));
				}
			}
		}
	}
}