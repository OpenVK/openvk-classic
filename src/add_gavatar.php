<?php
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
$path = 'content/gavatars/';
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
$qclub = $dbh1->prepare("SELECT * FROM club WHERE id='".$_POST['edit_avatar_id']."'");
$qclub -> execute();
$clubdata = $qclub->fetch();
if($clubdata['authorid'] == $_SESSION['id']){
if (!@copy($_FILES['picture']['tmp_name'], $path . $_FILES['picture']['name'])){
echo 'error! check logs.';
}else{
if(strpos($_FILES['picture']['name'],'.jpg') || strpos($_FILES['picture']['name'],'.png') || strpos($_FILES['picture']['name'],'.jpeg') || strpos($_FILES['picture']['name'],'.gif')){
	$avatarrr = $path.$_POST['edit_avatar_id']."_1.jpg";
//	rename($path.$_FILES['picture']['name'], $path.$_SESSION['id']."_1.jpg");
imagejpeg(
	imagecreatefromstring(
		file_get_contents($path . $_FILES['picture']['name'])
	),
	$path.$_POST['edit_avatar_id']."_1.jpg"
);
unlink($path . $_FILES['picture']['name']);
$qoq = "UPDATE `club` SET `avatar` = '".$avatarrr."' WHERE `club`.`id` = ".$_POST['edit_avatar_id']; // выбираем нашего 
$qoqa = $dbh1->prepare($qoq); // отправляем запрос серверу
$qoqa -> execute(); 
$qoqa->fetch();
   
header("Location: gsettings.php?id=".$_POST['edit_avatar_id']);
}else{
echo '<meta charset="utf-8">выберите картинку, а не что-то другое.';
unlink($path . $_FILES['picture']['name']);
exit();
}
}
}
}
?>