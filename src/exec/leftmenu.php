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

 $ff = "SELECT * FROM `users` WHERE id='".$_SESSION['id']."'"; // выбираем нашего 
 $ff1 = $dbh1->prepare($ff); // отправляем запрос серверу
 $ff1 -> execute(); 
 $userlf = $ff1->fetch(); // ответ в переменную 	
 $fulllm = $userlf['lms'];
 $fr = substr($fulllm, 0, 1);
 $ph = substr($fulllm, 1, 1);
 $vd = substr($fulllm, 2, 1);
 $im = substr($fulllm, 3, 1);
 $zm = substr($fulllm, 4, 1);
 $gp = substr($fulllm, 5, 1);
 $vs = substr($fulllm, 6, 1);
 $fd = substr($fulllm, 7, 1);
if($fulllm != NULL){
if($fr == 1){?>
<a id="fr" href="friends.php">Мои Друзья <b><?php if ($frleftc != 0 ) echo "(".$frleftc.")";?></b></a>
<?php } if($ph == 1){ ?>
<a id="ph" href="albums.php">Мои Фотографии</a>
<?php } if($vd == 1){ ?>
<a id="vd" href="videos.php">Мои Видеозаписи</a>
<?php } if($im == 1){ ?>
<a id="im" href="messages.php">Мои Сообщения <?php if ($msleftc != 0 OR $msleftc != null) echo "<b>(".(int)$msleftc.")</b>";?></a>
<?php } if($zm == 1){ ?>
<a id="zm" href="notes.php">Мои Заметки</a>
<?php } if($gp == 1){ ?>
<a id="gp" href="groups.php">Мои Группы</a>
<?php } if($vs == 1){ ?>
<a id="vs" href="meetings.php">Мои Встречи <?php if ($meleftc != 0 OR $meleftc != null) echo "<b>(".(int)$meleftc.")</b>";?></a>
<?php } if($fd == 1){ ?>
<a id="fd" href="feed.php">Мои Новости</a>
<?php }?>
<a href="settings.php">Мои Настройки</a>
<br>
  	<?php
}else{
?>
<a id="fr" href="friends.php">Мои Друзья <b><?php if ($frleftc != 0 ) echo "(".$frleftc.")";?></b></a>
<a id="ph" href="albums.php">Мои Фотографии</a>
<a id="vd" href="videos.php">Мои Видеозаписи</a>
<a id="im" href="messages.php">Мои Сообщения <?php if ($msleftc != 0 OR $msleftc != null) echo "<b>(".(int)$msleftc.")</b>";?></a>
<a id="zm" href="notes.php">Мои Заметки</a>
<a id="gp" href="groups.php">Мои Группы</a>
<a id="vs" href="meetings.php">Мои Встречи <?php if ($meleftc != 0 OR $meleftc != null) echo "<b>(".(int)$meleftc.")</b>";?></a>
<a id="fd" href="feed.php">Мои Новости</a>
<a href="settings.php">Мои Настройки</a>
<br>
<?php
}
  }else{
  ?>
  <form method="post" action="login.php">
   <b>Логин:</b><br><input style="width:118px;" type="text" name="login" id="text"><br>
   <b>Пароль:</b><br><input style="width:118px;" type="password" name="password" id="text"><br>
   <input type="submit" value="Вход" id="button">
   </form>
  <? } ?>
  <div id="novost" style="
    background: #f7f7f7;
    padding: 5px 10px;
    margin-top: 10px;
">
  <span style="
    color: #2b587a;
    font-weight: bold;
    font-size: 13px;
    margin: 21px;
">Новости</span>
<div style="
    height: 1px;
    background: #d0d9e0;
    margin: 3px 0px;
"></div>

    <?php 
$qleftblog = $dbh1->prepare("SELECT * FROM blog ORDER BY id DESC LIMIT 1");
$qleftblog->execute(); 
$leftblog = $qleftblog->fetch();
echo '<div style="text-align: center;">'.$leftblog['k_about'].'</div><a style="
    padding: 0;
    margin: 0;
    background: none;
    border-top: none;
    width: unset;
    color: #2b587a;
    margin: 0px 16px;
	margin-top: 2px;
" href="blog_'.$leftblog['id'].'">подробнее...</a>';
  ?>  </div>
  </div>
  <div id="content-main">