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
$qthis = "SELECT `groupu`, `verify` FROM `users` WHERE id = '".$_SESSION['id']."'"; // выбираем нашего 
$q1this = $dbh1->prepare($qthis); // отправляем запрос серверу
$q1this -> execute(); 
$userthis = $q1this->fetch(); // ответ в переменную 
include('exec/header.php');
include('exec/datefn.php');
include('exec/leftmenu.php');

    $q4 = $dbh1->prepare("SELECT * FROM `friends` WHERE `id1`='".$id."'");
    $q4 -> execute();
	$onlyfr = '';
    while($friend1 = $q4->fetch()) {
      $q5 = $dbh1->prepare("SELECT * FROM `users` WHERE `id`='".$friend1['id2']."'"); // отправляем запрос серверу
      $q5 -> execute(); 
      $friend = $q5->fetch(); // ответ в переменную .
      if($friend['ban'] != '1'){
      $onlyfr .= "OR `idwall`= ".$friend['id']." ";    
  } 
}
?>
<div style="display: block;" id="FRonly">
  <?  if ($_SESSION['loginin'] == '1') {
    
    
$q2 = $dbh1->prepare("SELECT * FROM `wall` WHERE `idwall`= ".$_SESSION['id']." ".$onlyfr." ORDER BY id DESC");
$q2 -> execute();
while($wall = $q2->fetch()) {
  if ($wall['iduser'] == $_SESSION['id'] OR $wall['idwall'] == $_SESSION['id']) {
    $deletebutton = '<a href="del_post.php?id='.$wall['id'].'" style="float:left;">Удалить</a>';
  }else{
    $deletebutton = '';
  }
  
  $q7 = $dbh1->prepare("SELECT * FROM `users` WHERE `id`='".$wall['idwall']."'"); // отправляем запрос серверу
   $q7-> execute(); 
   $napisal = $q7->fetch(); // ответ в переменную .
   if($wall['iduser'] != $wall['idwall']){
      echo "<a style='color: darkgray;'> в блоге пользователя </a><a href='id".$napisal['id']."'>".$napisal[name]." ".$napisal[surname]."</a><a style='color: darkgray;'> написали: </a>";
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
	   $nap = "написал ";
   }elseif($authorwall['gender'] == "2"){
	   $nap = "написала ";
   }else{
	   $nap = "написал(-а) ";
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
   <div id="content-wall-post-avatar"><img id="avatar" src="'.$authorwall['avatar_50'].'" width="50"></div>'.$onlinewall.'</td><td style="width:345px;vertical-align:0;">
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
        $qua = "SELECT * FROM `photo` WHERE `id`=:photo";
        $q3 = $dbh1->prepare($qua);
        $q3->bindParam(':photo', $wall['image']);
        $q3->execute();
        $photowall = $q3->fetch(); // ответ в переменную .
    if (!empty($photowall['image_333'])) {
      $im = '<br><br><a href="watchi.php?id='.$wall['image'].'"><img style="max-width: 333px;" src="'.$photowall['image_333'].'"></a>';
    }else{
      $im = '';
    }
   }else{
        $im = '';
   }
       $onlinewall = "";
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
    $q3 = $dbh1->prepare("SELECT * FROM `photo` WHERE `id`=:id");
    $q3->bindValue(':id', $wall['image']);
    $q3 -> execute(); 
    $photowall = $q3->fetch();
    $im = '<br><br><a href="watchi.php?id='.$wall['image'].'"><img style="max-width: 333px;" src="'.$photowall[3].'"></a>';// ответ в переменную .
    if (!empty($photowall[3])) {
      $im = '<br><br><a href="watchi.php?id='.$wall['image'].'"><img style="max-width: 333px;" src="'.$photowall[3].'"></a>';
    }else{
      $im = '';
    }
   }else{
        $im = '';
   }

    $onlinewall = "";
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
      <div id="content-wall-post-avatar"><img id="avatar" src="'.$user['avatar_50'].'" width="50"></div>'.$onlinewall.'</td><td style="width:345px;vertical-align:0;">
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
    $q3 = $dbh1->prepare("SELECT * FROM `photo` WHERE `id`=:id");
    $q3->bindValue(':id', $wall['image']);
    $q3 -> execute(); 
    $photowall = $q3->fetch(); // ответ в переменную .
    if (!empty($photowall['image_333'])) {
      $im = '<br><br><a href="watchi.php?id='.$wall['image'].'"><img style="max-width: 333px;" src="'.$photowall['image_333'].'"></a>';
    }else{
      $im = '';
    }
   }else{
        $im = '';
   }

    $onlinewall = "";
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
} } 
?>
</div>

  </div>
 <div>
 <? include ('exec/footer.php'); ?>
 </div>
 </body>
</script>
</html>