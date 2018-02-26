<?php
session_start();
include 'exec/dbconnect.php';
include('exec/check_user.php');
$_GET['id'] = htmlentities($_GET['id'],ENT_QUOTES);
$_GET['id'] = str_replace(array("\r\n", "\r", "\n", "<", ">", "<script>"), '<br>', $_GET['id']);
if($_SESSION['loginin'] != '1'){
echo '<meta charset="utf-8">Пожалуйста, авторизируйтесь.<meta http-equiv="refresh" content="3;blank/../">';
exit();
}else{
include 'exec/datefn.php';
include 'exec/header.php';
include 'exec/leftmenu.php';
$id;
if ($_GET['id'] != '') {
	$id = $_GET['id'];
}else{
	$id = $_SESSION['id'];
}
if ($_GET['id'] == '0') {
	echo "error ID.";
	exit();
}
if($_GET['sort_by'] == "date1"){
$qs = $dbh1->prepare("SELECT * FROM video WHERE `aid` = '".$id."'");
}elseif($_GET['sort_by'] == "date2"){
$qs = $dbh1->prepare("SELECT * FROM video WHERE `aid` = '".$id."' ORDER BY id DESC");
}elseif(empty($_GET['sort_by']) || $_GET['sort_by'] == "random"){
$qs = $dbh1->prepare("SELECT * FROM video WHERE `aid` = '".$id."' ORDER BY RAND()");
}
$qs->execute();


$userr = $dbh1->prepare("SELECT * FROM users WHERE id = '".$id."'");
$userr->execute();
$userrr = $userr->fetch();
?>
<div id="content-infoname"><b><?php echo '<a href="id'.$userrr['id'].'">'.$userrr['name'].' '.$userrr['surname'].'</a>' ?> » Видеозаписи</b><div style="float:right;"><a href="search.php?type=videos">Поиск видеозаписей</a></div></div>
<div style="min-width:0;width:415px;min-height:165px;float:left;margin-top:-10px;border-right:#BEBEBE solid 1px;">
<br><?php
   $qvideoscount = $dbh1->prepare("SELECT COUNT(1) FROM video WHERE `aid` = '".$id."'");
   $qvideoscount -> execute();
   $vidcount = $qvideoscount->fetch();
   $vidcount = $vidcount[0];
   if ($vidcount == '1') {
     $vidcouunt = (string)$vidcount." видеозапись";
   }elseif ($vidcount == '2' OR $vidcount == '3' OR $vidcount == '4') {
     $vidcouunt = (string)$vidcount." видеозаписи";
   }else{
     $vidcouunt = (string)$vidcount." видеозаписей";
   }
   echo '<b>'.$vidcouunt.'</b><br>';?>
<div id="content-main-gray" style="width: 400px">
<?php
while($vi = $qs->fetch()){
$qg = $dbh1->prepare("SELECT * FROM video WHERE `id` = '".$vi['id']."'");
$qg->execute();
$video = $qg->fetch();
if($video['avatar']){
$av = $video['avatar'];
$video['avatar'] = 'avatart.php?image='.$video['avatar'];
}else{
$video['avatar'] = "img/camera_200.png";
$av = $video['avatar'];
}
/*
<table border="0" style="font-size:11px;">
<tr>
<td width="75" style="vertical-align:top;"><img src=https://img.youtube.com/vi/'.$video['id_video'].'/0.jpg width="75" height="auto"></td>
<td style="vertical-align:0;">
<div id="content-wall-post" style="width:320px;">
<div id="content-wall-post-infoofpost">
<div id="content-wall-post-authorofpost">
<b style="margin-right:3px;"><a href="video.php?id='.$video['id'].'">'.$video['name'].'</a></b>
</div>
<div id="content-wall-post-text">
'.$video['about'].'
</div>
</div>
</div>
</td>
</tr>
</table>
<br><br>

*/
echo '

	<div id="content-main-gray-content">
		<table border="0" style="font-size: 11px;">
		<tbody>	
			<tr>
				<td width="120" style="vertical-align: top;">
					<div style="background:url(https://img.youtube.com/vi/'.substr($video['id_video'], 0, 12).'/0.jpg);background-size:100%;width:120px;height:90px;"></div>		
				</td>
				<td style="vertical-align: 0;">
					<div id="content-main-gray-content-info"><a href="video.php?id='.$video['id'].'"><b>'.substr($video['name'], 0, 60).'</b></a><br>'.$video['about'].'<br>Добавлено '.zmdate($video['date']).'<br></div>
				</td>
			</tr>
		</tbody>
		</table>
	</div>
';
}
if($av == ""){
	if ($id == $_SESSION['id']) {
		echo '<div style="margin:0 -10px;padding:55px;"><center><img src="img/error.png"><br><br><b style="font-size:25px;">Здесь ничего нет...</b><br><text style="font-size:14px;"><a href="add_video.php">Попробуйте добавить свою видеозапись</a> или <a href="search.php?type=videos&sort_by=random">посмотрите видеозаписи от других пользователей</a>.</text></center></div>';
	}else{
		echo '<div style="margin:0 -10px;padding:55px;"><center><img src="img/error.png"><br><br><b style="font-size:25px;">Здесь ничего нет...</b><br><text style="font-size:14px;">Извините, но этот пользователь не добавил ни одного видеоролика. <a href="search.php?type=videos&sort_by=random">Посмотрите видеозаписи от других пользователей</a>.</text></center></div>';
	}

}
?>
</div>
</div>
<div style="float:right;width:200px;margin-top:-8px;">
<div style="margin:10px;">
<a id="aprofile" href="add_video.php">Добавить видеозапись</a>
<hr style="margin-left:-14px;margin-right:-20px;margin-top:10px;margin-bottom:10px;">
<a id="aprofile" href="videos.php?id=<?php echo $id; ?>&sort_by=random">Сортировать рандомно</a>
<a id="aprofile" href="videos.php?id=<?php echo $id; ?>&sort_by=date1">Сортировать по дате создания (увеличение)</a>
<a id="aprofile" href="videos.php?id=<?php echo $id; ?>&sort_by=date2">Сортировать по дате создания (убывание)</a>
</div>
</div>
</div>
<div>
<?php include 'exec/footer.php'; ?>
</div>
</body>
</html>
<?php } ?>