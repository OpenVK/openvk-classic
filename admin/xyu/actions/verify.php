<?
session_start();
include('dbconnect.php');
include('check_user.php');
if(!isset($_GET['id'])){
header("Location: http://veselcraft.ru/openvk/index.php");
exit();
}
include('header.php');
include('datefn.php');
include('leftmenu.php');
if ($_SESSION['loginin'] == '1') {
if ($_SESSION['groupu'] == '2') {
$id = $_GET['id'];
$q = "SELECT * FROM users WHERE id='".$id."'"; // выбираем нашего 
$q1 = $dbh1->prepare($q); // отправляем запрос серверу
$q1 -> execute(); 
$user = $q1->fetch(); // ответ в переменную 

if($user['verify'] == "0"){
	if(!isset($_GET['comment'])){
	echo '<div id="content-infoname"><b>Верификация</b></div>
	<meta charset="utf-8" /><form method="get" action=""><span>Тип:</span><br><input class="comment" placeholder="тип галочки" name="comment"><br><span>ID:</span><br><input class="id" type="text" placeholder="id,еба" name="id" value="'.$id.'"><br><button type="submit" id="button" value="выдать">Выдать</button></form>';
	exit;
    } else {
	$qthis = "UPDATE `users` SET `verify` = '".$_GET['comment']."' WHERE `users`.`id` = '".$_GET['id']."'";
	$q1this = $dbh1->prepare($qthis); // отправляем запрос серверу
	$q1this -> execute();
	echo '<div id="content-infoname"><b>Верификация</b></div>';
	echo 'Верификационная отметка выдана.<br><br><a id="button" href="http://veselcraft.ru/openvk/id'.$id.'">Назад</a><br><br>';
	exit;
}
}
if($user['verify'] != "0"){
	$qthis = "UPDATE `users` SET `verify` = '0' WHERE `users`.`id` = '".$id."'";
	$q1this = $dbh1->prepare($qthis); // отправляем запрос серверу
	$q1this -> execute();
	echo '<div id="content-infoname"><b>Верификация</b></div>';
	echo 'Верификационная отметка снята.<br><br><a id="button" href="http://veselcraft.ru/openvk/id'.$id.'">Назад</a><br><br>';
	exit;
}else{
	echo 'Пользователь уже верифицирован.';
}
}else{
	exit();
}
}else{
	exit();
}
?>
