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
if($_SESSION['loginin'] != '1'){
echo '<meta charset="utf-8">Пожалуйста, авторизируйтесь.<meta http-equiv="refresh" content="3;blank/../">';
exit();
}else{
if (isset($_GET['id']) != null) { 
 $id = $_GET['id'];
}
include('exec/header.php');
echo '<style>#otv{font-size:8px;margin-left:10px;cursor:pointer;}#otv:hover{text-decoration:underline;}</style>';
include('exec/datefn.php');
include('exec/leftmenu.php');?>
<div id="content-infoname"><b>Стена</b></div><?php
echo '<div class="post-textarea-button">'.$wlcounnt;?><?php if($_SESSION['loginin'] == '1') { ?>
   <? if($user['id'] != '0'){ ?><? if($user['closedwall'] == '0'){ ?><a href="#" style="display: block;float: right;" onmousedown="openTextarea();" >Написать</a><? }else{} ?><? } ?></div>
    <div class="post-textarea" style="display: none;">
    <form method="post" action="add_post.php" enctype="multipart/form-data">
     <textarea placeholder="Что нового?" name="text" id="text"></textarea><div id="postphoto" style="display: none;"><input type="file" name="upimg" accept="image/jpeg,image/png,image/gif"></div><div style="float:right;clear:both;margin-top: 8px;"><a href="#" onclick="openMenuPin();" class="pinlink">Прикрепить</a><div class="absolutemenu" id="pinpostmenu" style="display: none;"><a href="#" onclick="menuPinPhoto();" ><img src="img/photo-icon.png"> Фотография</a></div></div><input type="submit" id="button" value="Опубликовать" style="float:left;margin-top:5px;"></form><div style="clear:both;"></div></div>
    <?php } ?>
  
  <div style="float:left;margin-top:-8px;">
	<div style="margin:10px;">

   <?php if ($_SESSION['loginin'] == '1') {
    
    $imc1 = "1";
$q2 = $dbh1->prepare("SELECT * FROM `wall` WHERE `idwall`='".$id."' ORDER BY id DESC");
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
    
<?php
if($imc1 != "1"){
echo '<center><div style="margin:80px 120px;">
<table>
<tr>
<td style="width:80px;">
<img src="new/img/msnofo-error.png" style="border-radius:50%;margin-bottom:-3px;">
</td>
<td style="margin-left:8px;">
<b style="font-size:26px;">Пусто.</b><br>
<span style="font-size:13px;color:#000;">Вы можете зайти в список <a href="friends.php">своих друзей</a> и выбрать того, с кем Вы хотите пообщаться.</span>
</td>
</tr>
</table>
</div></center>';
}
$qwa = $dbh1->prepare("SELECT * FROM users WHERE id='".$wall['idwall']."'");
$qwa->execute();
while($wau = $qwa->fetch()){
   if($wau['avatar'] == NULL){
    $wau['avatar'] = "img/camera_200.png";
   }else{
    $wau['avatar'] = "avatarm.php?image=".$wau['avatar'];
   }
	echo '<img src="'.$wau['avatar'].'" width="15" height="auto"><b style="padding-left:10px;"><a href="id'.$wau['id'].'">'.$wau['name'].' '.$wau['surname'].'</a> - стена</b><hr style="margin-left:-14px;margin-right:-20px;margin-top:10px;margin-bottom:10px;"><a id="aprofile" href="id'.$wau['id'].'">Посмотреть другие записи стены</a><a id="aprofile" href="id'.$authorwall['id'].'">... или зайти на страницу автора данной записи</a>';
}
?>
	</div>
  </div>
  </div>
  </div>
  </div>
  <div>
  <? include('exec/footer.php'); ?>
  </div>
 </body>
 <script type="text/javascript">
function otvet(a,b){
var str = a;
var idd = b;
var text=document.getElementById(b);
document.getElementById("comm-1").style.display = "none";
document.getElementById("comm-2").style.display = "block";
document.getElementById("comm-2-tool").style.display = "block";
document.getElementById(b).value=a+", "+text.value;
}

function openComment(){
  document.getElementById("comm-1").style.display = "none";
  document.getElementById("comm-2").style.display = "block";
  document.getElementById("comm-2-tool").style.display = "block";
}

function openTextarea() {
    document.getElementsByClassName('post-textarea-button')[0].style.display = "none";
    document.getElementsByClassName('post-textarea')[0].style.display = "block"; 
  }
</script>
</html>