<?php 
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');

if (isset($_GET['id']) != null) {
 $id = $_GET['id'];
 $q = "SELECT * FROM `users` WHERE id='".$id."'"; // выбираем нашего 
 $q1 = $dbh1->prepare($q); // отправляем запрос серверу
 $q1 -> execute(); 
 $user = $q1->fetch(); // ответ в переменную 
}else if (isset($_SESSION['id']) != null){
  $id = $_SESSION['id'];
 $q = "SELECT * FROM `users` WHERE id='".$id."'"; // выбираем нашего 
 $q1 = $dbh1->prepare($q); // отправляем запрос серверу
 $q1 -> execute(); 
 $user = $q1->fetch(); // ответ в переменную 
}
 $h = "SELECT * FROM `users`"; // выбираем нашего 
 $h1 = $dbh1->prepare($h); // отправляем запрос серверу
 $h1 -> execute(); 
 $admin = $h1->fetch(); // ответ в переменную 
$_SESSION['userwall'] = $id;
if ($user['id'] == ""){
    header("Location: blank.php?id=1");
    exit();
}
if (isset($_GET['id']) == null) {
  header("Location: blank.php?id=1");
  exit();
}

$qthis = "SELECT `groupu`, `verify` FROM `users` WHERE id = '".$_SESSION['id']."'"; // выбираем нашего 
$q1this = $dbh1->prepare($qthis); // отправляем запрос серверу
$q1this -> execute(); 
$userthis = $q1this->fetch(); // ответ в переменную 
include('exec/header.php');
include('exec/datefn.php');
include('exec/leftmenu.php');
?>
 <script type="text/javascript" src="js/profile.js?<?echo date("U");?>"></script>
