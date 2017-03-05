var pathArray = window.location.pathname.split( '/' );
var sn = pathArray[pathArray.length - 1];
var setOfAnchors = $('ul.nav > li > a');
var anchorFound = false;
$(setOfAnchors).each(function()
{
	if($(this).attr('href') == sn)
	{
		$(this).parent().addClass('active');
        anchorFound = true;
	}
});
if(anchorFound == false)
{
    $(setOfAnchors).each(function()
    {
        if(($(this).attr('href') == 'index.php') || ($(this).attr('href') == 'index.html') || ($(this).attr('') == 'index.html'))
        {
            $(this).parent().addClass('active');                       
        }
    });
}