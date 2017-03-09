<?php
$usernameInput = $bs->input('username', 'Email:', 'email');
$passwordInput = $bs->input('password', 'Password:', 'password');
$termsAnchor = 'Accept the <a data-toggle="modal" data-target="#terms">Terms of use?</a>';
$acceptTerms = $bs->checkbox('termsaccepted', $termsAnchor);
$reCaptcha = $bs->reCAPTCHA();
$fields = array($usernameInput,$passwordInput,$acceptTerms,$reCaptcha);
$action = $db->getVal('https_url').'formhandler.php?action=authenticate/register';
$form = $bs->form($fields,$action,FALSE,NULL);
$panel = $bs->panel($form,'Register');
$bs->tag('div',$panel,array('class'=>'col-md-4 authenticate'));
$bs->render();

$content = $db->u->include_to_string('includes/public/termsofusecontent.inc.php');
$bs->modal('terms', $content, 'Website terms of use', 'btn-primary');
$bs->render();
?>