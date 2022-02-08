<?php 
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
include('exec/header.php');
include('exec/datefn.php');
include('exec/leftmenu.php'); 
$qsi = "SELECT * FROM users WHERE id = '".$_SESSION['id']."'"; // выбираем нашего 
$qsa = $dbh1->prepare($qsi); // отправляем запрос серверу
$qsa -> execute(); 
$qsu = $qsa->fetch();
if($_POST['perevesti']){
if($_POST['golosa_pere'] <= $qsu['golosa']){
	if($qsu['rating'] == NULL){
	$qsu['rating'] = 0;
}
$fingolos = $qsu['rating'] + $_POST['golosa_pere'];
$fin = $qsu['golosa'] - $_POST['golosa_pere'];
$q = "UPDATE users SET rating='".$fingolos."' WHERE id='".$_SESSION['id']."'";
$q1 = $dbh1->prepare($q);
$q1 -> execute();
$q1->fetch();
$qq = "UPDATE users SET golosa='".$fin."' WHERE id='".$_SESSION['id']."'";
$qq1 = $dbh1->prepare($qq);
$qq1 -> execute();
$qq1->fetch();
echo '<div align="center"><b>Успешно</b><br><a href="pod_rejting.php"><<вернуться</a><br><br></div>';
exit();
}else{
echo '<div align="center"><b>Недостаточно средств</b><br><a href="pod_rejting.php"><<вернуться</a><br><br></div>';
exit();	
}
}
?>
<div id="content-infoname"><b>Поднять рейтинг</b><a style="
    float: right;
">Голосов на счёте: 
<?php
if($qsu['golosa'] == NULL){
	echo '0';
}else{
	echo $qsu['golosa'];
}
?>
</a>
</div>
<?php if($qsu['invitecode'] == 11 OR $qsu['invitecode'] == 22 OR $qsu['invitecode'] == 33){?>







<p>1 голос = 1% рейтинга</p>





<form action="pod_rejting.php" method="post">



<a>Введите сумму:</a>
    <input name="golosa_pere">
    <input type="submit" id="button" value="оплатить" name="perevesti">
</form>
<br>
<?php }else{?>
<div align="center"><b>Чтобы увеличивать рейтинг за голоса нужно пригласить хотя-бы одного друга в OpenVK</b><br><a href="pod_rejting.php"><<вернуться</a><br><br></div>
<?php }?>
  </div>
  </div>
  </div>
  <div>
  <? include('exec/footer.php'); ?>
  </div>
 </body>
</html>
