<?
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
include('exec/header.php');
include('exec/leftmenu.php'); 
$qthis = "SELECT groupu FROM users WHERE id = '".$_SESSION['id']."'"; // выбираем нашего 
$q1this = $dbh1->prepare($qthis); // отправляем запрос серверу
$q1this -> execute(); 
$userthis = $q1this->fetch(); // ответ в переменную
if($_SESSION['loginin'] == '1'){
?>
<div id="content-infoname"><b>Админ-Тулс</b></div>
<a href="galochka.php?id=1">Выдать галочку (а чо бы и нет?)</a>
<? }else if($_SESSION['loginin'] != '1'){
echo '<meta charset="utf-8">Хакеры? Интересно.<meta http-equiv="refresh" content="3;blank/..">';
exit();
} ?>