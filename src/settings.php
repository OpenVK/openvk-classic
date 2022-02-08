<?php 
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
if($_SESSION['loginin'] == "1"){
if($_POST['edit_general_submit']){
$quser = $dbh1->prepare("SELECT * FROM users WHERE id='".$_SESSION['id']."'");
$quser -> execute();
$userdata = $quser->fetch();

$q = "UPDATE users SET closedwall='".$_POST['edit_general_wall']."', telephone_settings='".$_POST['edit_general_telephone_settings']."' WHERE login='".$userdata['login']."'";
$q1 = $dbh1->prepare($q);
$q1 -> execute();
$q1->fetch();
header("Location: settings.php?act=suc");
exit();
}
if($_POST['edit_password_submit']){
$checkpass1 = md5($_POST['edit_password_old']);
$quser = $dbh1->prepare("SELECT * FROM users WHERE id='".$_SESSION['id']."'");
$quser -> execute();
$userdata = $quser->fetch();
if($checkpass1 == $userdata['password']){
$checkpass2 = md5($_POST['edit_password_new']);
$checkpass3 = md5($_POST['edit_password_new2']);
if($checkpass2 == $checkpass3){
if($checkpass2 == NULL){
echo '<meta charset="utf-8">!!!: введите новый пароль.';
exit();
}
$newpass = $checkpass2;
$quser = $dbh1->prepare("SELECT * FROM users WHERE id='".$_SESSION['id']."'");
$quser -> execute();
$userdata = $quser->fetch();
$q = "UPDATE users SET password='".$newpass."' WHERE login='".$userdata['login']."'";
$q1 = $dbh1->prepare($q);
$q1 -> execute();
$q1->fetch();
header("Location: settings.php?act=pass");
exit();
}else{
echo '<meta charset="utf-8">!!!: проверьте правильность вашего нового пароля.';
exit();
}
}else{
echo '<meta charset="utf-8">!!!: напиши текущий пароль правильно, господин.';
exit();
}
exit();
}
include('exec/header.php');
$quser = $dbh1->prepare("SELECT * FROM users WHERE id='".$_SESSION['id']."'");
$quser -> execute();
$userdata = $quser->fetch();
include('exec/leftmenu.php');
//$id = $_GET['id'];
//$q = "SELECT * FROM users WHERE id='".$id."'"; // выбираем нашего 
//$q1 = $dbh1->prepare($q); // отправляем запрос серверу
//$q1 -> execute(); 
//$user = $q1->fetch(); // ответ в переменную 
//if($_GET['id'] || $_SESSION['groupu'] == '1'){
?>
<div id="content-infoname"><b><a>Мои Настройки </a><div id="generalci" style="
    display: inline-block;
"> » Общие</div><div id="privateci" style="
    display: none;
"> » Приватность</div></b></div>
<div>
	<ul style="margin-bottom: 0;" id="Tabs">
  <li  id="GeneralInfoTab" class="SelectedTab"><a href="#" onclick=" _GeneralInfo(); return false;">Общие</a></li>
	<li id="PasswordTab" class="Tab"><a href="#" onclick="_PasswordTab(); return false;">Приватность</a></li>
	<li style="display: none;" id="AvatarTab" class="Tab"><a href="#" onclick="_AvatarTab(); return false;">Аватар</a></li>
	<li style="display: none;" id="InterfaceTab" class="Tab"><a href="#" onclick="_InterfaceTab(); return false;">Интерфейс</a></li>
	
	
</ul>
<div style="
    background: #f7f7f7;
    margin-left: -10px;
    margin-top: 0px;
    width: 629px;
    height: max-content;
    padding: 5px;
" id="_GeneralInfo">
<?php if (!empty($_GET["act"]) AND $_GET["act"] == "suc"){ ?>
<div style="
    background: #e7f2fc;
    border: 1px solid darkgrey;
    margin: 5px;
    padding: 8px 12px;
    font-weight: bold;
">Настройки успешно сохранены.</div>
<?php }?>
<?php if (!empty($_GET["pass"]) AND $_GET["pass"] == "suc"){ ?>
<div style="
    background: #e7f2fc;
    border: 1px solid darkgrey;
    margin: 5px;
    padding: 8px 12px;
    font-weight: bold;
">Пароль успешно изменен.</div>
<?php }?>
<h4 style="margin: 20px auto;width: 360px;border-bottom: 1px solid darkgrey;font-size: 13px;">Ваш номер</h4><div style="margin: auto;width: max-content;font-size: 12px;">Ваш номер в контакте: <?php echo $_SESSION['id'];?></div>
<h4 style="margin: 20px auto;width: 360px;border-bottom: 1px solid darkgrey;font-size: 13px;">Дополнительные сервисы</h4>

<form action="lm_edit.php" method="post" style="
    margin: auto;
    width: max-content;
">
<input type="checkbox" name="fr" value="1"<?php if($fr == 1){ echo ' checked="1"';} ?>>
<a>Мои Друзья</a>
<br><input type="checkbox" name="ph" value="1" <?php if($ph == 1){ echo ' checked="1"';} ?>>
<a>Мои Фотографии</a>
<br><input type="checkbox" name="vd" value="1" <?php if($vd == 1){ echo ' checked="1"';} ?>>
<a>Мои Видеозаписи</a>
<br><input type="checkbox" name="im" value="1" <?php if($im == 1){ echo ' checked="1"';} ?>>
<a>Мои Сообщения</a>
<br><input type="checkbox" name="zm" value="1" <?php if($zm == 1){ echo ' checked="1"';} ?>>
<a>Мои Заметки</a>
<br><input type="checkbox" name="gp" value="1" <?php if($gp == 1){ echo ' checked="1"';} ?>>
<a>Мои Группы</a>
<br><input type="checkbox" name="vs" value="1" <?php if($vs == 1){ echo ' checked="1"';} ?>>
<a>Мои Встречи</a>
<br><input type="checkbox" name="fd" value="1" <?php if($fd == 1){ echo ' checked="1"';} ?>>
<a>Мои Новости</a>

<br><br><input type="submit" name="formSubmit" value="Сохранить" id="button">
</form>
<h4 style="margin: 20px auto;width: 360px;border-bottom: 1px solid darkgrey;font-size: 13px;">Изменить пароль</h4>
<form action="settings.php" method="post">

<table border="0" style="font-size:11px;margin: auto;">
<tbody><tr><td style="width:150px;"><div style="float:right;padding-right:7px;color: black;">Старый пароль:</div></td><td><input type="password" id="text" style="width: 170px;" name="edit_password_old"></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color: black;">Новый пароль:</div></td><td><input type="password" id="text" style="width: 170px;" name="edit_password_new"></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color: black;">Повторите пароль:</div></td><td><input type="password" id="text" style="width: 170px;" name="edit_password_new2"></td></tr>
</tbody></table><br>
<div style="margin: auto;width: max-content;"><input type="submit" id="button" value="Изменить пароль" name="edit_password_submit"></div>
</form>
<h4 style="margin: 20px auto;width: 360px;border-bottom: 1px solid darkgrey;font-size: 13px;">Изменить стиль</h4>
<form method="post" action="change_style.php">

<table border="0" style="font-size:11px;margin: auto;">
<tbody><tr><td><select style="width: 250px;" name="edit_design_style">
<option value="1" <?php if($userdata['cssstyle'] == "1") {echo ' selected';} ?>>Обычный (серые тона)</option>
  <option value="2"<?php if($userdata['cssstyle'] == "2") {echo ' selected';} ?>>ВКонтакте (синие тона)</option></select></td></tr>
</tbody></table><br>
<div style="margin: auto;width: max-content;"><input type="submit" id="button" value="Изменить дизайн"></div>
</form>
</div>
<div style="
    display: none;
    background: #f7f7f7;
    margin-left: -10px;
    margin-top: 0px;
    width: 629px;
    height: max-content;
    padding: 5px;
" id="_PasswordTab" style="display: none;">
<br>
<form action="settings.php" method="post">
<table style="margin: auto;font-size: 11 !important;">
    <tbody>
	<tr>
	<td><div style="
    text-align: right;
    margin-right: 10px;
">Кто может оставлять сообщения на моей стене</div></td>
	<td><select name="edit_general_wall" style="
    width: 150px;
    background: transparent;
    border: none;
    -webkit-appearance: none;
    color: #56799f;
    width: 242px;
"><option value="1"<?php if($userdata['closedwall'] == "1") {echo ' selected';} ?>>Только я</option><option value="0"<?php if($userdata['closedwall'] == "0") {echo ' selected';} ?>>Все пользователи</option></select></td>
	</tr>
    <tr>
	<td><div style="
    text-align: right;
    margin-right: 10px;
">Кто видит мою контактную информацию</div></td>
	<td><select name="edit_general_telephone_settings" style="
    width: 150px;
    background: transparent;
    border: none;
    -webkit-appearance: none;
    color: #56799f;
    width: 242px;
"><option value="0"<?php if($userdata['telephone_settings'] == "0") {echo ' selected';} ?>>Мои друзья</option><option value="1"<?php if($userdata['telephone_settings'] == "1") {echo ' selected';} ?>>Все пользователи</option></select></td>
	</tr>
</tbody>
</table>
<br>
<div style="width: max-content;margin: auto;"><input type="submit" id="button" value="Сохранить" name="edit_general_submit"></div>
</form>
</div>
<div id="_AvatarTab" style="display: none;">
<h3><b>Аватар</b></h3>
<form method="post" enctype="multipart/form-data" action="add_avatar.php">
<div style="margin-left:157px;"><span style="color:#B5B5B5;font-size:11px;">А здесь вы можете изменить свою аватарку. Единственное, вы можете загружать JPG, PNG и GIF любых размеров.</span></div><br>
<table border="0" style="font-size:11px;">
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Файл:</div></td><td><input type="file" accept="image/jpeg,image/png,image/gif" name="picture"></td></tr>
</table><br>
<div style="margin-left:157px;"><input type="submit" id="button" value="Изменить аватар"></div>
</form>
</div>
<div id="_InterfaceTab" style="display: none;">
<h3><b>Интерфейс</b></h3>
<form method="post" action="change_style.php">
<div style="margin-left:157px;"><span style="color:#B5B5B5;font-size:11px;">Здесь вы можете сменить стиль сайта.</span></div><br>
<table border="0" style="font-size:11px;">
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Стиль:</div></td><td><select style="width:380px;" name="edit_design_style" style="width:185px;">
<option value="1" <?php if($userdata['cssstyle'] == "1") {echo ' selected';} ?>>Обычный (серые тона)</option>
  <option value="2"<?php if($userdata['cssstyle'] == "2") {echo ' selected';} ?>>ВКонтакте (синие тона)</option></select></td></tr>
  <?php /* ?><tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Реклама:</div></td><td><input type="checkbox" name="edit_design_advice" value="yes" <?php if ($userdata['advice_settings'] == "1") { echo "checked"; }?>> Включить</td></tr> <?php */ ?>
</table><br>
<div style="margin-left:157px;"><input type="submit" id="button" value="Изменить дизайн"></div>
</form>
</div>
 </div>
 </div>
 </div>
 <div>
 <? include('exec/footer.php'); ?>
 </div>
 </div>
 </body>
 <script type="text/javascript">
// 1
function _GeneralInfo()
{
  // Табы
  document.getElementById('GeneralInfoTab').className = 'SelectedTab';
  document.getElementById('PasswordTab').className = 'Tab';
  document.getElementById('AvatarTab').className = 'Tab';
  document.getElementById('InterfaceTab').className = 'Tab'; 
 
  // Страницы
  document.getElementById('_GeneralInfo').style.display = 'block';
  document.getElementById('_PasswordTab').style.display = 'none';
  document.getElementById('_AvatarTab').style.display = 'none';
  document.getElementById('_InterfaceTab').style.display = 'none'; 
  
  document.getElementById('generalci').style.display = 'inline-block';
  document.getElementById('privateci').style.display = 'none';
  document.getElementById('uvedci').style.display = 'none';
  document.getElementById('xddci').style.display = 'none'; 
 
}
// 2
function _PasswordTab()
{
  document.getElementById('GeneralInfoTab').className = 'Tab';
  document.getElementById('PasswordTab').className = 'SelectedTab';
  document.getElementById('AvatarTab').className = 'Tab';
  document.getElementById('InterfaceTab').className = 'Tab'; 
 
  // Страницы
  document.getElementById('_GeneralInfo').style.display = 'none';
  document.getElementById('_PasswordTab').style.display = 'block';
  document.getElementById('_AvatarTab').style.display = 'none';
  document.getElementById('_InterfaceTab').style.display = 'none'; 
  
  document.getElementById('generalci').style.display = 'none';
  document.getElementById('privateci').style.display = 'inline-block';
  document.getElementById('uvedci').style.display = 'none';
  document.getElementById('xddci').style.display = 'none'; 
 
}

function _AvatarTab()
{
  document.getElementById('GeneralInfoTab').className = 'Tab';
  document.getElementById('PasswordTab').className = 'Tab';
  document.getElementById('AvatarTab').className = 'SelectedTab';
  document.getElementById('InterfaceTab').className = 'Tab'; 
 
  // Страницы
  document.getElementById('_GeneralInfo').style.display = 'none';
  document.getElementById('_PasswordTab').style.display = 'none';
  document.getElementById('_AvatarTab').style.display = 'block';
  document.getElementById('_InterfaceTab').style.display = 'none'; 
 
}

function _InterfaceTab()
{
  document.getElementById('GeneralInfoTab').className = 'Tab';
  document.getElementById('PasswordTab').className = 'Tab';
  document.getElementById('AvatarTab').className = 'Tab';
  document.getElementById('InterfaceTab').className = 'SelectedTab'; 
 
  // Страницы
  document.getElementById('_GeneralInfo').style.display = 'none';
  document.getElementById('_PasswordTab').style.display = 'none';
  document.getElementById('_AvatarTab').style.display = 'none';
  document.getElementById('_InterfaceTab').style.display = 'block'; 
 
}

</script>
</html>
<?php }else if($_SESSION['loginin'] != "1"){
echo '<meta charset="utf-8">Пожалуйста, авторизируйтесь.<meta http-equiv="refresh" content="3;blank/../">';
exit();
}
//}
?>

