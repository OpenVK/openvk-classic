<?php
session_start();
include 'exec/dbconnect.php';
include 'exec/check_user.php';
if($_SESSION['loginin'] == "1"){
if($_SESSION['clubwall']){
$qc = $dbh1->prepare("SELECT * FROM clubsub WHERE id1 = '".$_SESSION['id']."' AND id2 = '".$_SESSION['clubwall']."'");
$qc->execute();
$c = $qc->fetch();
if($c['id1'] == $_SESSION['id'] && $c['id2'] == $_SESSION['clubwall']){
echo '...';
exit();
}else{
$q = $dbh1->prepare("INSERT INTO `clubsub` (`id`, `id1`, `id2`) VALUES (NULL, '".$_SESSION['id']."', '".$_SESSION['clubwall']."')");
$q->execute();
$q->fetch();
header("Location: club".$_SESSION['clubwall']);
}
}else{
echo '...';
exit();
}}else{
echo '<meta charset="utf-8">Хакеры? Интересно.<meta http-equiv="refresh" content="3;blank/..">';
exit();
}
?>