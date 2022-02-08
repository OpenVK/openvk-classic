<?php
if($_SESSION['loginin'] == "1"){
$qchuf = $dbh1->prepare("SELECT * FROM users WHERE id = '".$_SESSION['id']."'");
$qchuf->execute();
$chuf = $qchuf->fetch();
if($_SESSION['pass'] != $chuf['password'] || $_SESSION['id'] != $chuf['id']){
session_destroy();
$_SESSION['errormsg'] = "Пожалуйста, переавторизируйтесь.";
header("Location: index.php");
}
if($_SESSION['groupu'] != $chuf['groupu'] || $_SESSION['admin'] != $chuf['groupu']){
$_SESSION['groupu'] = $chuf['groupu'];
$_SESSION['admin'] = $chuf['groupu'];
}
if($chuf['ban'] == "1"){
echo '<meta charset="utf-8">Вы забанены!<meta http-equiv="refresh" content="3;blank/..">';
session_destroy();
exit();
}
}
?>