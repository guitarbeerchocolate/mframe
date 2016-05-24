(function()
{

  /*
  $('form.ajax').on('submit', function(event)
  {
    if($(this).hasClass('triggersave'))
    {
      tinyMCE.triggerSave();  
    }    
    
    $.post('formhandler.php?action='+$(this).attr('action'), $(this).serialize(), function(data)
    {
      var json_obj = JSON.parse(data);      
      if(json_obj.hasOwnProperty('message'))
      {
        $('#message > .alert').text(json_obj.message);
        $('#message').show();
        $('#message').fadeOut(10000); 
      }
      if(json_obj.hasOwnProperty('location'))
      {
        document.location.href = json_obj.location;
      }
    });    
    event.preventDefault();
  });
  */

  /*
  var newFileStr = '<h4>New file added</h4>';
  var newFilePath = null;
  $('#newfilepath > img').hide();
  $('form#addfile').on('submit', function(event)
  {
    var id = $(this).find('#id').val();
    $(this).ajaxSubmit(
    {
      url:$(this).attr('action'),
      method:$(this).attr('method'),
      success:function(data)
      {
        var json_obj = JSON.parse(data);         
        if(json_obj.hasOwnProperty('location'))
        {
          filePath = json_obj.location;
          $('#newfilepath').prepend(newFileStr);        
          $('#newfilepath > img').attr('src', $('#newfilepath > img').attr('src')+filePath);
          $('#newfilepath > img').show(); 
          $('#newfilepath').append($('#newfilepath > img').attr('src'));
        }
        $('#fileModal').modal('hide');
      }
    });   
    event.preventDefault();
  });
  */
})();

$.fn.appendRow = function()
{
  var s = '<tr>';
  for (var i = 0; i < arguments.length; i++)
  {
    s += '<td>'+arguments[i]+'</td>';
  }
  s += '</tr>';
  return $(this).append(s);
}