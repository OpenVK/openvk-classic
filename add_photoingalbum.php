<?php
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
$albumtest = $dbh1->prepare("SELECT * FROM galbum WHERE id = '".$_SESSION['idalbum']."'");
$albumtest->execute();
$albumcheck = $albumtest->fetch();
$rand = rand("1000000000","9999999999");
$path = 'content/img-albums/';
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
if (!@copy($_FILES['picture']['tmp_name'], $path . $_FILES['picture']['name'])){
echo 'error! check logs.';
}else{
if(strpos($_FILES['picture']['name'],'.jpg') || strpos($_FILES['picture']['name'],'.png') || strpos($_FILES['picture']['name'],'.jpeg') || strpos($_FILES['picture']['name'],'.gif' || $_FILES['picture']['name'],'.JPG') || strpos($_FILES['picture']['name'],'.PNG') || strpos($_FILES['picture']['name'],'.JPEG') || strpos($_FILES['picture']['name'],'.GIF')){
	$avatarrr = $path.$rand.".jpg";
//	rename($path.$_FILES['picture']['name'], $path.$_SESSION['id']."_1.jpg");
imagejpeg(
	imagecreatefromstring(
		file_get_contents($path . $_FILES['picture']['name'])
	),
	$path.$rand.".jpg"
);
unlink($path . $_FILES['picture']['name']);
$qoq = "INSERT INTO `photo` (`id`, `image`, `user`, `date`, `galbum`) VALUES (NULL, '".$avatarrr."',  '".$_SESSION['id']."', '".time()."', '".$_SESSION['idalbum']."')"; // выбираем нашего 
$qoqa = $dbh1->prepare($qoq); // отправляем запрос серверу
$qoqa -> execute(); 
$qoqa->fetch();
   
header("Location: album-".$_SESSION['idalbum']);
}else{
echo '<meta charset="utf-8">выберите картинку, а не что-то другое.';
unlink($path . $_FILES['picture']['name']);
exit();
}
}
}

?>
