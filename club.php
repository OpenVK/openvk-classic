  <?php 
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
if (isset($_GET['id']) != null) { 
 $id = $_GET['id'];
 $q = "SELECT * FROM club WHERE id='".$id."'"; // выбираем нашего 
 $q1 = $dbh1->prepare($q); // отправляем запрос серверу
 $q1 -> execute(); 
 $club = $q1->fetch(); // ответ в переменную
  $q44 = "SELECT * FROM users WHERE id='".$_SESSION['id']."'"; // выбираем нашего 
 $q2 = $dbh1->prepare($q); // отправляем запрос серверу
 $q2 -> execute(); 
 $user = $q2->fetch(); // ответ в переменную 
}
$_SESSION['clubwall'] = $id;
if ($club['id'] == ""){
    header("Location: blank.php?id=2");
    exit();
}
if (isset($_GET['id']) == null) {
  header("Location: blank.php?id=2");
  exit();
}
include('exec/header.php');
include('exec/datefn.php');
include('exec/leftmenu.php');
$qchsubcl = $dbh1->prepare("SELECT * FROM clubsub WHERE `id1` = '".$_SESSION['id']."' AND `id2` = '".$id."'");
      $qchsubcl->execute();
      $chsubcl = $qchsubcl->fetch();

      $qchsubcl1 = $dbh1->prepare("SELECT * FROM clubsubrequest WHERE `id1` = '".$_SESSION['id']."' AND `id2` = '".$id."'");
      $qchsubcl1->execute();
      $chsubcl1 = $qchsubcl1->fetch();
