<?php 
session_start();
include 'exec/dbconnect.php';
include 'exec/check_user.php';
if($_SESSION['userwall'] != $_SESSION['id']){
$qcf = $dbh1->prepare("SELECT * FROM subs WHERE `id1` = '".$_SESSION['id']."' AND `id2` = '".$_SESSION['userwall']."'");
$qcf->execute();
$cf = $qcf->fetch();
if($cf['id1'] == $_SESSION['id'] && $cf['id2'] == $_SESSION['userwall']){
echo '...';
exit();
}else{
$q = $dbh1->prepare("INSERT INTO subs (`id`, `id1`, `id2`) VALUES (NULL, '".$_SESSION['id']."', '".$_SESSION['userwall']."')");
$q->execute();
$q->fetch();
header("Location: id".$_SESSION['userwall']);
}
}else{
echo '...';
exit();
}
?>