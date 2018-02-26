<?php 
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
if($_SESSION['loginin'] == "1"){
if($_POST['note_create']){
if($_POST['note_name'] == NULL){
echo '<meta charset="utf-8">мы не можем для вас создать безымянную группу, извините.';
exit();
}
$_POST['note_name'] = htmlentities($_POST['note_name'],ENT_QUOTES);
$_POST['note_about'] = htmlentities($_POST['note_about'],ENT_QUOTES);
$_POST['note_name'] = str_replace(array("\r\n", "\r", "\n", "<", ">"), '<br>', $_POST['note_name']);
$_POST['note_about'] = str_replace(array("\r\n", "\r", "\n", "<", ">"), '<br>', $_POST['note_about']);
$q = "INSERT INTO `note` (`id`, `name`, `text`, `aid`, `date`) VALUES (NULL, '".$_POST['note_name']."', '".$_POST['note_about']."', '".$_SESSION['id']."', '".time()."')";
$q1 = $dbh1->prepare($q);
$q1 -> execute();
$q1->fetch();
$q2 = $dbh1->prepare("SELECT * FROM note WHERE `text` = '".$_POST['note_about']."' AND `aid` = '".$_SESSION['id']."'");
$q2->execute();
$clb = $q2->fetch();
$clb = $clb['id'];
header("Location: note".$clb);
exit();
}
include('exec/header.php');
include('exec/leftmenu.php');
?>
<div>
<div id="content-infoname"><b>Создание заметки</b></div>
<form action="note_add.php" method="post">
<table border="0" style="font-size:11px;">
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Название заметки:</div></td><td><input id="text" style="width:380px;" name="note_name" maxlength="255"></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Содержание:</div></td><td><textarea style="min-width:380px;max-width:380px;" id="text" nkeypress="return isNotMax(this)" name="note_about"></textarea></td></tr>
<script type="text/javascript">
	function isNotMax(oTextArea) {
    return oTextArea.value.length <= oTextArea.getAttribute('maxlength');
}
</script>
</table><br>
<div style="margin-left:157px;"><input type="submit" id="button" value="Опубликовать" name="note_create"></div>
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