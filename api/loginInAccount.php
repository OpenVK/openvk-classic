<?php
session_start(); // начинаем сессию
include('../exec/dbconnect.php');
if ($_SESSION['loginin'] != '1') {
 if ($_GET['login'] != null && $_GET['password'] != null) {
  $q = "SELECT * FROM users WHERE login='".$_GET['login']."'"; // выбираем нашего 
  $q1 = $dbh1->prepare($q); // отправляем запрос серверу
  $q1 -> execute(); 
  $user = $q1->fetch(); // ответ в переменную 
  if ($user['password'] == md5($_GET['password'])) {
  if ($user['ban'] == '1') {
    echo '{"error":"2", "message":"'.$user['comment_ban'].'"}';
    exit();
  }
    
    $_SESSION['loginin'] = '1'; // ставим сессионную переменную
    $_SESSION['login'] = $user['login']; 
    $_SESSION['id'] = $user['id'];
    $_SESSION['admin'] = $user['groupu'];
    $_SESSION['pass'] = $user['password']; // надо для проверки
    $_SESSION['groupu'] = $user['groupu']; // хм
    echo '{"error":"0", "message":"Вход выполнен"}';
     }else{
      echo '{"error":"1", "message":"Проверьте правильность логина и пароля."}';
     }
   }
}else if($_SESSION['loginin'] == '1'){
  //print('<center>  <h3> Привет! Ты уже зашел на свой аккаунт, нажми <a href="/openvk/id' . $_SESSION['id'] . '">КЛИК </a> </h3>');
  echo '{"error":"0", "message":"Вход выполнен"}';
  exit();
} ?>