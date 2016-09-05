var base64Str;
$('.base64').each(function()
{ 
	var img = $(this);
	var spinner = img.next('i.fa-spin');
	query = 'base64.php?id='+img.data('id');
	$.get(query, function(data)
	{
		img.attr('src',data);
		spinner.hide();
	});
});