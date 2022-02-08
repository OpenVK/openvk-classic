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
?>
<div id="content-infoname"><b>Подарки</b><a style="
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
<?php
    $q4 = $dbh1->prepare("SELECT * FROM `gifts`");
    $q4 -> execute();
    while($gift = $q4->fetch()) {
    echo '<div style="width: min-content;margin: 0 5px;margin-bottom: 10px;display: inline-block;">
  <img src="content/gift/'.$gift['id'].'.jpg" style="width: 72px;"><br><span style="font-size: 9px;">Стоимость: 3 г.</span><br>
  <div id="button" style="margin-top: 6px;"><a href="send_gift.php?id='.$gift['id'].'" style="color: white;">Отправить</a></div>
</div>';
  } 
?>
  </div>
  </div>
  </div>
  <div>
  <? include('exec/footer.php'); ?>
  </div>
 </body>
</html>
