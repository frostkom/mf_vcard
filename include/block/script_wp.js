(function()
{
	var __ = wp.i18n.__,
		el = wp.element.createElement,
		registerBlockType = wp.blocks.registerBlockType,
		SelectControl = wp.components.SelectControl,
		TextControl = wp.components.TextControl,
		MediaUpload = wp.blockEditor.MediaUpload,
	    Button = wp.components.Button,
		MediaUploadCheck = wp.blockEditor.MediaUploadCheck;

	registerBlockType('mf/vcard',
	{
		title: __("vCard", 'lang_vcard'),
		description: __("Display a vCard with custom information", 'lang_vcard'),
		icon: 'excerpt-view', /* https://developer.wordpress.org/resource/dashicons/ */
		category: 'widgets', /* common, formatting, layout, widgets, embed */
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
			}
		},
		edit: function(props)
		{
			var arr_out = [];

			/* Text */
			/* ################### */
			arr_out.push(el(
				'div',
				{className: "wp_mf_block " + props.className},
				el(
					TextControl,
					{
						label: __("Heading", 'lang_vcard'),
						type: 'text',
						value: props.attributes.vcard_heading,
						onChange: function(value)
						{
							props.setAttributes({vcard_heading: value});
						}
					}
				)
			));
			/* ################### */

			/* Text */
			/* ################### */
			arr_out.push(el(
				'div',
				{className: "wp_mf_block " + props.className},
				el(
					TextControl,
					{
						label: __("Name", 'lang_vcard'),
						type: 'text',
						value: props.attributes.vcard_name,
						onChange: function(value)
						{
							props.setAttributes({vcard_name: value});
						}
					}
				)
			));
			/* ################### */

			/* Text */
			/* ################### */
			arr_out.push(el(
				'div',
				{className: "wp_mf_block " + props.className},
				el(
					TextControl,
					{
						label: __("Organization", 'lang_vcard'),
						type: 'text',
						value: props.attributes.vcard_company,
						onChange: function(value)
						{
							props.setAttributes({vcard_company: value});
						}
					}
				)
			));
			/* ################### */

			/* Text */
			/* ################### */
			arr_out.push(el(
				'div',
				{className: "wp_mf_block " + props.className},
				el(
					TextControl,
					{
						label: __("Organization Number", 'lang_vcard'),
						type: 'text',
						value: props.attributes.vcard_company_no,
						onChange: function(value)
						{
							props.setAttributes({vcard_company_no: value});
						}
					}
				)
			));
			/* ################### */

			/* Text */
			/* ################### */
			arr_out.push(el(
				'div',
				{className: "wp_mf_block " + props.className},
				el(
					TextControl,
					{
						label: __("Heading", 'lang_vcard'),
						type: 'text',
						value: props.attributes.social_heading,
						onChange: function(value)
						{
							props.setAttributes({social_heading: value});
						}
					}
				)
			));
			/* ################### */

			/* Select */
			/* ################### */
			var arr_options = [];

			jQuery.each(script_social_feed_block_wp.yes_no_for_select, function(index, value)
			{
				if(index == "")
				{
					index = 0;
				}

				arr_options.push({label: value, value: index});
			});

			arr_out.push(el(
				'div',
				{className: "wp_mf_block " + props.className},
				el(
					SelectControl,
					{
						label: __("Show Map", 'lang_vcard'),
						value: props.attributes.vcard_map,
						options: arr_options,
						multiple: true,
						onChange: function(value)
						{
							props.setAttributes({vcard_map: value});
						}
					}
				)
			));
			/* ################### */

			/* Text */
			/* ################### */
			arr_out.push(el(
				'div',
				{className: "wp_mf_block " + props.className},
				el(
					TextControl,
					{
						label: __("Link", 'lang_vcard'),
						type: 'text',
						value: props.attributes.vcard_address_link,
						onChange: function(value)
						{
							props.setAttributes({vcard_address_link: value});
						}
					}
				)
			));
			/* ################### */

			/* Text */
			/* ################### */
			arr_out.push(el(
				'div',
				{className: "wp_mf_block " + props.className},
				el(
					TextControl,
					{
						label: __("Street Address", 'lang_vcard'),
						type: 'text',
						value: props.attributes.vcard_address,
						onChange: function(value)
						{
							props.setAttributes({vcard_address: value});
						}
					}
				)
			));
			/* ################### */

			/* Text */
			/* ################### */
			arr_out.push(el(
				'div',
				{className: "wp_mf_block " + props.className},
				el(
					TextControl,
					{
						label: __("Zip Code", 'lang_vcard'),
						type: 'text',
						value: props.attributes.vcard_zipcode,
						onChange: function(value)
						{
							props.setAttributes({vcard_zipcode: value});
						}
					}
				)
			));
			/* ################### */
			/* Text */
			/* ################### */
			arr_out.push(el(
				'div',
				{className: "wp_mf_block " + props.className},
				el(
					TextControl,
					{
						label: __("City", 'lang_vcard'),
						type: 'text',
						value: props.attributes.vcard_city,
						onChange: function(value)
						{
							props.setAttributes({vcard_city: value});
						}
					}
				)
			));
			/* ################### */

			/* Text */
			/* ################### */
			arr_out.push(el(
				'div',
				{className: "wp_mf_block " + props.className},
				el(
					TextControl,
					{
						label: __("Country", 'lang_vcard'),
						type: 'text',
						value: props.attributes.vcard_country,
						onChange: function(value)
						{
							props.setAttributes({vcard_country: value});
						}
					}
				)
			));
			/* ################### */

			/* Text */
			/* ################### */
			arr_out.push(el(
				'div',
				{className: "wp_mf_block " + props.className},
				el(
					TextControl,
					{
						label: __("Phone Number", 'lang_vcard'),
						type: 'text',
						value: props.attributes.vcard_phone,
						onChange: function(value)
						{
							props.setAttributes({vcard_phone: value});
						}
					}
				)
			));
			/* ################### */

			/* Select */
			/* ################### */
			var arr_options = [];

			jQuery.each(script_social_feed_block_wp.yes_no_for_select, function(index, value)
			{
				if(index == "")
				{
					index = 0;
				}

				arr_options.push({label: value, value: index});
			});

			arr_out.push(el(
				'div',
				{className: "wp_mf_block " + props.className},
				el(
					SelectControl,
					{
						label: __("Show Full Number", 'lang_vcard'),
						value: props.attributes.vcard_phone_show_number,
						options: arr_options,
						multiple: true,
						onChange: function(value)
						{
							props.setAttributes({vcard_phone_show_number: value});
						}
					}
				)
			));
			/* ################### */

			/* Select */
			/* ################### */
			var arr_options = [];

			jQuery.each(script_social_feed_block_wp.vcard_icon_shape, function(index, value)
			{
				if(index == "")
				{
					index = 0;
				}

				arr_options.push({label: value, value: index});
			});

			arr_out.push(el(
				'div',
				{className: "wp_mf_block " + props.className},
				el(
					SelectControl,
					{
						label: __("Icon Shape", 'lang_vcard'),
						value: props.attributes.vcard_icon_shape,
						options: arr_options,
						multiple: true,
						onChange: function(value)
						{
							props.setAttributes({vcard_icon_shape: value});
						}
					}
				)
			));
			/* ################### */

			/* Text */
			/* ################### */
			arr_out.push(el(
				'div',
				{className: "wp_mf_block " + props.className},
				el(
					TextControl,
					{
						label: __("E-mail", 'lang_vcard'),
						type: 'text',
						value: props.attributes.vcard_email,
						onChange: function(value)
						{
							props.setAttributes({vcard_email: value});
						}
					}
				)
			));
			/* ################### */
			/* Select */
			/* ################### */
			var arr_options = [];

			jQuery.each(script_social_feed_block_wp.vcard_page, function(index, value)
			{
				if(index == "")
				{
					index = 0;
				}

				arr_options.push({label: value, value: index});
			});

			arr_out.push(el(
				'div',
				{className: "wp_mf_block " + props.className},
				el(
					SelectControl,
					{
						label: __("E-mail Page", 'lang_vcard'),
						value: props.attributes.vcard_page,
						options: arr_options,
						multiple: true,
						onChange: function(value)
						{
							props.setAttributes({vcard_page: value});
						}
					}
				)
			));
			/* ################### */

			/* Text */
			/* ################### */
			arr_out.push(el(
				'div',
				{className: "wp_mf_block " + props.className},
				el(
					TextControl,
					{
						label: __("URL", 'lang_vcard'),
						type: 'text',
						value: props.attributes.vcard_url,
						onChange: function(value)
						{
							props.setAttributes({vcard_url: value});
						}
					}
				)
			));
			/* ################### */
			/* Text */
			/* ################### */
			arr_out.push(el(
				'div',
				{className: "wp_mf_block " + props.className},
				el(
					TextControl,
					{
						label: __("Facebook", 'lang_vcard'),
						type: 'text',
						value: props.attributes.vcard_facebook,
						onChange: function(value)
						{
							props.setAttributes({vcard_facebook: value});
						}
					}
				)
			));
			/* ################### */

			/* Text */
			/* ################### */
			arr_out.push(el(
				'div',
				{className: "wp_mf_block " + props.className},
				el(
					TextControl,
					{
						label: __("Instagram", 'lang_vcard'),
						type: 'text',
						value: props.attributes.vcard_instagram,
						onChange: function(value)
						{
							props.setAttributes({vcard_instagram: value});
						}
					}
				)
			));
			/* ################### */

			/* Text */
			/* ################### */
			arr_out.push(el(
				'div',
				{className: "wp_mf_block " + props.className},
				el(
					TextControl,
					{
						label: __("GitHub", 'lang_vcard'),
						type: 'text',
						value: props.attributes.vcard_github,
						onChange: function(value)
						{
							props.setAttributes({vcard_github: value});
						}
					}
				)
			));
			/* ################### */

			/* Text */
			/* ################### */
			arr_out.push(el(
				'div',
				{className: "wp_mf_block " + props.className},
				el(
					TextControl,
					{
						label: __("HeadLinkedIning", 'lang_vcard'),
						type: 'text',
						value: props.attributes.vcard_linkedin,
						onChange: function(value)
						{
							props.setAttributes({vcard_linkedin: value});
						}
					}
				)
			));
			/* ################### */

			/* Text */
			/* ################### */
			arr_out.push(el(
				'div',
				{className: "wp_mf_block " + props.className},
				el(
					TextControl,
					{
						label: __("Twitter", 'lang_vcard'),
						type: 'text',
						value: props.attributes.vcard_twitter,
						onChange: function(value)
						{
							props.setAttributes({vcard_twitter: value});
						}
					}
				)
			));
			/* ################### */

			return arr_out;
		},

		save: function()
		{
			return null;
		}
	});
})();