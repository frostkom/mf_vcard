jQuery(function($)
{
	$(document).on('click', '.vcard .contact.tel .hide_number', function()
	{
		$(this).find('span.hide').removeClass('hide').siblings('span').addClass('hide');

		$(this).removeClass('hide_number');

		return false;
	});
});