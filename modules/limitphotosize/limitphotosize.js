$("#photo").change(function()
{
	var iSize = ($("#photo")[0].files[0].size / 1024);
	iSize = (Math.round((iSize / 1024) * 100) / 100);		
	if(iSize > 2)
	{
		alert('Your photo is too big add one below 2MB');
		$("#photo").val('');
	}
});