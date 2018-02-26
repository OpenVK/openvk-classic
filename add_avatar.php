<?php
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
$path = 'content/avatars/';
$rand = rand("1000000000","9999999999");
if(file_exists($path.$rand.".jpg")){
	$rand = rand("1000000000","9999999999");
}
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
if (!@copy($_FILES['picture']['tmp_name'], $path . $_FILES['picture']['name'])){
echo 'error! check logs.';
}else{
if(strpos($_FILES['picture']['name'],'.jpg') || strpos($_FILES['picture']['name'],'.png') || strpos($_FILES['picture']['name'],'.jpeg') || strpos($_FILES['picture']['name'],'.gif')){
	$avatarrr = $path.$rand.".jpg";
//	rename($path.$_FILES['picture']['name'], $path.$_SESSION['id']."_1.jpg");
imagejpeg(
	imagecreatefromstring(
		file_get_contents($path . $_FILES['picture']['name'])
	),
	$path.$rand.".jpg"
);
unlink($path . $_FILES['picture']['name']);
$qoq = "UPDATE `users` SET `avatar` = '".$avatarrr."' WHERE `users`.`id` = ".$_SESSION['id']; // выбираем нашего 
$qoqa = $dbh1->prepare($qoq); // отправляем запрос серверу
$qoqa -> execute(); 
$qoqa->fetch();
   
header("Location: settings.php");
}else{
echo '<meta charset="utf-8">выберите картинку, а не что-то другое.';
unlink($path . $_FILES['picture']['name']);
exit();
}
}
}

?>
