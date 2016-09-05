var theStars = $('form.rating').find('i');
$('i').on('click', function()
{
  theStars.removeClass('star-selected');
  var theStarIclicked = $(this);
  var highVal = theStarIclicked.attr('value');
  theStarIclicked.addClass('star-selected');
  $("input[name='overallrating']").attr('value',highVal);
  theStars.each(function(i)
  {
    if($(this).attr('value') < highVal)
    {
      $(this).addClass('star-selected');
    }
  });
});