var form = $("form[role='form']");
var action = form.attr('action');
action = 'formhandler.php?action='+action;
form.attr('action', action);