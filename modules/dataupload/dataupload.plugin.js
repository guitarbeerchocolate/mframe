(function($)
{
    $.fn.extend(
    {
        dataupload:function(elem,loaderelem)
        {
            var target = this;
            var theDiv = elem;
            var theLoaderImage = loaderelem;
            theLoaderImage.hide();
            target.on('submit', function(e)
            {
                var thisForm = $(this);
                var action = thisForm.attr('action');
                var method = thisForm.attr('method');                
                $.ajax(
                {
                    url: action,
                    type: method,
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    beforeSend: function()
                    {
                        thisForm.hide();
                        theLoaderImage.show();
                    },
                    complete: function()
                    {
                        theLoaderImage.hide();
                    }
                }).done(function(datareceived)
                {
                    thisForm.find('input, textarea').val('');
                    thisForm.show();
                    theDiv.html(datareceived);
                });
                e.preventDefault();
            });
        }
    });
})(jQuery);