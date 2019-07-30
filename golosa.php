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

if($_POST['add_golosa']){
if($_SESSION['admin'] = 3){
if($qsu['golosa'] == NULL){
	$qsu['golosa'] = 0;
}
$fingolos = $qsu['golosa'] + $_POST['summa_add'];
$q = "UPDATE users SET golosa='".$fingolos."' WHERE id='".$qsu['id']."'";
$q1 = $dbh1->prepare($q);
$q1 -> execute();
$q1->fetch();
echo '<div align="center"><b>Успешно</b><br><a href="golosa.php"><<вернуться</a><br><br></div>';
exit();
}else{
echo '<div align="center"><b>Хакеры? Интересно.</b><br><a href="golosa.php"><<вернуться</a><br><br></div>';	
}
}
if($_POST['perevesti']){
$qsr = "SELECT * FROM users WHERE id = '".$_POST['drug']."'"; // выбираем нашего 
$qsrr = $dbh1->prepare($qsr); // отправляем запрос серверу
$qsrr -> execute(); 
$qsum = $qsrr->fetch();
if($_POST['golosa_pere'] <= $qsu['golosa']){
if($qsum['golosa'] == NULL){
	$qsum['golosa'] = 0;
}
$fingolos = $qsum['golosa'] + $_POST['golosa_pere'];
$fin = $qsu['golosa'] - $_POST['golosa_pere'];
$q = "UPDATE users SET golosa='".$fingolos."' WHERE id='".$_POST['drug']."'";
$q1 = $dbh1->prepare($q);
$q1 -> execute();
$q1->fetch();
$qq = "UPDATE users SET golosa='".$fin."' WHERE id='".$_SESSION['id']."'";
$qq1 = $dbh1->prepare($qq);
$qq1 -> execute();
$qq1->fetch();
echo '<div align="center"><b>Успешно</b><br><a href="golosa.php"><<вернуться</a><br><br></div>';
exit();
}else{
echo '<div align="center"><b>Недостаточно средств</b><br><a href="golosa.php"><<вернуться</a><br><br></div>';
exit();	
}
}
?>
<div id="content-infoname"><b>Голоса</b><a style="
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
<?php if($_SESSION['admin'] != 3){?>
<i style="
    color: gray;
">*вы не можете пополнить счёт, так как не являетесь администратором OpenVK, но вам могут их перевести.</i><br><br>

<?php }else{?>
<h4>Пополнить счёт</h4><br>
<form action="golosa.php" method="post">
<a>Введите сумму:</a>
    <input name="summa_add">
    <input type="submit" id="button" value="Пополнить" name="add_golosa">
</form><br><?php }?>



<h4>Куда можно потратить?</h4>

<br><a href="gifts.php" style="
">Сделать подарок другу</a><br>
<br><a href="pod_rejting.php">Увеличить рейтинг</a>
<br><br>
<br><h4>Сделать перевод</h4>


<br>
<form action="golosa.php" method="post"><a>Выберите друга:</a>
<select name="drug" style="
    width: 160px;
">
<?php
    $q4 = $dbh1->prepare("SELECT * FROM `friends` WHERE `id1`='".$_SESSION['id']."'");
    $q4 -> execute();
    while($friend1 = $q4->fetch()) {
      $q5 = $dbh1->prepare("SELECT * FROM `users` WHERE `id`='".$friend1['id2']."'"); // отправляем запрос серверу
      $q5 -> execute(); 
      $friend = $q5->fetch(); // ответ в переменную .
      echo '<option value="'.$friend['id'].'">'.$friend['name'].' '.$friend['surname'].'</option>';
  } 
      
?>
</select>
<br>
<br>
<a>Введите сумму:</a>
    <input name="golosa_pere">
    <input type="submit" id="button" value="перевести" name="perevesti">
</form>
<br>


  </div>
  </div>
  </div>
  <div>
  <? include('exec/footer.php'); ?>
  </div>
 </body>
</html>
