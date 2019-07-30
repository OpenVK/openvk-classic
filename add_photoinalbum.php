<?php
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
include 'reseample.php';
$albumtest = $dbh1->prepare("SELECT * FROM album WHERE id = :id");
$albumtest->bindValue(":id", $_SESSION['idalbum']);
$albumtest->execute();
$albumcheck = $albumtest->fetch();
if ($_SESSION['idalbum'] == $albumcheck['id']) {
	if ($_SESSION['id'] != $albumcheck['aid']) {
		echo $_SESSION['idalbum'].'<meta charset="utf-8">К сожалению, это не ваш альбом. В досутпе отказано.<meta http-equiv="refresh" content="3;blank/../">';
		exit();
	}
}
$rand = rand("1000000000","9999999999");
$path = 'content/img-albums/';
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
if (!@copy($_FILES['picture']['tmp_name'], $path . $_FILES['picture']['name'])){
echo 'error! check logs.';
}else{
if(strpos($_FILES['picture']['name'],'.jpg') || strpos($_FILES['picture']['name'],'.png') || strpos($_FILES['picture']['name'],'.jpeg') || strpos($_FILES['picture']['name'],'.gif' || $_FILES['picture']['name'],'.JPG') || strpos($_FILES['picture']['name'],'.PNG') || strpos($_FILES['picture']['name'],'.JPEG') || strpos($_FILES['picture']['name'],'.GIF')){
//	rename($path.$_FILES['picture']['name'], $path.$_SESSION['id']."_1.jpg");
imagejpeg(
	imagecreatefromstring(
		file_get_contents($path . $_FILES['picture']['name'])
	),
	$filename = $path.$rand.".jpg"
);
			$filename_333 = $path.$rand."_333.jpg";
			$filename_150 = $path.$rand."_150.jpg";
					
			reseample($filename, $filename_333, 333, 500);
			reseample($filename, $filename_150, 150, 800);

unlink($path . $_FILES['picture']['name']);
$qoq = "INSERT INTO `photo` (`id`, `image`, `image_333`, `image_150`, `aid`, `date`, `album`) VALUES (NULL, :image,  :image_333, :image_150, :aid, :dateup, :album)"; // выбираем нашего 
$qoqa = $dbh1->prepare($qoq); // отправляем запрос серверу
$qoqa->bindValue(':image', $filename);
$qoqa->bindValue(':image_333', $filename_333);
$qoqa->bindValue(':image_150', $filename_150);
$qoqa->bindValue(':aid', $_SESSION['id']);
$qoqa->bindValue(':dateup', time());
$qoqa->bindValue(':album', $_SESSION['idalbum']);
$qoqa -> execute(); 
$qoqa->fetch();
   
header("Location: album".$_SESSION['idalbum']);
}else{
echo '<meta charset="utf-8">выберите картинку, а не что-то другое.';
unlink($path . $_FILES['picture']['name']);
exit();
}
}
}

?>