?>
<? if($club['closed'] == '2' AND $club['authorid'] == $_SESSION['id']){?>
типа соси хуй
<? } ?>
<? if($club['closed'] != '2'){ ?>
<div id="content-infoname"><b><?php if($club['ban'] == '1') { echo "Сообщество заблокированно";}else{echo substr($club['name'], 0, 45); } ?></b><?php if ($club['verify'] == '1') {
      echo '<img src="img/verify.png" width="12" height="12" style="margin-left:5px;margin-right:5px;margin-bottom:-2px;" onmouseenter="openVerify();" onmouseleave="openVerify();"><div id="verify" style="display:none;margin:10px 0;">Данная группа была официально верифицирована администрацией OpenVK.</div>';
    }  if ($club['verify'] == '2') {
      echo '<img src="data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2216%22%20height%3D%2216%22%20viewBox%3D%220%200%2016%2016%22%3E%0A%20%20%3Cg%20fill%3D%22none%22%20fill-rule%3D%22evenodd%22%3E%0A%20%20%20%20%3Cpath%20fill%3D%22%2374A2D6%22%20d%3D%22M5.82331983%2C14.8223666%20L4.54259486%2C15.0281417%20C4.15718795%2C15.0900653%203.78122933%2C14.8730055%203.64215331%2C14.5082715%20L3.17999726%2C13.2962436%20C3.09635683%2C13.0768923%202.92310766%2C12.9036432%202.70375635%2C12.8200027%20L1.49172846%2C12.3578467%20C1.12699447%2C12.2187707%200.909934662%2C11.842812%200.971858288%2C11.4574051%20L1.17763336%2C10.1766802%20C1.21487428%2C9.94489615%201.15146068%2C9.70823338%201.00331709%2C9.52612299%20L0.184748166%2C8.51987017%20C-0.0615827221%2C8.21705981%20-0.0615827221%2C7.78294019%200.184748166%2C7.48012983%20L1.00331709%2C6.47387701%20C1.15146068%2C6.29176662%201.21487428%2C6.05510385%201.17763336%2C5.82331983%20L0.971858288%2C4.54259486%20C0.909934662%2C4.15718795%201.12699447%2C3.78122933%201.49172846%2C3.64215331%20L2.70375635%2C3.17999726%20C2.92310766%2C3.09635683%203.09635683%2C2.92310766%203.17999726%2C2.70375635%20L3.64215331%2C1.49172846%20C3.78122933%2C1.12699447%204.15718795%2C0.909934662%204.54259486%2C0.971858288%20L5.82331983%2C1.17763336%20C6.05510385%2C1.21487428%206.29176662%2C1.15146068%206.47387701%2C1.00331709%20L7.48012983%2C0.184748166%20C7.78294019%2C-0.0615827221%208.21705981%2C-0.0615827221%208.51987017%2C0.184748166%20L9.52612299%2C1.00331709%20C9.70823338%2C1.15146068%209.94489615%2C1.21487428%2010.1766802%2C1.17763336%20L11.4574051%2C0.971858288%20C11.842812%2C0.909934662%2012.2187707%2C1.12699447%2012.3578467%2C1.49172846%20L12.8200027%2C2.70375635%20C12.9036432%2C2.92310766%2013.0768923%2C3.09635683%2013.2962436%2C3.17999726%20L14.5082715%2C3.64215331%20C14.8730055%2C3.78122933%2015.0900653%2C4.15718795%2015.0281417%2C4.54259486%20L14.8223666%2C5.82331983%20C14.7851257%2C6.05510385%2014.8485393%2C6.29176662%2014.9966829%2C6.47387701%20L15.8152518%2C7.48012983%20C16.0615827%2C7.78294019%2016.0615827%2C8.21705981%2015.8152518%2C8.51987017%20L14.9966829%2C9.52612299%20C14.8485393%2C9.70823338%2014.7851257%2C9.94489615%2014.8223666%2C10.1766802%20L15.0281417%2C11.4574051%20C15.0900653%2C11.842812%2014.8730055%2C12.2187707%2014.5082715%2C12.3578467%20L13.2962436%2C12.8200027%20C13.0768923%2C12.9036432%2012.9036432%2C13.0768923%2012.8200027%2C13.2962436%20L12.3578467%2C14.5082715%20C12.2187707%2C14.8730055%2011.842812%2C15.0900653%2011.4574051%2C15.0281417%20L10.1766802%2C14.8223666%20C9.94489615%2C14.7851257%209.70823338%2C14.8485393%209.52612299%2C14.9966829%20L8.51987017%2C15.8152518%20C8.21705981%2C16.0615827%207.78294019%2C16.0615827%207.48012983%2C15.8152518%20L6.47387701%2C14.9966829%20C6.29176662%2C14.8485393%206.05510385%2C14.7851257%205.82331983%2C14.8223666%20L5.82331983%2C14.8223666%20Z%22%2F%3E%0A%20%20%20%20%3Cpolyline%20stroke%3D%22%23FFFFFF%22%20stroke-width%3D%221.6%22%20points%3D%224.755%208.252%207%2010.5%2011.495%206.005%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%2F%3E%0A%20%20%3C%2Fg%3E%0A%3C%2Fsvg%3E" width="13" height="12" style="margin-left:4px;margin-right:4px;margin-bottom:-2px;" onmouseenter="openVerify();" onmouseleave="openVerify();"><div id="verify" style="display:none;margin:10px 0;">Данная группа - группа тестеров OpenVK.</div>';
    } if($club['verify'] == "3"){
      echo '<img src="img/verify_orange.png" width="12" height="12" style="margin-left:4px;margin-right:4px;margin-bottom:-2px;" onmouseenter="openVerify();" onmouseleave="openVerify();"><div id="verify" style="display:none;margin:10px 0;">Данная группа - группа от команды разработчиков.</div>';
    }
    if($club['verify'] == "4"){
      echo '<img src="img/verify_dvach.png" width="13" height="13" style="margin-left:4px;margin-right:4px;margin-bottom:-2px;" onmouseenter="openVerify();" onmouseleave="openVerify();"><div id="verify" style="display:none;margin:10px 0;">2ch.hk</div>';
    }
    if($club['verify'] == "5"){
      echo '
<svg xmlns="http://www.w3.org/2000/svg" width="12" height="14" viewBox="0 0 12 16">
  <g fill="none" fill-rule="evenodd" transform="translate(-2)">
    <rect width="10" height="10"/>
    <path fill="#F05C44" fill-rule="nonzero" d="M7.45670576,0.0491191453 C7.23924532,0.210359904 7.06315593,0.339042665 6.92843761,0.435167426 C3.32165527,3.00869327 2.01518627,6.64914309 2,9.23539075 C2,12.6514555 4.57142857,15 8,15 C11.4285714,15 13.9571805,12.651039 14,9.23539075 C14.0119431,8.28270421 13.9289521,6.06769422 11.8070494,3.42138153 C11.2108201,2.67779927 10.6987542,2.16500767 10.2708516,1.88300673 L10.2708501,1.88300908 C10.1647875,1.81311057 10.0221428,1.84242735 9.95224428,1.94848996 C9.92291174,1.99299857 9.90994982,2.04631381 9.91557442,2.09932116 C9.93942176,2.32406296 9.96908823,2.60035551 10.0045738,2.92819881 C10.2106584,4.83216737 9.2474996,5.7142721 7.93083746,5.51953039 C6.65784262,5.33124732 5.82871798,3.579141 7.71655826,0.664277772 C7.76981213,0.582052729 7.8141433,0.462249592 7.84955177,0.30486836 L7.84961918,0.304883527 C7.87993399,0.170142276 7.79527963,0.0363379053 7.66053837,0.00602310064 C7.58956004,-0.00994598395 7.51514617,0.00578723569 7.45670576,0.0491191453 Z"/>
  </g>
</svg>';
    } ?>
    </div>
  <? if($club['ban'] == "1"){ ?>
<link rel="stylesheet" href="blank.css">
<div class="simpleBlock">
  <div class="simpleHeader">Ошибка!</div>
  <div class="simpleBar clearFix">
   Группа заблокирована.<hr> Комментарий модератора:
   <? if($club['comment_ban'] != null){ echo $club['comment_ban'];}else{echo 'отсутствует.';} ?><br>


  
  </div>
   <? if($_SESSION['groupu'] == "2"){
	echo '<a id="aprofile" href="admin/actions/ban_club.php?id='.$id.'">Забанить/Разбанить</a>';
   } ?>
 </div>
<? } ?>
  <? if($club['deleted'] == "1"){  ?>
<link rel="stylesheet" href="blank.css">
<div class="simpleBlock">
  <div class="simpleHeader">Ошибка!</div>
  <div class="simpleBar clearFix">
   Группа удалена.


  
  </div>

   <? if($_SESSION['groupu'] == "2"){
  echo '<a id="aprofile" href="admin/actions/ban_club.php?id='.$id.'">Забанить/Разбанить</a>';
   } ?>
 </div>
<? exit(); } ?>
  <div id="content-left" style="width:397px;">
   <div id="content-info" >
    
    


    <?php if($_SESSION['loginin'] == '1') { ?>
    <div class="clear" id="profile_current_info"><span style="font-size:10px;"><?php // echo $club['status'] ?></span></div>
    <?php } ?>

  
        <?php if ($club['ban'] != '1'){?>
<div id="content-wall-title" class="clear_fix">Информация</div>
        <div class="profile_info" class="clear_fix"><div class="clear_fix miniblock">
            <?php if($club['type'] == '1'){?><h4>О встрече</h4><?php } ?>
 <div class="label fl_l" style="width: 65px;">Название:</div>
<b><? echo substr($club['name'], 0, 45); ?></b><br>
 <div class="label fl_l" style="width: 65px;">Тип:</div>
<? if ($club['type'] == "0") {
  echo 'Группа';
}else if ($club['type'] == "1") {
  echo "Встреча";
}  ?>
  <?php if ($club['type'] == "1") { ?>
  <br>
  <br>
  <h4>Время и место</h4>
  <? $club['place'] = htmlentities($club['place'],ENT_QUOTES);
$club['place'] = str_replace(array("\r\n", "\r", "\n", "<", ">", "<script>"), '<br>', $club['place']);
   if($club['place'] != ""){?>
  <div class="label fl_l" style="width: 65px;">Место:</div>
<? echo $club['place']; ?><br><?php } ?>
  <div class="label fl_l" style="width: 65px;">Начало:</div>
<? echo zmd($club['datestart']); ?><br>
<div class="label fl_l" style="width: 65px;">Окончание:</div>
<? echo zmd($club['datefinish']); ?>
<?
$club['email'] = htmlentities($club['email'],ENT_QUOTES);
$club['email'] = str_replace(array("\r\n", "\r", "\n", "<", ">", "<script>"), '<br>', $club['email']);
if($club['email'] == '') {}else{ ?>
<br>
<br>
 <h4>Дополнительно</h4>
<div class="label fl_l" style="width: 65px;">Email:</div>
<? echo $club['email'];?><br>
  <?php } }?>
</div>
</div>
<div id="content-wall-title">Описание</div>
<div class="label fl_l" style="width: 65px;"></div><br>
  <? if($club['about']){
    echo '<div class="labeled fl_l" style="width:400px;">'.substr($club['about'], 0, 255).'</div>';
  }else{
    echo '<div class="labeled fl_l" style="width:320px;"><i>&#60;нет информации&#62;</i></div>';
  } ?>
   <div id="content-wall" class="clear_fix" style="padding-top:15px;">

<? if($club['ban'] == '0') {  ?>
<?php echo '<a href="participants.php?id='.$id.'" style="text-decoration: none;">'; ?><div id="content-wall-title">Участники</div>
<div id="content-wall-send"><?php
$qcountclub = $dbh1->prepare("SELECT COUNT(1) FROM clubsub WHERE `id2` = '".$id."'");
$qcountclub->execute();
$countclub = $qcountclub->fetch();
$countclub = $countclub[0];
if ($countclub == '1' OR $countclub == '21') {
echo $countclub." участник";
}elseif ($countclub == '2' OR $countclub == '3' OR $countclub == '4' OR $countclub == '22') {
echo $countclub." участника";
}else{
echo $countclub." участников";
}
?></div></a>

<?php
$qsubclub = $dbh1->prepare("SELECT * FROM clubsub WHERE `id2` = '".$id."' GROUP BY id1 ORDER BY RAND() LIMIT 6");
$qsubclub->execute();
while($subclub = $qsubclub->fetch()){
$qsubu = $dbh1->prepare("SELECT * FROM users WHERE `id` = '".$subclub['id1']."'");
$qsubu->execute();
$subu = $qsubu->fetch();
if ($subu['avatar'] != null) {
echo '<div id="content-friends-friend" style="clear:both;margin-right:3.65px;"><img id="avatar" src="avatarc.php?image='.$subu['avatar'].'" style="margin-top: 3px;clear:both;">
<b style="margin-right: 3px;clear:both;"><a style="margin-top: 3px;clear:both;" href="id'.$subu['id'].'">'.$subu['name'].'<br> <text style="font-size: 8px;clear:both;">'.$subu['surname'].'</text></a></b></div>';
}else{
echo '<div id="content-friends-friend" style="clear:both;margin-right:3.65px;"><img id="avatar" src="img/camera_200.png" width="50" height="50" style=" margin-top: 3px;clear:both;">
<b style="margin-right: 3px;clear:both;"><a style="margin-top: 3px;clear:both;" href="id'.$subu['id'].'">'.$subu['name'].'<br> <text style="font-size: 8px;clear:both;">'.$subu['surname'].'</text></a></b></div>';
}
}
?>
<br><br><?php  if($club['closed'] == '0' OR $chsubcl['id1'] == $_SESSION['id'] AND $chsubcl['id2'] == $id){ ?>
   <div id="content-wall-title" class="clear_fix">Стена</div>
    <div id="content-wall-send" class="clear_fix"><?php
   $qwallcount = $dbh1->prepare("SELECT COUNT(1) FROM gpost WHERE idwall='".$id."'");
   $qwallcount -> execute();
   $wlcount = $qwallcount->fetch();
   $wlcount = $wlcount[0];
   if ($wlcount == '1' OR $wlcount == '21') {
     $wlcounnt = (string)$wlcount." запись";
   }elseif ($wlcount == '2' OR $wlcount == '3' OR $wlcount == '4' OR $wlcount == '22') {
     $wlcounnt = (string)$wlcount." записи";
   }else{
     $wlcounnt = (string)$wlcount." записей";
   }
   echo '<div class="post-textarea-button">'.$wlcounnt;?><?php if($_SESSION['loginin'] == '1') { 
    if($club['wall'] == "0" OR $club['authorid'] == $_SESSION['id']){?>

   <a href="#" style="display: block;float: right;" onmousedown="openTextarea();" >Написать</a></div>
    <div class="post-textarea" style="display: none;">
    <form method="post" action="add_gpost.php" enctype="multipart/form-data">
     <textarea placeholder="Что нового?" name="text"></textarea><div id="postphoto" style="display: none;"><input type="file" name="upimg" accept="image/jpeg,image/png,image/gif"></div><div style="float:right;clear:both;"><?php if ($club['wall'] == "1") {
       echo '<input style="margin-right:5px;" type="checkbox" name="bygroup" id="bygroup" checked disabled><label for="bygroup" style="color:black;margin-right:8px;" >от имени сообщества</label>';
     }elseif($club['authorid'] == $_SESSION['id'] || $user['groupu'] == '2'){echo '<input style="margin-right:5px;" type="checkbox" name="bygroup" id="bygroup"><label for="bygroup" style="color:black;margin-right:8px;">от имени сообщества</label>';} ?><a href="#" onclick="openMenuPin();" class="pinlink">Прикрепить</a><div class="absolutemenu" id="pinpostmenu" style="display: none;<?php if($club['authorid'] == $_SESSION['id']){ ?>margin-left: 139px;<?php } ?>"><a href="#" onclick="menuPinPhoto();" ><img src="img/photo-icon.png"> Фотография</a></div></div><input type="submit" id="button" value="Опубликовать" style="float:left;margin-top:5px;"></form><div style="clear:both;"></div>
   </div>
 </div>
    <?php }else{
      echo "</div></div>";
    }
  }else{
      echo "</div></div>";
    } ?>

    <?php
    if ($_SESSION['loginin'] == '1') {
    
    
$q2 = $dbh1->prepare("SELECT * FROM gpost WHERE idwall='".$id."' ORDER BY id DESC");
$q2 -> execute();
while($wall = $q2->fetch()) {
  
   $q3 = $dbh1->prepare("SELECT * FROM users WHERE id='".$wall['iduser']."'"); // отправляем запрос серверу
   $q3 -> execute(); 
   $authorwall = $q3->fetch(); // ответ в переменную .
   if(time()-300 <= $authorwall['lastonline']){
    $onlinewall = "<b>Онлайн</b>";
  }else{
    $onlinewall = "";
  }
   if($wall['bygroup'] == "0"){
    $qchg = $dbh1->prepare("SELECT * FROM club WHERE id='".$id."' AND authorid='".$_SESSION['id']."'");
  $qchg -> execute();
  $chg = $qchg->fetch();
  if($chg['id'] == $id && $chg['authorid'] == $_SESSION['id']){
    if ($wall['iduser'] == $_SESSION['id'] OR $chg['id'] == $id && $chg['authorid'] == $_SESSION['id']) {
    $deletebutton = '<a href="del_gpost.php?id='.$wall['id'].'" style="float:left;">Удалить</a>';
  }else{
    $deletebutton = '';
  }
}else{
  if ($wall['iduser'] == $_SESSION['id']) {
    $deletebutton = '<a href="del_gpost.php?id='.$wall['id'].'" style="float:left;">Удалить</a>';
  }else{
    $deletebutton = '';
  }
}
    if ($wall['image'] != null) {
     $im = '<br><br><a href="watchi.php?image='.$wall['image'].'"><img src="imagep.php?image='.$wall['image'].'"></a>';
   }else{
    $im = '';
   }
   if($authorwall['avatar'] == NULL){
    $ava = "img/camera_200.png";
   }else{
    $ava = "avatarc.php?image=".$authorwall['avatar'];
   }
       
   echo '<div id="content-wall-post"><table border="0" style="font-size:11px;"><tr><td style="width:54px;vertical-align:top;">
   <div id="content-wall-post-avatar"><img id="avatar" src="'.$ava.'" width="50"></div>'.$onlinewall.'</td><td style="width:345px;vertical-align:0;">
     <div id="content-wall-post-infoofpost">
      
      <div id="content-wall-post-authorofpost"><text style="margin-right: 3px;"><b><a href="id'.$authorwall['id'].'">'.$authorwall['name'].' '.$authorwall['surname'].'</a></b></text>написал<br><div id="content-date"><a href="gpost'.$wall['id'].'">'.zmdate($wall['date']).'</a></div></div>
     
     <div id="content-wall-post-text">'.$wall['text'].$im.' </div>
     </div>'.$deletebutton.'<a href="gpost'.$wall['id'].'" style="float:right;">Открыть комментарии</a><div style="clear:both;"></div>
    
    </td></tr></table></div><br>';
}elseif($wall['bygroup'] == "1"){
    if ($wall['image'] != null) {
     $im = '<br><br><a href="watchi.php?image='.$wall['image'].'"><img src="imagep.php?image='.$wall['image'].'"></a>';
   }else{
    $im = '';
   }
   if($club['avatar'] == NULL){
    $ava = "img/camera_200.png";
   }else{
    $ava = "avatarc.php?image=".$club['avatar'];
   }
       
   echo '<div id="content-wall-post"><table border="0" style="font-size:11px;"><tr><td style="width:54px;vertical-align:top;">
   <div id="content-wall-post-avatar"><img id="avatar" src="'.$ava.'" width="50"></div>'.$onlinewall.'</td><td style="width:345px;vertical-align:0;">
     <div id="content-wall-post-infoofpost">
      
      <div id="content-wall-post-authorofpost"><text style="margin-right: 3px;"><b><a href="club'.$club['id'].'">'.substr($club['name'], 0, 45).'</a></b></text><br><div id="content-date"><a href="gpost'.$wall['id'].'">'.zmdate($wall['date']).'</a></div></div>
     
     <div id="content-wall-post-text">'.$wall['text'].$im.'<br><div style="margin-top:6px;font-size:9px;"><a href="id'.$authorwall['id'].'"><svg width="8" height="9" viewBox="20 203 8 9" xmlns="http://www.w3.org/2000/svg" style="fill:#AABBCE;margin-right:5px;"><path d="M24 209c3.5 0 4 1 4 2.5 0 .5 0 .5-1 .5h-6c-1 0-1 0-1-.5 0-1.5.5-2.5 4-2.5zm0-1c-1.1 0-2-1.12-2-2.5s.9-2.5 2-2.5 2 1.12 2 2.5-.9 2.5-2 2.5z"/></svg>'.$authorwall['name'].' '.$authorwall['surname'].'</a></div></div>
     </div>'.$deletebutton.'<a href="gpost'.$wall['id'].'" style="float:right;">Открыть комментарии</a><div style="clear:both;"></div>
    
    </td></tr></table></div><br>';
}
} }else{
  ?> <div id="msg">Для того, чтобы просматривать стену группы, вам необходимо авторизоваться</div><?php
 } } } ?>
    
  </div>
  </div>
  </div>
  <div id="content-right" style="width:200px;">
    
   <div id="content-avatar">
    <?php 
    if ($club['avatar'] != null AND $club['ban'] == '0') {
      echo '<a href="watchi.php?image='.$club['avatar'].'"><img src="avatar.php?image='.$club['avatar'].'"></a>';
    }else{
      echo '<img src="img/camera_200.png">';
    }
    if($_SESSION['loginin'] == "1"){
      

      
      if ($club['ban'] != '1') {

      if($chsubcl['id1'] == $_SESSION['id'] && $chsubcl['id2'] == $id){
        echo '<a id="aprofile" href="unsub_club.php" style="margin-top:10px;clear:both;">Выйти из группы</a>';
      }elseif ($chsubcl1['id1'] == $_SESSION['id'] && $chsubcl1['id2'] == $id) {
        echo '<a id="aprofile" href="club_cancelreq.php?id='.$club['id'].'" style="margin-top:10px;clear:both;">Отменить заявку</a>';
      }

      else if ($club['closed'] == "1") {
        echo '<a id="aprofile" href="club_sendreq.php?id='.$club['id'].'" style="margin-top:10px;clear:both;">Отправить заявку</a>';
    }else{
        echo '<a id="aprofile" href="sub_club.php" style="margin-top:10px;clear:both;">Вступить в группу</a>';
      }
    }
  }
    if($club['authorid'] == $_SESSION['id']){
      echo '<a id="aprofile" href="gsettings.php?id='.$id.'" style="margin-top:10px;clear:both;">Редактировать группу</a>';
    }
    if($_SESSION['groupu'] == "2"){
    //echo '<a id="aprofile" href="#" onclick="openAdmin();">Дополнительные параметры</a><br>';
    //echo '<div id="admin" style="display:none;">
    //<a id="aprofile" href="gsettings.php?id='.$id.'" style="margin-top:10px;clear:both;">Редактировать группу</a>';
    //echo '<a id="aprofile" href="admin/actions/ban_club.php?id='.$id.'">Забанить/Разбанить</a>';
    //echo '</div>';
    }
    ?>
   </div>
<?php if($club['type'] == '1'){?>
<div id="content-wall-title" style="clear:both;">Тип события</div>
<div id="content-wall" style="width: 200px;margin:5px;"><p>Это открытая встреча. Любой может прийти.</p></div>
<?php }elseif($club['closed'] == "0" AND $club['type'] == "0"){?>
<div id="content-wall-title" style="clear:both;">Тип группы</div>
<div id="content-wall" style="width: 200px;margin:5px;"><p>Это открытая группа. В неё может вступить любой желающий.</p></div>
<?php }elseif ($club['closed'] == "1" AND $club['type'] == "0") {?>
<div id="content-wall-title" style="clear:both;">Тип группы</div>
<div id="content-wall" style="width: 200px;margin:5px;"><p>Это закрытая группа. В неё можно вступить только по заявке.</p></div>
<?php
} if($chsubcl['id1'] == $_SESSION['id'] && $chsubcl['id2'] == $id){ ?>
<br><a href="albums-<?php echo $id;?>" style="text-decoration: none;"><div id="content-wall-title">Фотоальбомы</div>
<div id="content-wall-send"><?php
$qalbumscount = $dbh1->prepare("SELECT COUNT(1) FROM `galbums` WHERE `aid` = '".$id."'");
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
   echo $vidcouunt.'</div><div id="content-wall">';
 $qphoto = $dbh1->prepare("SELECT * FROM `galbums` WHERE `aid` = '".$id."' ORDER BY RAND() LIMIT 2");
 $qphoto->execute();
 while ($pho = $qphoto->fetch()) {
   $qgg = $dbh1->prepare("SELECT * FROM `galbums` WHERE `id` = '".$pho['id']."'");
$qgg->execute();
$photo = $qgg->fetch();

$qphotoo = $dbh1->prepare("SELECT * FROM `photo` WHERE `galbum` = '".$photo['id']."' ORDER BY id LIMIT 1");
$qphotoo->execute();
$photoo = $qphotoo->fetch();
if ($phocount == "0") {
  $photoalbum = "img/nophoto.jpg";
}else{
  $photoalbum = $photoo['image'];
}
echo '<table border="0" style="font-size:11px;clear:both;"><div style="clear:both;"><tr><td style="width:25px;margin-right:7px;"><a href="album-'.$photo['id'].'" style="clear:both;"><img src="'.$photoalbum.'" width="75" height="auto" style="clear:both;"></a></td><td style="width:168px;"><b style="padding-left:7px;clear:both;"><a href="album-'.$photo['id'].'" style="clear:both;">'.$photo['name'].'</a></b></td></tr></div></table>';
 }

 ?>

   </div></a><?php } ?>
<? if($club['authorid'] != "0" AND $club['type'] == '0') {?>
<div id="content-wall-title" style="clear:both;">Создатель</div>
<? }else{echo '<div id="content-wall-title" style="clear:both;">Организатор</div>';} if($club['authorid'] != "0"){?>
<?php
$qcont = $dbh1->prepare("SELECT * FROM users WHERE `id` = '".$club['authorid']."'");
$qcont->execute();
$contu = $qcont->fetch();
if($contu['avatar']){
$contu['avatar'] = "avatarm.php?image=".$contu['avatar'];
}else{
$contu['avatar'] = "img/camera_200.png";
}
echo '<table border="0" style="font-size:11px;clear:both;"><div style="clear:both;"><tr><td style="width:25px;margin-right:7px;"><img src="'.$contu['avatar'].'" width="25" height="auto" style="clear:both;"></td><td style="width:168px;"><b style="padding-left:7px;clear:both;"><a href="id'.$contu['id'].'" style="clear:both;">'.$contu['name'].' '.$contu['surname'].'</a></b></td></tr></div></table>';
}
}
}
?>
<? if($club['closed'] == '2' AND $club['authorid'] != $_SESSION['id']){ ?>
<link rel="stylesheet" href="blank.css">
<div class="simpleBlock">
  <div class="simpleHeader">Ошибка!</div>
  <div class="simpleBar clearFix">
   Это частное сообщество. Доступ только по приглашениям администраторов.<hr><br>


  
  </div>
   <? if($_SESSION['groupu'] == "2"){
	echo '<a id="aprofile" href="admin/actions/ban_club.php?id='.$id.'">Забанить/Разбанить</a>';
   } ?>
 </div>
<? } ?>


<br>
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
  if(document.getElementById('verify').style.display == "none"){
    document.getElementById('verify').style.display = "block";
  }else{
    document.getElementById('verify').style.display = "none";
  }
}
 function openAdmin() {
    if(document.getElementById('admin').style.display == "none"){
      document.getElementById('admin').style.display = "block";
    }else{
      document.getElementById('admin').style.display = "none"
    }
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
</script>
</html>