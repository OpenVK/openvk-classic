<?php
session_start(); // начинаем сессию
include('exec/dbconnect.php');
include('exec/header.php');
include('exec/leftmenu.php');
?>
<div id="content-infoname"><b>Регистрация</b></div>
    <div id="content-info">
	   	<form method="post" action="index.php">
	   		<table style="font-size: 11px;">
	   			<tbody>
	   				<tr>
	   					<td style="width: 150px;"><div style="float:right;padding-right:7px;color:#777;">Логин:</div></td>
	   					<td><input style="width:380px;" type="text" name="login" placeholder="Используется для входа в аккаунт" id="text"></td>
	   				</tr>
	   				<tr>
	   					<td style="width: 150px;"><div style="float:right;padding-right:7px;color:#777;">Пароль:</div></td>
	   					<td><input style="width:380px;" type="password" name="password" placeholder="Пароль" id="text"></td>
	   				</tr>
	   				<tr>
	   					<td style="width: 150px;"><div style="float:right;padding-right:7px;color:#777;">Имя:</div></td>
	   					<td><input style="width:380px;" type="text" name="name" placeholder="Имя" id="text"></td>
	   				</tr>
	   				<tr>
	   					<td style="width: 150px;"><div style="float:right;padding-right:7px;color:#777;">Фамилия:</div></td>
	   					<td><input style="width:380px;" type="text" name="surname" placeholder="Фамилия" id="text"></td>
	   				</tr>
	   				<tr>
	   					<td style="width: 150px;"><div style="float:right;padding-right:7px;color:#777;">Floor:</div></td>
	   					<td>
   <select style="width:380px;" name="gender">
   	<option value="0">Не указан</option>
   	<option value="1">Мужской</option>
   	<option value="2">Женский</option>
   </select></td>
	   				</tr>
	   			</tbody>
	   		</table>
   <input type="submit" value="Зарегистрироваться!" id="button">
   </form>
   </div>
  </div>
 </div>
 </body>
</html>