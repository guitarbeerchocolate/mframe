<?php
ini_set('log_errors', 1);
$logfile = 'logs/php-'.date('d-m-Y');
ini_set('error_log', $logfile);
error_reporting(-1);
?>