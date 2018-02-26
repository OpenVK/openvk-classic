<?php
session_start();
include 'exec/dbconnect.php';
include('exec/check_user.php');
$_GET['id'] = htmlentities($_GET['id'],ENT_QUOTES);
$_GET['id'] = str_replace(array("\r\n", "\r", "\n", "<", ">", "<script>"), '<br>', $_GET['id']);
	$id;
if ($_GET['id'] != '') {
	$id = $_GET['id'];
}
include 'exec/datefn.php';
include 'exec/header.php';
include 'exec/leftmenu.php';
if($_GET['sort_by'] == "date1"){
$qs = $dbh1->prepare("SELECT * FROM clubsub WHERE id2 = '".$id."'");
}elseif($_GET['sort_by'] == "date2"){
$qs = $dbh1->prepare("SELECT * FROM clubsub WHERE id2 = '".$id."' ORDER BY id DESC");
}elseif(empty($_GET['sort_by']) || $_GET['sort_by'] == "random"){
$qs = $dbh1->prepare("SELECT * FROM clubsub WHERE id2 = '".$id."' ORDER BY RAND()");
}
$qs->execute();


$userr = $dbh1->prepare("SELECT * FROM club WHERE id = '".$id."'");
$userr->execute();
$userrr = $userr->fetch();
?>
<div id="content-infoname"><b><?php echo '<a href="club'.$userrr['id'].'">'.$userrr['name'].'</a>' ?> » Участники</b></div>
<div style="min-width:0;width:415px;min-height:300px;float:left;margin-top:-10px;border-right:#BEBEBE solid 1px;">
<br>
<?php
while($us = $qs->fetch()){
$qu = $dbh1->prepare("SELECT * FROM users WHERE id = '".$us['id1']."'");
$qu->execute();
$user = $qu->fetch();
if($user['avatar']){
$av = $user['avatar'];
$user['avatar'] = 'avatart.php?image='.$user['avatar'];
}else{
$user['avatar'] = "img/camera_200.png";
$av = $user['avatar'];
}

if($user['verify'] == "1"){
$ver = ' <img src="img/verify.png" width="12" height="12" style="margin-left:0;margin-right:0;">';
}elseif($user['verify'] == "5"){
$ver = ' <img src="img/verify_orange.png" width="12" height="12" style="margin-left:0;margin-right:0;">';
}elseif($user['verify'] == "3"){
$ver = ' <img src="data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2216%22%20height%3D%2216%22%20viewBox%3D%220%200%2016%2016%22%3E%0A%20%20%3Cg%20fill%3D%22none%22%20fill-rule%3D%22evenodd%22%3E%0A%20%20%20%20%3Cpath%20fill%3D%22%2374A2D6%22%20d%3D%22M5.82331983%2C14.8223666%20L4.54259486%2C15.0281417%20C4.15718795%2C15.0900653%203.78122933%2C14.8730055%203.64215331%2C14.5082715%20L3.17999726%2C13.2962436%20C3.09635683%2C13.0768923%202.92310766%2C12.9036432%202.70375635%2C12.8200027%20L1.49172846%2C12.3578467%20C1.12699447%2C12.2187707%200.909934662%2C11.842812%200.971858288%2C11.4574051%20L1.17763336%2C10.1766802%20C1.21487428%2C9.94489615%201.15146068%2C9.70823338%201.00331709%2C9.52612299%20L0.184748166%2C8.51987017%20C-0.0615827221%2C8.21705981%20-0.0615827221%2C7.78294019%200.184748166%2C7.48012983%20L1.00331709%2C6.47387701%20C1.15146068%2C6.29176662%201.21487428%2C6.05510385%201.17763336%2C5.82331983%20L0.971858288%2C4.54259486%20C0.909934662%2C4.15718795%201.12699447%2C3.78122933%201.49172846%2C3.64215331%20L2.70375635%2C3.17999726%20C2.92310766%2C3.09635683%203.09635683%2C2.92310766%203.17999726%2C2.70375635%20L3.64215331%2C1.49172846%20C3.78122933%2C1.12699447%204.15718795%2C0.909934662%204.54259486%2C0.971858288%20L5.82331983%2C1.17763336%20C6.05510385%2C1.21487428%206.29176662%2C1.15146068%206.47387701%2C1.00331709%20L7.48012983%2C0.184748166%20C7.78294019%2C-0.0615827221%208.21705981%2C-0.0615827221%208.51987017%2C0.184748166%20L9.52612299%2C1.00331709%20C9.70823338%2C1.15146068%209.94489615%2C1.21487428%2010.1766802%2C1.17763336%20L11.4574051%2C0.971858288%20C11.842812%2C0.909934662%2012.2187707%2C1.12699447%2012.3578467%2C1.49172846%20L12.8200027%2C2.70375635%20C12.9036432%2C2.92310766%2013.0768923%2C3.09635683%2013.2962436%2C3.17999726%20L14.5082715%2C3.64215331%20C14.8730055%2C3.78122933%2015.0900653%2C4.15718795%2015.0281417%2C4.54259486%20L14.8223666%2C5.82331983%20C14.7851257%2C6.05510385%2014.8485393%2C6.29176662%2014.9966829%2C6.47387701%20L15.8152518%2C7.48012983%20C16.0615827%2C7.78294019%2016.0615827%2C8.21705981%2015.8152518%2C8.51987017%20L14.9966829%2C9.52612299%20C14.8485393%2C9.70823338%2014.7851257%2C9.94489615%2014.8223666%2C10.1766802%20L15.0281417%2C11.4574051%20C15.0900653%2C11.842812%2014.8730055%2C12.2187707%2014.5082715%2C12.3578467%20L13.2962436%2C12.8200027%20C13.0768923%2C12.9036432%2012.9036432%2C13.0768923%2012.8200027%2C13.2962436%20L12.3578467%2C14.5082715%20C12.2187707%2C14.8730055%2011.842812%2C15.0900653%2011.4574051%2C15.0281417%20L10.1766802%2C14.8223666%20C9.94489615%2C14.7851257%209.70823338%2C14.8485393%209.52612299%2C14.9966829%20L8.51987017%2C15.8152518%20C8.21705981%2C16.0615827%207.78294019%2C16.0615827%207.48012983%2C15.8152518%20L6.47387701%2C14.9966829%20C6.29176662%2C14.8485393%206.05510385%2C14.7851257%205.82331983%2C14.8223666%20L5.82331983%2C14.8223666%20Z%22%2F%3E%0A%20%20%20%20%3Cpolyline%20stroke%3D%22%23FFFFFF%22%20stroke-width%3D%221.6%22%20points%3D%224.755%208.252%207%2010.5%2011.495%206.005%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%2F%3E%0A%20%20%3C%2Fg%3E%0A%3C%2Fsvg%3E" width="13" height="12" style="margin-left:0;margin-right:0;">';
}else{
$ver = '';
}
if($user['aboutuser2']){
$abo = '<div class="labeled fl_l" style="width:210px;">'.$user['aboutuser2'].'</div>';
}else{
$abo = '<div class="labeled fl_l" style="width:210px;"><i>&#60;нет информации&#62;</i></div>';
}
if ($user['gender'] == '1') {
$gen = '<div class="labeled fl_l" style="width:210px;">Мужской</div>';
}else if ($user['gender'] == '2'){ 
$gen = '<div class="labeled fl_l" style="width:210px;">Женский</div>';
}else if ($user['gender'] == '0'){
$gen = '<div class="labeled fl_l" style="width:210px;"><i>&#60;не указано&#62;</i></div>';
}
if($user['ban'] != '1'){
echo '<table border="0" style="font-size:11px;">
<tr>
<td width="75" style="vertical-align:top;"><img src="'.$user['avatar'].'" width="75" height="auto"></td>
<td style="vertical-align:0;">
<div id="content-wall-post" style="width:320px;">
<div id="content-wall-post-infoofpost">
<div id="content-wall-post-authorofpost">
<b style="margin-right:3px;"><a href="id'.$user['id'].'">'.$user['name'].' '.$user['surname'].'</a></b>'.$ver.'
</div>
<div id="content-wall-post-text">
<div class="profile_info" class="clear_fix"><div class="clear_fix">
<div class="label fl_l" style="width:90px;">День рождения:</div>
<div class="labeled fl_l" style="width:210px;">'.zmbd($user['birthdate']).' г.</div></div><div class="clear_fix">
<div class="label fl_l" style="width:90px;">Пол:</div>
'.$gen.'</div><div class="clear_fix">
<div class="label fl_l" style="width:90px;">Коротко о себе:</div>
'.$abo.'<br>
</div></div>
</div>
</div>
</div>
</td>
</tr>
</table>
<br><br>';
}
}

if($av == ""){
echo '<div style="margin:0 -10px;padding:55px;"><center><img src="img/error.png"><br><br><b style="font-size:25px;">Упс...</b><br><text style="font-size:14px;">В группе нету участников...</text></center></div>';
}
?>
</div>
<div style="float:right;width:200px;margin-top:-8px;">
<div style="margin:10px;">
<a id="aprofile" href="participants.php?sort_by=random&id=<?php echo $id; ?>">Сортировать рандомно</a>
<a id="aprofile" href="participants.php?sort_by=date1&id=<?php echo $id; ?>">Сортировать по дате регистрации (увеличение)</a>
<a id="aprofile" href="participants.php?sort_by=date2&id=<?php echo $id; ?>">Сортировать по дате регистрации (убывание)</a>
</div>
</div>
</div>
<div>
<?php include 'exec/footer.php'; ?>
</div>
</body>
</html>