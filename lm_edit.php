<?php 
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
if($_SESSION['loginin'] == "1"){

if(isset($_POST['fr']) &&
   $_POST['fr'] == '1')
{
    $fr = "1";
}
else
{
    $fr = "0";
}

if(isset($_POST['ph']) &&
   $_POST['ph'] == '1')
{
    $ph = "1";
}
else
{
    $ph = "0";
}

if(isset($_POST['vd']) &&
   $_POST['vd'] == '1')
{
    $vd = "1";
}
else
{
    $vd = "0";
}

if(isset($_POST['im']) &&
   $_POST['im'] == '1')
{
    $im = "1";
}
else
{
    $im = "0";
}

if(isset($_POST['zm']) &&
   $_POST['zm'] == '1')
{
    $zm = "1";
}
else
{
    $zm = "0";
}

if(isset($_POST['gp']) &&
   $_POST['gp'] == '1')
{
    $gp = "1";
}
else
{
    $gp = "0";
}

if(isset($_POST['vs']) &&
   $_POST['vs'] == '1')
{
    $vs = "1";
}
else
{
    $vs = "0";
}

if(isset($_POST['fd']) &&
   $_POST['fd'] == '1')
{
    $fd = "1";
}
else
{
    $fd = "0";
}
$fstyle = $fr.$ph.$vd.$im.$zm.$gp.$vs.$fd;
$q = "UPDATE `users` SET `lms` = '".$fstyle."' WHERE `users`.`id` = '".$_SESSION['id']."'";
$q1 = $dbh1->prepare($q);
$q1 -> execute();
$q1->fetch();
header('Location: settings.php?act=suc');
exit();
}else{
echo '<meta charset="utf-8">Пожалуйста, авторизируйтесь.<meta http-equiv="refresh" content="3;blank/../">';
}
?>