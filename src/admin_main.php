<?php
session_start();
include "exec/dbconnect.php";
include "exec/check_user.php";
if($_SESSION['loginin'] == "1"){
if($_SESSION['groupu'] == "2"){
include "exec/datefn.php";
include "exec/header.php";
include "exec/leftmenu.php";
?>
<div id="content-infoname"><b>Админ-панель</b></div>
<p>Сейчас онлайн <?php $q = "SELECT * FROM users"; // выбираем нашего 
 $q1 = $dbh1->prepare($q); // отправляем запрос серверу
 $q1 -> execute(); 
 while ($countusers = $q1->fetch()) {
 	if (time()-300 <= $countusers['lastonline']) {
 		$userscouunt++;
 	}
 }
 if ($userscouunt == '1') {
     $userscouunt = (string)$userscouunt." пользователь";
   }elseif ($userscouunt == '2' OR $userscouunt == '3' OR $userscouunt == '4') {
     $userscouunt = (string)$userscouunt." пользователя";
   }else{
     $userscouunt = (string)$userscouunt." пользователей";
   }
   echo $userscouunt;
 ?>.</p>
<a href="admin_users.php">Пользователи</a><br>
<a href="admin_groups.php">Группы</a><br>
<a href="admin_blog.php">Блог</a><br>
<a href="admin_users.php">Пользователи</a><br>
<a href="admin_bugtr.php">Баг-трекер</a><br><br>
</div>
<div><?php include "exec/footer.php"; ?></div>
</body>
</html>
<?php
}else{
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