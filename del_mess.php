<?php 
// Сделан "ХУЙ ЗНАЕТ КЕМ" (афтор файлика напиши сюда своё имя пожалуйста)
// Доделан кеселем
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
if($_SESSION['loginin'] == "1"){
include('exec/dbconnect.php');
$qchu = $dbh1->prepare("SELECT * FROM messages WHERE id = '".$_GET['id']."'");
$qchu->execute();
$chu = $qchu->fetch();
if ($chu['id1'] == $_SESSION['id']){
$q = "DELETE FROM `messages` WHERE `messages`.`id` = '".$_GET['id']."'";
$q1 = $dbh1->prepare($q);
$q1 -> execute();
$q1->fetch();
}else{
echo 'нахуй';
}
header('Location: messages.php');
exit();
}else{
echo '<meta charset="utf-8">Пожалуйста, авторизируйтесь.<meta http-equiv="refresh" content="3;blank/../">';
}
?>