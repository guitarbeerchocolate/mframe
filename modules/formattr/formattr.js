var form = '';
var action = '';
$("form[role='form']").each(function()
{
	action = $(this).attr('action');
	action = 'formhandler.php?action='+action;
	$(this).attr('action', action);
});