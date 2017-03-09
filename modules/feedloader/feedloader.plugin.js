(function($)
{
    $.fn.extend(
    {
        feedloader:function(feedtype, entrycount)
        {
            var target = this;
            var loaderStr = 'loader';
            var hasFeedType = false;
            target.append('<i class="fa fa-spinner fa-spin fa-5x fa-fw"></i><span class="sr-only">Loading...</span>');
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