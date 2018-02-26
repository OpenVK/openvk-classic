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
$q2 = $dbh1->prepare("SELECT * FROM wall WHERE id='".$id."'");
$q2 -> execute();
$wall = $q2->fetch();
if($wall['date'] == NULL){
header("Location: blank.php?id=3");
exit();
}
include('exec/header.php');
echo '<style>#otv{font-size:8px;margin-left:10px;cursor:pointer;}#otv:hover{text-decoration:underline;}</style>';
include('exec/datefn.php');
include('exec/leftmenu.php');
$q2 = $dbh1->prepare("SELECT * FROM wall WHERE id='".$id."'");
$q2 -> execute();
while($wall = $q2->fetch()) { ?>
<div style="min-width:0;width:415px;float:left;margin-top:-10px;border-right:#BEBEBE solid 1px;">
<br>
<?php
   $q3 = $dbh1->prepare("SELECT * FROM users WHERE id='".$wall['iduser']."'"); // отправляем запрос серверу
   $q3 -> execute(); 
   $authorwall = $q3->fetch(); // ответ в переменную .
   if($authorwall['avatar'] == NULL){
    $authorwall['avatar'] = "img/camera_200.png";
   }else{
    $authorwall['avatar'] = "avatarc.php?image=".$authorwall['avatar'];
   }
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
   if ($wall['edited'] == "1") {
      $redached = " <span>(Ред.)</span>";
    }else{
      $redached = '';
    }
   echo '<div id="content-wall-post" style="width:405px;"><table border="0" style="font-size:11px;"><tr><td style="width:54px;vertical-align:top;">
   <div id="content-wall-post-avatar"><img id="avatar" src="'.$authorwall['avatar'].'" width="50"></div></td><td style="width:345px;vertical-align:0;">
     <div id="content-wall-post-infoofpost">
      
      <div id="content-wall-post-authorofpost"><text style="margin-right: 3px;"><b><a href="id'.$authorwall['id'].'">'.$authorwall['name'].' '.$authorwall['surname'].'</a></b></text>'.$nap.$redached.'<br><div id="content-date"><span>'.zmdate($wall['date']).'</span></div></div>
     
     <div id="content-wall-post-text">'.$wall['text'].$im.'</div>
     </div>
    
    </td></tr></table></div>
    ';
    $qcomments = $dbh1->prepare("SELECT * FROM comments WHERE idpost='".$id."'");
    $qcomments -> execute();
    while ($comment = $qcomments->fetch()) {
      $qcommentauthor = $dbh1->prepare("SELECT * FROM users WHERE id='".$comment['iduser']."'");
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
      //echo '<br><hr style="margin-left:-10px;"><form action="add_comment.php" method="post">
      //<div>
      //<input type="hidden" name="id" value="'.$wall['id'].'">
      //<textarea name="text" id="text" placeholder="Написать комментарий" style="min-width:405px;max-width:405px;width:405px;"></textarea>
      //<input type="submit" id="button" style="margin-top:7px;margin-right:10px;float:right;" value="Опубликовать">
      //<div style="clear:both;"></div>
      //</div>
      //</form>';
      $qtu = $dbh1->prepare("SELECT * FROM users WHERE id = '".$_SESSION['id']."'");
      $qtu->execute();
      $tu = $qtu->fetch();
      if($tu['avatar'] == NULL){
        $tu['avatar'] = "img/camera_200.png";
      }
      echo '<br><div id="comm-1" style="border-top:#BEBEBE 1px solid;margin-left:-10px;margin-bottom:-10px;margin-top:-13px;cursor:pointer;display:block;" onclick="openComment()">
        <div style="padding:10px;"><table border="0" style="font-size:8pt;"><tr><td width="40px"><a href="id'.$_SESSION['id'].'"><img src="'.$tu['avatar'].'" width="28px" height="auto"></a></td><td><span style="color:#828282;">Написать комментарий...</span></td></tr></table></div>
      </div>
      <form action="add_comment.php" method="post">
      <input name="id" type="hidden" value="'.$id.'">
      <div id="comm-2" style="border-top:#BEBEBE 1px solid;margin-left:-10px;margin-top:-13px;display:none;">
        <div style="padding:10px;"><table border="0" style="font-size:8pt;"><tr><td width="40px" style="vertical-align:top;"><a href="id'.$_SESSION['id'].'"><img src="'.$tu['avatar'].'" width="28px" height="auto"></a></td><td><textarea rows="1" name="text" id="text" style="min-width:360px;max-width:360px;width:360px;min-height:25px;border:0;outline:0;display:block;"></textarea></td></tr></table></div>
      </div>
      <div id="comm-2-tool" style="border-top:#BEBEBE 1px solid;margin-left:-10px;margin-bottom:-10px;display:none;background-color:#FAFBFC;">
        <div style="padding:10px;float:right;"><input type="submit" id="button" value="Опубликовать"></div>
        <div style="clear:both;"></div>
      </div>
      </form>';
      // margin:-10px;margin-top:10px;border:0;border-top:#BEBEBE solid 1px;padding:15px;min-height:52px;height:52px;min-width:425px;max-width:425px;background-color:#F9F9F9;border-radius:0 0 5px 5px; ?>
  </div>
  <div style="float:right;width:200px;margin-top:-8px;">
	<div style="margin:10px;">
<?php
$qwa = $dbh1->prepare("SELECT * FROM users WHERE id='".$wall['idwall']."'");
$qwa->execute();
while($wau = $qwa->fetch()){
   if($wau['avatar'] == NULL){
    $wau['avatar'] = "img/camera_200.png";
   }else{
    $wau['avatar'] = "avatarm.php?image=".$wau['avatar'];
   }
	echo '<img src="'.$wau['avatar'].'" width="15" height="auto"><b style="padding-left:10px;"><a href="id'.$wau['id'].'">'.$wau['name'].' '.$wau['surname'].'</a> - стена</b><hr style="margin-left:-14px;margin-right:-20px;margin-top:10px;margin-bottom:10px;"><a id="aprofile" href="wall'.$wau['id'].'">Посмотреть другие записи стены</a><a id="aprofile" href="id'.$authorwall['id'].'">... или зайти на страницу автора данной записи</a>';
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