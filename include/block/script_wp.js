(function()
{
	var el = wp.element.createElement,
		registerBlockType = wp.blocks.registerBlockType,
		SelectControl = wp.components.SelectControl,
		TextControl = wp.components.TextControl,
		MediaUpload = wp.blockEditor.MediaUpload,
	    Button = wp.components.Button,
		MediaUploadCheck = wp.blockEditor.MediaUploadCheck,
		InspectorControls = wp.blockEditor.InspectorControls;

	registerBlockType('mf/vcard',
	{
		title: script_vcard_block_wp.block_title,
		description: script_vcard_block_wp.block_description,
		icon: 'excerpt-view',
		category: 'widgets',
		'attributes':
		{
			'align':
			{
				'type': 'string',
				'default': ''
			},
			'vcard_heading':
			{
                'type': 'string',
                'default': ''
            },
			'vcard_name':
			{
                'type': 'string',
                'default': ''
            },
			'vcard_company':
			{
                'type': 'string',
                'default': ''
            },
			'vcard_company_no':
			{
                'type': 'string',
                'default': ''
            },
			'vcard_map':
			{
                'type': 'string',
                'default': ''
            },
			'vcard_address_link':
			{
                'type': 'string',
                'default': ''
            },
			'vcard_address':
			{
                'type': 'string',
                'default': ''
            },
			'vcard_zipcode':
			{
                'type': 'string',
                'default': ''
            },
			'vcard_city':
			{
                'type': 'string',
                'default': ''
            },
			'vcard_country':
			{
                'type': 'string',
                'default': ''
            },
			'vcard_phone':
			{
                'type': 'string',
                'default': ''
            },
			'vcard_phone_show_number':
			{
                'type': 'string',
                'default': ''
            },
			'vcard_icon_shape':
			{
                'type': 'string',
                'default': ''
            },
			'vcard_email':
			{
                'type': 'string',
                'default': ''
            },
			'vcard_page':
			{
                'type': 'string',
                'default': ''
            },
			'vcard_url':
			{
                'type': 'string',
                'default': ''
            },
			'vcard_facebook':
			{
                'type': 'string',
                'default': ''
            },
			'vcard_instagram':
			{
                'type': 'string',
                'default': ''
            },
			'vcard_github':
			{
                'type': 'string',
                'default': ''
            },
			'vcard_linkedin':
			{
                'type': 'string',
                'default': ''
            },
			'vcard_twitter':
			{
                'type': 'string',
                'default': ''
            }
		},
		'supports':
		{
			'html': false,
			'multiple': false,
			'align': true,
			'spacing':
			{
				'margin': true,
				'padding': true
			},
			'color':
			{
				'background': true,
				'gradients': false,
				'text': true
			},
			'defaultStylePicker': true,
			'typography':
			{
				'fontSize': true,
				'lineHeight': true
			},
			"__experimentalBorder":
			{
				"radius": true
			}
		},
		edit: function(props)
		{
			return el(
				'div',
				{className: 'wp_mf_block_container'},
				[
					el(
						InspectorControls,
						'div',
							el(
								TextControl,
								{
									label: script_vcard_block_wp.vcard_heading_label,
									type: 'text',
									value: props.attributes.vcard_heading,
									onChange: function(value)
									{
										props.setAttributes({vcard_heading: value});
									}
								}
							),
							el(
								TextControl,
								{
									label: script_vcard_block_wp.vcard_name_label,
									type: 'text',
									value: props.attributes.vcard_name,
									onChange: function(value)
									{
										props.setAttributes({vcard_name: value});
									}
								}
							),
							el(
								TextControl,
								{
									label: script_vcard_block_wp.vcard_company_label,
									type: 'text',
									value: props.attributes.vcard_company,
									onChange: function(value)
									{
										props.setAttributes({vcard_company: value});
									}
								}
							),
							el(
								TextControl,
								{
									label: script_vcard_block_wp.vcard_company_no_label,
									type: 'text',
									value: props.attributes.vcard_company_no,
									onChange: function(value)
									{
										props.setAttributes({vcard_company_no: value});
									}
								}
							),
							el(
								TextControl,
								{
									label: script_vcard_block_wp.vcard_heading_label,
									type: 'text',
									value: props.attributes.social_heading,
									onChange: function(value)
									{
										props.setAttributes({social_heading: value});
									}
								}
							),
							el(
								SelectControl,
								{
									label: script_vcard_block_wp.vcard_map_label,
									value: props.attributes.vcard_map,
									options: convert_php_array_to_block_js(script_vcard_block_wp.yes_no_for_select, true),
									multiple: true,
									onChange: function(value)
									{
										props.setAttributes({vcard_map: value});
									}
								}
							),
							el(
								TextControl,
								{
									label: script_vcard_block_wp.vcard_address_link_label,
									type: 'text',
									value: props.attributes.vcard_address_link,
									onChange: function(value)
									{
										props.setAttributes({vcard_address_link: value});
									}
								}
							),
							el(
								TextControl,
								{
									label: script_vcard_block_wp.vcard_address_label,
									type: 'text',
									value: props.attributes.vcard_address,
									onChange: function(value)
									{
										props.setAttributes({vcard_address: value});
									}
								}
							),
							el(
								TextControl,
								{
									label: script_vcard_block_wp.vcard_zipcode_label,
									type: 'text',
									value: props.attributes.vcard_zipcode,
									onChange: function(value)
									{
										props.setAttributes({vcard_zipcode: value});
									}
								}
							),
							el(
								TextControl,
								{
									label: script_vcard_block_wp.vcard_city_label,
									type: 'text',
									value: props.attributes.vcard_city,
									onChange: function(value)
									{
										props.setAttributes({vcard_city: value});
									}
								}
							),
							el(
								TextControl,
								{
									label: script_vcard_block_wp.vcard_country_label,
									type: 'text',
									value: props.attributes.vcard_country,
									onChange: function(value)
									{
										props.setAttributes({vcard_country: value});
									}
								}
							),
							el(
								TextControl,
								{
									label: script_vcard_block_wp.vcard_phone_label,
									type: 'text',
									value: props.attributes.vcard_phone,
									onChange: function(value)
									{
										props.setAttributes({vcard_phone: value});
									}
								}
							),
							el(
								SelectControl,
								{
									label: script_vcard_block_wp.vcard_phone_show_number_label,
									value: props.attributes.vcard_phone_show_number,
									options: convert_php_array_to_block_js(script_vcard_block_wp.yes_no_for_select, true),
									multiple: true,
									onChange: function(value)
									{
										props.setAttributes({vcard_phone_show_number: value});
									}
								}
							),
							el(
								SelectControl,
								{
									label: script_vcard_block_wp.vcard_icon_shape_label,
									value: props.attributes.vcard_icon_shape,
									options: convert_php_array_to_block_js(script_vcard_block_wp.vcard_icon_shape, true),
									multiple: true,
									onChange: function(value)
									{
										props.setAttributes({vcard_icon_shape: value});
									}
								}
							),
							el(
								TextControl,
								{
									label: script_vcard_block_wp.vcard_email_label,
									type: 'text',
									value: props.attributes.vcard_email,
									onChange: function(value)
									{
										props.setAttributes({vcard_email: value});
									}
								}
							),
							el(
								SelectControl,
								{
									label: script_vcard_block_wp.vcard_page_label,
									value: props.attributes.vcard_page,
									options: convert_php_array_to_block_js(script_vcard_block_wp.vcard_page, true),
									multiple: true,
									onChange: function(value)
									{
										props.setAttributes({vcard_page: value});
									}
								}
							),
							el(
								TextControl,
								{
									label: script_vcard_block_wp.vcard_url_label,
									type: 'text',
									value: props.attributes.vcard_url,
									onChange: function(value)
									{
										props.setAttributes({vcard_url: value});
									}
								}
							),
							el(
								TextControl,
								{
									label: script_vcard_block_wp.vcard_facebook_label,
									type: 'text',
									value: props.attributes.vcard_facebook,
									onChange: function(value)
									{
										props.setAttributes({vcard_facebook: value});
									}
								}
							),
							el(
								TextControl,
								{
									label: script_vcard_block_wp.vcard_instagram_label,
									type: 'text',
									value: props.attributes.vcard_instagram,
									onChange: function(value)
									{
										props.setAttributes({vcard_instagram: value});
									}
								}
							),
							el(
								TextControl,
								{
									label: script_vcard_block_wp.vcard_github_label,
									type: 'text',
									value: props.attributes.vcard_github,
									onChange: function(value)
									{
										props.setAttributes({vcard_github: value});
									}
								}
							),
							el(
								TextControl,
								{
									label: script_vcard_block_wp.vcard_linkedin_label,
									type: 'text',
									value: props.attributes.vcard_linkedin,
									onChange: function(value)
									{
										props.setAttributes({vcard_linkedin: value});
									}
								}
							),
							el(
								TextControl,
								{
									label: script_vcard_block_wp.vcard_twitter_label,
									type: 'text',
									value: props.attributes.vcard_twitter,
									onChange: function(value)
									{
										props.setAttributes({vcard_twitter: value});
									}
								}
							)
					),
					el(
						'strong',
						{className: props.className},
						script_vcard_block_wp.block_title
					)
				]
			);
		},
		save: function()
		{
			return null;
		}
	});
})();