<?php 
session_start();
include 'exec/dbconnect.php';
include 'exec/check_user.php';
$qcf = $dbh1->prepare("SELECT * FROM clubsubrequest WHERE `id1` = '".$_SESSION['id']."' AND `id2` = '".$_GET['id']."'");
$qcf->execute();
$cf = $qcf->fetch();
if($cf['id1'] == $_SESSION['id'] && $cf['id2'] == $_GET['id']){
echo '...';
exit();
}else{
$q = $dbh1->prepare("INSERT INTO clubsubrequest (`id`, `id1`, `id2`) VALUES (NULL, '".$_SESSION['id']."', '".$_GET['id']."')");
$q->execute();
$q->fetch();
header("Location: club".$_GET['id']);
}
?>