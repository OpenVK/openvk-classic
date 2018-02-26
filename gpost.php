<?php 
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
if($_SESSION['loginin'] != '1'){
echo '<meta charset="utf-8">Пожалуйста, авторизируйтесь.<meta http-equiv="refresh" content="3;blank/../">';
exit();
}else{
if (isset($_GET['id']) != null) { 
 $id = $_GET['id'];
}
$q2 = $dbh1->prepare("SELECT * FROM `gpost` WHERE id='".$id."'");
$q2 -> execute();
$wall = $q2->fetch();
if($wall['date'] == NULL){
header("Location: blank.php?id=3");
exit();
}
$qchsubcl1 = $dbh1->prepare("SELECT * FROM club WHERE `id` = '".$wall['idwall']."'");
      $qchsubcl1->execute();
      $chsubcl1 = $qchsubcl1->fetch();
      if ($chsubcl1['closed'] == "1") {
$qchsubcl = $dbh1->prepare("SELECT * FROM clubsub WHERE `id1` = '".$_SESSION['id']."' AND `id2` = '".$wall['idwall']."'");
      $qchsubcl->execute();
      $chsubcl = $qchsubcl->fetch();
        if (empty($chsubcl['id'])) {
          header("Location: blank.php?id=7");
          exit();
        }
      }
include('exec/header.php');
echo '<style>#otv{font-size:8px;margin-left:10px;cursor:pointer;}#otv:hover{text-decoration:underline;}</style>';
include('exec/datefn.php');
include('exec/leftmenu.php');
$q2 = $dbh1->prepare("SELECT * FROM `gpost` WHERE id='".$id."'");
$q2 -> execute();
while($wall = $q2->fetch()) { ?>
<div style="min-width:0;width:415px;float:left;margin-top:-10px;border-right:#BEBEBE solid 1px;">
<br>
<?php
   $q3 = $dbh1->prepare("SELECT * FROM `users` WHERE id='".$wall['iduser']."'"); // отправляем запрос серверу
   $q3 -> execute(); 
   $authorwall = $q3->fetch(); // ответ в переменную .
   if($wall['bygroup'] == "0"){
   if($authorwall['avatar'] == NULL){
    $authorwall['avatar'] = "img/camera_200.png";
    $avy = 'width="50" height="50"';
   }else{
    $authorwall['avatar'] = "avatarc.php?image=".$authorwall['avatar'];
   }
   if ($wall['image'] != null) {
     $im = '<br><br><a href="watchi.php?image='.$wall['image'].'"><img src="imagep.php?image='.$wall['image'].'"></a>';
   }else{
    $im = '';
   }
   echo '<div id="content-wall-post" style="width:405px;"><table border="0" style="font-size:11px;"><tr><td style="width:54px;vertical-align:top;">
   <div id="content-wall-post-avatar"><img id="avatar" src="'.$authorwall['avatar'].'" width="50"></div></td><td style="width:345px;vertical-align:0;">
     <div id="content-wall-post-infoofpost">
      
      <div id="content-wall-post-authorofpost"><text style="margin-right: 3px;"><b><a href="id'.$authorwall['id'].'">'.$authorwall['name'].' '.$authorwall['surname'].'</a></b></text>написал<br><div id="content-date"><span>'.zmdate($wall['date']).'</span></div></div>
     
     <div id="content-wall-post-text">'.$wall['text'].$im.'</div>
     </div>
    
    </td></tr></table></div>
    ';
    $qcomments = $dbh1->prepare("SELECT * FROM `gcomments` WHERE idpost='".$id."'");
    $qcomments -> execute();
    while ($comment = $qcomments->fetch()) {
      $qcommentauthor = $dbh1->prepare("SELECT * FROM `users` WHERE id='".$comment['iduser']."'");
      $qcommentauthor -> execute();
      $comauthor = $qcommentauthor->fetch();
      if ($comauthor['avatar'] == null){
        $comauthor['avatar'] = "img/camera_200.png";
      }
      if($_SESSION['loginin'] == '1'){
        $otvet = '<span id="otv" onclick="otvet(`'.$comauthor['name'].'`, `text`);">Ответить</span>';
      }else{
        $otvet = "";
      }
      if($comauthor['avatar'] == NULL){
        $comauthor['avatar'] = "img/camera_200.png";
      }
      echo '<div style="border-top:#BEBEBE 1px solid;margin-left:-10px;width:425px;">
      <div style="margin-left:10px;margin-top:10px;margin-bottom:10px;">
      <div>
      <table border="0" style="font-size:11px;"><tr><td style="width:34px;vertical-align:top;"><a href="id'.$comauthor['id'].'"><img src="'.$comauthor['avatar'].'" width="34" height="auto"></a></td>
      <td style="vertical-align:0;"><a href="id'.$comauthor['id'].'"  style="font-size:12px;font-weight:bold;margin-left:5px;margin-right:5px;">'.$comauthor['name'].' '.$comauthor['surname'].'</a><div style="word-wrap:break-word;overflow:hidden;margin-left:5px;margin-right:5px;">'.$comment['text'].'</div><text style="font-size:8px;color:#808080;margin-left:5px;">'.zmdate($comment['date']).'</text>'.$otvet.'</td></tr></table>
      </div>
      
      <div>
      </div>
      </div>
      </div>';
    }
      //echo '<br><hr style="margin-left:-10px;"><form action="add_gcomment.php" method="post">
      //<div>
      //<input type="hidden" name="id" value="'.$wall['id'].'">
      //<textarea name="text" id="text" placeholder="Написать комментарий" style="min-width:405px;max-width:405px;width:405px;"></textarea>
      //<input type="submit" id="button" style="margin-top:7px;margin-right:10px;float:right;" value="Опубликовать">
      //<div style="clear:both;"></div>
      //</div>
      //</form>';
    $qtu = $dbh1->prepare("SELECT * FROM `users` WHERE id = '".$_SESSION['id']."'");
      $qtu->execute();
      $tu = $qtu->fetch();
      if($tu['avatar'] == NULL){
        $tu['avatar'] = "img/camera_200.png";
      }
      echo '<br><div id="comm-1" style="border-top:#BEBEBE 1px solid;margin-left:-10px;margin-bottom:-10px;margin-top:-13px;cursor:pointer;display:block;" onclick="openComment()">
        <div style="padding:10px;"><table border="0" style="font-size:8pt;"><tr><td width="40px"><a href="id'.$_SESSION['id'].'"><img src="'.$tu['avatar'].'" width="28px" height="auto"></a></td><td><span style="color:#828282;">Написать комментарий...</span></td></tr></table></div>
      </div>
      <form action="add_gcomment.php" method="post">
      <input name="id" type="hidden" value="'.$id.'">
      <div id="comm-2" style="border-top:#BEBEBE 1px solid;margin-left:-10px;margin-top:-13px;display:none;">
        <a href="id'.$_SESSION['id'].'"><img src="'.$tu['avatar'].'" width="28px" height="auto" style="margin:12px;margin-top:13px;margin-left:13px;"></a>
        <div style="float:right;"><textarea rows="1" name="text" id="text" style="margin:12px;margin-top:15px;margin-left:-12px;min-width:360px;max-width:360px;width:360px;min-height:25px;border:0;outline:0;overflow:hidden;display:block;"></textarea></div>
        <div style="clear:both;"></div>
      </div>
      <div id="comm-2-tool" style="border-top:#BEBEBE 1px solid;margin-left:-10px;margin-bottom:-10px;display:none;background-color:#FAFBFC;">
        <div style="padding:10px;float:right;"><input type="submit" id="button" value="Опубликовать"></div>
        <div style="clear:both;"></div>
      </div>
      </form>';
      // margin:-10px;margin-top:10px;border:0;border-top:#BEBEBE solid 1px;padding:15px;min-height:52px;height:52px;min-width:425px;max-width:425px;background-color:#F9F9F9;border-radius:0 0 5px 5px; 
  }elseif($wall['bygroup'] == "1"){
    $qclub = $dbh1->prepare("SELECT * FROM `club` WHERE id = '".$wall['idwall']."'");
    $qclub->execute();
    $club = $qclub->fetch();
   if($club['avatar'] == NULL){
    $club['avatar'] = "img/camera_200.png";
    $avy = 'width="50" height="50"';
   }else{
    $club['avatar'] = "avatarc.php?image=".$club['avatar'];
   }
   if ($wall['image'] != null) {
     $im = '<br><br><a href="watchi.php?image='.$wall['image'].'"><img src="imagep.php?image='.$wall['image'].'"></a>';
   }else{
    $im = '';
   }
   echo '<div id="content-wall-post" style="width:405px;"><table border="0" style="font-size:11px;"><tr><td style="width:54px;vertical-align:top;">
   <div id="content-wall-post-avatar"><img id="avatar" src="'.$club['avatar'].'" width="50"></div></td><td style="width:345px;vertical-align:0;">
     <div id="content-wall-post-infoofpost">
      
      <div id="content-wall-post-authorofpost"><text style="margin-right: 3px;"><b><a href="club'.$club['id'].'">'.substr($club['name'], 0, 45).'</a></b></text><br><div id="content-date"><a href="gpost'.$wall['id'].'">'.zmdate($wall['date']).'</a></div></div>
     
     <div id="content-wall-post-text">'.$wall['text'].$im.'<br><div style="margin-top:6px;font-size:9px;"><a href="id'.$authorwall['id'].'"><svg width="8" height="9" viewBox="20 203 8 9" xmlns="http://www.w3.org/2000/svg" style="fill:#AABBCE;margin-right:5px;"><path d="M24 209c3.5 0 4 1 4 2.5 0 .5 0 .5-1 .5h-6c-1 0-1 0-1-.5 0-1.5.5-2.5 4-2.5zm0-1c-1.1 0-2-1.12-2-2.5s.9-2.5 2-2.5 2 1.12 2 2.5-.9 2.5-2 2.5z"/></svg>'.$authorwall['name'].' '.$authorwall['surname'].'</a></div></div>
     </div><div style="clear:both;"></div>
    
    </td></tr></table></div>
    ';
    $qcomments = $dbh1->prepare("SELECT * FROM `gcomments` WHERE idpost='".$id."'");
    $qcomments -> execute();
    while ($comment = $qcomments->fetch()) {
      $qcommentauthor = $dbh1->prepare("SELECT * FROM `users` WHERE id='".$comment['iduser']."'");
      $qcommentauthor -> execute();
      $comauthor = $qcommentauthor->fetch();
      if ($comauthor['avatar'] == null){
        $comauthor['avatar'] = "img/camera_200.png";
      }
      if($_SESSION['loginin'] == '1'){
        $otvet = '<span id="otv" onclick="otvet(`'.$comauthor['name'].'`, `text`);">Ответить</span>';
      }else{
        $otvet = "";
      }
      if($comauthor['avatar'] == NULL){
        $comauthor['avatar'] = "img/camera_200.png";
      }
      echo '<div style="border-top:#BEBEBE 1px solid;margin-left:-10px;width:425px;">
      <div style="margin-left:10px;margin-top:10px;margin-bottom:10px;">
      <div>
      <table border="0" style="font-size:11px;"><tr><td style="width:34px;vertical-align:top;"><a href="id'.$comauthor['id'].'"><img src="'.$comauthor['avatar'].'" width="34" height="auto"></a></td>
      <td style="vertical-align:0;"><a href="id'.$comauthor['id'].'"  style="font-size:12px;font-weight:bold;margin-left:5px;margin-right:5px;">'.$comauthor['name'].' '.$comauthor['surname'].'</a><div style="word-wrap:break-word;overflow:hidden;margin-left:5px;margin-right:5px;">'.$comment['text'].'</div><text style="font-size:8px;color:#808080;margin-left:5px;">'.zmdate($comment['date']).'</text>'.$otvet.'</td></tr></table>
      </div>
      
      <div>
      </div>
      </div>
      </div>';
    }
      //echo '<br><hr style="margin-left:-10px;"><form action="add_gcomment.php" method="post">
      //<div>
      //<input type="hidden" name="id" value="'.$wall['id'].'">
      //<textarea name="text" id="text" placeholder="Написать комментарий" style="min-width:405px;max-width:405px;width:405px;"></textarea>
      //<input type="submit" id="button" style="margin-top:7px;margin-right:10px;float:right;" value="Опубликовать">
      //<div style="clear:both;"></div>
      //</div>
      //</form>';
    $qtu = $dbh1->prepare("SELECT * FROM `users` WHERE id = '".$_SESSION['id']."'");
      $qtu->execute();
      $tu = $qtu->fetch();
      if($tu['avatar'] == NULL){
        $tu['avatar'] = "img/camera_200.png";
      }
      echo '<br><div id="comm-1" style="border-top:#BEBEBE 1px solid;margin-left:-10px;margin-bottom:-10px;margin-top:-13px;cursor:pointer;display:block;" onclick="openComment()">
        <div style="padding:10px;"><table border="0" style="font-size:8pt;"><tr><td width="40px"><a href="id'.$_SESSION['id'].'"><img src="'.$tu['avatar'].'" width="28px" height="auto"></a></td><td><span style="color:#828282;">Написать комментарий...</span></td></tr></table></div>
      </div>
      <form action="add_gcomment.php" method="post">
      <input name="id" type="hidden" value="'.$id.'">
      <div id="comm-2" style="border-top:#BEBEBE 1px solid;margin-left:-10px;margin-top:-13px;display:none;">
        <div style="padding:10px;"><table border="0" style="font-size:8pt;"><tr><td width="40px" style="vertical-align:top;"><a href="id'.$_SESSION['id'].'"><img src="'.$tu['avatar'].'" width="28px" height="auto"></a></td><td><textarea rows="1" name="text" id="text" style="min-width:360px;max-width:360px;width:360px;min-height:25px;border:0;outline:0;display:block;"></textarea></td></tr></table></div>
      </div>
      <div id="comm-2-tool" style="border-top:#BEBEBE 1px solid;margin-left:-10px;margin-bottom:-10px;display:none;background-color:#FAFBFC;">
        <div style="padding:10px;float:right;"><input type="submit" id="button" value="Опубликовать"></div>
        <div style="clear:both;"></div>
      </div>
      </form>';
      // margin:-10px;margin-top:10px;border:0;border-top:#BEBEBE solid 1px;padding:15px;min-height:52px;height:52px;min-width:425px;max-width:425px;background-color:#F9F9F9;border-radius:0 0 5px 5px;
  } ?>
  </div>
  <div style="float:right;width:200px;margin-top:-8px;">
	<div style="margin:10px;">
<?php
$qwa = $dbh1->prepare("SELECT * FROM `club` WHERE id='".$wall['idwall']."'");
$qwa->execute();
while($wau = $qwa->fetch()){
   if($wau['avatar'] == NULL){
    $wau['avatar'] = "img/camera_200.png";
   }else{
    $wau['avatar'] = "avatarm.php?image=".$wau['avatar'];
   }
	echo '<img src="'.$wau['avatar'].'" width="15" height="auto"><b style="padding-left:10px;"><a href="club'.$wau['id'].'">'.substr($wau['name'], 0, 45).'</a> - стена</b><hr style="margin-left:-14px;margin-right:-20px;margin-top:10px;margin-bottom:10px;"><a id="aprofile" href="club'.$wau['id'].'">Посмотреть другие записи стены</a><a id="aprofile" href="id'.$authorwall['id'].'">... или зайти на страницу автора данной записи</a>';
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
 <?php } ?>
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
</script>
</html>
<?php } ?>