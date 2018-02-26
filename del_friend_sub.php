<?php 
session_start();
include 'exec/dbconnect.php';
include 'exec/check_user.php';
if($_SESSION['userwall'] != $_SESSION['id']){
if($_GET['id']){
$qcf = $dbh1->prepare("SELECT * FROM subs WHERE `id1` = '".$_SESSION['id']."' AND `id2` = '".$_GET['id']."'");
$qcf->execute();
$cf = $qcf->fetch();
if($cf['id1'] == $_SESSION['id'] && $cf['id2'] == $_GET['id']){
$q = $dbh1->prepare("DELETE FROM subs WHERE `id1` = '".$_SESSION['id']."' AND `id2` = '".$_GET['id']."'");
$q->execute();
$q->fetch();
header("Location: friends.php");
}else{
echo '...';
exit();
}
}
$qcf = $dbh1->prepare("SELECT * FROM subs WHERE `id1` = '".$_SESSION['id']."' AND `id2` = '".$_SESSION['userwall']."'");
$qcf->execute();
$cf = $qcf->fetch();
if($cf['id1'] == $_SESSION['id'] && $cf['id2'] == $_SESSION['userwall']){
$q = $dbh1->prepare("DELETE FROM subs WHERE `id1` = '".$_SESSION['id']."' AND `id2` = '".$_SESSION['userwall']."'");
$q->execute();
$q->fetch();
header("Location: id".$_SESSION['userwall']);
}else{
echo '...';
exit();
}
}else{
echo '...';
exit();
}
?>