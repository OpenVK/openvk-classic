<div id="content">
  <div id="left-menu">

  <?php 
  if ($_SESSION['loginin'] == '1') {
  ?>
<a href="id<?php echo $_SESSION['id'];?>">Моя Страница</a>
<?php 
$qsf = $dbh1->prepare("SELECT COUNT(1) FROM subs WHERE id2 = '".$_SESSION['id']."'");
$qsf->execute(); 
$frleftc = $qsf->fetch();
$frleftc = $frleftc[0];

$qsm1 = $dbh1->prepare("SELECT * FROM messages WHERE id2 = '".$_SESSION['id']."'");
$qsm1->execute(); 
while ($msleftc1 = $qsm1->fetch()) {
  
  if ($msleftc1['id2'] == $_SESSION['id'] AND $msleftc1['readed'] == "0") {
    $msleftc++;
    /*$qsm = $dbh1->prepare("SELECT COUNT(1) FROM messages WHERE readed = '0'");
  $qsm->execute(); 
  $msleftc = $qsm->fetch();
  $msleftc = $msleftc[0];*/
  }
}

$qsm2 = $dbh1->prepare("SELECT * FROM bugtracker WHERE status = '1'");
$qsm2->execute(); 
while ($bgleftc1 = $qsm2->fetch()) {
  
    $bgleftc++;
    
}

$qsme1 = $dbh1->prepare("SELECT * FROM `clubsub` WHERE `id1` = '".$_SESSION['id']."'");
$qsme1->execute(); 
while ($meleftc1 = $qsme1->fetch()) {
  $qsme12 = $dbh1->prepare("SELECT * FROM `club` WHERE `id` = '".$meleftc1['id2']."'");
  $qsme12->execute(); 
  $meleftc12 = $qsme12->fetch();
  if ($meleftc12['datefinish'] > time()) {
    $meleftc++;
    /*$qsm = $dbh1->prepare("SELECT COUNT(1) FROM messages WHERE readed = '0'");
  $qsm->execute(); 
  $msleftc = $qsm->fetch();
  $msleftc = $msleftc[0];*/
  }
}


 $q = "SELECT avatar, groupu FROM users WHERE id='".$_SESSION['id']."'"; // выбираем нашего 
 $q1 = $dbh1->prepare($q); // отправляем запрос серверу
 $q1 -> execute(); 
 $user1 = $q1->fetch(); // ответ в переменную 


?>
<a href="friends.php">Мои Друзья <b><?php if ($frleftc != 0 ) echo "(".$frleftc.")";?></b></a>
<a href="albums.php">Мои Фотографии</a>
<a href="videos.php">Мои Видеозаписи</a>
<a href="messages.php">Мои Сообщения <?php if ($msleftc != 0 OR $msleftc != null) echo "<b>(".(int)$msleftc.")</b>";?></a>

<a href="notes.php">Мои Заметки</a>
<a href="groups.php">Мои Группы</a>
<a href="meetings.php">Мои Встречи <?php if ($meleftc != 0 OR $meleftc != null) echo "<b>(".(int)$meleftc.")</b>";?></a>
<!-- <a href="#" onclick="alert('сорян ещё не запилили');" style="opacity: 0.25;">Мои Новости</a> -->
<a href="settings.php">Мои Настройки</a>
<? if($user1['groupu'] == "1" || $user1['groupu'] == "2"){ ?>
<hr>
<a href="bugtracker.php">Баг-трекер <b><?php if ($bgleftc != 0 ) echo "(".$bgleftc.")";?></b></a>
<? } ?>
<? if($user1['groupu'] == "2"){ ?>
<a href="admin_main.php">Админ-Панель</a>
<a href="admin_users.php">Пользователи</a>
<a href="admin_groups.php">Сообщества</a>

<? } ?>
<br>
  <div id="left-menu">
    <br>
    <br>
    <? if ($user1['avatar'] != null) {
      //echo '<img src="avatar.php?image='.$user1['avatar'].'" width="120" height="120">';
    }else{
      //echo '<img src="img/camera_200.png" width="120" height="120">';
    }
 ?>

    </div>
  	<?php
  }else{
  ?>
  <form method="post" action="login.php">
   <b>Логин:</b><br><input style="width:118px;" type="text" name="login" id="text"><br>
   <b>Пароль:</b><br><input style="width:118px;" type="password" name="password" id="text"><br>
   <input type="submit" value="Вход" id="button">
   </form>
  <? } ?>
  <hr>
  <h4>Новости</h4>
  <?php 
$qleftblog = $dbh1->prepare("SELECT * FROM blog ORDER BY id DESC LIMIT 1");
$qleftblog->execute(); 
$leftblog = $qleftblog->fetch();
echo '<text>'.$leftblog['name'].'</text><br><br><text>'.$leftblog['k_about'].'</text><a href="blog_'.$leftblog['id'].'">Подробнее...</a>';
  ?>
  </div>
  <div id="content-main">