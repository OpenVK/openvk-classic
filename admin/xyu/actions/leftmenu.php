<div id="content">
  <div id="left-menu">

  <?php 
  if ($_SESSION['loginin'] == '1') {
  ?>
<a href="/openvk/id<?php echo $_SESSION['id'];?>">Моя Страница</a>
<?php 
$qsf = $dbh1->prepare("SELECT COUNT(1) FROM subs WHERE id2 = '".$_SESSION['id']."'");
$qsf->execute(); 
$frleftc = $qsf->fetch();
$frleftc = $frleftc[0];
?>
<a href="/openvk/friends.php">Мои Друзья <b><?php if ($frleftc != '0') echo "(".$frleftc.")";?></b></a>
<a href="#" onclick="alert('сорян ещё не запилили');" style="opacity: 0.25;">Мои Фотографии</a>
<a href="/openvk/videos.php">Мои Видеозаписи</a>
<a href="//soundcloud.com/">Мои Аудиозаписи</a>
<a href="#" onclick="alert('сорян ещё не запилили');" style="opacity: 0.25;">Мои Сообщения</a>
<a href="#" onclick="alert('сорян ещё не запилили');" style="opacity: 0.25;">Мои Заметки</a>
<a href="/openvk/groups.php">Мои Группы</a>
<a href="#" onclick="alert('сорян ещё не запилили');" style="opacity: 0.25;">Мои Встречи</a>
<a href="#" onclick="alert('сорян ещё не запилили');" style="opacity: 0.25;">Мои Новости</a>
<a href="#" onclick="alert('сорян ещё не запилили');" style="opacity: 0.25;">Мои Закладки</a>
<!-- <a href="groups">Мои Группы</a> -->
<a href="settings.php">Мои Настройки</a>
<hr>
<a href="bugtracker.php">Баг-трекер</a>
  	<?php
  }else{
  ?>
  <a href="/openvk">Авторизация</a>
  <? } ?>
   <!-- <a href="http://www.wtfpl.net/"><img
       src="http://www.wtfpl.net/wp-content/uploads/2012/12/wtfpl-badge-1.png"
       width="80" height="15" alt="WTFPL" /></a>
    <div id="adddd"></div> -->
  </div>
  <div id="content-main">