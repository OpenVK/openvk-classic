<?php 
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
if($_SESSION['loginin'] == "1"){
if($_POST['edit_general_submit']){
//$_POST['edit_general_fname'] = str_replace('<', '&#60;', $_POST['edit_general_fname']);
//$_POST['edit_general_fname'] = str_replace('>', '&#62;', $_POST['edit_general_fname']);
//$_POST['edit_general_lname'] = str_replace('<', '&#60;', $_POST['edit_general_lname']);
//$_POST['edit_general_lname'] = str_replace('>', '&#62;', $_POST['edit_general_lname']);
//$_POST['edit_general_about'] = str_replace('<', '&#60;', $_POST['edit_general_about']);
//$_POST['edit_general_about'] = str_replace('>', '&#62;', $_POST['edit_general_about']);
//$_POST['edit_general_about2'] = str_replace('<', '&#60;', $_POST['edit_general_about2']);
//$_POST['edit_general_about2'] = str_replace('>', '&#62;', $_POST['edit_general_about2']);
$_POST['edit_general_fname'] = htmlentities($_POST['edit_general_fname'],ENT_QUOTES);
$_POST['edit_general_fname'] = str_replace('<', '&#60;', $_POST['edit_general_fname']);
$_POST['edit_general_fname'] = str_replace('>', '&#62;', $_POST['edit_general_fname']);
$_POST['edit_general_lname'] = htmlentities($_POST['edit_general_lname'],ENT_QUOTES);
$_POST['edit_general_lname'] = str_replace('<', '&#60;', $_POST['edit_general_lname']);
$_POST['edit_general_lname'] = str_replace('>', '&#62;', $_POST['edit_general_lname']);
$_POST['edit_general_fname'] = htmlentities($_POST['edit_general_fname'],ENT_QUOTES);
$_POST['edit_general_fname'] = trim($_POST['edit_general_fname']);
$_POST['edit_general_fname'] = mb_strtolower($_POST['edit_general_fname'], 'utf-8');
$_POST['edit_general_fname'] = mb_convert_case($_POST['edit_general_fname'], MB_CASE_TITLE, 'UTF-8');
$_POST['edit_general_fname'] = str_replace(' ','-',$_POST['edit_general_fname']);
$_POST['edit_general_lname'] = htmlentities($_POST['edit_general_lname'],ENT_QUOTES);
$_POST['edit_general_lname'] = trim($_POST['edit_general_lname']);
$_POST['edit_general_lname'] = mb_strtolower($_POST['edit_general_lname'], 'utf-8');
$_POST['edit_general_lname'] = mb_convert_case($_POST['edit_general_lname'], MB_CASE_TITLE, 'UTF-8');
$_POST['edit_general_lname'] = str_replace(' ','-',$_POST['edit_general_lname']);
$_POST['edit_general_nname'] = htmlentities($_POST['edit_general_nname'],ENT_QUOTES);
$_POST['edit_general_nname'] = str_replace('<', '&#60;', $_POST['edit_general_nname']);
$_POST['edit_general_nname'] = str_replace('>', '&#62;', $_POST['edit_general_nname']);
$_POST['edit_general_about'] = htmlentities($_POST['edit_general_about'],ENT_QUOTES);
$_POST['edit_general_about'] = str_replace('<', '&#60;', $_POST['edit_general_about']);
$_POST['edit_general_about'] = str_replace('>', '&#62;', $_POST['edit_general_about']);
$_POST['edit_general_about'] = str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['edit_general_about']);
$_POST['edit_general_status'] = htmlentities($_POST['edit_general_status'],ENT_QUOTES);
$_POST['edit_general_status'] = str_replace('<', '&#60;', $_POST['edit_general_status']);
$_POST['edit_general_status'] = str_replace('>', '&#62;', $_POST['edit_general_status']);
$_POST['edit_general_about2'] = htmlentities($_POST['edit_general_about2'],ENT_QUOTES);
$_POST['edit_general_about2'] = str_replace('<', '&#60;', $_POST['edit_general_about2']);
$_POST['edit_general_about2'] = str_replace('>', '&#62;', $_POST['edit_general_about2']);
$_POST['edit_general_email'] = htmlentities($_POST['edit_general_email'],ENT_QUOTES);
$_POST['edit_general_email'] = str_replace('<', '&#60;', $_POST['edit_general_email']);
$_POST['edit_general_email'] = str_replace('>', '&#62;', $_POST['edit_general_email']);
$_POST['edit_general_telephone'] = htmlentities($_POST['edit_general_telephone'],ENT_QUOTES);
//$_POST['edit_general_about2'] = htmlentities($_POST['edit_general_about2'],ENT_QUOTES);
if($_POST['edit_general_fname'] == NULL || $_POST['edit_general_lname'] == NULL){
echo '<meta charset="utf-8">Напишите имя и/или фамилию.';
exit();
}
if ($_POST['edit_general_birth_month'] == '2' AND $_POST['edit_general_birth_day'] == array('29', '30', '31')) {
  echo '<meta charset="utf-8">Неверная дата.';
exit();
}elseif ($_POST['edit_general_birth_month'] == '4' AND $_POST['edit_general_birth_day'] == array('30', '31')) {
  echo '<meta charset="utf-8">Неверная дата.';
exit();
}elseif ($_POST['edit_general_birth_month'] == '6' AND $_POST['edit_general_birth_day'] == array('30', '31')) {
  echo '<meta charset="utf-8">Неверная дата.';
exit();
}elseif ($_POST['edit_general_birth_month'] == '9' AND $_POST['edit_general_birth_day'] == array('30', '31')) {
  echo '<meta charset="utf-8">Неверная дата.';
exit();
}elseif ($_POST['edit_general_birth_month'] == '11' AND $_POST['edit_general_birth_day'] == array('30', '31')) {
  echo '<meta charset="utf-8">Неверная дата.';
exit();
}
$quser = $dbh1->prepare("SELECT * FROM users WHERE id='".$_SESSION['id']."'");
$quser -> execute();
$userdata = $quser->fetch();
$q = "UPDATE users SET name='".$_POST['edit_general_fname']."', surname='".$_POST['edit_general_lname']."', gender='".$_POST['edit_general_gender']."', birthdate='".mktime(0,0,0,$_POST['edit_general_birth_month'],$_POST['edit_general_birth_day'],$_POST['edit_general_birth_year'])."', aboutuser='".$_POST['edit_general_about']."', nickname='".$_POST['edit_general_nname']."', status='".$_POST['edit_general_status']."',closedwall='".$_POST['edit_general_wall']."', aboutuser2='".$_POST['edit_general_about2']."', telephone='".$_POST['edit_general_telephone']."', email='".$_POST['edit_general_email']."', telephone_settings='".$_POST['edit_general_telephone_settings']."', email_settings='".$_POST['edit_general_telephone_settings']."' WHERE login='".$userdata['login']."'";
$q1 = $dbh1->prepare($q);
$q1 -> execute();
$q1->fetch();
header("Location: settings.php");
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
header("Location: settings.php");
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
include('exec/leftmenu.php');
$quser = $dbh1->prepare("SELECT * FROM users WHERE id='".$_SESSION['id']."'");
$quser -> execute();
$userdata = $quser->fetch();

//$id = $_GET['id'];
//$q = "SELECT * FROM users WHERE id='".$id."'"; // выбираем нашего 
//$q1 = $dbh1->prepare($q); // отправляем запрос серверу
//$q1 -> execute(); 
//$user = $q1->fetch(); // ответ в переменную 
//if($_GET['id'] || $_SESSION['groupu'] == '1'){
?>
<div id="content-infoname"><b>Настройки</b></div>
<div>
	<ul id="Tabs">
  <li id="GeneralInfoTab" class="SelectedTab"><a href="#" onclick=" _GeneralInfo(); return false;">Основная информация</a></li>
	<li id="PasswordTab" class="Tab"><a href="#" onclick="_PasswordTab(); return false;">Пароль</a></li>
	<li id="AvatarTab" class="Tab"><a href="#" onclick="_AvatarTab(); return false;">Аватар</a></li>
	<li id="InterfaceTab" class="Tab"><a href="#" onclick="_InterfaceTab(); return false;">Интерфейс</a></li>
	
	
</ul>
<div id="_GeneralInfo">
<h3><b>Основная информация</b></h3>
<form action="settings.php" method="post">
<table border="0" style="font-size:11px;">
<div style="margin-left:157px;"><span style="color:#B5B5B5;font-size:11px;">В поле "Имя" и "Фамилия" запрещены символы, которые мешают просмотру текста, а также пустые коды, иначе будет бан в течении нескольких часов. Разрешены алфавиты нашего и других языков.</span></div>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Имя:</div></td><td><input id="text" style="width:200px;" name="edit_general_fname" <?php echo 'value="'.$userdata['name'].'"'; ?> ></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Фамилия:</div></td><td><input id="text" style="width:200px;" name="edit_general_lname" <?php echo 'value="'.$userdata['surname'].'"'; ?> ></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Никнейм:</div></td><td><input id="text" style="width:200px;" name="edit_general_nname" <?php echo 'value="'.$userdata['nickname'].'"'; ?> ></td></tr>
</table>
<div style="margin-left:157px;"><span style="color:#B5B5B5;font-size:11px;">В поле "Никнейм" вы можете вписать всё что угодно.</span></div>
<table border="0" style="font-size:11px;">
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Статус:</div></td><td><input id="text" style="width:200px;" name="edit_general_status" <?php echo 'value="'.$userdata['status'].'"'; ?> ></td></tr>
</table>
<div style="margin-left:157px;"><span style="color:#B5B5B5;font-size:11px;">Вы здесь для смены статуса? Вам сюда.</span></div>
<table border="0" style="font-size:11px;">
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Пол:</div></td><td><select style="width:200px;" name="edit_general_gender" style="width:185px;"><option value="1"<?php if($userdata['gender'] == "1") {echo ' selected';} ?> >Мужской</option>
  <option value="2"<?php if($userdata['gender'] == "2") {echo ' selected';} ?> >Женский</option>
  <option value="0"<?php if($userdata['gender'] == "0") {echo ' selected';} ?> >Не указано</option></select></td></tr>

  <tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Стена:</div></td><td><select style="width:200px;" name="edit_general_wall" style="width:185px;"><option value="0"<?php if($userdata['closedwall'] == "0") {echo ' selected';} ?> >Открытая</option>
  <option value="1"<?php if($userdata['closedwall'] == "1") {echo ' selected';} ?> >Закрытая</option></select></td></tr>

  <tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Номер телефона:</div></td><td><input id="text" type="tel" style="width:200px;" name="edit_general_telephone" <?php echo 'value="'.$userdata['telephone'].'"'; ?> ><div style="position: absolute;margin-left:220px;border: #bbb solid 5px;width: 150px;padding: 5px;"><h4>Кто видит мою Эл. Почту и Ном. Телефона</h4><input type="radio" name="edit_general_telephone_settings" value="0" <?php if($userdata['telephone_settings'] == "0") {echo ' checked';} ?>>Мои друзья<br><input type="radio" name="edit_general_telephone_settings" value="1"<?php if($userdata['telephone_settings'] == "1") {echo ' checked';} ?>>Все желающие</div></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">E-mail (для связи):</div></td><td><input id="text" type="email" style="width:200px;" name="edit_general_email" <?php echo 'value="'.$userdata['email'].'"'; ?> ></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">О себе:</div></td><td><textarea style="min-width:200px;max-width:200px;" id="text" name="edit_general_about"><?php $userdata['aboutuser'] = str_replace('<br>', '
', $userdata['aboutuser']);
  echo $userdata['aboutuser']; ?></textarea></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Дата рождения:</div></td><td>
  <select style="width:50px;" name="edit_general_birth_day">
  <option value="1"<?php if(date('d', $userdata['birthdate']) == "01") {echo ' selected';} ?> >01</option>
  <option value="2"<?php if(date('d', $userdata['birthdate']) == "02") {echo ' selected';} ?> >02</option>
  <option value="3"<?php if(date('d', $userdata['birthdate']) == "03") {echo ' selected';} ?> >03</option>
  <option value="4"<?php if(date('d', $userdata['birthdate']) == "04") {echo ' selected';} ?> >04</option>
  <option value="5"<?php if(date('d', $userdata['birthdate']) == "05") {echo ' selected';} ?> >05</option>
  <option value="6"<?php if(date('d', $userdata['birthdate']) == "06") {echo ' selected';} ?> >06</option>
  <option value="7"<?php if(date('d', $userdata['birthdate']) == "07") {echo ' selected';} ?> >07</option>
  <option value="8"<?php if(date('d', $userdata['birthdate']) == "08") {echo ' selected';} ?> >08</option>
  <option value="9"<?php if(date('d', $userdata['birthdate']) == "09") {echo ' selected';} ?> >09</option>
  <option value="10"<?php if(date('d', $userdata['birthdate']) == "10") {echo ' selected';} ?> >10</option>
  <option value="11"<?php if(date('d', $userdata['birthdate']) == "11") {echo ' selected';} ?> >11</option>
  <option value="12"<?php if(date('d', $userdata['birthdate']) == "12") {echo ' selected';} ?> >12</option>
  <option value="13"<?php if(date('d', $userdata['birthdate']) == "13") {echo ' selected';} ?> >13</option>
  <option value="14"<?php if(date('d', $userdata['birthdate']) == "14") {echo ' selected';} ?> >14</option>
  <option value="15"<?php if(date('d', $userdata['birthdate']) == "15") {echo ' selected';} ?> >15</option>
  <option value="16"<?php if(date('d', $userdata['birthdate']) == "16") {echo ' selected';} ?> >16</option>
  <option value="17"<?php if(date('d', $userdata['birthdate']) == "17") {echo ' selected';} ?> >17</option>
  <option value="18"<?php if(date('d', $userdata['birthdate']) == "18") {echo ' selected';} ?> >18</option>
  <option value="19"<?php if(date('d', $userdata['birthdate']) == "19") {echo ' selected';} ?> >19</option>
  <option value="20"<?php if(date('d', $userdata['birthdate']) == "20") {echo ' selected';} ?> >20</option>
  <option value="21"<?php if(date('d', $userdata['birthdate']) == "21") {echo ' selected';} ?> >21</option>
  <option value="22"<?php if(date('d', $userdata['birthdate']) == "22") {echo ' selected';} ?> >22</option>
  <option value="23"<?php if(date('d', $userdata['birthdate']) == "23") {echo ' selected';} ?> >23</option>
  <option value="24"<?php if(date('d', $userdata['birthdate']) == "24") {echo ' selected';} ?> >24</option>
  <option value="25"<?php if(date('d', $userdata['birthdate']) == "25") {echo ' selected';} ?> >25</option>
  <option value="26"<?php if(date('d', $userdata['birthdate']) == "26") {echo ' selected';} ?> >26</option>
  <option value="27"<?php if(date('d', $userdata['birthdate']) == "27") {echo ' selected';} ?> >27</option>
  <option value="28"<?php if(date('d', $userdata['birthdate']) == "28") {echo ' selected';} ?> >28</option>
  <option value="29"<?php if(date('d', $userdata['birthdate']) == "29") {echo ' selected';} ?> >29</option>
  <option value="30"<?php if(date('d', $userdata['birthdate']) == "30") {echo ' selected';} ?> >30</option>
  <option value="31"<?php if(date('d', $userdata['birthdate']) == "31") {echo ' selected';} ?> >31</option>
  

</select><select style="width:50px;" name="edit_general_birth_month" >
  <option value="1"<?php if(date('m', $userdata['birthdate']) == "01") {echo ' selected';} ?> >Янв</option>
  <option value="2"<?php if(date('m', $userdata['birthdate']) == "02") {echo ' selected';} ?> >Фев</option>
  <option value="3"<?php if(date('m', $userdata['birthdate']) == "03") {echo ' selected';} ?> >Мар</option>
  <option value="4"<?php if(date('m', $userdata['birthdate']) == "04") {echo ' selected';} ?> >Апр</option>
  <option value="5"<?php if(date('m', $userdata['birthdate']) == "05") {echo ' selected';} ?> >Май</option>
  <option value="6"<?php if(date('m', $userdata['birthdate']) == "06") {echo ' selected';} ?> >Июн</option>
  <option value="7"<?php if(date('m', $userdata['birthdate']) == "07") {echo ' selected';} ?> >Июл</option>
  <option value="8"<?php if(date('m', $userdata['birthdate']) == "08") {echo ' selected';} ?> >Авг</option>
  <option value="9"<?php if(date('m', $userdata['birthdate']) == "09") {echo ' selected';} ?> >Сен</option>
  <option value="10"<?php if(date('m', $userdata['birthdate']) == "10") {echo ' selected';} ?> >Окт</option>
  <option value="11"<?php if(date('m', $userdata['birthdate']) == "11") {echo ' selected';} ?> >Ноя</option>
  <option value="12"<?php if(date('m', $userdata['birthdate']) == "12") {echo ' selected';} ?> >Дек</option>
  

</select>
<select style="width:100px;" name="edit_general_birth_year" style="width:185px;">
  <option value="2005"<?php if(date('Y', $userdata['birthdate']) == "2005") {echo ' selected';} ?> >2005</option>
  <option value="2004"<?php if(date('Y', $userdata['birthdate']) == "2004") {echo ' selected';} ?> >2004</option>
  <option value="2003"<?php if(date('Y', $userdata['birthdate']) == "2003") {echo ' selected';} ?> >2003</option>
  <option value="2002"<?php if(date('Y', $userdata['birthdate']) == "2002") {echo ' selected';} ?> >2002</option>
  <option value="2001"<?php if(date('Y', $userdata['birthdate']) == "2001") {echo ' selected';} ?> >2001</option>
  <option value="2000"<?php if(date('Y', $userdata['birthdate']) == "2000") {echo ' selected';} ?> >2000</option>
  <option value="1999"<?php if(date('Y', $userdata['birthdate']) == "1999") {echo ' selected';} ?> >1999</option>
  <option value="1998"<?php if(date('Y', $userdata['birthdate']) == "1998") {echo ' selected';} ?> >1998</option>
  <option value="1997"<?php if(date('Y', $userdata['birthdate']) == "1997") {echo ' selected';} ?> >1997</option>
  <option value="1996"<?php if(date('Y', $userdata['birthdate']) == "1996") {echo ' selected';} ?> >1996</option>
  <option value="1995"<?php if(date('Y', $userdata['birthdate']) == "1995") {echo ' selected';} ?> >1995</option>
  <option value="1994"<?php if(date('Y', $userdata['birthdate']) == "1994") {echo ' selected';} ?> >1994</option>
  <option value="1993"<?php if(date('Y', $userdata['birthdate']) == "1993") {echo ' selected';} ?> >1993</option>
  <option value="1992"<?php if(date('Y', $userdata['birthdate']) == "1992") {echo ' selected';} ?> >1992</option>
  <option value="1991"<?php if(date('Y', $userdata['birthdate']) == "1991") {echo ' selected';} ?> >1991</option>
  <option value="1990"<?php if(date('Y', $userdata['birthdate']) == "1990") {echo ' selected';} ?> >1991</option>
  <option value="1989"<?php if(date('Y', $userdata['birthdate']) == "1989") {echo ' selected';} ?> >1989</option>
  <option value="1988"<?php if(date('Y', $userdata['birthdate']) == "1988") {echo ' selected';} ?> >1988</option>
  <option value="1987"<?php if(date('Y', $userdata['birthdate']) == "1987") {echo ' selected';} ?> >1987</option>
  <option value="1986"<?php if(date('Y', $userdata['birthdate']) == "1986") {echo ' selected';} ?> >1986</option>
  <option value="1985"<?php if(date('Y', $userdata['birthdate']) == "1985") {echo ' selected';} ?> >1985</option>
  <option value="1984"<?php if(date('Y', $userdata['birthdate']) == "1984") {echo ' selected';} ?> >1984</option>
  <option value="1983"<?php if(date('Y', $userdata['birthdate']) == "1983") {echo ' selected';} ?> >1983</option>
  <option value="1982"<?php if(date('Y', $userdata['birthdate']) == "1982") {echo ' selected';} ?> >1982</option>
  <option value="1981"<?php if(date('Y', $userdata['birthdate']) == "1981") {echo ' selected';} ?> >1981</option>
  <option value="1980"<?php if(date('Y', $userdata['birthdate']) == "1980") {echo ' selected';} ?> >1980</option>
  <option value="1979"<?php if(date('Y', $userdata['birthdate']) == "1979") {echo ' selected';} ?> >1979</option>
  <option value="1978"<?php if(date('Y', $userdata['birthdate']) == "1978") {echo ' selected';} ?> >1978</option>
  <option value="1977"<?php if(date('Y', $userdata['birthdate']) == "1977") {echo ' selected';} ?> >1977</option>
  <option value="1976"<?php if(date('Y', $userdata['birthdate']) == "1976") {echo ' selected';} ?> >1976</option>
  <option value="1975"<?php if(date('Y', $userdata['birthdate']) == "1975") {echo ' selected';} ?> >1975</option>
  <option value="1974"<?php if(date('Y', $userdata['birthdate']) == "1974") {echo ' selected';} ?> >1974</option>
  <option value="1973"<?php if(date('Y', $userdata['birthdate']) == "1973") {echo ' selected';} ?> >1973</option>
  <option value="1972"<?php if(date('Y', $userdata['birthdate']) == "1972") {echo ' selected';} ?> >1972</option>
<option value="1971"<?php if(date('Y', $userdata['birthdate']) == "1971") {echo ' selected';} ?> >1971</option>
<option value="1970"<?php if(date('Y', $userdata['birthdate']) == "1970") {echo ' selected';} ?> >1970</option>

  

  

</select>
</td></tr>

<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">О себе (<a href="search.php">для поиска</a>):</div></td><td><input id="text" style="width:200px;" name="edit_general_about2" <?php echo 'value="'.$userdata['aboutuser2'].'"'; ?> ></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Логин:</div></td><td><input id="text" style="width:200px;" disabled <?php echo 'value="'.$userdata['login'].'"'; ?> ></td></tr>
</table>
<div style="margin-left:157px;"><span style="color:#B5B5B5;font-size:11px;">Логин у вас не получится изменить. ¯\_(ツ)_/¯</span></div><br>
<div style="margin-left:157px;"><input type="submit" id="button" value="Сохранить" name="edit_general_submit"></div>
</form>
</div>
<div id="_PasswordTab" style="display: none;">
<h3><b>Пароль</b></h3>
<form action="settings.php" method="post">
<div style="margin-left:157px;"><span style="color:#B5B5B5;font-size:11px;">При желании вы можете изменить свой пароль (только нужно помнить старый для смены на новый :D).</span></div><br>
<table border="0" style="font-size:11px;">
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Текущий пароль:</div></td><td><input type="password" id="text" style="width:380px;" name="edit_password_old"></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Новый пароль:</div></td><td><input type="password" id="text" style="width:380px;" name="edit_password_new"></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Новый пароль (повторите):</div></td><td><input type="password" id="text" style="width:380px;" name="edit_password_new2"></td></tr>
</table><br>
<div style="margin-left:157px;"><input type="submit" id="button" value="Сохранить" name="edit_password_submit"></div>
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

window.onbeforeunload = function (e) { 
  // Ловим событие для Interner Explorer 
  var e = e || window.event; 
  var myMessage= "Вы действительно хотите покинуть страницу, не сохранив данные?"; 
  // Для Internet Explorer и Firefox 
  if (e) { 
    e.returnValue = myMessage; 
  } 
  // Для Safari и Chrome 
  return myMessage; 
}; 


</script>
</html>
<?php }else if($_SESSION['loginin'] != "1"){
echo '<meta charset="utf-8">Пожалуйста, авторизируйтесь.<meta http-equiv="refresh" content="3;blank/../">';
exit();
}
//}
?>

