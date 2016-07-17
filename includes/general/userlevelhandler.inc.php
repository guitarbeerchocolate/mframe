<?php
if($status == 'private')
{
    $s->privateRedirect();
}
elseif($status == 'manager')
{
    $s->managerRedirect();
}
?>