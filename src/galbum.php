<?
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
include('exec/header.php');
include('exec/leftmenu.php'); 
include 'exec/datefn.php';


if ($_GET['id'] != '') {
	$id = $_GET['id'];
}else{
	$id = $_SESSION['id'];
}
$qs = $dbh1->prepare("SELECT * FROM photo WHERE `galbum` = '".$id."' ORDER BY id DESC");
$qs->execute();

$qalb = $dbh1->prepare("SELECT * FROM galbums WHERE `id` = '".$id."' ORDER BY id DESC");
$qalb->execute();
$album = $qalb->fetch();

$userr = $dbh1->prepare("SELECT * FROM club WHERE id = '".$album['aid']."'");
$userr->execute();
$userrr = $userr->fetch();
?>
<div id="content-infoname"><b><?php echo '<a href="club'.$userrr['id'].'">'.$userrr['name'].'</a>' ?> » <a href="albums-<?php echo $userrr['id']?>">Альбомы</a> » <?php echo $album['name']?></b><text style="font-size: 8pt; color: #aaa; float: right;"><a href="photogalbum_add.php?id=<?php echo $id ?>">Добавить фотографию</a></text></div>
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