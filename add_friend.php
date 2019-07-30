<?php 
session_start();
include 'exec/dbconnect.php';
include 'exec/check_user.php';
if($_GET['id']){
$qcf = $dbh1->prepare("SELECT * FROM subs WHERE `id1` = '".$_GET['id']."' AND `id2` = '".$_SESSION['id']."'");
$qcf->execute();
$cf = $qcf->fetch();
	if($cf['id1'] == $_GET['id'] && $cf['id2'] == $_SESSION['id']){
		$qcfch = $dbh1->prepare("SELECT * FROM friends WHERE `id1` = '".$_SESSION['id']."' AND `id2` = '".$_GET['id']."'");
	$qcfch->execute();
	$cfch = $qcf->fetch();
		if (empty($cfch['id'])) {
	$q = $dbh1->prepare("DELETE FROM subs WHERE `id1` = '".$_GET['id']."' AND `id2` = '".$_SESSION['id']."'");
	$q->execute();
	$q->fetch();
	$q2 = $dbh1->prepare("INSERT INTO friends (`id`, `id1`, `id2`) VALUES (NULL, '".$_SESSION['id']."', '".$_GET['id']."')");
	$q2->execute();
	$q2->fetch();
	$q3 = $dbh1->prepare("INSERT INTO friends (`id`, `id1`, `id2`) VALUES (NULL, '".$_GET['id']."', '".$_SESSION['id']."')");
	$q3->execute();
	$q3->fetch();
	header("Location: id".$_SESSION['userwall']);
	}else{
		exit('You already friends');
	}
	}else{
	echo '...';
	exit();
	}
}else{
	$qcf = $dbh1->prepare("SELECT * FROM subs WHERE `id1` = '".$_SESSION['userwall']."' AND `id2` = '".$_SESSION['id']."'");
$qcf->execute();
$cf = $qcf->fetch();
if($cf['id1'] == $_SESSION['userwall'] && $cf['id2'] == $_SESSION['id']){
	$qcfch = $dbh1->prepare("SELECT * FROM friends WHERE `id1` = '".$_SESSION['id']."' AND `id2` = '".$_SESSION['userwall']."'");
	$qcfch->execute();
	$cfch = $qcf->fetch();
	if (empty($cfch['id'])) {
		
	$q = $dbh1->prepare("DELETE FROM subs WHERE `id1` = '".$_SESSION['userwall']."' AND `id2` = '".$_SESSION['id']."'");
	$q->execute();
	$q->fetch();
	
	$q2 = $dbh1->prepare("INSERT INTO friends (`id`, `id1`, `id2`) VALUES (NULL, '".$_SESSION['id']."', '".$_SESSION['userwall']."')");
	$q2->execute();
	$q2->fetch();
	$q3 = $dbh1->prepare("INSERT INTO friends (`id`, `id1`, `id2`) VALUES (NULL, '".$_SESSION['userwall']."', '".$_SESSION['id']."')");
	$q3->execute();
	$q3->fetch();
	header("Location: id".$_SESSION['userwall']);
	}else{
		exit('You already friends');
	}
}else{
	echo '...';
	exit();
}
}

?>