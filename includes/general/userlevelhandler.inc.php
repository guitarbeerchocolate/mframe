<?php
if($liveConfig['status'] == 'private')
{
    $s->privateRedirect();
}
elseif($liveConfig['status'] == 'manager')
{
    $s->managerRedirect();
}
?>