<?php
session_start();
include "exec/dbconnect.php";
include "exec/check_user.php";
if($_SESSION['loginin'] == "1"){
if($_SESSION['groupu'] == "2"){
if($_GET['idu']){
if($_POST['edit_general_submit']){
$qu = $dbh1->prepare("SELECT * FROM users WHERE id = '".$_GET['idu']."'");
$qu->execute();
$userdata = $qu->fetch();
$q44 = "
UPDATE `users` SET `name`='".$_POST['edit_general_fname']."',`surname`='".$_POST['edit_general_lname']."',`gender`='".$_POST['edit_general_gender']."',`groupu`='".$_POST['edit_general_groupu']."',`verify`='".$_POST['edit_general_verify']."',`ban`='".$_POST['edit_general_ban']."' WHERE 1";
$q11 = $dbh1->prepare($q44);
$q11 -> execute();
$q11->fetch();
header('Location: admin_user.php?idu="'.$_GET['idu'].'"');
exit();
}
$qu4 = $dbh1->prepare("SELECT * FROM users WHERE id = '".$_GET['idu']."'");
$qu4->execute();
$user = $qu4->fetch();
include "exec/datefn.php";
include "exec/header.php";
include "exec/leftmenu.php";
?>
<div id="content-infoname"><b><?php echo $user['name'].' '.$user['surname']; ?><div style="float:right;"><a href="admin_users.php">Назад</a></div></b></div>
<form action="admin_users.php" method="post">
<input type="hidden" name="edit_id" <?php echo 'value="'.$_GET['idu'].'"'; ?>>
<table border="0" style="font-size:11px;">
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Имя:</div></td><td><input id="text" style="width:380px;" name="edit_general_fname" <?php echo 'value="'.$user['name'].'"'; ?>></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Фамилия:</div></td><td><input id="text" style="width:380px;" name="edit_general_lname" <?php echo 'value="'.$user['surname'].'"'; ?>></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Никнейм:</div></td><td><input id="text" style="width:380px;" name="edit_general_nname" <?php echo 'value="'.$user['nickname'].'"'; ?>></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Статус:</div></td><td><input id="text" style="width:380px;" name="edit_general_status" <?php echo 'value="'.$user['status'].'"'; ?>></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Пол:</div></td><td><select style="width:380px;" name="edit_general_gender" style="width:185px;"><option value="1"<?php if($user['gender'] == "1") {echo ' selected';} ?>>Мужской</option>
  <option value="2"<?php if($user['gender'] == "2") {echo ' selected';} ?>>Женский</option>
  <option value="0"<?php if($user['gender'] == "0") {echo ' selected';} ?>>Не указано</option></select></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">О себе:</div></td><td><textarea style="min-width:380px;max-width:380px;" id="text" name="edit_general_about"><?php $user['aboutuser'] = str_replace('<br>', '
', $user['aboutuser']);
  echo $user['aboutuser']; ?></textarea></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">О себе (<a href="search.php">для поиска</a>):</div></td><td><input id="text" style="width:380px;" name="edit_general_about2" <?php echo 'value="'.$user['aboutuser2'].'"'; ?>></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Группа:</div></td><td><select style="width:380px;" name="edit_general_groupu" style="width:185px;"><option value="2"<?php if($user['groupu'] == "2") {echo ' selected';} ?>>Администратор</option>
  <option value="1"<?php if($user['groupu'] == "1") {echo ' selected';} ?>>Тестер</option>
  <option value="0"<?php if($user['groupu'] == "0") {echo ' selected';} ?>>Обычный пользователь</option></select></td></tr>
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
<div id="content-infoname"><b>Пользователи</b></div>
<table border="0" style="font-size:11px;">
<tr>
<td>
ID
</td>
<td>
Ф.И.
</td>
<td>
Группа
</td>
<td>
Логин
</td>
<td>
Управление
</td>
</tr>
<?php $qu = $dbh1->prepare("SELECT * FROM users ORDER BY id");
$qu->execute();
while($users = $qu->fetch()){
if($users['groupu'] == "2"){
$gr = "Администратор";
}elseif($users['groupu'] == "1"){
$gr = "Тестер";
}else{
$gr = "Пользователь";
}
echo '<tr>
<td>
'.$users['id'].'
</td>
<td>
<a href="id'.$users['id'].'">'.$users['name'].' '.$users['surname'].'</a>
</td>
<td>
'.$gr.'
</td>
<td>
'.$users['login'].'
</td>
<td>
<a href="admin_users.php?idu='.$users['id'].'">Перейти в управление</a>
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