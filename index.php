<?php 
session_start(); // начинаем сессию
include('exec/dbconnect.php');
if($_SESSION['loginin'] == '1'){
  //print('<center>  <h3> Привет! Ты уже зашел на свой аккаунт, нажми <a href="/openvk/id' . $_SESSION['id'] . '">КЛИК </a> </h3>');
  header("Location: id".$_SESSION['id']);
  exit();
}
include('exec/header.php');
include('exec/leftmenu.php');
?>
<div id="content-infoname"><b>Добро пожаловать!</b></div>
  <?php if($_SESSION['errormsg']){
    echo '<div id="msg">'.$_SESSION['errormsg'].'</div>';
    $_SESSION['errormsg'] = NULL;
  } ?>
   <form method="post" action="index.php">
    
   <b>Добро пожаловать в OpenVK.</b><br><br>
   Этот сайт создан для быстрой связи с друзьями, одноклассниками и однокурсниками.<br><br>
   <?php $q = "SELECT COUNT(1) FROM users"; // выбираем нашего 
 $q1 = $dbh1->prepare($q); // отправляем запрос серверу
 $q1 -> execute(); 
 $countusers = $q1->fetch(); 
 $countusers = $countusers[0];
 if ($countusers == '1') {
     $userscouunt = (string)$countusers." пользователь";
   }elseif ($countusers == '2' OR $countusers == '3' OR $countusers == '4') {
     $userscouunt = (string)$countusers." пользователя";
   }else{
     $userscouunt = (string)$countusers." пользователей";
   }
 ?>
   Уже написано <b>5,000+</b> строчек кода и зарегистрированно <b><?php echo $userscouunt ?></b>.<br><br>
   <span style="font-style:italic;">Не путать с другим продуктом с таким же названием &mdash; программы для взлома страницы во ВКонтакте. Обратите внимание, что мы лишь создаём социальную сеть с исходным кодом.</span><br><br>На сайте Вы можете:<br>
   <ul>
     <li>Найти старых и новых друзей</li>
     <li>Узнать побольше информации о тех, с кем Вы дружили или учились</li>
     <li>Оставить данные о себе, чтобы находить новых друзей</li>
   </ul><br>
   <br><center><a href="login.php" id="button">Вход</a><a id="button" style="margin-left:12px;" href="register.php">Регистрация</a></center><br><br>
   <a href="tour.php?a=1"><div id="buttontour">Тур по сайту</div></a>
   </form>
   
  </div>
 </div>
 </div>
 <div>
 <? include ('exec/footer.php'); ?>
 </div>
 </body>
</html>



