<?php
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
include 'reseample.php';
$usercheckq = 'SELECT id, ban, closedwall FROM `users` WHERE id = :id'; // выбираем нашего
$usercheck = $dbh1->prepare($usercheckq); // отправляем запрос серверу
$usercheck->bindValue(':id', $_SESSION['userwall']);
$usercheck -> execute();
$userc = $usercheck->fetch();
if ($userc['ban'] == '1' || $userc['closedwall'] == '1') {
	if ($userc['id'] != $_SESSION['id']) {
		exit("user is banned or wall is closed");
	}
}elseif (empty($userc['id'])){
	exit("user is not exists");
}else{

if($_SESSION['loginin'] == '1'){
	if($_POST['text'] == NULL){
		echo '<meta charset="utf-8">Проверьте, вы вообще что-то писали на поле?<meta http-equiv="refresh" content="3;id'.$_SESSION['userwall'].'">';
		exit();
	}
	$_POST['text'] = htmlentities($_POST['text'],ENT_QUOTES);
	$_POST['text'] = str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['text']);
	$_POST['text'] = preg_replace("~(http|https|ftp|ftps)://(.*?)(\s|\n|[,.?!](\s|\n)|$)~", '<a href="$1://$2">$1://$2</a>$3', $_POST['text']);
	include('exec/dbconnect.php');
	$path = 'content/img-post/';
	if (!@copy($_FILES['upimg']['tmp_name'], $path . $_FILES['upimg']['name'])){
		$timep = time();
		$dbh1->query("INSERT INTO `wall` (`id`, `iduser`, `idwall`, `text`, `date`) VALUES (NULL, '{$_SESSION['id']}', '{$_SESSION['userwall']}', '{$_POST['text']}', '$timep')"); // выбираем нашего
		/*$q1 = $dbh1->prepare($q); // отправляем запрос серверу
		$q1 -> execute(); 
		$q1->bindValue(':id', $_SESSION['id']);
		$q1->bindValue(':wall', $_SESSION['userwall']);
		$q1->bindValue(':text', $_POST['text']);
		$q1->bindValue(':timep', $timep);
		$q1->fetch();*/
		header('Location: id'.$_SESSION['userwall']);
		exit();
	}else{
	if(strpos($_FILES['upimg']['name'],'.jpg') || strpos($_FILES['upimg']['name'],'.png') || strpos($_FILES['upimg']['name'],'.jpeg') || strpos($_FILES['upimg']['name'],'.gif')){
	$timep = time();
	$rand = rand("1000000000","9999999999");
	$path = 'content/img-post/';
	if(file_exists($path.$rand.".jpg")){
		$rand = rand("1000000000","9999999999");
	}
	imagejpeg(
		imagecreatefromstring(
			file_get_contents($path . $_FILES['upimg']['name'])
		),
		$filename = $path.$rand.".jpg"
	);

	$filename_333 = $path.$rand."_333.jpg";
	$filename_150 = $path.$rand."_150.jpg";
			
	reseample($filename, $filename_333, 333, 500);
	reseample($filename, $filename_150, 150, 800);


	$timephoto = time();
	unlink($path . $_FILES['upimg']['name']);

	$qoq = "INSERT INTO `photo` (`id`, `image`, `image_333`, `image_150`, `aid`, `date`, `album`) VALUES (NULL, :image, :image_333, :image_150, :aid,:dateup,:album)";// выбираем нашего
	$qoqa = $dbh1->prepare($qoq); // отправляем запрос серверу
	$qoqa->bindValue(':image', $filename);
	$qoqa->bindValue(':image_333', $filename_333);
	$qoqa->bindValue(':image_150', $filename_150);
	$qoqa->bindValue(':aid', $_SESSION['id']);
	$qoqa->bindValue(':dateup', $timephoto);
	$qoqa->bindValue(':album', '-1');
	$qoqa -> execute();
	$qoqa->fetch();


	$qoqcheck = 'SELECT id FROM `photo` WHERE image = :image AND aid = :aid'; // выбираем нашего
	$qoqac = $dbh1->prepare($qoqcheck); // отправляем запрос серверу
	$qoqac->bindValue(':image', $filename);
	$qoqac->bindValue(':aid', $_SESSION['id']);
	$qoqac -> execute();
	$qoqacc = $qoqac->fetch();
	$tt = time();
	$photo__ = $qoqacc['id'];
	$q = "INSERT INTO `wall` (`id`, `iduser`, `idwall`, `text`, `date`, `image`) VALUES (NULL, :id, :wall, :text, :time, :image)"; // выбираем нашего
	$q1 = $dbh1->prepare($q); // отправляем запрос серверу
	$q1->bindValue(':id', $_SESSION['id']);
	$q1->bindValue(':wall', $_SESSION['userwall']);
	$q1->bindValue(':text', $_POST['text']);
	$q1->bindValue(':time', time());
	$q1->bindValue(':image', $photo__);
	if ($q1->execute()) {
        echo 'Hi!';
        $q1->fetch();
	} else {
		echo 'error! check logs.';
	}



	
	unlink($path . $_FILES['upimg']['name']);
	header('Location: id'.$_SESSION['userwall']);
	}else{
	echo '<meta charset="utf-8">выберите картинку, а не что-то другое.';
	unlink($path . $_FILES['upimg']['name']);
	exit();
	}
	}
}else if($_SESSION['loginin'] != '1'){
	echo '<meta charset="utf-8">Хакеры? Интересно.<meta http-equiv="refresh" content="3;blank/..">';
	exit();
}
}
?>
