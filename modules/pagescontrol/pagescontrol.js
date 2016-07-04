$('#issubpageholder input').change(function()
{
	if($(this).val() == 1)
	{
		$('#secondarycontentholder').hide();
		$("#secondarycontentholder select option").val('0');
		$('#layoutholder').hide();
		var value = 1;
		$("#layoutholder input[name=layout][value="+value+"]").attr('checked', 'checked');
	}
	else
	{
		$('#secondarycontentholder').show();
		$('#layoutholder').show();
	}
});