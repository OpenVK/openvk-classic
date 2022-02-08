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
if(isset($_SESSION['id'])){
$id = $_SESSION['id'];
}
if(isset($_POST['id'])){
$idpost = $_POST['id'];
}
if(isset($_POST['text'])){
$text = $_POST['text'];
}
$q = "INSERT INTO `comments` (`id`, `iduser`, `idpost`, `text`, `date`) VALUES (NULL, '".$id."', '".$idpost."', '".$text."', '".time()."')"; // добавляем коммент 
$q1 = $dbh1->prepare($q); // отправляем запрос серверу
$q1 -> execute(); 
$q1->fetch();
header('Location: post'.$_POST['id']);
}else if($_SESSION['loginin'] != '1'){
echo '<meta charset="utf-8">Хакеры? Интересно.<meta http-equiv="refresh" content="3;blank/..">';
exit();
}
?>
