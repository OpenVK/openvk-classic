<?php 
// Сделан "ХУЙ ЗНАЕТ КЕМ" (афтор файлика напиши сюда своё имя пожалуйста)
// Доделан кеселем
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
if($_SESSION['loginin'] == "1"){
include('exec/dbconnect.php');
$qchg = $dbh1->prepare("SELECT * FROM gpost WHERE id = '".$_GET['id']."'");
$qchg->execute();
$chg = $qchg->fetch();
$qchg2 = $dbh1->prepare("SELECT * FROM club WHERE id = '".$chg['idwall']."'");
$qchg2->execute();
$chg2 = $qchg2->fetch();
if ($chg['iduser'] == $_SESSION['id']){
$q = "DELETE FROM `gpost` WHERE `gpost`.`id` = '".$_GET['id']."'";
$q1 = $dbh1->prepare($q);
$q1 -> execute();
$q1->fetch();
}elseif ($chg2['authorid'] == $_SESSION['id']) {
$q = "DELETE FROM `gpost` WHERE `gpost`.`id` = '".$_GET['id']."'";
$q1 = $dbh1->prepare($q);
$q1 -> execute();
$q1->fetch();
}
header('Location: club'.$_SESSION['clubwall']);
exit();
}else{
echo '<meta charset="utf-8">Пожалуйста, авторизируйтесь.<meta http-equiv="refresh" content="3;blank/../">';
}
?>