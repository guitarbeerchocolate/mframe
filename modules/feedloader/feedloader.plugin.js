(function($)
{
    $.fn.extend(
    {
        feedloader:function(feedtype)
        {
            var target = this;            
            var loaderStr = 'loader.php';
            target.append('<img src="img/loading.gif" />');
            if((feedtype != null) || (feedtype != undefined))
            {
                loaderStr += '?feedtype='+feedtype;
            } 
            $.get(loaderStr, function(data)
            {
                target.empty().html(data);
            });
        }
    });
})(jQuery);