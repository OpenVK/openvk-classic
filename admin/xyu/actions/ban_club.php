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
$q = "SELECT * FROM club WHERE id='".$id."'"; // выбираем нашего 
$q1 = $dbh1->prepare($q); // отправляем запрос серверу
$q1 -> execute(); 
$user = $q1->fetch(); // ответ в переменную 

if($user['ban'] == "0"){
	$qthis = "UPDATE `club` SET `ban` = '1' WHERE `club`.`id` = '".$id."'";
	$q1this = $dbh1->prepare($qthis); // отправляем запрос серверу
	$q1this -> execute();
	echo '<div id="content-infoname"><b>Бан</b></div>';
	echo 'Группа успешно заблокирована<br><br><a id="button" href="http://veselcraft.ru/openvk/club'.$id.'">Назад</a><br><br>';
	exit;
}
if($user['ban'] == "1"){
	$qthis = "UPDATE `club` SET `ban` = '0' WHERE `club`.`id` = '".$id."'";
	$q1this = $dbh1->prepare($qthis); // отправляем запрос серверу
	$q1this -> execute();
	echo '<div id="content-infoname"><b>Разбан</b></div>';
	echo 'Группа успешно разблокирована.<br><br><a id="button" href="http://veselcraft.ru/openvk/club'.$id.'">Назад</a><br><br>';
	exit;
}else{
	echo 'Группа уже заблокирована.';
}
}else{
	exit();
}
}else{
	exit();
}
?>
