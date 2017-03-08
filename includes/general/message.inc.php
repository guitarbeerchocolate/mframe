<?php
if(isset($_GET['message']))
{
    $alert = $bs->alert($_GET['message']);
    $bs->singleRow(NULL, $alert);
    $bs->render();
}
?>