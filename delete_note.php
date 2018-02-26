<?php 
// Сделан "вовой" 
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
if($_SESSION['loginin'] == "1"){
include('exec/dbconnect.php');
$qchu = $dbh1->prepare("SELECT * FROM note WHERE id = '".$_GET['id']."'");
$qchu->execute();
$chu = $qchu->fetch();
if ($chu['aid'] == $_SESSION['id']){
$q = "DELETE FROM `note` WHERE `id` = '".$_GET['id']."'";
$q1 = $dbh1->prepare($q);
$q1 -> execute();
$q1->fetch();
}
header('Location: notes'.$chu['aid']);
exit();
}else{
echo '<meta charset="utf-8">Пожалуйста, авторизируйтесь.<meta http-equiv="refresh" content="3;blank/../">';
}
?>