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
if($_POST['podarit']){
if(3 <= $qsu['golosa']){
$fin = $qsu['golosa'] - 3;
$qq = "UPDATE users SET golosa='".$fin."' WHERE id='".$_SESSION['id']."'";
$qq1 = $dbh1->prepare($qq);
$qq1 -> execute();
$qq1->fetch();
$q = "INSERT INTO `giftogift` (`id`, `giftid`, `toid`, `fromid`, `comment`) VALUES (NULL, '".$_GET['id']."', '".$_POST['drug']."','".$_SESSION['id']."','".$_POST['comment']."')";
$q1 = $dbh1->prepare($q);
$q1 -> execute();
$q1->fetch();
echo '<div align="center"><b>Успешно</b><br><a href="gifts.php"><<вернуться</a><br><br></div>';
exit();
}else{
echo '<div align="center"><b>Недостаточно средств</b><br><a href="gifts.php"><<вернуться</a><br><br></div>';
exit();	
}
}
?>
<div id="content-infoname"><b>Отправить подарок</b><a style="
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
<img src="content/gift/<?php echo $_GET['id']?>.jpg">
<br>
<br>
<span>Стоимость: </span><a>3 голоса</a>
<br>
<br>
<form action="send_gift.php?id=<?php echo $_GET['id']?>" method="post"><span>Выберите друга: </span><select name="drug" style="
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
<span>Ваш комментарий:</span>
<br>
<textarea style="font-size: 12px;" name="comment"></textarea>
<br>
<br><input type="submit" id="button" value="Подарить" name="podarit">
</form>

  </div>
  </div>
  </div>
  <div>
  <? include('exec/footer.php'); ?>
  </div>
 </body>
</html>
