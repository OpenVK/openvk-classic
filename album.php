<?
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
include('exec/header.php');
include('exec/leftmenu.php'); 
include 'exec/datefn.php';
$_GET['id'] = htmlentities($_GET['id'],ENT_QUOTES);
$_GET['id'] = str_replace(array("\r\n", "\r", "\n", "<", ">"), '<br>', $_GET['id']);
if ($_GET['id'] != '') {
	$id = $_GET['id'];
}else{
	$id = $_SESSION['id'];
}
if ($_GET['id'] == '0' AND $_GET['id'] == '-0') {
 echo 'Error ID album';
	exit();
}


$qs = $dbh1->prepare("SELECT * FROM photo WHERE `album` = '".$id."' ORDER BY id DESC");
$qs->execute();

$qalb = $dbh1->prepare("SELECT * FROM albums WHERE `id` = '".$id."' ORDER BY id DESC");
$qalb->execute();
$album = $qalb->fetch();

$userr = $dbh1->prepare("SELECT * FROM users WHERE id = '".$album['aid']."'");
$userr->execute();
$userrr = $userr->fetch();
?>
<div id="content-infoname"><b><?php echo '<a href="id'.$userrr['id'].'">'.$userrr['name'].' '.$userrr['surname'].'</a>' ?> » <a href="albums<?php echo $userrr['id']?>">Альбомы</a> » <?php echo $album['name']?></b><?php if($_SESSION['id'] == $userrr['id']){?><text style="font-size: 8pt; color: #aaa; float: right;"><a href="photoalbum_add.php?id=<?php echo $id ?>">Добавить фотографию</a></text><?php } ?></div>
<br>

<?php
while($photo = $qs->fetch()){
$qg = $dbh1->prepare("SELECT * FROM photo WHERE `id` = '".$photo['id']."'");
$qg->execute();
$photoo = $qg->fetch();
echo '<a href="watchi.php?id='.$photoo['id'].'"><img src="imagesmall.php?image='.$photoo['image'].'" style="margin-right: 4px;margin-bottom: 4px;"></a>';
}
?>
	<br>
</div>
<? include ('exec/footer.php'); ?>
</body>
</html>