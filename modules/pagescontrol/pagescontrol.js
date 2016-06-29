$('#issubpageholder input').change(function()
{
	if($(this).val() == 1)
	{
		$('#secondarycontentholder').hide();
		$('#layoutholder').hide();
	}
	else
	{
		$('#secondarycontentholder').show();
		$('#layoutholder').show();
	}
});