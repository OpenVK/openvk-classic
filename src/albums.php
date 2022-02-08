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
if($_GET['sort_by'] == "date1"){
$qs = $dbh1->prepare("SELECT * FROM albums WHERE `aid` = '".$id."'");
}elseif($_GET['sort_by'] == "date2"){
$qs = $dbh1->prepare("SELECT * FROM albums WHERE `aid` = '".$id."' ORDER BY id DESC");
}elseif(empty($_GET['sort_by']) || $_GET['sort_by'] == "random"){
$qs = $dbh1->prepare("SELECT * FROM albums WHERE `aid` = '".$id."' ORDER BY RAND()");
}
$qs->execute();


$userr = $dbh1->prepare("SELECT * FROM users WHERE id = '".$id."'");
$userr->execute();
$userrr = $userr->fetch();
?>
<div id="content-infoname"><b><?php echo '<a href="id'.$userrr['id'].'">'.$userrr['name'].' '.$userrr['surname'].'</a>' ?> » Альбомы</b><?php if($_SESSION['id'] == $id){?><text style="font-size: 8pt; color: #aaa; float: right;"><a href="album_add.php">Создать альбом</a></text><?php } ?></div>
<br>
<?php
   $qalbumscount = $dbh1->prepare("SELECT COUNT(1) FROM albums WHERE `aid` = '".$id."'");
   $qalbumscount -> execute();
   $albcount = $qalbumscount->fetch();
   $albcount = $albcount[0];
   if ($albcount == '1') {
     $albcouunt = (string)$albcount." альбом";
   }elseif ($albcount == '2' OR $albcount == '3' OR $albcount == '4') {
     $albcouunt = (string)$albcount." альбома";
   }else{
     $albcouunt = (string)$albcount." альбомов";
   }
   echo '<b>'.$albcouunt.'</b><br>';?>
<div id="content-main-gray">

<?php
while($alb = $qs->fetch()){
$qg = $dbh1->prepare("SELECT * FROM albums WHERE `id` = '".$alb['id']."'");
$qg->execute();
$album = $qg->fetch();

$qphotocount = $dbh1->prepare("SELECT COUNT(1) FROM photo WHERE `album` = '".$album['id']."'");
   $qphotocount -> execute();
   $phocount = $qphotocount->fetch();
   $phocount = $phocount[0];
   if ($phocount == '1') {
     $photocouunt = (string)$phocount." фотография";
   }elseif ($phocount == '2' OR $phocount == '3' OR $phocount == '4') {
     $photocouunt = (string)$phocount." фотографии";
   }else{
     $photocouunt = (string)$phocount." фотографий";
   }
$qphoto = $dbh1->prepare("SELECT * FROM photo WHERE `album` = '".$album['id']."' ORDER BY id LIMIT 1");
$qphoto->execute();
$photo = $qphoto->fetch();
if ($phocount == "0") {
  $photoalbum = "img/nophoto.jpg";
}else{
  $photoalbum = $photo['image'];
}
echo '<div id="content-main-gray-content">
		<table border="0" style="font-size: 11px;">
		<tbody>	
			<tr>
				<td width="200" style="vertical-align: top;">
					<img src="avatar.php?image='.$photoalbum.'">
				</td>
				<td style="vertical-align: 0;">
					<div id="content-main-gray-content-info"><a href="album'.$album['id'].'"><h4><b>'.$album['name'].'</b></h4></a><span><br>'.$photocouunt.'<br>Создан '.zmdate($album['date']).'</span><br>'.$album['note'].'</div>
				</td>
			</tr>
		</tbody>
		</table>
	</div>';
}
?>
	
</div>
</div>
<? include ('exec/footer.php'); ?>
</body>
</html>