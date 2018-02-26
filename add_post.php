<?php 
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
if($_SESSION['loginin'] == '1'){
	if($_POST['text'] == NULL){
		echo '<meta charset="utf-8">Проверьте, вы вообще что-то писали на поле?<meta http-equiv="refresh" content="3;id'.$_SESSION['userwall'].'">';
		exit();
	}
	$_POST['text'] = htmlentities($_POST['text'],ENT_QUOTES);
	$_POST['text'] = str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['text']);
	$_POST['text'] = preg_replace("~(http|https|ftp|ftps)://(.*?)(\s|\n|[,.?!](\s|\n)|$)~", '<a href="$1://$2">$1://$2</a>$3', $_POST['text']);
    //тестирование плюшек
    if($_SESSION['groupu'] == '1' OR $_SESSION['groupu'] == '2'){
    	//цвета
    	$_POST['text'] = str_replace('&amp;Green', '<span style="color:green">', $_POST['text']);
    	$_POST['text'] = str_replace('&amp;Red', '<span style="color:red">', $_POST['text']);
    	$_POST['text'] = str_replace('&amp;Blue', '<span style="color:blue">', $_POST['text']);
    	$_POST['text'] = str_replace('&amp;Violet', '<span style="color:violet">', $_POST['text']);
    	$_POST['text'] = str_replace('&amp;Brown', '<span style="color:brown">', $_POST['text']);
    	//закрывалка
    	$_POST['text'] = str_replace('&amp;Close', '</span>', $_POST['text']);
    	//фаст-фразочки
    	$_POST['text'] = str_replace('&amp;hi', 'Приветствую!', $_POST['text']);
    	$_POST['text'] = str_replace('&amp;oa', 'Мы добавили в OpenVK некоторые функции, а так-же исправили баги.', $_POST['text']);
    	$_POST['text'] = str_replace('&amp;ia', 'Так-же Мы на данный момент планируем сделать ещё несколько функций.', $_POST['text']);
    	$_POST['text'] = str_replace('&amp;bi', 'До скорых встреч!', $_POST['text']);
    }
    $_POST['text'] = str_replace('bold', '<b>', $_POST['text']);
    $_POST['text'] = $_POST['text'].'</b>';
	include('exec/dbconnect.php');
	$path = 'content/img-post/';
	if (!@copy($_FILES['upimg']['tmp_name'], $path . $_FILES['upimg']['name'])){
		$timep = time();
		$q = "INSERT INTO `wall` (`id`, `iduser`, `idwall`, `text`, `date`) VALUES (NULL, '".$_SESSION['id']."', '".$_SESSION['userwall']."', '".$_POST['text']."', '".$timep."')"; // выбираем нашего 
		$q1 = $dbh1->prepare($q); // отправляем запрос серверу
		$q1 -> execute(); 
		$q1->fetch();
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
	$q = "INSERT INTO `wall` (`id`, `iduser`, `idwall`, `text`, `date`, `image`) VALUES (NULL, '".$_SESSION['id']."', '".$_SESSION['userwall']."', '".$_POST['text']."', '".$timep."', '".$path.$rand.".jpg')"; // выбираем нашего 
	$q1 = $dbh1->prepare($q); // отправляем запрос серверу
	$q1 -> execute(); 
	$q1->fetch();
	//if (!@copy($_FILES['upimg']['tmp_name'], $path . $_FILES['upimg']['name'])){
	//	//echo $path.$_FILES['upimg']['name'].'.jpg // '.$path.$_FILES['upimg']['tmp_name'].'.jpg';
	//	header('Location: id'.$_SESSION['userwall']);
	//}else{
	imagejpeg(
		imagecreatefromstring(
			file_get_contents($path . $_FILES['upimg']['name'])
		),
		$path.$rand.".jpg"
	);
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
?>
