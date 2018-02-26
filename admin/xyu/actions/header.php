<?php
$unixshit = time();
$qo = "UPDATE `users` SET `lastonline` = '".$unixshit."' WHERE `users`.`id` = ".$_SESSION['id']; // выбираем нашего 
$qonline = $dbh1->prepare($qo); // отправляем запрос серверу
$qonline -> execute(); 
$qonline->fetch();
?>
<html>
 <head>
  <title>OpenVK</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="http://veselcraft.ru/openvk/style.css">
  <style>#head-wrapper{background:url(http://veselcraft.ru/openvk/img/header-beta.png);}</style>
 </head>
 <body>
 <noscript><div class="infonew">Мы заметили у Вас древнейший браузер.<br><br>Некоторые функции сайта не будут работать (из-за использования JavaScript).<br><br>Рекомендуем Вам обновить свой браузер на <a href="http://google.com/chrome">Google Chrome</a> или на <a href="http://browser.yandex.ru">Яндекс.Браузер</a>, но в то же время поддерживаются старые версии Opera начиная с версии 9.64</div></noscript>
 <?
 
$qh2 = "SELECT * FROM users WHERE id='".$id."'";
 $h2 = $dbh1->prepare($qh2);
$h2 -> execute();
$g2r = $h2->fetch();
$q = "SELECT * FROM info_site"; // выбираем нашего 
 $q1 = $dbh1->prepare($q); // отправляем запрос серверу
 $q1 -> execute(); 
 $inf = $q1->fetch(); // ответ в переменную  ?>

<?php if($inf['infoonn'] == '1'){
echo '<div class="infonew">
'.$inf["infotext"].'
</div>';
} ?>
 <div id="head">
  <div id="head-wrapper">
   <div style="margin-left: 50px;"></div>
   <div id="head-buttons">
   <?php 
  if ($_SESSION['loginin'] == '1') {
  ?><div id="head-button" style="width: 3.5em"><a href="logout.php">выйти</a></div><div id="head-button" style="width: 4.0em"><a href="help.php">помощь</a></div>
  <?php } ?>   <div id="head-button" style="width: 3.5em"><a href="search.php">люди</a></div><div id="head-button" style="width: 3.0em"><a href="#" onclick="alert('Мы - команда OpenVK, и это клон ВКонтакте, но с открытым исходным кодом (который ещё не опубликован) под лицензией GPL (GNU General Public License). Ознакомиться с ней можно по ссылке: http://veselcraft.ru/openvk/LICENSE.txt');">о нас</a></div></div>	
   </div>
  </div>
 </div>