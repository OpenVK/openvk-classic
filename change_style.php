<?php
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
if ($_POST['edit_design_advice'] == "yes") {
	$advice_settings = "1";
}else{
	$advice_settings = "0";
}
$qoq = "UPDATE `users` SET `cssstyle` = '".$_POST['edit_design_style']."', `advice_settings` = '".$advice_settings."'  WHERE `users`.`id` = ".$_SESSION['id']; // выбираем нашего 
$qoqa = $dbh1->prepare($qoq); // отправляем запрос серверу
$qoqa -> execute(); 
$qoqa->fetch();
header("Location: settings.php");
?>
