<?php 
session_start(); // начинаем сессию
include('exec/dbconnect.php');
if ($_SESSION['loginin'] != '1') {
 if ($_POST['login'] != null && $_POST['password'] != null) {
  $q = "SELECT * FROM users WHERE login='".$_POST['login']."'"; // выбираем нашего 
  $q1 = $dbh1->prepare($q); // отправляем запрос серверу
  $q1 -> execute(); 
  $user = $q1->fetch(); // ответ в переменную 
  if ($user['password'] == md5($_POST['password'])) {
  if ($user['ban'] == '1') {
    echo "<meta charset='utf-8'>Ваша страница был заблокированна модераторами. Комментарий модератора: ".$user['comment_ban'].". Сожалеем об этом.";
    exit();
  }
    
    $_SESSION['loginin'] = '1'; // ставим сессионную переменную
    $_SESSION['login'] = $user['login']; 
    $_SESSION['id'] = $user['id'];
    $_SESSION['admin'] = $user['groupu'];
    $_SESSION['pass'] = $user['password']; // надо для проверки
    $_SESSION['groupu'] = $user['groupu']; // хм
    header('Location: id'.$_SESSION['id']);
     }else{
      $_SESSION['errormsg'] = "<b> Проверьте правильность логина и пароля. </b>";
     }
   }
}else if($_SESSION['loginin'] == '1'){
  //print('<center>  <h3> Привет! Ты уже зашел на свой аккаунт, нажми <a href="/openvk/id' . $_SESSION['id'] . '">КЛИК </a> </h3>');
  header("Location: id".$_SESSION['id']);
  exit();
}
include('exec/header.php');
include('exec/leftmenu.php');
?>
<div id="content-infoname"><b>Вход</b></div>
  <?php if($_SESSION['errormsg']){
    echo '<div id="msg">'.$_SESSION['errormsg'].'</div>';
    $_SESSION['errormsg'] = NULL;
  } ?>
   <form method="post" action="login.php">
   <table border="0" style="font-size:11px;">
   <tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Логин:</div></td><td><input style="width:380px;" type="text" name="login" id="text"></td></tr>
   <tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Пароль:</div></td><td><input style="width:380px;" type="password" name="password" id="text"></td></tr>
   </table><br><div style="margin-left:157px;"><input type="submit" value="Вход" id="button"><button id="button" style="margin-left:12px;" href="register.php" disabled>Регистрация</button></div><br><br>
   </form>
   
  </div>
 </div>
 </div>
 <div>
 <? include ('exec/footer.php'); ?>
 </div>
 </body>
</html>
