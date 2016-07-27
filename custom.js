(function()
{
	console.log('Success!');
	$('form[role="search"] > .form-group > input').focus();
	/*
	var options = {
		serviceUrl:'search.php',
	    lookupLimit: 2
	};	
	$('form[role="search"] > .form-group > input').autocomplete(options);	
	*/
	var query = '';
	$('form[role="search"] > .form-group > input').bind('change keyup input',function()
	{ 
		var theFormField = $(this);
		query = 'search.php?query='+encodeURI($(this).val());
		$('.autocomplete-suggestions').show();
		// Create select box and populate it.
		$.getJSON(query, function(data)
		{
			console.log(data);

		})
	});
})();

/* <div style="position: absolute; max-height: 300px; z-index: 9999; top: 43px; left: 774px; width: 195px; display: block;" class="autocomplete-suggestions"><div class="autocomplete-suggestion" data-index="0">Leave it out</div><div class="autocomplete-suggestion" data-index="1">Shoul<strong>d</strong> not be there.</div><div class="autocomplete-suggestion" data-index="2">Put this in search</div><div class="autocomplete-suggestion" data-index="3">Miss this out</div></div> */