<?php 
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
include('exec/header.php');
include('exec/datefn.php');
include('exec/leftmenu.php');
$id = $_GET['id'];
$userr = $dbh1->prepare("SELECT * FROM `users` WHERE `id` = '".$id."'");
$userr->execute();
$userrr = $userr->fetch();
?>
<div id="content-infoname"><b><?php echo '<a href="id'.$userrr['id'].'">'.$userrr['name'].' '.$userrr['surname'].'</a>' ?> » Подарки</b>
</div>
<?php
    $q4 = $dbh1->prepare("SELECT * FROM `giftogift` WHERE toid = '".$id."'");
    $q4 -> execute();
    while($gift = $q4->fetch()) {
	$user = $dbh1->prepare("SELECT * FROM `users` WHERE `id` = '".$gift['fromid']."'");
$user->execute();
$userrf = $user->fetch();
    echo '<div style="width: 90px;padding: 5px;display: inline-block;">
<img src="content/gift/'.$gift['giftid'].'.jpg" style="width: 90px;"><br>
<span>От: </span><a href="id'.$userrf['id'].'">'.$userrf['name'].' '.$userrf['surname'].'</a><br>
<span>Комментарий:</span><br><div style="width: 90px;word-break: break-all;">'.$gift['comment'].'</div>
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
