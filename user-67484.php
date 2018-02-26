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
<div id="content-infoname"><b><?php echo $user['name'].' '.$user['surname']; ?></b><?php if ($user['verify'] == '1') {
      echo '<img src="img/verify.png" width="12" height="12" style="margin-left:5px;margin-right:5px;margin-bottom:-2px;" onmouseenter="openVerify();" onmouseleave="openVerify();"><div id="verify" style="display:none;margin:5px 0;">Данная страница была официально верифицирована администрацией OpenVK.</div>';
    } ?><?php if ($user['verify'] == '5') {
      echo '<img src="img/verify_orange.png" width="12" height="12" style="margin-left:4px;margin-right:4px;margin-bottom:-2px;" onmouseenter="openVerify();" onmouseleave="openVerify();"><div id="verify" style="display:none;margin:5px 0;">Владелец данной страницы -  администратор OpenVK.</div>';
    } ?><?php if ($user['verify'] == '3') {
      echo '<img src="data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2216%22%20height%3D%2216%22%20viewBox%3D%220%200%2016%2016%22%3E%0A%20%20%3Cg%20fill%3D%22none%22%20fill-rule%3D%22evenodd%22%3E%0A%20%20%20%20%3Cpath%20fill%3D%22%2374A2D6%22%20d%3D%22M5.82331983%2C14.8223666%20L4.54259486%2C15.0281417%20C4.15718795%2C15.0900653%203.78122933%2C14.8730055%203.64215331%2C14.5082715%20L3.17999726%2C13.2962436%20C3.09635683%2C13.0768923%202.92310766%2C12.9036432%202.70375635%2C12.8200027%20L1.49172846%2C12.3578467%20C1.12699447%2C12.2187707%200.909934662%2C11.842812%200.971858288%2C11.4574051%20L1.17763336%2C10.1766802%20C1.21487428%2C9.94489615%201.15146068%2C9.70823338%201.00331709%2C9.52612299%20L0.184748166%2C8.51987017%20C-0.0615827221%2C8.21705981%20-0.0615827221%2C7.78294019%200.184748166%2C7.48012983%20L1.00331709%2C6.47387701%20C1.15146068%2C6.29176662%201.21487428%2C6.05510385%201.17763336%2C5.82331983%20L0.971858288%2C4.54259486%20C0.909934662%2C4.15718795%201.12699447%2C3.78122933%201.49172846%2C3.64215331%20L2.70375635%2C3.17999726%20C2.92310766%2C3.09635683%203.09635683%2C2.92310766%203.17999726%2C2.70375635%20L3.64215331%2C1.49172846%20C3.78122933%2C1.12699447%204.15718795%2C0.909934662%204.54259486%2C0.971858288%20L5.82331983%2C1.17763336%20C6.05510385%2C1.21487428%206.29176662%2C1.15146068%206.47387701%2C1.00331709%20L7.48012983%2C0.184748166%20C7.78294019%2C-0.0615827221%208.21705981%2C-0.0615827221%208.51987017%2C0.184748166%20L9.52612299%2C1.00331709%20C9.70823338%2C1.15146068%209.94489615%2C1.21487428%2010.1766802%2C1.17763336%20L11.4574051%2C0.971858288%20C11.842812%2C0.909934662%2012.2187707%2C1.12699447%2012.3578467%2C1.49172846%20L12.8200027%2C2.70375635%20C12.9036432%2C2.92310766%2013.0768923%2C3.09635683%2013.2962436%2C3.17999726%20L14.5082715%2C3.64215331%20C14.8730055%2C3.78122933%2015.0900653%2C4.15718795%2015.0281417%2C4.54259486%20L14.8223666%2C5.82331983%20C14.7851257%2C6.05510385%2014.8485393%2C6.29176662%2014.9966829%2C6.47387701%20L15.8152518%2C7.48012983%20C16.0615827%2C7.78294019%2016.0615827%2C8.21705981%2015.8152518%2C8.51987017%20L14.9966829%2C9.52612299%20C14.8485393%2C9.70823338%2014.7851257%2C9.94489615%2014.8223666%2C10.1766802%20L15.0281417%2C11.4574051%20C15.0900653%2C11.842812%2014.8730055%2C12.2187707%2014.5082715%2C12.3578467%20L13.2962436%2C12.8200027%20C13.0768923%2C12.9036432%2012.9036432%2C13.0768923%2012.8200027%2C13.2962436%20L12.3578467%2C14.5082715%20C12.2187707%2C14.8730055%2011.842812%2C15.0900653%2011.4574051%2C15.0281417%20L10.1766802%2C14.8223666%20C9.94489615%2C14.7851257%209.70823338%2C14.8485393%209.52612299%2C14.9966829%20L8.51987017%2C15.8152518%20C8.21705981%2C16.0615827%207.78294019%2C16.0615827%207.48012983%2C15.8152518%20L6.47387701%2C14.9966829%20C6.29176662%2C14.8485393%206.05510385%2C14.7851257%205.82331983%2C14.8223666%20L5.82331983%2C14.8223666%20Z%22%2F%3E%0A%20%20%20%20%3Cpolyline%20stroke%3D%22%23FFFFFF%22%20stroke-width%3D%221.6%22%20points%3D%224.755%208.252%207%2010.5%2011.495%206.005%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%2F%3E%0A%20%20%3C%2Fg%3E%0A%3C%2Fsvg%3E" width="13" height="12" style="margin-left:4px;margin-right:4px;" onmouseenter="openVerify();" onmouseleave="openVerify();"><div id="verify" style="display:none;margin:5px 0; margin-bottom:-2px;">Владелец данной страницы - тестер OpenVK.</div>';
    } ?><?php if ($user['verify'] == '4') {
      echo '<img src="img/verify_hacker.png" width="12" height="12" style="margin-left:4px;margin-right:4px;margin-bottom:-2px;" onmouseenter="openVerify();" onmouseleave="openVerify();"><div id="verify" style="display:none;margin:5px 0;">Владелец данной страницы - л-лакер..</div>';
    } ?>
    <?php if ($_SESSION['id'] == $id){?><span><b>(это Вы)</b></span><? } 
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
    <?php 
    if ($user['avatar'] != null AND $user['ban'] == '0') {
      echo '<a href="watchi.php?image='.$user['avatar'].'"><img src="avatar.php?image='.$user['avatar'].'"></a>';
    }else{
      echo '<img src="img/camera_200.png">';
    }
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
$friends_verify = "yep";
}elseif($fcs['id1'] == $_SESSION['id'] && $fcs['id2'] == $id){
echo '<a id="aprofile" href="del_friend_sub.php">Отменить заявку</a><div style="color:black;font-size:10px;margin-top:8px;margin-left:7px;">Вы подписаны на него</div>';
$friends_verify = "";
}elseif($fcs2['id1'] == $id && $fcs2['id2'] == $_SESSION['id']){
echo '<a id="aprofile" href="add_friend.php">Добавить в друзья</a><div style="color:black;font-size:10px;margin-top:8px;margin-left:25px;">Подписан на Вас</div>';
$friends_verify = "";
}else{
echo '<a id="aprofile"  href="add_friend_sub.php">Добавить в друзья</a>';
$friends_verify = "";
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
   </div><?php if ($id != '100') {?>
   <div id="content-friends">
   <?php
   $qfriendscount = $dbh1->prepare("SELECT COUNT(1) FROM `friends` WHERE `id1`='".$id."'");
   $qfriendscount -> execute();
   $frcount = $qfriendscount->fetch();
   $frcount = $frcount[0];
   if ($frcount == '1') {
     $frcounnt = (string)$frcount." друг";
   }elseif ($frcount == '2' OR $frcount == '3' OR $frcount == '4') {
     $frcounnt = (string)$frcount." друга";
   }else{
     $frcounnt = (string)$frcount." друзей";
   }
   ?>
   <? if($user['ban'] != '1'){?>
    <?php echo '<a href="friends'.$id.'" style="text-decoration: none;">'; ?><div id="content-wall-title">Друзья</text></div><div id="content-wall-send"><?php echo $frcounnt; ?></div>
    <div id="content-friends-list">
   <?php 

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
}?>
     
    </div></a><br><br>
<?php if($user['ban'] != '1'){ ?>
<?php echo '<a href="groups'.$id.'" style="text-decoration: none;">'; ?><div id="content-wall-title">Группы</div>
<div id="content-wall-send"><?php
$qcountclub = $dbh1->prepare("SELECT COUNT(1) FROM `clubsub` WHERE `id1` = '".$id."'");
$qcountclub->execute();
$countclub = $qcountclub->fetch();
$countclub = $countclub[0];
if ($countclub == '1' OR $countclub == '21') {
echo $countclub." группа";
}elseif ($countclub == '2' OR $countclub == '3' OR $countclub == '4' OR $countclub == '22') {
echo $countclub." группы";
}else{
echo $countclub." групп";
}
echo '</div></a>';
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
}?>
<?php if($user['ban'] != '1'){ ?><br>
<a href="videos<?php echo $id;?>" style="text-decoration: none;"><div id="content-wall-title">Видеозаписи</div>
<div id="content-wall-send"><?php
$qvideoscount = $dbh1->prepare("SELECT COUNT(1) FROM `video` WHERE `aid` = '".$id."'");
   $qvideoscount -> execute();
   $vidcount = $qvideoscount->fetch();
   $vidcount = $vidcount[0];
   if ($vidcount == '1') {
     $vidcouunt = (string)$vidcount." видеозапись";
   }elseif ($vidcount == '2' OR $vidcount == '3' OR $vidcount == '4') {
     $vidcouunt = (string)$vidcount." видеозаписи";
   }else{
     $vidcouunt = (string)$vidcount." видеозаписей";
   }
   echo $vidcouunt.'</div>';
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
}
} ?>

   <? if($id != '6'){ ?>
   <br><a href="albums<?php echo $id;?>" style="text-decoration: none;"><div id="content-wall-title">Фотоальбомы</div>
<div id="content-wall-send"><?php
$qalbumscount = $dbh1->prepare("SELECT COUNT(1) FROM `albums` WHERE `aid` = '".$id."'");
   $qalbumscount -> execute();
   $phocount = $qalbumscount->fetch();
   $phocount = $phocount[0];
   if ($phocount == '1') {
     $vidcouunt = (string)$phocount." альбом";
   }elseif ($phocount == '2' OR $phocount == '3' OR $phocount == '4') {
     $vidcouunt = (string)$phocount." альбома";
   }else{
     $vidcouunt = (string)$phocount." альбомов";
   }
   echo $vidcouunt.'</div>';
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
}
 ?>

   </div></a><?php } ?>
   <br><a href="notes<?php echo $id;?>" style="text-decoration: none;"><div id="content-wall-title">Заметки</div>