<div id="content-infoname"><b><?php echo $user['name'].' '.$user['surname']; ?></b><?php if ($user['verify'] == '1') {
      echo '<img src="img/verify_silver.png" width="12" height="12" style="margin-left:5px;margin-right:5px;margin-bottom:-2px;" onmouseenter="openVerify();" onmouseleave="openVerify();"><div id="verify" style="display:none;margin:5px 0;">Верифицированная страница</div>';
    } ?><?php if ($user['verify'] == '5') {
      echo '<img src="img/verify_green.png" width="12" height="12" style="margin-left:4px;margin-right:4px;margin-bottom:-2px;" onmouseenter="openVerify();" onmouseleave="openVerify();"><div id="verify" style="display:none;margin:5px 0;">Верифицированная страница администратора OpenVK</div>';
    } ?><?php if ($user['verify'] == '3') {
      echo '<img src="img/verify_blue.png" width="12" height="12" style="margin-left:4px;margin-right:4px;margin-bottom:-2px;" onmouseenter="openVerify();" onmouseleave="openVerify();"><div id="verify" style="display:none;margin:5px 0;">Верифицированная страница тестера OpenVK</div>';
    } ?><?php if ($user['verify'] == '4') {
      echo '<img src="img/verify_blue.png" width="12" height="12" style="margin-left:4px;margin-right:4px;margin-bottom:-2px;" onmouseenter="openVerify();" onmouseleave="openVerify();"><div id="verify" style="display:none;margin:5px 0;">Верифицированная страница тестера OpenVK</div>';
    } ?>
    <? if ($_SESSION['id'] == $id){?><span><b>(это Вы)</b></span><? } 
    if($user['ban'] != '1'){?>
    <text style="font-size: 8pt; color: #aaa; float: right;"><?php if(time()-2629743 <= $user['lastonline']){ if(time()-300 <= $user['lastonline']){ echo "<b>Онлайн</b>";}else{ if ($user['gender'] == '1') {
        echo "был в сети ";
      }else if ($user['gender'] == '2'){ 
        echo "была в сети ";
      }else if ($user['gender'] == '0'){
          echo "было в сети ";
      } echo zmdate($user['lastonline']);}}}?></text></div>
  
  <div id="content-left">
   <div id="content-avatar">
    <? 
    if ($user['avatar'] != null AND $user['ban'] == '0') {
      echo '<a href="watchi.php?image='.$user['avatar'].'"><img src="avatar.php?image='.$user['avatar'].'"></a><br><br>';
    }else{
      echo '<img src="img/camera_200.png"><br><br>';
    }
    /*if($user['advice_settings'] == '1'){
      echo '<img src="https://i.imgur.com/MuJ4hhF.png" width=200>';
    }*/
    if($user['ban'] != '1'){
if($_SESSION['loginin'] == "1"){
if($id != $_SESSION['id']){
$qfcs = $dbh1->prepare("SELECT * FROM `subs` WHERE `id1` = '".$_SESSION['id']."' AND `id2` = '".$id."'");
$qfcs->execute();
$fcs = $qfcs->fetch();
$qfcs2 = $dbh1->prepare("SELECT * FROM `subs` WHERE `id1` = '".$id."' AND `id2` = '".$_SESSION['id']."'");
$qfcs2->execute();
$fcs2 = $qfcs2->fetch();
$qfc = $dbh1->prepare("SELECT * FROM `friends` WHERE `id1` = '".$_SESSION['id']."' AND `id2` = '".$id."'");
$qfc->execute();
$fc = $qfc->fetch();
$qfc2 = $dbh1->prepare("SELECT * FROM `friends` WHERE `id1` = '".$id."' AND `id2` = '".$_SESSION['id']."'");
$qfc2->execute();
$fc2 = $qfc2->fetch();
if($id != '100'){
if($fc['id1'] == $_SESSION['id'] && $fc['id2'] == $id && $fc2['id1'] == $id && $fc2['id2'] == $_SESSION['id']){
echo '<a id="aprofile" href="del_friend.php">Удалить из друзей</a><a id="aprofile" href="sendmessage.php?id='.$id.'">Отправить сообщение</a>';
$friends_verify = 1;
}elseif($fcs['id1'] == $_SESSION['id'] && $fcs['id2'] == $id){
echo '<a id="aprofile" href="del_friend_sub.php">Отменить заявку</a><div style="color:black;font-size:10px;margin-top:8px;margin-left:7px;">Вы подписаны на него</div>';
$friends_verify = 0;
}elseif($fcs2['id1'] == $id && $fcs2['id2'] == $_SESSION['id']){
echo '<a id="aprofile" href="add_friend.php">Добавить в друзья</a><div style="color:black;font-size:10px;margin-top:8px;margin-left:25px;">Подписан на Вас</div>';
$friends_verify = 0;
}else{
echo '<a id="aprofile"  href="add_friend_sub.php">Добавить в друзья</a>';
$friends_verify = 0;
}
}
}
}
}   if ($_SESSION['id'] == $id){
    echo '<a id="aprofile" href="settings.php">Редактировать страницу</a>';
   }
    if ($_SESSION['groupu'] == "2" AND $_SESSION['id'] != $id){
    echo '<a id="aprofile" href="admin_users.php?idu='.$user['id'].'">Админ-Панель Юзера</a>';
}
    ?>
   </div>
     
   <? 
   
   $qfriendscount = $dbh1->prepare("SELECT COUNT(1) FROM `friends` WHERE `id1`='".$id."'");
   $qfriendscount -> execute();
   $frcount = $qfriendscount->fetch();
   $frcount = $frcount[0];
   if ($frcount == '1') {
     $frcounnt = (string)$frcount." друг";
   }else if ($frcount == '2' OR $frcount == '3' OR $frcount == '4') {
     $frcounnt = (string)$frcount." друга";
   }else{
     $frcounnt = (string)$frcount." друзей";
   }
   if ($frcount!=0) {
   ?>
   
 <div id="content-friends" class="content_left">
			<div id="content-wall-title" class="clear_fix" style="margin-top:15px;" onclick="hidePanel(this,<?echo $frcount;?>);">
				<div class="hideTitle"></div>Друзья
			</div>
			<div id="profile_friends_list">
   <div id="content-wall-send"><?echo $frcounnt;?><a href="/friends.php?id=<?echo $id;?>" class="fl_r">Все</a></div>
	  <div class="profile_info" style="padding:0px;">
	  <? 
   
    $q4 = $dbh1->prepare("SELECT * FROM `friends` WHERE `id1`='".$id."' ORDER BY RAND() limit 6");
    $q4 -> execute();
    while($friend1 = $q4->fetch()) {
      $q5 = $dbh1->prepare("SELECT * FROM `users` WHERE `id`='".$friend1['id2']."'"); // отправляем запрос серверу
      $q5 -> execute(); 
      $friend = $q5->fetch(); // ответ в переменную .
      if($friend['ban'] != '1'){
     if ($friend['avatar'] != null) {
      echo '<div id="content-friends-friend"><img id="avatar" src="avatarc.php?image='.$friend['avatar'].'" style="margin-top: 3px;">
     <b style="margin-right: 3px;"><a style="margin-top: 3px;" href="id'.$friend['id'].'">'.$friend['name'].'<br> <text style="font-size: 8px;">'.$friend['surname'].'</text></a></b></div>';
    }else{
      echo '<div id="content-friends-friend"><img id="avatar" src="img/camera_200.png" width="50" height="50" style=" margin-top: 3px;">
     <b style="margin-right: 3px;"><a style="margin-top: 3px;" href="id'.$friend['id'].'">'.$friend['name'].'<br> <text style="font-size: 8px;">'.$friend['surname'].'</text></a></b></div>';
    }
  } 
}
?>
	  </div>
	</div>
	</div>
	<?}
   $qgroupscount = $dbh1->prepare("SELECT COUNT(1) FROM `clubsub` WHERE `id1`='".$id."'");
   $qgroupscount -> execute();
   $grcount = $qgroupscount->fetch();
   $grcount = $grcount[0];
   if ($grcount == '1') {
     $grcounnt = (string)$grcount." группа";
   }else if ($grcount == '2' OR $grcount == '3' OR $grcount == '4') {
     $grcounnt = (string)$grcount." группы";
   }else{
     $grcounnt = (string)$grcount." групп";
   }
   
   if ($grcount!=0) {
   ?>
	<div id="content-groups" class="content_left">
			<div id="content-wall-title" class="clear_fix" style="margin-top:15px;" onclick="hidePanel(this,<?echo $grcount;?>);">
				<div class="hideTitle"></div>Группы
			</div>
			<div id="profile_friends_list">
   <div id="content-wall-send"><?echo $grcounnt;?><a href="/groups.php?id=<?echo $id;?>" class="fl_r">Все</a></div>
	  <div class="profile_info" style="padding:0px;">
	  <? 

   $qsubclub = $dbh1->prepare("SELECT * FROM `clubsub` WHERE `id1` = '".$id."' ORDER BY RAND() LIMIT 5");
$qsubclub->execute();
while($subclub = $qsubclub->fetch()){
$qsubu = $dbh1->prepare("SELECT * FROM `club` WHERE `id` = '".$subclub['id2']."'");
$qsubu->execute();
$subu = $qsubu->fetch();
if ($subu['avatar'] != null) {
echo '<table border="0" style="font-size:11px;clear:both;"><div style="clear:both;"><tr><td style="width:25px;margin-right:7px;"><img src="'.$subu['avatar'].'" width="25" height="auto" style="clear:both;"></td><td style="width:168px;"><b style="padding-left:7px;clear:both;"><a href="club'.$subu['id'].'" style="clear:both;">'.substr($subu['name'], 0, 45).'</a></b></td></tr></div></table>';
}else{
echo '<table border="0" style="font-size:11px;clear:both;"><div style="clear:both;"><tr><td style="width:25px;margin-right:7px;"><img src="img/camera_200.png" width="25" height="auto" style="clear:both;"></td><td style="width:168px;"><b style="padding-left:7px;clear:both;"><a href="club'.$subu['id'].'" style="clear:both;">'.substr($subu['name'], 0, 45).'</a></b></td></tr></div></table>';
}

}
?>
	  </div>
	</div>
	</div>
	
   <?}
   $qvideoscount = $dbh1->prepare("SELECT COUNT(1) FROM `video` WHERE `aid`='".$id."'");
   $qvideoscount -> execute();
   $vdcount = $qvideoscount->fetch();
   $vdcount = $vdcount[0];
   if ($vdcount == '1') {
     $vdcounnt = (string)$vdcount." видеозапись";
   }else if ($vdcount == '2' OR $vdcount == '3' OR $vdcount == '4') {
     $vdcounnt = (string)$vdcount." видеозаписи";
   }else{
     $vdcounnt = (string)$vdcount." видеозаписей";
   }
   if ($vdcount!=0) {
   ?>
	<div id="content-groups" class="content_left">
			<div id="content-wall-title" class="clear_fix" style="margin-top:15px;" onclick="hidePanel(this,<?echo $vdcount;?>);">
				<div class="hideTitle"></div>Видеозаписи
			</div>
			<div id="profile_friends_list">
   <div id="content-wall-send"><?echo $vdcounnt;?><a href="/videos.php?id=<?echo $id;?>" class="fl_r">Все</a></div>
	  <div class="profile_info" style="padding:0px;">
	  <? 
$qvideo = $dbh1->prepare("SELECT * FROM `video` WHERE `aid` = '".$id."' ORDER BY RAND() LIMIT 2");
 $qvideo->execute();
 while ($vid = $qvideo->fetch()) {
   $qg = $dbh1->prepare("SELECT * FROM `video` WHERE `id` = '".$vid['id']."'");
$qg->execute();
$video = $qg->fetch();
if($video['avatar']){
$av = $video['avatar'];
$video['avatar'] = 'avatart.php?image='.$video['avatar'];
}else{
$video['avatar'] = "img/camera_200.png";
$av = $video['avatar'];
}
echo '<table border="0" style="font-size:11px;clear:both;"><div style="clear:both;"><tr><td style="width:25px;margin-right:7px;"><img src="https://img.youtube.com/vi/'.$video['id_video'].'/0.jpg" width="50" height="auto" style="clear:both;"></td><td style="width:168px;"><b style="padding-left:7px;clear:both;"><a href="video'.$video['id'].'" style="clear:both;">'.$video['name'].'</a></b></td></tr></div></table>';
 }
?>

	  </div>
	</div>
	</div>	
<?
   }
   $qalbumscount = $dbh1->prepare("SELECT COUNT(1) FROM `albums` WHERE `aid`='".$id."'");
   $qalbumscount -> execute();
   $alcount = $qalbumscount->fetch();
   $alcount = $alcount[0];
   if ($alcount == '1') {
     $alcounnt = (string)$alcount." видеозапись";
   }else if ($alcount == '2' OR $alcount == '3' OR $alcount == '4') {
     $alcounnt = (string)$alcount." видеозаписи";
   }else{
     $alcounnt = (string)$alcount." видеозаписей";
   }
   
   if ($alcount!=0) {
   ?>
	<div id="content-groups" class="content_left">
			<div id="content-wall-title" class="clear_fix" style="margin-top:15px;" onclick="hidePanel(this,<?echo $alcount;?>);">
				<div class="hideTitle"></div>Фотоальбомы
			</div>
			<div id="profile_friends_list">
   <div id="content-wall-send"><?echo $alcount;?><a href="/albums.php?id=<?echo $id;?>" class="fl_r">Все</a></div>
	  <div class="profile_info" style="padding:0px;">
	  <? 
 $qphoto = $dbh1->prepare("SELECT * FROM `albums` WHERE `aid` = '".$id."' ORDER BY RAND() LIMIT 2");
 $qphoto->execute();
 while ($pho = $qphoto->fetch()) {
   $qgg = $dbh1->prepare("SELECT * FROM `albums` WHERE `id` = '".$pho['id']."'");
$qgg->execute();
$photo = $qgg->fetch();

$qphotoo = $dbh1->prepare("SELECT * FROM `photo` WHERE `album` = '".$photo['id']."' ORDER BY id LIMIT 1");
$qphotoo->execute();
$photoo = $qphotoo->fetch();
if ($phocount == "0") {
  $photoalbum = "img/nophoto.jpg";
}else{
  $photoalbum = $photoo['image'];
}
echo '<table border="0" style="font-size:11px;clear:both;"><div style="clear:both;"><tr><td style="width:25px;margin-right:7px;"><a href="album'.$photo['id'].'" style="clear:both;"><img src="'.$photoalbum.'" width="75" height="auto" style="clear:both;"></a></td><td style="width:168px;"><b style="padding-left:7px;clear:both;"><a href="album'.$photo['id'].'" style="clear:both;">'.$photo['name'].'</a></b></td></tr></div></table>';
 }
?>
	  </div>
	</div>
	</div>		

   <?
   }
   $qnotesscount = $dbh1->prepare("SELECT COUNT(1) FROM `note` WHERE `aid`='".$id."'");
   $qnotesscount -> execute();
   $ntcount = $qnotesscount->fetch();
   $ntcount = $ntcount[0];
   if ($ntcount == '1') {
     $ntcounnt = (string)$ntcount." заметка";
   }else if ($ntcount == '2' OR $ntcount == '3' OR $ntcount == '4') {
     $ntcounnt = (string)$ntcount." заметки";
   }else{
     $ntcounnt = (string)$ntcount." заметок";
   }
   
   if ($ntcount!=0) {
   ?>
	<div id="content-groups" class="content_left">
			<div id="content-wall-title" class="clear_fix" style="margin-top:15px;" onclick="hidePanel(this,<?echo $ntcount;?>);">
				<div class="hideTitle"></div>Заметки
			</div>
			<div id="profile_friends_list">
   <div id="content-wall-send"><?echo $ntcounnt;?><a href="/notes.php?id=<?echo $id;?>" class="fl_r">Все</a></div>
	  <div class="profile_info" style="padding:0px;">
	  <? 
$qnote = $dbh1->prepare("SELECT * FROM `note` WHERE `aid` = '".$id."' ORDER BY RAND() LIMIT 2");
 $qnote->execute();
 while ($notee = $qnote->fetch()) {
   
echo '<table border="0" style="font-size: 11px;">
    <tbody> 
      <tr>
        <td width="16" style="vertical-align: top;">
          <img src="img/note.gif">
        </td>
        <td style="vertical-align: 0;">
          <a href="note'.$notee['id'].'"><h4><b>'.$notee['name'].'</b></h4></a><span><br>Написана '.zmdate($notee['date']).'</span><br>
        </td>
      </tr>
    </tbody>
    </table>';
   }
?>
	  </div>
	</div>
	</div><? }?>
	</div>
   
  <div id="content-right">
   <div id="content-info" >
    <h4 class="simple">
    <? if($user['nickname'] == NULL){echo substr($user['name'], 0, 26).' '.substr($user['surname'], 0, 26);}else{echo substr($user['name'], 0, 26).' '.substr($user['nickname'], 0, 30).' '.substr($user['surname'], 0, 26);} ?>


    <? if($_SESSION['loginin'] == '1') { ?>
     <div class="clear" id="profile_current_info"><div class="absolutemenu" id="statusarea" style="display: none;padding: 5px;margin:-10px;"><form method="get" action="change_status.php" style="margin:0;"><input type="text" name="status" id="text" size="75" value="<?php if($user['ban'] != '1'){ echo $user['status']; }?>"><br><br><input type="submit" id="button" value="Сохранить"></form></div><a <? if($_SESSION['id'] == $id){?> href="#" onclick="openStatusEdit()" <? } ?> style="font-size:11px;word-wrap:break-word;overflow:hidden;text-decoration: none;color: black;font-weight: initial;"><?php if($user['ban'] != '1'){ echo $user['status']; }?></a></div>
    <? } ?>

    
  </h4>
        <? if ($user['ban'] != '1'){?>

        <div class="profile_info" class="clear_fix"><div class="clear_fix">
          <? if($id == '100') { echo "<center><b>Официальная страница администрации OpenVK.</b></center>
<br>
<center>
Если у Вас возникла проблема или Вам требуется помощь, обратитесь в <a href='club2'>службу поддержки.</a> </center> "; } ?>
            <? if($id != '100') { ?>
  <div class="label fl_l">День рождения:</div>
  <div class="labeled fl_l"><?php echo zmbd($user['birthdate']);?> г.</div>
</div><div class="clear_fix miniblock">
  <div class="label fl_l">Пол:</div>
  <div class="labeled fl_l"><?php if ($user['gender'] == '1') {
        echo "Мужской";
      }else if ($user['gender'] == '2'){ 
        echo "Женский";
      }else if ($user['gender'] == '0'){
          echo "<i>&#60;не указано&#62;</i>";
      }?></div>
      <br>
  <div class="label fl_l">О себе:</div>
  <? if($user['aboutuser']){
  	echo '<div class="labeled fl_l">'.$user['aboutuser'].'</div>';
  }else{
  	echo '<div class="labeled fl_l"><i>&#60;нет информации&#62;</i></div>';
  }?>
</div></div>
      <? /* if($user['advice_settings'] == '1'){
      echo '<br><img src="https://i.imgur.com/VTXsTUi.png" width=200> <img src="https://i.imgur.com/alboVp6.png" width=200>';
    }*/ ?>
<? if (($user['telephone']!="" and $user['telephone_settings']==1 or $friends_verify==1) or ($user['email']!="" and $user['email_settings']==1 or $friends_verify==1)) {
	
?>
<div id="content-full-info">
<div id="content-wall-title" class="clear_fix" style="margin-top:15px;" onclick="hidePanel(this);"><div class="hideTitle"></div>Информация</div>
<div class="profile_info" >
<div class="clear_fix miniblock">
<? if ($user['telephone_settings']==1 or $friends_verify==1 or $id == $_SESSION['id']) 
echo $user['telephone']!=""?'<div class="label fl_l">Номер телефона: </div>
<div class="labeled fl_l">'.$user['telephone'].'
</div>':'';
if ($user['email_settings']==1 or $friends_verify==1 or $id == $_SESSION['id']) 
echo $user['email']!=""?'<div class="label fl_l">Email: </div>
<div class="labeled fl_l">'.$user['email'].'
</div>':'';
?>
</div>
</div>
</div>
<?}
   $qwallcount = $dbh1->prepare("SELECT COUNT(1) FROM `wall` WHERE `idwall`='".$id."'");
   $qwallcount -> execute();
   $wlcount = $qwallcount->fetch();
   $wlcount = $wlcount[0];
   ?>
   <div id="content-wall" class="clear_fix" style="padding-top:15px;">
   <div id="content-wall-title" class="clear_fix" onclick="hidePanel(this,<?echo $wlcount;?>);"><div class="hideTitle"></div>Стена</div>
    <div id="profile_wall">
	<div id="content-wall-send" class="clear_fix">
	<?
   if ($wlcount == '1' OR $wlcount == '21') {
    if ($wlcount < '10') {
     $wlcounnt = "Показано ".(string)$wlcount." из ".(string)$wlcount." записи";
   }else{
     $wlcounnt = "Показано 10 из ".(string)$wlcount." запись";
   }
   }elseif ($wlcount == '2' OR $wlcount == '3' OR $wlcount == '4' OR $wlcount == '22') {
    if ($wlcount < '10') {
     $wlcounnt = "Показано ".(string)$wlcount." из ".(string)$wlcount." записей";
   }else{
     $wlcounnt = "Показано 10 из ".(string)$wlcount." записей";
   }
   }else{
    if ($wlcount < '10') {
     $wlcounnt = "Показано ".(string)$wlcount." из ".(string)$wlcount." записей";
   }else{
     $wlcounnt = "Показано 10 из ".(string)$wlcount." записей";
   }
   }
   echo '<div class="post-textarea-button">'.$wlcounnt;?><?php if($_SESSION['loginin'] == '1') { ?>
   <? if($user['id'] != '0'){ ?><a href="wall<?php echo $id ?>" style="display: block;float: right;">Все</a><? if($user['closedwall'] == '0'){ ?><text style="display: block;float: right;margin-left:5px;margin-right:5px;">|</text><a href="#" style="display: block;float: right;" onmousedown="openTextarea();" >Написать</a><? }else{} ?><? } ?></div>
    <div class="post-textarea" style="display: none;">
    <form method="post" action="add_post.php" enctype="multipart/form-data">
     <textarea placeholder="Что нового?" name="text"></textarea><div id="postphoto" style="display: none;"><input type="file" name="upimg" accept="image/jpeg,image/png,image/gif"></div><div style="float:right;clear:both;margin-top: 8px;"><a href="#" onclick="openMenuPin();" class="pinlink">Прикрепить</a><div class="absolutemenu" id="pinpostmenu" style="display: none;"><a href="#" onclick="menuPinPhoto();" ><img src="img/photo-icon.png"> Фотография</a></div></div><input type="submit" id="button" value="Опубликовать" style="float:left;margin-top:5px;"></form><div style="clear:both;"></div></div>
    <? } ?></div>
    <? /*if($user['advice_settings'] == '1'){
  echo '<img src="https://i.imgur.com/16Dt2OV.png" width=400>';
 }*/ ?>
    <?	
    if ($_SESSION['loginin'] == '1') {
    
    
$q2 = $dbh1->prepare("SELECT * FROM `wall` WHERE `idwall`='".$id."' ORDER BY id DESC LIMIT 10");
$q2 -> execute();
while($wall = $q2->fetch()) {
  if ($wall['iduser'] == $_SESSION['id'] OR $wall['idwall'] == $_SESSION['id']) {
    $deletebutton = '<a href="del_post.php?id='.$wall['id'].'" style="float:left;">Удалить</a>';
  }else{
    $deletebutton = '';
  }
  if ($id != $wall['iduser']) {
   $q3 = $dbh1->prepare("SELECT * FROM `users` WHERE `id`='".$wall['iduser']."'"); // отправляем запрос серверу
   $q3 -> execute(); 
   $authorwall = $q3->fetch(); // ответ в переменную .
   if(time()-300 <= $authorwall['lastonline']){
    $onlinewall = "<b>Онлайн</b>";
  }else{
    $onlinewall = "";
  }
   if ($authorwall['avatar'] != null) {
    if ($wall['image'] != null) {
     $im = '<br><br><a href="watchi.php?image='.$wall['image'].'"><img src="imagep.php?image='.$wall['image'].'"></a>';
   }else{
        $im = '';
   }
   if($authorwall['gender'] == "1"){
	   $nap = "написал";
   }elseif($authorwall['gender'] == "2"){
	   $nap = "написала";
   }else{
	   $nap = "написал(-а)";
   }
   
    if ($wall['date']+172800 > time()) {
      
    
   if ($authorwall['id'] == $_SESSION['id']) {
     $redach = ' | <a href="#" onclick="openTextareaEdit('.$wall['id'].');">Редактировать</a>';
     $redachtext = str_replace(array('<br><br>', '<br>'), '
', $wall['text']);
     $redachtext = str_replace('</b>', '', $redachtext);
   }else{
     $redach = '';
   }
   }else{
     $redach = '';
   }
  
   if ($wall['edited'] == "1") {
   $redached = " <span>(ред.)</span>";
 }else{
  $redached = '';
 }
   echo '<div id="content-wall-post"><table border="0" style="font-size:11px;"><tr><td style="width:54px;vertical-align:top;">
   <div id="content-wall-post-avatar"><img id="avatar" src="avatarc.php?image='.$authorwall['avatar'].'" width="50"></div>'.$onlinewall.'</td><td style="width:345px;vertical-align:0;">
     <div id="content-wall-post-infoofpost">
      
      <div id="content-wall-post-authorofpost"><text style="margin-right: 3px;"><b><a href="id'.$authorwall['id'].'">'.$authorwall['name'].' '.$authorwall['surname'].'</a></b></text>'.$nap.$redached.'<br><div id="content-date"><a href="post'.$wall['id'].'">'.zmdate($wall['date']).'</a></div></div>
     
     <div id="content-wall-post-text" class="post'.$wall['id'].'">'.$wall['text'].$im.' </div>
     <div id="content-wall-post-text" class="postedit'.$wall['id'].'" style="display:none;">
     <form method="post" action="edit_post.php">
     <input name="id" type="hidden" value="'.$wall['id'].'"><textarea name="text" id="text">'.$redachtext.'</textarea><br>
     <input type="submit" value="Изменить" id="button">
     </form>
     </div>
     </div>'.$deletebutton.$redach.'<a href="post'.$wall['id'].'" style="float:right;">Открыть комментарии</a><div style="clear:both;"></div>
    
    </td></tr></table></div><br>';
   }else{
    if ($wall['image'] != null) {
     $im = '<br><br><a href="watchi.php?image='.$wall['image'].'"><img src="imagep.php?image='.$wall['image'].'"></a>';
   }else{
        $im = '';
      }
      if(time()-300 <= $authorwall['lastonline']){
    $onlinewall = "<b>Онлайн</b>";
  }else{
    $onlinewall = "";
  }
   if($authorwall['gender'] == "1"){
	   $nap = "написал";
   }elseif($authorwall['gender'] == "2"){
	   $nap = "написала";
   }else{
	   $nap = "написало";
   }
   
    if ($wall['date']+172800 > time()) {
   if ($authorwall['id'] == $_SESSION['id']) {
     $redach = ' | <a href="#" onclick="openTextareaEdit('.$wall['id'].');">Редактировать</a>';
     $redachtext = str_replace(array('<br><br>', '<br>'), '
', $wall['text']);
     $redachtext = str_replace('</b>', '', $redachtext);
   }else{
     $redach = '';
   }
 }else{
  $redach = '';
 }
  if ($wall['edited'] == "1") {
   $redached = "<span>(отредактированно)</span>";
 }else{
  $redached = '';
 }
    echo '<div id="content-wall-post"><table border="0" style="font-size:11px;"><tr><td style="width:54px;vertical-align:top;">
    <div id="content-wall-post-avatar"><img id="avatar" src="img/camera_200.png" width="50" height="50"></div>'.$onlinewall.'</td><td style="width:345px;vertical-align:0;">
     <div id="content-wall-post-infoofpost">
      
      <div id="content-wall-post-authorofpost"><text style="margin-right: 3px;"><b><a href="id'.$authorwall['id'].'">'.$authorwall['name'].' '.$authorwall['surname'].' '.$var.'</a></b></text>'.$nap.$redached.'<br><div id="content-date"><a href="post'.$wall['id'].'">'.zmdate($wall['date']).'</a></div></div>
     
     <div id="content-wall-post-text" class="post'.$wall['id'].'">'.$wall['text'].$im.'</div>
     <div id="content-wall-post-text" class="postedit'.$wall['id'].'" style="display:none;">
     <form method="post" action="edit_post.php">
     <input name="id" type="hidden" value="'.$wall['id'].'"><textarea name="text" id="text">'.$redachtext.'</textarea><br>
     <input type="submit" value="Изменить" id="button">
     </form>
     </div>
     </div>'.$deletebutton.$redach.'<a href="post'.$wall['id'].'" style="float:right;">Открыть комментарии</a><div style="clear:both;"></div>
    
   </td></tr></table></div><br>';
   }
  }else{
    if ($wall['image'] != null) {
     $im = '<br><br><a href="watchi.php?image='.$wall['image'].'"><img src="imagep.php?image='.$wall['image'].'"></a>';
   }else{
        $im = '';
      }
      if(time()-300 <= $user['lastonline']){
    $onlinewall = "<b>Онлайн</b>";
  }else{
    $onlinewall = "";
  }
    if ($user['avatar'] != null) {
	if($user['gender'] == "1"){
	   $nap = "написал";
   }elseif($user['gender'] == "2"){
	   $nap = "написала";
   }else{
	   $nap = "написало";
   }
   
    if ($wall['date']+172800 > time()) {
   if ($user['id'] == $_SESSION['id']) {
     $redach = ' | <a href="#" onclick="openTextareaEdit('.$wall['id'].');">Редактировать</a>';
     $redachtext = str_replace(array('<br><br>', '<br>'), '
', $wall['text']);
     $redachtext = str_replace('</b>', '', $redachtext);
   }else{
     $redach = '';
   }
 }else{
  $redach = '';
 }
 if ($wall['edited'] == "1") {
   $redached = "<span>(отредактированно)</span>";
 }else{
  $redached = '';
 }
      echo '<div id="content-wall-post"><table border="0" style="font-size:11px;"><tr><td style="width:54px;vertical-align:top;">
      <div id="content-wall-post-avatar"><img id="avatar" src="avatarc.php?image='.$user['avatar'].'" width="50"></div>'.$onlinewall.'</td><td style="width:345px;vertical-align:0;">
     <div id="content-wall-post-infoofpost">
      
      <div id="content-wall-post-authorofpost"><text style="margin-right: 3px;"><b><a href="id'.$user['id'].'">'.$user['name'].' '.$user['surname'].' '.$var.'</a></b></text>'.$nap.$redached.'<br><div id="content-date"><a href="post'.$wall['id'].'">'.zmdate($wall['date']).'</a></div></div>
     
     <div id="content-wall-post-text" class="post'.$wall['id'].'">'.$wall['text'].$im.'</div>
     <div id="content-wall-post-text" class="postedit'.$wall['id'].'" style="display:none;">
     <form method="post" action="edit_post.php">
     <input name="id" type="hidden" value="'.$wall['id'].'"><textarea name="text" id="text">'.$redachtext.'</textarea><br>
     <input type="submit" value="Изменить" id="button">
     </form>
     </div>
     </div>'.$deletebutton.$redach.'<a href="post'.$wall['id'].'" style="float:right;">Открыть комментарии</a><div style="clear:both;"></div>
    
    </td></tr></table></div><br>';
    }else{
      if ($wall['image'] != null) {
        $im = '<br><br><a href="watchi.php?image='.$wall['image'].'"><img src="imagep.php?image='.$wall['image'].'"></a>';
      }else{
        $im = '';
      }
      if(time()-300 <= $authorwall['lastonline']){
    $onlinewall = "<b>Онлайн</b>";
  }else{
    $onlinewall = "";
  }
  if($user['gender'] == "1"){
	   $nap = "написал";
   }elseif($user['gender'] == "2"){
	   $nap = "написала";
   }else{
	   $nap = "написало";
   }
  
     if ($wall['date']+172800 > time()) {
   
   if ($user['id'] == $_SESSION['id']) {
     $redach = ' | <a href="#" onclick="openTextareaEdit('.$wall['id'].');">Редактировать</a>';
     $redachtext = str_replace(array('<br><br>', '<br>'), '
', $wall['text']);
     $redachtext = str_replace('</b>', '', $redachtext);
   }else{
     $redach = '';
   }
 }else{
  $redach = '';
 }
  if ($wall['edited'] == "1") {
   $redached = "<span>(отредактированно)</span>";
 }else{
  $redached = '';
 }
      echo '
      <div id="content-wall-post"><table border="0" style="font-size:11px;"><tr><td style="width:54px;vertical-align:top;">
      <div id="content-wall-post-avatar"><img id="avatar" src="img/camera_200.png" width="50" height="50"></div>'.$onlinewall.'</td><td style="width:345px;vertical-align:0;">
     <div id="content-wall-post-infoofpost">
      
      <div id="content-wall-post-authorofpost"><text style="margin-right: 3px;"><b><a href="id'.$user['id'].'">'.$user['name'].' '.$user['surname'].' '.$var.'</a></b></text>'.$nap.$redached.'<br><div id="content-date"><a href="post'.$wall['id'].'">'.zmdate($wall['date']).'</a></div></div>
     
     <div id="content-wall-post-text" class="post'.$wall['id'].'">'.$wall['text'].$im.'</div>
     <div id="content-wall-post-text" class="postedit'.$wall['id'].'" style="display:none;">
     <form method="post" action="edit_post.php">
     <input name="id" type="hidden" value="'.$wall['id'].'"><textarea name="text" id="text">'.$redachtext.'</textarea><br>
     <input type="submit" value="Изменить" id="button">
     </form>
     </div>
     </div>'.$deletebutton.$redach.'<a href="post'.$wall['id'].'" style="float:right;">Открыть комментарии</a><div style="clear:both;"></div>
    
    </td></tr></table></div><br>';
    }
}
} }else{
    ?> <div id="msg">Для того, чтобы просматривать стену пользователя, вам необходимо авторизоваться</div><?php
  } }?>
   </div>
    <? } else { ?>
     <div id="msg">К сожалению нам пришлось заблокировать этого пользователя.<br> Комментарий модератора: <? if($user['comment_ban'] == null){echo "Причина не указана.";}else{echo $user['comment_ban']; echo ".";} ?></div>
    <? } ?>
  </div>  
  </div>
  </div>
  </div>
  </div>
  </div>
 <div>
 <? include ('exec/footer.php'); ?>
 </div>
 </body>
</script>
</html>