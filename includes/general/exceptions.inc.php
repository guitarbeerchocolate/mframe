<?php
if(isset($_GET['params']) && ($_GET['params'] == 'loader'))
{
    include_once 'includes/public/loader.inc.php';
    exit;
}
?>