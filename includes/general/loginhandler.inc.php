<?php
if((isset($_GET['setuid'])) && (isset($_GET['secret'])))
{
    $id = $_GET['setuid'];
    $secret = $_GET['secret'];
    $row = $db->getOneByID('users',$id,'content');
    if($row['password'] == $secret)
    {
        $_SESSION['userid'] = $id;
        $outURL = $db->getVal('url').'private';
        $db->u->move_on($outURL);    
    }
    else
    {
        $error = 'Hack attempt failed';
        $outURL = $db->getVal('url');
        $db->u->move_on($outURL, $error);
    }
}
?>