<?php 
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
if($_SESSION['loginin'] == '1'){
if($_POST['text'] == NULL){
echo '<meta charset="utf-8">Проверьте, вы вообще что-то писали на поле?<meta http-equiv="refresh" content="3;post'.$_POST['id'].'">';
exit();
}
//$_POST['text'] = str_replace('<', '&#60;', $_POST['text']);
//$_POST['text'] = str_replace('>', '&#62;', $_POST['text']);
$_POST['text'] = htmlentities($_POST['text'],ENT_QUOTES);
$_POST['text'] = str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['text']);
include('exec/dbconnect.php');
if(isset($_SESSION['id'])){
$id = $_SESSION['id'];
}
if(isset($_POST['id'])){
$idpost = $_POST['id'];
}
if(isset($_POST['text'])){
$text = $_POST['text'];
}
// провирка
$q2= "SELECT * FROM `wall` WHERE id = '".$idpost."'"; // добавляем коммент 
$q22 = $dbh1->prepare($q2); // отправляем запрос серверу
$q22 -> execute(); 
$q222 = $q22->fetch();
if ($q222['iduser'] == $_SESSION['id']) {
	$q = "UPDATE `wall` SET `text` = '".$text."', `edited` = '1' WHERE `wall`.`id` = ".$idpost; // добавляем коммент 
	$q1 = $dbh1->prepare($q); // отправляем запрос серверу
	$q1 -> execute(); 
	$q1->fetch();
	header('Location: post'.$_POST['id']);
}else{
	echo '<meta charset="utf-8">Хакеры? Интересно.<meta http-equiv="refresh" content="3;blank/..">';
exit();
}


}else if($_SESSION['loginin'] != '1'){
echo '<meta charset="utf-8">Хакеры? Интересно.<meta http-equiv="refresh" content="3;blank/..">';
exit();
}
?>
