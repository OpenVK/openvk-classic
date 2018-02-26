<?php
session_start();
include 'exec/dbconnect.php';
include('exec/check_user.php');
if($_SESSION['loginin'] == "1"){
$qchu = $dbh1->prepare("SELECT * FROM users WHERE id = '".$_SESSION['id']."'");
$qchu->execute();
$chu = $qchu->fetch();
if($chu['verify'] == "3" || $chu['verify'] == "5" || $chu['verify'] == "4" || $_SESSION['groupu'] == "2"){
$id = $_GET['id'];
 $q = "SELECT * FROM bugtracker WHERE id='".$id."'"; // выбираем нашего 
 $q1 = $dbh1->prepare($q); // отправляем запрос серверу
 $q1 -> execute(); 
 $bug = $q1->fetch(); // ответ в переменную 
  $q = "SELECT admin FROM bugtracker WHERE id='".$id."'"; // выбираем нашего 
 $q1 = $dbh1->prepare($q); // отправляем запрос серверу
 $q1 -> execute(); 
 $buga = $q1->fetch(); // ответ в переменную 
  if($bug['id'] == null){
 	echo '<meta charset="utf-8">Нету такого отчета.';
 	exit();
 }
$aid = $_SESSION['id'];
$qs = $dbh1->prepare('SELECT * FROM users WHERE id='.$bug['aid'].''); // выбираем нашего 
$qs->execute();
$bugrs = $qs->fetch();
include 'exec/datefn.php';
include 'exec/header.php';
include 'exec/leftmenu.php';
 if($chu['ban_bugtracker'] != "1"){
?>
<div id="content-infoname"><b>Баг-трекер</b><div style="float:right;"><a href="bugtracker.php">Назад</a></div></div>
<div style="min-width:0;width:420px;float:left;margin-top:-10px;border-right:#BEBEBE solid 1px;">
<br>
<?php
if($bug['important'] == "1"){
$ver = 'Важно!';
}elseif($bug['important'] == "2"){
$ver = 'Средне';
}elseif($bug['important'] == "3"){
$ver = 'Не очень важный баг';
}
if($bug['status'] == "1"){
$status = 'Открыт';
}elseif($bug['status'] == "2"){
$status = 'Закрыт';
}elseif($bug['status'] == "3"){
$status = 'На модерировании';
}
if($bug['comment'] != null && $bug['status'] == "2"){
$moder = ''.$bug['comment'].'';
}elseif($bug['comment'] == null){
$moder = '<i> Ожидается ответ модератора </i>';
}
if($bug['photo'] != null){
$photo = '<img src="'.$bug['photo'].'" width="400" height="auto">';
}elseif($bug['photo'] == null){
$photo = '<i style="font-size:15px;"><Фото не найдено.></i>';
}
if($bug['news'] == '0'){
echo '<div id="bugs_view_description">
      <div class="bugs_view_title">
  '.$bug['name'].'
</div>
<div class="bugs_view_text">
 '.$bug['about'].' ';
 echo '
</div>

<div class="bugs_view_tags clear_fix">
</div>
<div class="bugs_updates">
  <div class="bugs_updates_title_wrap clear_fix">
    <div class="bugs_updates_title fl_l">Последние изменения</div>
    <div class="bugs_updates_toggle fl_r" style="display: none;"><a id="bugs_toggle_link" href="#">Развернуть</a></div>
  </div>
  <div class="bugs_updates_replies"><div id="bug_update8182_2" class="bugs_update_row clear_fix">';
    if($bug['status'] == "3"){
  echo' 
  <div class="bugs_meminfo"><a class="mem_link" href="/id'.$buga['admin'].'">Администратор</a> изменил статус на <span class="bugs_status_label">На рассмотрении</span></div><br>';
}
  if($bug['status'] == "2"){
  echo' 
  <div class="bugs_meminfo"><a class="mem_link" href="/id'.$buga['admin'].'">Администратор</a> изменил статус на <span class="bugs_status_label">Закрытый</span></div><br>';
}
  if($bug['comment'] != null){
  echo' 
  <div class="bugs_meminfo"><a class="mem_link" href="/id'.$buga['admin'].'">Администратор</a> добавил примечание <span class="bugs_status_label">'.$bug['comment'].'</span></div><br>';
}
  echo' 
  <div class="bugs_meminfo"><a class="mem_link" href="/id'.$bugrs['id'].'">Пользователь</a> добавил отчет <span class="bugs_status_label">'.$bug['name'].'</span></div><br>';

  echo'
    <div class="bugs_memphoto fl_l">
  </div>
  <div class="bugs_update_data fl_l">


    <div class="bugs_update_info clear_fix">

    </div>
  </div>
</div></div>
</div>
    </div>';
}
    if($bug['news'] == '1'){
     echo '<div id="bugs_view_description">
      <div class="bugs_view_title">
  '.$bug['name'].'
</div>
<div class="bugs_view_text">
 '.$bug['about'].' ';
 echo '
</div>

<div class="bugs_view_tags clear_fix">
<br>
<hr>
</div>
    </div>';
    }
?>

<?php
  $q2 = $dbh1->prepare("SELECT * FROM bgcomments WHERE idbug='".$bug['id']."' ORDER BY id");
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
      $q6 = $dbh1->prepare("SELECT * FROM users WHERE id='".$buga['admin']."'"); // отправляем запрос серверу
   $q6 -> execute(); 
   $admin_authorwall = $q6->fetch(); // ответ в переменную .
if($admin_authorwall['verify'] == "5"){
$ver = ' <img src="img/verify_orange.png" width="12" height="12" style="margin-left:0;margin-right:0;margin_bottom:-2;">';
}else{
$ver = '';
}


   if($admin_authorwall['avatar'] == NULL){
    $avaa = "img/camera_200.png";
   }else{
    $avaa = "avatarc.php?image=".$admin_authorwall['avatar'];
   }
    
   if($authorwall['avatar'] == NULL){
    $ava = "img/camera_200.png";
   }else{
    $ava = "avatarc.php?image=".$authorwall['avatar'];
   }
       
   echo '<div id="content-wall-post"><table border="0" style="font-size:11px;"><tr><td style="width:54px;vertical-align:top;">
   <div id="content-wall-post-avatar"><img id="avatar" src="'.$ava.'" width="50"></div>'.$onlinewall.'</td><td style="width:345px;vertical-align:0;">
     <div id="content-wall-post-infoofpost">
      
      <div id="content-wall-post-authorofpost"><text style="margin-right: 3px;"><b><a href="id'.$authorwall['id'].'">'.$authorwall['name'].' '.$authorwall['surname'].'</a></b></text>написал<br><div id="content-date">'.zmdate($wall['date']).'</div></div>
     
     <div id="content-wall-post-text">'.$wall['text'].' </div>
     </div><div style="clear:both;"></div>
    
    </td></tr></table></div><br>';

    
} 
 if($bug['status'] == "2" AND $bug['news'] == '0'){ 
  echo '<div id="content-wall-post"><table border="0" style="font-size:11px;"><tr><td style="width:54px;vertical-align:top;">
   <div id="content-wall-post-avatar"><img id="avatar" src="'.$avaa.'" width="50"></div></td><td style="width:345px;vertical-align:0;">
     <div id="content-wall-post-infoofpost">
      
      <div id="content-wall-post-authorofpost"><text style="margin-right: 3px;"><b><a href="id'.$admin_authorwall['id'].'">'.$admin_authorwall['name'].' '.$admin_authorwall['surname'].'</a>'.$ver.'</b></text><br><div id="content-date"></div></div>
     
     <div id="content-wall-post-text"> <div class="bugs_row_tags clear_fix"><div class="bugs_tag fl_l">Новый статус отчёта – <b>Закрыт</b></div></div><br><br>'.$bug['comment'].'</div>
     </div><div style="clear:both;"></div>
    
    </td></tr></table></div><br>';
  }
    ?>
<? if($bug['status'] != "2" AND $bug['news'] != '0'){ ?>
<form action="add_bgcomment.php" method="post">
      <input name="id" type="hidden" value="<?php echo $bug['id'] ?>">
      <b>Ваш комментарий</b><br>
        <textarea rows="3" name="text" id="text"></textarea>
      
      
        <div style="padding:10px;float:right;"><input type="submit" id="button" value="Опубликовать"></div>
        <div style="clear:both;"></div>
      
      </form>
<? } ?>
</div>
<? 
if($bug['news'] == '0'){
echo'
<div style="float:right;width:198px;">
<div class="bugs_view_author">
  <div class="bugs_author clear_fix">
    <div class="bugs_author_name fl_l">
      <div class="bugs_author_link"><a class="mem_link" href="/id'.$bugrs['id'].'">'.$bugrs['name'].' '.$bugrs['surname'].'</a></div>
      <div class="bugs_created_info">'.zmdate($bug['date']).'</div>
	<div class="bugs_created_info">Статус: '.$status.'</div>

  </div>
    <div class="bugs_info_rows">
    <br>
    <br>
   <div class="bugs_created_info"></div>
    <div class="bugs_info_row">
      <span class="bugs_info_label">
</div>
</span>
<span class="bugs_info_value">

</span>
    </div>
    <div class="bugs_info_row">
      <span class="bugs_info_label">

</span>
<span class="bugs_info_value">

</span>
    </div>
  </div>
</div>
</div>
</div>
';
}
if($bug['news'] == '1'){
  echo'
<div style="float:right;width:198px;">
<div class="bugs_view_author">
  <div class="bugs_author clear_fix">
    <div class="bugs_author_name fl_l">
      <div class="bugs_author_link">Автор: <a class="mem_link" href="/id'.$bugrs['id'].'">'.$bugrs['name'].' '.$bugrs['surname'].'</a></div>
      <div class="bugs_created_info">'.zmdate($bug['date']).'</div>

  </div>
    <div class="bugs_info_rows">
    <br>
    <br>
   <div class="bugs_created_info"></div>
    <div class="bugs_info_row">
      <span class="bugs_info_label">
</div>
</span>
<span class="bugs_info_value">

</span>
    </div>
    <div class="bugs_info_row">
      <span class="bugs_info_label">

</span>
<span class="bugs_info_value">

</span>
    </div>
  </div>
</div>
</div>
</div>
';
} ?>
<div>
<?php include 'exec/footer.php'; ?>
</div>
</body>
</html>
<? }else{ echo '<meta charset="utf-8"><link rel="stylesheet" href="blank.css">
<div class="simpleBlock">
  <div class="simpleHeader">Ошибка!</div>
  <div class="simpleBar clearFix">
   Вам запрещено просматривать отчет!<hr> Причина:<br>
   Блокировка аккаунта тестера.<br>
  
  </div>
 </div>'; }
}else{echo '<meta charset="utf-8">Извините, но баг-трекер работает только для тестеров.';
exit();}}else{echo '<meta charset="utf-8">Пожалуйста, авторизируйтесь.<meta http-equiv="refresh" content="3;blank/../">';}?>
<link rel="stylesheet" type="text/css" href="bug.css">  