var theInput = $('form[role="search"] > .input-group > input');
theInput.focus();
theInput.attr('autocomplete', 'off');
var query = '';
var datalist = $('form[role="search"] > .input-group > select#names');
theInput.on('change input',function()
{ 
	datalist.show();
	var theFormField = $(this);
	query = 'search.php?query='+encodeURI($(this).val());
	$.getJSON(query, function(data)
	{
		datalist.empty();
		datalistOption = '<option>Suggestions</option>';    			
    	datalist.append(datalistOption);
    	for(var i = 0; i < data.suggestions.length; i++)
    	{
    		var ItemArray = [];
			ItemArray.push(data.suggestions[i]);
			ItemArray = $.unique(ItemArray);
			for(var j = 0; j < ItemArray.length; j++)
    		{
    			var datalistOption = '';
    			datalistOption = '<option>'+ItemArray[j]+'</option>';    			
    			datalist.append(datalistOption);
			}
        }
	}).fail(function(jqXHR, textStatus, errorThrown)
	{
		console.log('getJSON request failed! ' + textStatus);
	});
});
datalist.change(function()
{
	theInput.val($('select option:selected').text());
	datalist.hide();
});

theInput.keydown(function(e)
{
	var keyCode = e.keyCode || e.which;
	if (keyCode == 13)
	{
    	$(this).parents('form').submit();
		return false;
	}
});