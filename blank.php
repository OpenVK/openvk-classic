<?php 
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
include('exec/header.php');
echo '<link rel="stylesheet" href="blank.css">';
include('exec/leftmenu.php');
$id = $_GET['id'];
 if($id == '1'){
   echo '<div class="simpleBlock">
  <div class="simpleHeader">Ошибка!</div>
  <div class="simpleBar clearFix">
   Пользователь не найден!<hr> Попробуйте:<br>
   1. Ввести корректный ID.<br>
  
  </div>
 </div>';
 }  
 if($id == '2'){
   echo '<div class="simpleBlock">
  <div class="simpleHeader">Ошибка!</div>
  <div class="simpleBar clearFix">
   Сообщество не найдено!<hr> Попробуйте:<br>
   1. Ввести корректный ID сообщества.<br>
  
  </div>
 </div>';
 }  
  if($id == '3'){
   echo '<div class="simpleBlock">
  <div class="simpleHeader">Ошибка!</div>
  <div class="simpleBar clearFix">
   Пост не найден!<hr> Попробуйте:<br>
   1. Ввести корректный ID поста.<br>
  
  </div>
 </div>';
 } 
  if($id == '4'){
   echo '<div class="simpleBlock">
  <div class="simpleHeader">Ошибка!</div>
  <div class="simpleBar clearFix">
   Запись в блоге не найдена!<hr> Попробуйте:<br>
   1. Ввести корректный ID записи.<br>
  
  </div>
 </div>';
 } 
  if($id == '5'){
   echo '<div class="simpleBlock">
  <div class="simpleHeader">Ошибка!</div>
  <div class="simpleBar clearFix">
   Доступ к странице запрещен!<hr> Попробуйте:<br>
   1. Вернутся на <a href="index.php">главную</a>.<br>
  
  </div>
 </div>';
 } 
 if($id == '6'){
   echo '<div class="simpleBlock">
  <div class="simpleHeader">Ошибка!</div>
  <div class="simpleBar clearFix">
   Фотография не найдена!<hr> Попробуйте:<br>
   1. Ввести правильный путь файла.<br>
  
  </div>
 </div>';
 }
 if($id == '7'){
   echo '<div class="simpleBlock">
  <div class="simpleHeader">Ошибка!</div>
  <div class="simpleBar clearFix">
   Отказано в доступе.<br>
  
  </div>
 </div>';
 }
   if($id == null){
   echo '<div class="simpleBlock">
  <div class="simpleHeader">Ошибка!</div>
  <div class="simpleBar clearFix">
   Ошибка в обработчике ошибок. Офигенно, не правда ли?<hr> Попробуйте:<br>
   1. Вернуться на ту страницу, с которой пришли сюда.
  
  </div>
 </div>';
 } 
    if($id == '0'){
   echo '<div class="simpleBlock">
  <div class="simpleHeader">Ошибка!</div>
  <div class="simpleBar clearFix">
   Ошибка в обработчике ошибок. Офигенно, не правда ли?<hr> Попробуйте:<br>
   1. Вернуться на ту страницу, с которой пришли сюда.
  
  </div>
 </div>';
 } 
?>
</div>
</div>
</div>
<div>
<?php include('exec/footer.php'); ?>
</div>
</div>
</body>
</html>