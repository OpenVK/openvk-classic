<?php
session_start();
include 'exec/dbconnect.php';
include 'exec/check_user.php';
if($_SESSION['loginin'] == "1"){
if($_SESSION['clubwall']){
$qc = $dbh1->prepare("SELECT * FROM clubsub WHERE id2 = '".$_SESSION['clubwall']."'");
$qc->execute();

while ($c = $qc->fetch()) {
	
if($c['id1'] == $_SESSION['id'] && $c['id2'] == $_SESSION['clubwall']){
$q = $dbh1->prepare("DELETE FROM clubsub WHERE id = '".$c['id']."'");
$q->execute();
$q->fetch();

}
}
header("Location: club".$_SESSION['clubwall']);

}else{
echo '... 2';
exit();
}}else{
echo '<meta charset="utf-8">Хакеры? Интересно.<meta http-equiv="refresh" content="3;blank/..">';
exit();
}
?>