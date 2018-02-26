<?php 
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
if($_GET['image'] == 'admin_main.php' AND $_GET['image'] == 'php' ){
  echo "hackers?";
  exit();
}
if (isset($_GET['image']) != null && is_file($_GET['image'])){ 
$image = $_GET['image'];
}elseif ($_GET['id'] != null) {
$qs = $dbh1->prepare("SELECT * FROM photo WHERE `id` = '".$_GET['id']."' ORDER BY id");
$qs->execute();
$photo = $qs->fetch();
$image = $photo['image'];
}else{
header("Location: blank.php?id=6");
exit();
}
if (isset($_GET['content']) == null){ 
}
if(file_exists($image)){
include('exec/header.php');
include('exec/datefn.php');
include('exec/leftmenu.php'); ?>
<div id="content-infoname"><b>Просмотр изображения</b></div>
<center><a <? echo 'href="'.$image.'"'; ?>><img <? echo 'src="'.$image.'"'; ?> style="width:400px;height:auto;"></center></a><br><hr>
<table border="0" style="font-size:11px;">
<?php if ($_GET['id'] != null) { ?>
<tr><td style="width:400px;"><?php
  $q2 = $dbh1->prepare("SELECT * FROM pcomments WHERE idphoto='".$photo['id']."' ORDER BY id");
$q2 -> execute();
while($wall = $q2->fetch()) {
  
   $q3 = $dbh1->prepare("SELECT * FROM users WHERE id='".$wall['aid']."'"); // отправляем запрос серверу
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

} ?><form action="add_pcomment.php" method="post">
      <input name="id" type="hidden" value="<?php echo $_GET['id'] ?>">
      <b>Ваш комментарий</b><br>
        <textarea rows="3" name="text" id="text"></textarea>
      
      
        <div style="padding:10px;float:right;"><input type="submit" id="button" value="Опубликовать"></div>
        <div style="clear:both;"></div>
      
      </form></td>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Описание:</div></td><td><?php echo $photo['note']; ?></td></tr>
<?php } ?>
<?php if($photo['user'] != ""){
$qss = $dbh1->prepare("SELECT * FROM users WHERE `id` = '".$photo['user']."'");
$qss->execute();
$author = $qss->fetch();
  ?>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Загрузил:</div></td><td><?php echo '<a href="id'.$author['id'].'">'.$author['name'].' '.$author['surname'].'</a>' ; ?></td></tr>
<?php } ?>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Дата создания:</div></td><td><?php echo zmdate(filemtime($image)); ?></td></tr> 
</table><br>
  </div>
  </div>
  </div>
  <div>
  <? include('exec/footer.php'); ?>
  </div>
 </body>
</html>
<? 
}else{
header("Location: blank.php?id=6");
exit();
} ?>