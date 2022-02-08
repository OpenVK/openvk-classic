<?php 
session_start();
include 'exec/dbconnect.php';
include 'exec/check_user.php';
if($_SESSION['userwall'] != $_SESSION['id']){
$qcf = $dbh1->prepare("SELECT * FROM friends WHERE `id1` = '".$_SESSION['id']."' AND `id2` = '".$_SESSION['userwall']."'");
$qcf->execute();
$cf = $qcf->fetch();
$qcf2 = $dbh1->prepare("SELECT * FROM friends WHERE `id1` = '".$_SESSION['userwall']."' AND `id2` = '".$_SESSION['id']."'");
$qcf2->execute();
$cf2 = $qcf2->fetch();
if($cf['id1'] == $_SESSION['id'] && $cf['id2'] == $_SESSION['userwall'] && $cf2['id1'] == $_SESSION['userwall'] && $cf2['id2'] == $_SESSION['id']){
$q = $dbh1->prepare("DELETE FROM friends WHERE `id1` = '".$_SESSION['id']."' AND `id2` = '".$_SESSION['userwall']."'");
$q->execute();
$q->fetch();
$q2 = $dbh1->prepare("DELETE FROM friends WHERE `id1` = '".$_SESSION['userwall']."' AND `id2` = '".$_SESSION['id']."'");
$q2->execute();
$q2->fetch();
$q3 = $dbh1->prepare("INSERT INTO subs (`id`, `id1`, `id2`) VALUES (NULL, '".$_SESSION['userwall']."', '".$_SESSION['id']."')");
$q3->execute();
$q3->fetch();
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