<div id="content-wall-send"><?php
$qnotesscount = $dbh1->prepare("SELECT COUNT(1) FROM note WHERE `aid` = '".$id."'");
   $qnotesscount -> execute();
   $notecount = $qnotesscount->fetch();
   $notecount = $notecount[0];
   if ($notecount == '1') {
     $notecouunt = (string)$notecount." заметка";
   }elseif ($notecount == '2' OR $notecount == '3' OR $notecount == '4') {
     $notecouunt = (string)$notecount." заметки";
   }else{
     $notecouunt = (string)$notecount." заметок";
   }
   echo $notecouunt.'</div>';
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

   </div></a>
  <div id="content-right">
   <div id="content-info" >
    <h4 class="simple">
    <?php if($user['nickname'] == NULL){echo substr($user['name'], 0, 26).' '.substr($user['surname'], 0, 26);}else{echo substr($user['name'], 0, 26).' '.substr($user['nickname'], 0, 30).' '.substr($user['surname'], 0, 26);} ?>


    <?php if($_SESSION['loginin'] == '1') { ?>
    <div class="clear" id="profile_current_info"><div class="absolutemenu" id="statusarea" style="display: none;padding: 5px;margin:-10px;"><form method="get" action="change_status.php" style="margin:0;"><input type="text" name="status" id="text" size="75" value="<?php if($user['ban'] != '1'){ echo $user['status']; }?>"><br><br><input type="submit" id="button" value="Сохранить"></form></div><a <?php if($_SESSION['id'] == $id){?> href="#" onclick="openStatusEdit()" <?php } ?> style="font-size:11px;word-wrap:break-word;overflow:hidden;text-decoration: none;color: black;font-weight: initial;"><?php if($user['ban'] != '1'){ echo $user['status']; }?></a></div>
    <?php } ?>

    
  </h4>
        <?php if ($user['ban'] != '1'){?>

        <div class="profile_info" class="clear_fix"><div class="clear_fix">
          <?php if($id == '100') { echo "<center><b>Официальная страница администрации OpenVK.</b></center>
<br>
<center>
Если у Вас возникла проблема или Вам требуется помощь, обратитесь в <a href='club2'>службу поддержки.</a> </center> "; } ?>
            <?php if($id != '100') { ?>
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
<div id="content-wall-title" class="clear_fix" style="margin-top:15px;">Информация</div>
<div class="profile_info" >
<div class="clear_fix miniblock">
<div class="label fl_l">Номер телефона: </div>
<div class="labeled fl_l">
  <?php if($friends_verify == "yep"){
    if ($user['telephone'] != "") {
      echo $user['telephone'];
    }else{
      echo "<i>&#60;не указан&#62;</i>";
    }
  }else if ($user['id'] == $_SESSION['id']) {
    if ($user['telephone'] != "") {
      echo $user['telephone'];
    }else{
      echo "<i>&#60;не указан&#62;</i>";
    }
  }else if ($user['telephone_settings'] == "1") {
    if ($user['telephone'] != "") {
      echo $user['telephone'];
    }else{
      echo "<i>&#60;не указан&#62;</i>";
    }
  }else{
    echo "<i>&#60;информация только для друзей&#62;</i>";
  }
    ?>
      </div>
      <div class="label fl_l">E-mail: </div>
<div class="labeled fl_l">
  <?php if($friends_verify == "yep"){
    if ($user['email'] != "") {
      echo $user['email'];
    }else{
      echo "<i>&#60;не указан&#62;</i>";
    }
  }else if ($user['email_settings'] == "1") {
    if ($user['email'] != "") {
      echo $user['email'];
    }else{
      echo "<i>&#60;не указан&#62;</i>";
    }
  }else if ($user['id'] == $_SESSION['id']) {
    if ($user['email'] != "") {
      echo $user['email'];
    }else{
      echo "<i>&#60;не указан&#62;</i>";
    }
  }else{
    echo "<i>&#60;информация только для друзей&#62;</i>";
  }
    ?>
      </div>
    </div>
</div>
</div>

    
   <div id="content-wall" class="clear_fix" style="padding-top:15px;">
   <div id="content-wall-title" class="clear_fix">Стена</div>
    <div id="content-wall-send" class="clear_fix"><?php
   $qwallcount = $dbh1->prepare("SELECT COUNT(1) FROM `wall` WHERE `idwall`='".$id."'");
   $qwallcount -> execute();
   $wlcount = $qwallcount->fetch();
   $wlcount = $wlcount[0];
   
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
   <? if($user['id'] != '0'){ ?><a href="wall<?php echo $id ?>" style="display: block;float: right;">Все</a><? } ?></div>
    <?php } ?></div>
    <?php
    if ($_SESSION['loginin'] == '1') { 
	$qtu = $dbh1->prepare("SELECT * FROM users WHERE id = '".$_SESSION['id']."'");
	$qtu->execute();
	$tu = $qtu->fetch();
	if($tu['avatar'] == NULL){
	$tu['avatar'] = "img/camera_200.png";
	}
	?>
	
<div id="post-1" style="border:#F0F0F0 1px solid;cursor:pointer;display:block;background:#fff;margin-top:-11px;" onclick="openNewPost()">
	<div style="padding:10px;"><table border="0" style="font-size:8pt;"><tr><td width="40px"><a href="id<?php echo $_SESSION['id'] ?>"><img src="<?php echo $tu['avatar']; ?>" width="28px" height="auto"></a></td><td><span style="color:#828282;">Что нового?</span></td></tr></table></div>
  </div>
  <form action="add_post.php" method="post" enctype="multipart/form-data">
  <div id="post-2" style="border:#F0F0F0 1px solid;display:none;background:#fff;margin-top:-11px;">
	<div style="padding:10px;"><table border="0" style="font-size:8pt;"><tr><td width="40px" style="vertical-align:top;"><a href="id<?php echo $_SESSION['id']; ?>"><img src="<?php echo $tu['avatar']; ?>" width="28px" height="auto"></a></td><td><textarea rows="1" name="text" id="text" style="min-width:345px;max-width:345px;width:345px;min-height:25px;border:0;outline:0;display:block;"></textarea></td></tr></table></div>
  </div>
  <div id="post-2-tool" style="border:#F0F0F0 1px solid;border-top:0;display:none;background-color:#FAFBFC;">
	<div style="padding:10px;float:right;"><input type="submit" id="button" value="Опубликовать"></div>
	<div style="clear:both;"></div>
  </div>
  </form>
    
<?php
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
    <?php } else { ?>
     <div id="msg">К сожалению нам пришлось заблокировать этого пользователя.<br> Комментарий модератора: <? if($user['comment_ban'] == null){echo "Причина не указана.";}else{echo $user['comment_ban']; echo ".";} ?></div>
    <?php } ?>
    
  </div>
  </div>
  </div>
  </div>
  </div>
 <div>
 <? include ('exec/footer.php'); ?>
 </div>
 </body>
 <script type="text/javascript">
function otvet(a,b)

{
var str = a;
var idd = b;
var text=document.getElementById(b);
document.getElementById(b).value=a+", "+text.value;
}
  function openVerify() {
    if(document.getElementById('verify').style.display == "block"){
      document.getElementById('verify').style.display = "none";
    }else{
      document.getElementById('verify').style.display = "block";
    }
  }

  function openAdmin() {
    if(document.getElementById('admin').style.display == "block"){
      document.getElementById('admin').style.display = "none";
    }else{
      document.getElementById('admin').style.display = "block";
    }
  }
  
function openNewPost(){
  document.getElementById("post-1").style.display = "none";
  document.getElementById("post-2").style.display = "block";
  document.getElementById("post-2-tool").style.display = "block";
}

  function openMenuPin() {
    if(document.getElementById('pinpostmenu').style.display == "block"){
      document.getElementById('pinpostmenu').style.display = "none";
    }else{
      document.getElementById('pinpostmenu').style.display = "block";
    }
  }

  function menuPinPhoto() {
    document.getElementById('pinpostmenu').style.display = "none";
    document.getElementById('postphoto').style.display = "block";
  }

  function openTextarea() {
    document.getElementsByClassName('post-textarea-button')[0].style.display = "none";
    document.getElementsByClassName('post-textarea')[0].style.display = "block"; 
  }

  function openTextareaEdit(idpost) {
    alert(idpost);
    document.getElementsByClassName('post'+idpost)[0].style.display = "none";
    document.getElementsByClassName('postedit'+idpost)[0].style.display = "block"; 
  }

  function openStatusEdit() {
    if(document.getElementById('statusarea').style.display == "block"){
      document.getElementById('statusarea').style.display = "none";
    }else{
      document.getElementById('statusarea').style.display = "block";
    }
  }

function openImage(imgFile){
  var imgWindow = window.open("", "ImgWindow", "width=800,height=600,scrollbars=yes"); 
  imgWindow.document.write('<img src="' + imgFile + '">');
}
</script>
</html>