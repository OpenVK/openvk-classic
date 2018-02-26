<?php 
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
 $id = $_GET['id'];
 $q = "SELECT * FROM video WHERE id='".$id."'"; // выбираем нашего 
 $q1 = $dbh1->prepare($q); // отправляем запрос серверу
 $q1 -> execute(); 
 $video = $q1->fetch(); // ответ в переменную 
 $video_id = $video['id_video'];
 $name = $video['name'];
 if($video['id'] == null){
 	echo '<meta charset="utf-8"> Видеозапись не найдена!';
 	exit();
 }
if ($video['about'] == null) {
$about = '<p> Описание отсутствует </p>';
}else if ($video['about'] != null){ 
$about =  $video['about'];
}
$aid = $_SESSION['id'];
$qs = $dbh1->prepare('SELECT * FROM users WHERE id='.$video['aid'].''); // выбираем нашего 
$qs->execute();
$bugrs = $qs->fetch();
include('exec/header.php');
include('exec/datefn.php');
include('exec/leftmenu.php'); ?>
<div id="content-infoname"><b><?php echo '<a href="id'.$bugrs['id'].'"> '.$bugrs['name'].' '.$bugrs['surname'].' </a> » Видеозаписи » '.$name; ?></b></div>
<? if($video['ban'] != "1"){?>
<div id="content-main-gray"><center><iframe width="560" height="315" <? echo 'src="https://www.youtube.com/embed/'.$video_id.'" frameborder="0" allowfullscreen="allowfullscreen"'; ?> frameborder="1"></iframe></center><p style="font-size: 11px;"> <? echo ''.$about.''; ?></p><div style="float:right;width:200px;margin-top:-8px;">

<a href="id<?php echo $bugrs['id']?>"><?php echo $bugrs['name'].' '.$bugrs['surname']?></a>

</div></div>
<br><hr>
<table border="0" style="font-size:11px;">

	
<tr><td style="width:400px;"><?php
  $q2 = $dbh1->prepare("SELECT * FROM vcomments WHERE idvideo='".$video['id']."' ORDER BY id");
$q2 -> execute();
while($wall = $q2->fetch()) {
  
   $q3 = $dbh1->prepare("SELECT * FROM users WHERE id='".$wall['idauthor']."'"); // отправляем запрос серверу
   $q3 -> execute(); 
   $authorwall = $q3->fetch(); // ответ в переменную .
   if(time()-300 <= $authorwall['lastonline']){
    $onlinewall = "<b>Онлайн</b>";
  }else{
    $onlinewall = "";
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

} ?>
<form action="add_vcomment.php" method="post">
      <input name="id" type="hidden" value="<?php echo $id ?>">
      <b>Ваш комментарий</b><br>
        <textarea rows="3" name="text" id="text"></textarea>
      
      
        <div style="padding:10px;float:right;"><input type="submit" id="button" value="Опубликовать"></div>
        <div style="clear:both;"></div>
      
      </form></td><td></td></tr>
</table><br>
<? }else{
	echo '<link rel="stylesheet" href="blank.css">
<div class="simpleBlock">
  <div class="simpleHeader">Ошибка!</div>
  <div class="simpleBar clearFix">
   Видеозапись заблокирована.<hr> Сожалеем об этом.
   </div>';
} ?>
<? if($_SESSION['groupu'] == "2"){ 
echo '<div style="float:right;width:200px;margin-top:-8px;">
<div style="margin:10px;">
<a id="aprofile" href="admin/actions/ban_video.php?id='.$id.'">Забанить/Разбанить</a>
</div>
</div> ';
 } ?>
  </div>
  </div>
  </div>

  <div>
  <? include('exec/footer.php'); ?>
  </div>
 </body>
</html>