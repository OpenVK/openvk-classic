<?php 
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
 $id = $_GET['id'];
 $q = "SELECT * FROM note WHERE id='".$id."'"; // выбираем нашего 
 $q1 = $dbh1->prepare($q); // отправляем запрос серверу
 $q1 -> execute(); 
 $notes = $q1->fetch(); // ответ в переменную 
if ($video['about'] == null) {
$about = '<p> Описание отсутствует </p>';
}else if ($video['about'] != null){ 
$about =  $video['about'];
}
$aid = $_SESSION['id'];
$qs = $dbh1->prepare('SELECT * FROM users WHERE id='.$notes['aid'].''); // выбираем нашего 
$qs->execute();
$mynote = $qs->fetch();
if ($mynote['avatar'] != "") {
	$avatar = "avatarc.php?image=".$mynote['avatar'];
}else{
	$avatar = "img/camera_200.png";
}
if ($notes['aid'] == $_SESSION['id']) {
     $redach = '<a href="#" onclick="openTextareaEdit();">Редактировать</a>';
     $redachtext = str_replace(array('<br><br>', '<br>'), '
', $notes['text']);
     $redachtext = str_replace('</b>', '', $redachtext);
   }else{
     $redach = '';
   }
   if ($notes['edited'] == "1") {
   	$redachstatus = ' <span>(ред.)</span>';
   }else{
   	$redachstatus = '';
   }
include('exec/header.php');
include('exec/datefn.php');
include('exec/leftmenu.php'); ?>
<div id="content-infoname"><b>Заметка</b><div style="float: right;"><?php echo $redach; ?></div></div>
<div id="content-wall-post">
<table style="font-size:11px;width: 620px;" border="0"><tbody><tr><td style="width:54px;vertical-align:top;">
   <div id="content-wall-post-avatar"><img id="avatar" src="<?php echo $avatar ?>" width="50"></div></td><td style="width:345px;vertical-align:0;">
     <div id="content-wall-post-infoofpost">
      
      <div id="content-wall-post-authorofpost"><text style="margin-right: 3px;"><b><a href="id<?php echo $mynote['id']?>"><?php echo $mynote['name'].' '.$mynote['surname'] ?></a></b></text><br><div id="content-date"><?php echo zmdate($notes['date']) ;?></div></div>
     
     <div id="content-wall-post-text" style="width:550px;" class="note"><h4><?echo $notes['name'].$redachstatus?></h4><p><? echo $notes['text']; ?></p></div>
     <div id="content-wall-post-text" class="noteedit" style="width: 550px;display:none;">
     	<form method="post" action="edit_note.php">
     <input name="id" type="hidden" value="<?php echo $id;?>"><textarea name="text" id="text"><?php echo $redachtext;?></textarea><br>
     <input type="submit" value="Изменить" id="button">
     <a href="#" onclick="openWindowsQ();">Удалить</a>
     </form>
     </div>
     </div>
    
    </td></tr></tbody></table>
</div>
<?php
  $q2 = $dbh1->prepare("SELECT * FROM ncomments WHERE idnote='".$_GET['id']."' ORDER BY id");
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
<form action="add_ncomment.php" method="post">
      <input name="id" type="hidden" value="<?php echo $id ?>">
      <b>Ваш комментарий</b><br>
        <textarea rows="3" name="text" id="text"></textarea>
      
      
        <div style="padding:10px;float:right;"><input type="submit" id="button" value="Опубликовать"></div>
        <div style="clear:both;"></div>
      
      </form></td><td></td></tr>
</table><br>

</div>
<div>
<?php include 'exec/footer.php'; ?>
<script type="text/javascript">
  function openTextareaEdit() {
    document.getElementsByClassName('note')[0].style.display = "none";
    document.getElementsByClassName('noteedit')[0].style.display = "block"; 
  }

  function openWindowsQ(){
    WindowsQ = $.window({
   title: "Подтверждение",
   content: '<div style="padding:10px; font-size:11px;"><center>Вы действительно хотите удалить заметку?</center><br><center><a href="delete_note.php?id=<?php echo $_GET['id']?>" id="button">Да</a> <a href="#" onclick="WindowsQ.close();" id="button">Нет</a></center></div>',
   draggable: false,
   resizable: false,
   maximizable: false,
   minimizable: false,
   showModal: true,
   width: 300,
   height: 110
});
  }
</script>
</div>
</body>
</html>
