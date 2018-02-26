<?php
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
$_GET['status'] = htmlentities($_GET['status'],ENT_QUOTES);
$_GET['status'] = str_replace(array("\r\n", "\r", "\n", ">", "<script>", ">"), '<br>', $_GET['status']);
$qoq = "UPDATE `users` SET `status` = '".$_GET['status']."'  WHERE `users`.`id` = ".$_SESSION['id']; // выбираем нашего 
$qoqa = $dbh1->prepare($qoq); // отправляем запрос серверу
$qoqa -> execute(); 
$qoqa->fetch();
header("Location: id".$_SESSION['id']);
?>
