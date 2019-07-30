<?php 
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
$qs = "SELECT * FROM users WHERE id = '".$_GET['id']."'"; // выбираем нашего 
$qstyle = $dbh1->prepare($qs); // отправляем запрос серверу
$qstyle -> execute(); 
$qst = $qstyle->fetch();
if($_SESSION['loginin'] == "1"){
if($_SESSION['groupu'] == "3" AND $qst['groupu'] != "3"){
if($_GET['gr'] == "2"){
	$galya = 4;
}elseif($_GET['gr'] == "3"){
	$galya = 5;
}
$q = "UPDATE `users` SET `groupu` = '".$_GET['gr']."', `verify` = '".$galya."' WHERE `users`.`id` = '".$_GET['id']."'";
$q1 = $dbh1->prepare($q);
$q1 -> execute();
$q1->fetch();
header('Location: id'.$_SESSION['userwall']);
exit();
}else{
	echo '<meta charset="utf-8">А может нахуй?';
}
}else{
echo '<meta charset="utf-8">Пожалуйста, авторизируйтесь.<meta http-equiv="refresh" content="3;blank/../">';
}
?>