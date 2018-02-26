<?php 
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
if($_SESSION['loginin'] == "1"){
include('exec/header.php');
include('exec/leftmenu.php');

?>
<div>
<div id="content-infoname"><b>Загрузка фотографии</b></div>
<form action="add_photoinalbum.php" enctype="multipart/form-data" method="post">
<table border="0" style="font-size:11px;">
	<?php $_SESSION['idalbum'] = $_GET['id'] ?>
	<tr><td style="width: 150px;"></td><td>Внимание! Большие фото (с фотоаппарата например) он не переваривает, пожалуйста, пережмите файл.</td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Фотография:</div></td><td><input type="file" accept="image/jpeg,image/png,image/gif" name="picture"></td></tr>
</table><br>
<div style="margin-left:157px;"><input type="submit" id="button" value="Загрузить фотографию"></div>
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