$('h2, h3, h4, h5').each(function()
{
	var $p = $(this); $p.html($p.html().replace(/^(\w+)/, '<strong class="dark">$1</strong>'));
});