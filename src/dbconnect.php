<?php
//echo '<meta charset="utf-8"><center>Сайт временно недоступен.</center>';
//exit;
$pz0 = "PASSWORD";
$logz = "USER";
$reqz = "mysql:host=HOST;dbname=DATABASE;charset=utf8";
$dbh1 = new PDO($reqz, $logz, $pz0);
?>