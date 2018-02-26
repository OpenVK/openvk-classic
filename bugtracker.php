<?php
session_start();
include 'exec/dbconnect.php';
include('exec/check_user.php');
if($_SESSION['loginin'] == "1" ){
$qchu = $dbh1->prepare("SELECT * FROM users WHERE id = '".$_SESSION['id']."'");
$qchu->execute();
$chu = $qchu->fetch();
if($chu['verify'] == "3" || $chu['verify'] == "5" || $chu['verify'] == "4" || $_SESSION['groupu'] == "2"){
if(empty($_GET['type']) || $_GET['type'] == "bugs"){
include 'exec/datefn.php';
include 'exec/header.php';
include 'exec/leftmenu.php';
$qs = $dbh1->prepare('SELECT * FROM bugtracker ORDER BY date DESC');
$qs->execute();
?>
<div id="content-infoname"><b>Все отчеты</b><div style="float:right;"><a href="add_bug.php">Создать отчет</a></div></div>
<div style="min-width:0;width:420px;float:left;margin-top:-10px;border-right:#BEBEBE solid 1px;">
<br>
<a href="rule.php?id=2"><img src="https://i.imgur.com/zBPRUBM.png"></a>
<?php
while($bugs = $qs->fetch()){
if($bugs['photo']){
$av = $bugs['photo'];
$bugs['photo'] = $bugs['photo'];
}else{
$bugs['photo'] = "img/camera_200.png";
$av = $bugs['photo'];
}
if($bugs['important'] == "1"){
$ver = 'Важно!';
}elseif($bugs['important'] == "2"){
$ver = 'Средне';
}elseif($bugs['important'] == "3"){
$ver = 'Не очень важный баг';
}else{
$ver = '';
}
if($bugs['status'] == "1"){
$status = 'Открыт';
}elseif($bugs['status'] == "2"){
$status = 'Закрыт';
}elseif($bugs['status'] == "3"){
$status = 'На модерировании';
}else{
$status = '';
}

if($bugs['news'] == '1'){
  echo '
  <hr> <div class="bugs_row">
  <div class="bugs_row_title"><a href="bug.php?id='.$bugs['id'].'" style="color: red;">'.$bugs['name'].'</a></div>
  <div class="bugs_row_tags clear_fix"><div class="bugs_tag fl_l">Новость</div></div>
  <div class="bugs_row_status_wrap clear_fix">
    <div class="bugs_row_updated fl_l"><a href="bug.php?id='.$bugs['id'].'" onclick="return nav.go(this, event);">добавлено '.zmdate($bugs['date']).'</a></div>
    
  </div>
</div><hr>';
}
if($bugs['news'] == '0'){
echo '<div class="bugs_row">
  <div class="bugs_row_title"><a href="bug.php?id='.$bugs['id'].'">'.$bugs['name'].'</a></div>
  <div class="bugs_row_tags clear_fix"><div class="bugs_tag fl_l">Баг</div></div>
  <div class="bugs_row_status_wrap clear_fix">
    <div class="bugs_row_updated fl_l"><a href="bug.php?id='.$bugs['id'].'" onclick="return nav.go(this, event);">добавлено '.zmdate($bugs['date']).'</a></div>
    <div class="bugs_row_status fl_l">Статус: '.$status.'</b></div>
  </div>
</div>';
}
}



if($av == ""){
echo 'Жизнь боль, когда отчетов ноль. Шутка.';
}
?>
</div>
<div id="bugs_filters" class="bugs_filters fl_r">
    <div class="bugs_filter_label">Реклама:</div><div class="bugs_filter_checkboxes">
  <div id="bugs_filter_checkboxes">
  </div>
</div><div id="selected_tags_wrap" style="display: none;">
  <div class="bugs_filter_label"></div>
  <div id="bugs_selected_tags" class="bugs_tags"></div>
</div><div id="tags_wrap" style="">
  <div class="bugs_filter_label"><img src="img/vityazzi.gif" width="150" alt="lorem"></div>
    <div class="bugs_filter_label">Лучшая игра на мобильных телефонах 2018 года!</div>
  <div id="bugs_tags" class="bugs_tags"><div id="filter_tag0" class="bugs_filter_tag clear_fix summary_tab">
  
  <div id="filter_tag_cnt8" class="bugs_tag_count fl_l">на самом деле, это просто заглушка =)</div>
</div></div>
</div>
  </div>
</div>
<div>
<?php include 'exec/footer.php'; ?>
</div>
</body>
</html>
<?php }}else{echo '<meta charset="utf-8">Извините, но баг-трекер работает только для тестеров.';
exit();}
}else{echo '<meta charset="utf-8">Пожалуйста, авторизируйтесь.<meta http-equiv="refresh" content="3;blank/../">';} ?>
<link rel="stylesheet" type="text/css" href="bugtracker.css">  
