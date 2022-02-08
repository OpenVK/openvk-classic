<?php 
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
if($_SESSION['loginin'] == "1"){
if($_POST['group_create']){
if($_POST['video_name'] == NULL){
echo '<meta charset="utf-8">йоу, название введи, чел ;)';
exit();
}if($_POST['id_video'] == NULL){
echo '<meta charset="utf-8">вы забыли ввести код видео';
exit();
}
$_POST['video_name'] = htmlentities($_POST['video_name'],ENT_QUOTES);
$_POST['video_about'] = htmlentities($_POST['video_about'],ENT_QUOTES);
$_POST['video_name'] = str_replace(array("\r\n", "\r", "\n", "<", ">"),'<br>', $_POST['video_name']);
$_POST['video_about'] = str_replace(array("\r\n", "\r", "\n", "<", ">"),'<br>', $_POST['video_about']);
$_POST['id_video'] = str_replace(array("\r\n", "\r", "\n", "<", ">"),'<br>', $_POST['id_video']);
$q = "INSERT INTO `video` (`id`, `name`, `id_video`, `about`, `aid`, `date`) VALUES (NULL, '".$_POST['video_name']."', '".$_POST['id_video']."','".$_POST['video_about']."','".$_SESSION['id']."', '".time()."')";
$q1 = $dbh1->prepare($q);
$q1 -> execute();
$q1->fetch();
header("Location: videos.php");
exit();
}
include('exec/header.php');
include('exec/leftmenu.php');
?>
<div>
<div id="content-infoname"><b>Добавление видеозаписи</b></div>
<form action="add_video.php" method="post">
<table border="0" style="font-size:11px;">
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Название видео:</div></td><td><input id="text" style="width:380px;" name="video_name" maxlength="255"></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">О видео:</div></td><td><textarea style="min-width:380px;max-width:380px;" id="text" nkeypress="return isNotMax(this)" name="video_about" maxlength="500"></textarea></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Код видео:</div></td><td><input id="text" style="width:380px;" name="id_video" maxlength="13"></td></tr>
<script type="text/javascript">
	function isNotMax(oTextArea) {
    return oTextArea.value.length <= oTextArea.getAttribute('maxlength');
}
</script>
</table><br>
<center><img src="https://i.imgur.com/XzlcKOM.png"></center><br>
<div style="margin-left:157px;"><input type="submit" id="button" value="Добавить видеозапись" name="group_create"></div>
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