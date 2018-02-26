<?php 
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
if($_SESSION['loginin'] == "1"){
include('exec/dbconnect.php');
$qchu = $dbh1->prepare("SELECT * FROM users WHERE id = '".$_SESSION['id']."'");
$qchu->execute();
$chu = $qchu->fetch();
if($chu['verify'] == "3" || $chu['verify'] == "5" || $_SESSION['groupu'] == "2"){
if(empty($_GET['type']) || $_GET['type'] == "bugs"){
if($_POST['bug_create']){
if($_POST['bug_name'] == NULL){
echo '<meta charset="utf-8">мы не можем создать безымянный отчет, извините.';
exit();
}
$_POST['bug_name'] = htmlentities($_POST['bug_name'],ENT_QUOTES);
$_POST['bug_about'] = htmlentities($_POST['bug_about'],ENT_QUOTES);
$_POST['bug_about'] = str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['bug_about']);
$_POST['bug_name'] = str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['bug_name']);
$q = "INSERT INTO `bugtracker` (`id`, `name`, `about`, `photo`, `important`,`aid`, `status`, `date`) VALUES (NULL, '".$_POST['bug_name']."', '".$_POST['bug_about']."', '', '2','".$_SESSION['id']."', '1', '".time()."')";
$q1 = $dbh1->prepare($q);
$q1 -> execute();
$q1->fetch();
header("Location: bugtracker.php");
exit();
}
include('exec/header.php');
include('exec/leftmenu.php');
?>
<div>
<div id="content-infoname"><b>Создание отчета</b></div>
<form action="add_bug.php" method="post">
<table border="0" style="font-size:11px;">
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Заголовок:</div></td><td><input id="text" style="width:380px;" name="bug_name" maxlength="45"></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Описание:</div></td><td><textarea style="min-width:380px;max-width:380px;" id="text" nkeypress="return isNotMax(this)" name="bug_about"></textarea></td></tr>
<!-- <tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Картинка (imgur.com):</div></td><td><input id="text" style="width:380px;" name="bug_photo" ></td></tr> -->
<b>Ссылку на картинку оставлять в описании!!!</b><br><br>
<script type="text/javascript">
	function isNotMax(oTextArea) {
    return oTextArea.value.length <= oTextArea.getAttribute('maxlength');
}
</script>
</table><br>
<div style="margin-left:157px;"><input type="submit" id="button" value="Добавить отчет" name="bug_create"></div>
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
<?php }}else{echo '<meta charset="utf-8">Извините, но баг-трекер работает только для тестеров.';
exit();}}else if($_SESSION['loginin'] != "1"){
echo '<meta charset="utf-8">Пожалуйста, авторизируйтесь.<meta http-equiv="refresh" content="3;blank/../">';
exit();
}
?>