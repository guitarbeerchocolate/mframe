(function($)
{
    $.fn.extend(
    {
        feedloader:function(feedtype, entrycount)
        {
            var target = this;
            var loaderStr = 'loader';
            var hasFeedType = false;
            target.append('<img src="img/loading.gif" />');
            if((feedtype != null) || (feedtype != undefined))
            {
                loaderStr += '?feedtype='+feedtype;
                hasFeedType = true;
            }
            if((entrycount != null) || (entrycount != undefined))
            {
                if(hasFeedType == false)
                {
                    loaderStr += '?';
                }
                else
                {
                    loaderStr += '&';
                }
                loaderStr += 'entrycount='+entrycount;
            }
            $.get(loaderStr, function(data)
            {
                target.empty().html(data);
            });
        }
    });
})(jQuery);