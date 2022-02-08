<?php
session_start();
include "exec/dbconnect.php";
include "exec/check_user.php";
if($_SESSION['loginin'] == "1"){
if($_SESSION['groupu'] == "2"){
if($_GET['idg']){
include "exec/datefn.php";
include "exec/header.php";
include "exec/leftmenu.php";
$qu = $dbh1->prepare("SELECT * FROM club WHERE id = '".$_GET['idg']."'");
$qu->execute();
$user = $qu->fetch();
?>
<div id="content-infoname"><b><?php echo $user['name'].' '.$user['surname']; ?></b></div>
<form action="admin_groups.php" method="post">
<input type="hidden" name="edit_id" <?php echo 'value="'.$_GET['idg'].'"'; ?>>
<table border="0" style="font-size:11px;">
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Имя:</div></td><td><input id="text" style="width:380px;" name="edit_general_fname" <?php echo 'value="'.$user['name'].'"'; ?>></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">О себе:</div></td><td><textarea style="min-width:380px;max-width:380px;" id="text" name="edit_general_about"><?php echo ''.$user['about'].''; ?></textarea></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Забанен?:</div></td><td><select style="width:380px;" name="edit_general_ban" style="width:185px;"><option value="1"<?php if($user['ban'] == "1") {echo ' selected';} ?>>Да</option>
  <option value="0"<?php if($user['ban'] == "0") {echo ' selected';} ?>>Нет</option></select></td></tr>
  <tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Галочка?:</div></td><td><select style="width:380px;" name="edit_general_verify" style="width:185px;">
<option value="1"<?php if($user['verify'] == "1") {echo ' selected';} ?>>Обычная</option>
  <option value="5"<?php if($user['verify'] == "5") {echo ' selected';} ?>>Админская</option>
   <option value="0"<?php if($user['verify'] == "0") {echo ' selected';} ?>>Нету</option>
  <option value="3"<?php if($user['verify'] == "3") {echo ' selected';} ?>>Не указано</option></select></td></tr>
<?php
if($user['ban'] == "1"){
echo '<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Причина бана:</div></td><td><input id="text" style="width:380px;" name="edit_general_fname" value="'.$user['comment_ban'].'"></td></tr>';
}
?>
</table>
<div style="margin-left:157px;"><input type="submit" id="button" value="Сохранить" name="edit_general_submit"></div>
</form>
</div>
<div><?php include "exec/footer.php"; ?></div>
</body>
</html><?php
}else{
include "exec/datefn.php";
include "exec/header.php";
include "exec/leftmenu.php";
?>
<div id="content-infoname"><b>Сообщества</b></div>
<table border="0" style="font-size:11px;">
<tr>
<td>
ID
</td>
<td>
Название
</td>
<td>
Описание
</td>
<td>
Верификация
</td>
<td>
Управление
</td>
</tr>
<?php $qu = $dbh1->prepare("SELECT * FROM club");
$qu->execute();
while($users = $qu->fetch()){
if($users['verify'] == "0"){
$gr = "-";
}elseif($users['verify'] == "1"){
$gr = "+";
}
echo '<tr>
<td>
'.$users['id'].'
</td>
<td>
<a href="club'.$users['id'].'">'.$users['name'].'</a>
</td>
<td>
'.$users['about'].'
</td>
<td>
'.$gr.'
</td>
<td>
<a href="admin_groups.php?idg='.$users['id'].'">Перейти в управление</a>
</td>
</tr>';
} ?>
</table>
<br>
</div>
<div><?php include "exec/footer.php"; ?></div>
</body>
</html>
<?php
}}else{
include "exec/header.php";
include "exec/leftmenu.php";
?>
<div style="margin:0 -10px;padding:55px;"><center><img src="img/critical-error.png"><br><br><b style="font-size:25px;">Access denied</b><br><text style="font-size:14px;">У Вас нет доступа к данной странице.</text></center></div>
</div>
<div><?php include "exec/footer.php"; ?></div>
</body>
</html>
<?php
}
}else{
header("Location: blank/..");
exit();
}
?>