var conWidth = $('.container_12 > .navbar').width();
var liwidth = 0;
$(window).resize(function()
{
	$('.navbar > ul > li').each(function()
	{
		liwidth += parseInt($(this).width());
	});

	$('h1').text(liwidth);
	$('h2').text(conWidth);
	$('h3').text($(window).width());
	liwidth = 0;
	/*
	if(liwidth < conWidth)
	{
		$('.navbar > ul > li').width(400);
	}
	*/
});