<?php 
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
if($_SESSION['loginin'] == "1"){
if($_POST['group_create']){
if($_POST['group_name'] == NULL){
echo '<meta charset="utf-8">мы не можем для вас создать безымянную группу, извините.';
exit();
}
if($_POST['group_name'] == ' '){
	echo '<meta charset="utf-8">Низя просто взять и поставить пробел.';
	exit();
}
$_POST['group_name'] = htmlentities($_POST['group_name'],ENT_QUOTES);
$_POST['group_about'] = htmlentities($_POST['group_about'],ENT_QUOTES);
$_POST['group_name'] = str_replace(array("\r\n", "\r", "\n", "&nbsp;", "<br>"), ' ', $_POST['group_name']);
$_POST['group_about'] = str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['group_about']);
$q = "INSERT INTO `club` (`id`, `name`, `about`, `authorid`, `type`) VALUES (NULL, '".$_POST['group_name']."', '".$_POST['group_about']."', '".$_SESSION['id']."', '".$_POST['group_type']."')";
$q1 = $dbh1->prepare($q);
$q1 -> execute();
$q1->fetch();
$q2 = $dbh1->prepare("SELECT * FROM `club` WHERE `name` = '".$_POST['group_name']."' AND `authorid` = '".$_SESSION['id']."'");
$q2->execute();
$clb = $q2->fetch();
$clb = $clb['id'];
$q3 = $dbh1->prepare("INSERT INTO `clubsub` (`id`, `id1`, `id2`) VALUES (NULL, '".$_SESSION['id']."', '".$clb."')");
$q3->execute();
$q3->fetch();
header("Location: club".$clb);
exit();
}
include('exec/header.php');
include('exec/leftmenu.php');
?>
<div>
<div id="content-infoname"><b>Создание группы</b></div>
<form action="create_group.php" method="post">
<table border="0" style="font-size:11px;">
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Название группы:</div></td><td><input id="text" style="width:380px;" name="group_name" maxlength="255"></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">О группе:</div></td><td><textarea style="min-width:380px;max-width:380px;" id="text" nkeypress="return isNotMax(this)" name="group_about" maxlength="500"></textarea></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Тип:</div></td><td>
<select name="group_type">
	<option value="0">Группа</option>
	<option value="1" <?php if ($_GET['meeting'] == "1") {
		echo " selected";
	}?>>Встреча</option>
</select>
</td></tr>

<script type="text/javascript">
	function isNotMax(oTextArea) {
    return oTextArea.value.length <= oTextArea.getAttribute('maxlength');
}
</script>
</table><br>
<div style="margin-left:157px;"><input type="submit" id="button" value="Создать группу" name="group_create"></div>
</form>
</div>
 </div>
 </div>
 </div>
 <div>
 <? include('exec/footer.php'); ?>
 </div>
 </div>
 </body>
</html>
<?php }else if($_SESSION['loginin'] != "1"){
echo '<meta charset="utf-8">Пожалуйста, авторизируйтесь.<meta http-equiv="refresh" content="3;blank/../">';
exit();
}
?>