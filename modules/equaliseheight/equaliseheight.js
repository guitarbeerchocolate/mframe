(function($)
{
  $.fn.equaliseheight = function()
  {
    var maxHeight = 0;
    $(this).each(function()
    {
      if($(this).height() > maxHeight)
      {
        maxHeight = $(this).height();
      }
    });
    $(this).height(maxHeight);
  }
})(jQuery);