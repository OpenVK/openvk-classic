<?php 
session_start();
include 'exec/dbconnect.php';
include 'exec/check_user.php';

if($_GET['id']){
	$qcff = $dbh1->prepare("SELECT * FROM club WHERE `id` = '".$_GET['club']."'");
$qcff->execute();
$cff = $qcff->fetch();
if ($cff['authorid'] == $_SESSION['id']) {
	
$qcf = $dbh1->prepare("SELECT * FROM clubsubrequest WHERE `id1` = '".$_GET['id']."' AND `id2` = '".$_GET['club']."'");
$qcf->execute();
$cf = $qcf->fetch();
if($cf['id1'] == $_GET['id'] && $cf['id2'] == $_GET['club']){
$q = $dbh1->prepare("DELETE FROM clubsubrequest WHERE `id1` = '".$_GET['id']."' AND `id2` = '".$_GET['club']."'");
$q->execute();
$q->fetch();
$q3 = $dbh1->prepare("INSERT INTO clubsub (`id`, `id1`, `id2`) VALUES (NULL, '".$_GET['id']."', '".$_GET['club']."')");
$q3->execute();
$q3->fetch();
header("Location: gsettings.php?id=".$_GET['club']);
}else{
echo '... 1';
exit();
}
}else{
	echo '... 2';
exit();
}
}

?>