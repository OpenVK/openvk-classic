<?
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
include('exec/header.php');
include('exec/leftmenu.php'); 
include 'exec/datefn.php';

if ($_GET['id'] == null) {
	$id = $_SESSION['id'];
}

if ($_GET['id'] != '') {
	$id = $_GET['id'];
}else{
	$id = $_SESSION['id'];
}
$qs = $dbh1->prepare("SELECT * FROM note WHERE `aid` = '".$id."' ORDER BY id DESC");
$qs->execute();


$userr = $dbh1->prepare("SELECT * FROM users WHERE id = '".$id."'");
$userr->execute();
$userrr = $userr->fetch();
?>
<div id="content-infoname"><b><?php echo '<a href="id'.$userrr['id'].'">'.$userrr['name'].' '.$userrr['surname'].'</a>' ?> » Заметки</b><?php if($_SESSION['id'] == $id){?><text style="font-size: 8pt; color: #aaa; float: right;"><a href="note_add.php">Добавить запись</a></text><?php } ?></div>
<br>
<?php
   $qnotesscount = $dbh1->prepare("SELECT COUNT(1) FROM note WHERE `aid` = '".$id."'");
   $qnotesscount -> execute();
   $notecount = $qnotesscount->fetch();
   $notecount = $notecount[0];
   if ($notecount == '1') {
     $notecouunt = (string)$notecount." заметка";
   }elseif ($notecount == '2' OR $notecount == '3' OR $notecount == '4') {
     $notecouunt = (string)$notecount." заметки";
   }else{
     $notecouunt = (string)$notecount." заметок";
   }
   echo '<b>'.$notecouunt.'</b><br>';?>
<div id="content-main-gray">

<?php
while($note = $qs->fetch()){

echo '
		<table border="0" style="font-size: 11px;">
		<tbody>	
			<tr>
				<td width="16" style="vertical-align: top;">
					<img src="img/note.gif">
				</td>
				<td style="vertical-align: 0;">
					<a href="note'.$note['id'].'"><h4><b>'.$note['name'].'</b></h4></a><span><br>Написана '.zmdate($note['date']).'</span><br>
				</td>
			</tr>
		</tbody>
		</table>
	';
}
?>
	
</div>
</div>
<? include ('exec/footer.php'); ?>
</body>
</html>