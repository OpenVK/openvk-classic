<?
session_start();
include('dbconnect.php');
include('check_user.php');
if(!isset($_GET['id'])){
	die('<meta charset="utf-8">чё, пацаны, хакеры?');
}
if($_GET['id'] == null){
	echo '<meta charset="utf-8">чё, пацаны, хакеры?';
	exit();
}
include('header.php');
include('datefn.php');
include('leftmenu.php');
if ($_SESSION['loginin'] == '1') {
if ($_SESSION['groupu'] == '2') {
$idthis = $_SESSION['id'];
$id = $_GET['id'];
$qthis = "SELECT groupu FROM users WHERE id = '".$_SESSION['id']."'"; // выбираем нашего 
$q1this = $dbh1->prepare($qthis); // отправляем запрос серверу
$q1this -> execute(); 
$userthis = $q1this->fetch(); // ответ в переменную
if($userthis['groupu'] != "2"){
	header("Location: http://veselcraft.ru/openvk/id".$id);
}
if($user['groupu'] != "0"){
	$qthis = "UPDATE `users` SET `groupu` = '0' WHERE `users`.`id` = '".$id."'";
	$q1this = $dbh1->prepare($qthis); // отправляем запрос серверу
	$q1this -> execute();
	echo '<div id="content-infoname"><b>Выдача определенных прав</b></div>';
	echo 'Пользователь теперь относится к группе пользователей.<br><br><a id="button" href="http://veselcraft.ru/openvk/id'.$id.'">Назад</a><br><br>';
	exit;
}
if(!isset($_GET['type'])){
	echo '<div id="content-infoname"><b>Выдача определенных прав</b></div>
	<meta charset="utf-8" /><form method="get" action=""><span>ID:</span><br><input class="id" type="text" placeholder="id,еба" name="id" value="'.$id.'"><br><button type="submit" id="button" value="выдать">Выдать</button></form><br>';
}
elseif($idthis != $id){
	$galka = $_GET['type'];
	$qthis = "UPDATE `users` SET `groupu` = '1' WHERE `users`.`id` = '".$id."'";
	$q1this = $dbh1->prepare($qthis); // отправляем запрос серверу
	$q1this -> execute();
	echo '<div id="content-infoname"><b>Выдача определенных прав</b></div>
	Права модератора успешно выданны.<br><br><a id="button" href="http://veselcraft.ru/openvk/id'.$id.'">Назад</a><br><br>';
} else {
	 echo 'Неизвестная ошибка.';
}
}else{exit();}
}else{exit();}
?>