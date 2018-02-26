<?php 
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
if($_GET['id'] || $_POST['edit_group_id']){
$qclub = $dbh1->prepare("SELECT * FROM `club` WHERE id='".$_GET['id']."'");
$qclub -> execute();
$clubdata = $qclub->fetch();
$qclub2 = $dbh1->prepare("SELECT * FROM `club` WHERE id='".$_POST['edit_group_id']."'");
$qclub2 -> execute();
$clubdata2 = $qclub2->fetch();
$qthis = "SELECT groupu, verify,name,surname FROM `users` WHERE id = '".$_SESSION['id']."'"; // выбираем нашего 
$q1this = $dbh1->prepare($qthis); // отправляем запрос серверу
$q1this -> execute(); 
$userthis = $q1this->fetch(); // ответ в переменную 


if($_SESSION['id'] == $clubdata['authorid'] || $_SESSION['id'] == $clubdata2['authorid'] || $_SESSION['groupu'] == "2"){
if($_SESSION['loginin'] == "1"){
if($_SERVER['REQUEST_METHOD'] == 'POST'){
if($_POST['edit_group_name'] == ""){
echo '<meta charset="utf-8">напиши хотя-бы название, дебил';
exit();
}
$_POST['edit_group_place'] = htmlentities($_POST['edit_group_place'],ENT_QUOTES);
$_POST['edit_group_place'] = str_replace(array("\r\n", "\r", "\n", "<", ">", "<script>"), '<br>', $_POST['edit_group_place']);
$_POST['edit_group_name'] = htmlentities($_POST['edit_group_name'],ENT_QUOTES);
$_POST['edit_group_about'] = htmlentities($_POST['edit_group_about'],ENT_QUOTES);
$_POST['edit_group_about'] = str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['edit_group_about']);
$qclub = $dbh1->prepare("SELECT * FROM `club` WHERE id='".$_POST['edit_group_id']."'");
$qclub -> execute();
$clubdata = $qclub->fetch();
if ($clubdata['type'] == "0") {
  $q = "UPDATE club SET name='".$_POST['edit_group_name']."', about='".$_POST['edit_group_about']."', wall='".$_POST['walltype']."', closed='".$_POST['closed']."' WHERE id='".$_POST['edit_group_id']."'";
}elseif ($clubdata['type'] == "1") {
  if (mktime($_POST['edit_group_start_hours']-3,$_POST['edit_group_start_minutes'],0,$_POST['edit_group_start_month'],$_POST['edit_group_start_day'],$_POST['edit_group_start_year']) < time() OR mktime($_POST['edit_group_finish_hours']-3,$_POST['edit_group_finish_minutes'],0,$_POST['edit_group_finish_month'],$_POST['edit_group_finish_day'],$_POST['edit_group_finish_year']) < time()) {
    echo '<meta charset="utf-8">Ставить прошедшую дату запрещено!';
  }else{
  $q = "UPDATE club SET name='".$_POST['edit_group_name']."', about='".$_POST['edit_group_about']."',email='".$_POST['edit_group_email']."', wall='".$_POST['walltype']."', place='".$_POST['edit_group_place']."', datestart='".mktime($_POST['edit_group_start_hours']-3,$_POST['edit_group_start_minutes'],0,$_POST['edit_group_start_month'],$_POST['edit_group_start_day'],$_POST['edit_group_start_year'])."', datefinish='".mktime($_POST['edit_group_finish_hours']-3,$_POST['edit_group_finish_minutes'],0,$_POST['edit_group_finish_month'],$_POST['edit_group_finish_day'],$_POST['edit_group_finish_year'])."', closed='".$_POST['closed']."'WHERE id='".$_POST['edit_group_id']."'";
}
}
$q1 = $dbh1->prepare($q);
$q1 -> execute();
$q1->fetch();
header("Location: gsettings.php?id=".$_POST['edit_group_id']);
exit();
}
include('exec/header.php');
include('exec/leftmenu.php');
if($_GET['del'] == '1'){
$dclub = $dbh1->prepare("DELETE FROM `club` WHERE id='".$_GET['id']."'");
$dclub -> execute();
$deleteclub = $qclub->fetch();
}
?>
<div>
<div id="content-infoname"><b><?php echo '<a href="club'.$clubdata['id'].'">'.$clubdata['name'].'</a>' ?> » Информация</b></div>
<ul id="Tabs">
  <li id="GeneralInfoTab" class="SelectedTab"><a href="#" onclick=" _GeneralInfo(); return false;">Информация</a></li>
  <li id="RequestionsTab" class="Tab"><a href="#" onclick="_RequestionsTab(); return false;">Заявки</a></li>
  
  
</ul>
<div id="_GeneralInfo">
<form action="gsettings.php" method="post">
<input name="edit_group_id" type="hidden" <?php echo 'value="'.$clubdata['id'].'"'; ?>>
<table border="0" style="font-size:11px;">
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Название группы:</div></td><td><input id="text" style="width:380px;" name="edit_group_name" <?php echo 'value="'.$clubdata['name'].'"'; ?>></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">О себе:</div></td><td><textarea style="min-width:380px;max-width:380px;" id="text" name="edit_group_about"><?php $clubdata['about'] = str_replace('<br>', '
', $clubdata['about']);
  echo $clubdata['about']; ?></textarea></td></tr>
  <tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Стена:</div></td><td>
  	
  	<select name="walltype">
  		<?php 
  		if ($clubdata['wall'] == "0") {?>
  		<option selected value="0" >Открытая</option><?php }else{ ?>
  		<option value="0">Открытая</option><?php } if ($clubdata['wall'] == "1") {?>
  		<option selected value="1">Закрытая</option><?php }else{ ?>
  		<option value="1">Закрытая</option><?php }?>
  	</select>
  </td></tr>
    
    
  <tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Доступ:</div></td><td>
    
    <input type="radio" name="closed" value="0" <?php if($clubdata['closed'] == "0") {echo ' checked';} ?>>Открытое<br><span>Вступить в группу может любой желающий. Все могут просматривать информацию о группе, его стену и фотоальбом.</span><br><br>
    <input type="radio" name="closed" value="1" <?php if($clubdata['closed'] == "1") {echo ' checked';} ?>>Закрытое<br><span>Строго по заявкам. Все могут просматривать информацию о группе, но его стена видны только участникам.</span>
  </td></tr>
  <?php if($clubdata['type'] == "1"){ ?>
  <tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Место:</div></td><td><input id="text" style="width:200px;" name="edit_group_place" <?php echo 'value="'.$clubdata['place'].'"'; ?> ></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Дата начала:</div></td><td>
  <select style="width:50px;" name="edit_group_start_day">
  <option value="1"<?php if(date('d', $clubdata['datestart']) == "01") {echo ' selected';} ?> >01</option>
  <option value="2"<?php if(date('d', $clubdata['datestart']) == "02") {echo ' selected';} ?> >02</option>
  <option value="3"<?php if(date('d', $clubdata['datestart']) == "03") {echo ' selected';} ?> >03</option>
  <option value="4"<?php if(date('d', $clubdata['datestart']) == "04") {echo ' selected';} ?> >04</option>
  <option value="5"<?php if(date('d', $clubdata['datestart']) == "05") {echo ' selected';} ?> >05</option>
  <option value="6"<?php if(date('d', $clubdata['datestart']) == "06") {echo ' selected';} ?> >06</option>
  <option value="7"<?php if(date('d', $clubdata['datestart']) == "07") {echo ' selected';} ?> >07</option>
  <option value="8"<?php if(date('d', $clubdata['datestart']) == "08") {echo ' selected';} ?> >08</option>
  <option value="9"<?php if(date('d', $clubdata['datestart']) == "09") {echo ' selected';} ?> >09</option>
  <option value="10"<?php if(date('d', $clubdata['datestart']) == "10") {echo ' selected';} ?> >10</option>
  <option value="11"<?php if(date('d', $clubdata['datestart']) == "11") {echo ' selected';} ?> >11</option>
  <option value="12"<?php if(date('d', $clubdata['datestart']) == "12") {echo ' selected';} ?> >12</option>
  <option value="13"<?php if(date('d', $clubdata['datestart']) == "13") {echo ' selected';} ?> >13</option>
  <option value="14"<?php if(date('d', $clubdata['datestart']) == "14") {echo ' selected';} ?> >14</option>
  <option value="15"<?php if(date('d', $clubdata['datestart']) == "15") {echo ' selected';} ?> >15</option>
  <option value="16"<?php if(date('d', $clubdata['datestart']) == "16") {echo ' selected';} ?> >16</option>
  <option value="17"<?php if(date('d', $clubdata['datestart']) == "17") {echo ' selected';} ?> >17</option>
  <option value="18"<?php if(date('d', $clubdata['datestart']) == "18") {echo ' selected';} ?> >18</option>
  <option value="19"<?php if(date('d', $clubdata['datestart']) == "19") {echo ' selected';} ?> >19</option>
  <option value="20"<?php if(date('d', $clubdata['datestart']) == "20") {echo ' selected';} ?> >20</option>
  <option value="21"<?php if(date('d', $clubdata['datestart']) == "21") {echo ' selected';} ?> >21</option>
  <option value="22"<?php if(date('d', $clubdata['datestart']) == "22") {echo ' selected';} ?> >22</option>
  <option value="23"<?php if(date('d', $clubdata['datestart']) == "23") {echo ' selected';} ?> >23</option>
  <option value="24"<?php if(date('d', $clubdata['datestart']) == "24") {echo ' selected';} ?> >24</option>
  <option value="25"<?php if(date('d', $clubdata['datestart']) == "25") {echo ' selected';} ?> >25</option>
  <option value="26"<?php if(date('d', $clubdata['datestart']) == "26") {echo ' selected';} ?> >26</option>
  <option value="27"<?php if(date('d', $clubdata['datestart']) == "27") {echo ' selected';} ?> >27</option>
  <option value="28"<?php if(date('d', $clubdata['datestart']) == "28") {echo ' selected';} ?> >28</option>
  <option value="29"<?php if(date('d', $clubdata['datestart']) == "29") {echo ' selected';} ?> >29</option>
  <option value="30"<?php if(date('d', $clubdata['datestart']) == "30") {echo ' selected';} ?> >30</option>
  <option value="31"<?php if(date('d', $clubdata['datestart']) == "31") {echo ' selected';} ?> >31</option>
  

</select><select style="width:50px;" name="edit_group_start_month" >
  <option value="1"<?php if(date('m', $clubdata['datestart']) == "01") {echo ' selected';} ?> >Янв</option>
  <option value="2"<?php if(date('m', $clubdata['datestart']) == "02") {echo ' selected';} ?> >Фев</option>
  <option value="3"<?php if(date('m', $clubdata['datestart']) == "03") {echo ' selected';} ?> >Мар</option>
  <option value="4"<?php if(date('m', $clubdata['datestart']) == "04") {echo ' selected';} ?> >Апр</option>
  <option value="5"<?php if(date('m', $clubdata['datestart']) == "05") {echo ' selected';} ?> >Май</option>
  <option value="6"<?php if(date('m', $clubdata['datestart']) == "06") {echo ' selected';} ?> >Июн</option>
  <option value="7"<?php if(date('m', $clubdata['datestart']) == "07") {echo ' selected';} ?> >Июл</option>
  <option value="8"<?php if(date('m', $clubdata['datestart']) == "08") {echo ' selected';} ?> >Авг</option>
  <option value="9"<?php if(date('m', $clubdata['datestart']) == "09") {echo ' selected';} ?> >Сен</option>
  <option value="10"<?php if(date('m', $clubdata['datestart']) == "10") {echo ' selected';} ?> >Окт</option>
  <option value="11"<?php if(date('m', $clubdata['datestart']) == "11") {echo ' selected';} ?> >Ноя</option>
  <option value="12"<?php if(date('m', $clubdata['datestart']) == "12") {echo ' selected';} ?> >Дек</option>
  

</select>
<select style="width:100px;" name="edit_group_start_year" style="width:185px;">
  <option value="2031"<?php if(date('Y', $clubdata['datestart']) == "2031") {echo ' selected';} ?> >2031</option>
  <option value="2030"<?php if(date('Y', $clubdata['datestart']) == "2030") {echo ' selected';} ?> >2030</option>
  <option value="2029"<?php if(date('Y', $clubdata['datestart']) == "2029") {echo ' selected';} ?> >2029</option>
  <option value="2028"<?php if(date('Y', $clubdata['datestart']) == "2028") {echo ' selected';} ?> >2028</option>
  <option value="2027"<?php if(date('Y', $clubdata['datestart']) == "2027") {echo ' selected';} ?> >2027</option>
  <option value="2026"<?php if(date('Y', $clubdata['datestart']) == "2026") {echo ' selected';} ?> >2026</option>
  <option value="2025"<?php if(date('Y', $clubdata['datestart']) == "2025") {echo ' selected';} ?> >2025</option>
  <option value="2024"<?php if(date('Y', $clubdata['datestart']) == "2024") {echo ' selected';} ?> >2024</option>
  <option value="2023"<?php if(date('Y', $clubdata['datestart']) == "2023") {echo ' selected';} ?> >2023</option>
  <option value="2022"<?php if(date('Y', $clubdata['datestart']) == "2022") {echo ' selected';} ?> >2022</option>
  <option value="2021"<?php if(date('Y', $clubdata['datestart']) == "2021") {echo ' selected';} ?> >2021</option>
  <option value="2020"<?php if(date('Y', $clubdata['datestart']) == "2020") {echo ' selected';} ?> >2020</option>
  <option value="2019"<?php if(date('Y', $clubdata['datestart']) == "2019") {echo ' selected';} ?> >2019</option>
  <option value="2018"<?php if(date('Y', $clubdata['datestart']) == "2018") {echo ' selected';} ?> >2018</option>  

</select> в 

<select style="width:100px;" name="edit_group_start_hours" style="width:185px;">
  <option value="0"<?php if(date('H', $clubdata['datestart']) == "01") {echo ' selected';} ?> >00</option>
  <option value="1"<?php if(date('H', $clubdata['datestart']) == "02") {echo ' selected';} ?> >01</option>
  <option value="2"<?php if(date('H', $clubdata['datestart']) == "03") {echo ' selected';} ?> >02</option>
  <option value="3"<?php if(date('H', $clubdata['datestart']) == "03") {echo ' selected';} ?> >03</option>
  <option value="4"<?php if(date('H', $clubdata['datestart']) == "04") {echo ' selected';} ?> >04</option>
  <option value="5"<?php if(date('H', $clubdata['datestart']) == "05") {echo ' selected';} ?> >05</option>
  <option value="6"<?php if(date('H', $clubdata['datestart']) == "06") {echo ' selected';} ?> >06</option>
  <option value="7"<?php if(date('H', $clubdata['datestart']) == "07") {echo ' selected';} ?> >07</option>
  <option value="8"<?php if(date('H', $clubdata['datestart']) == "08") {echo ' selected';} ?> >08</option>
  <option value="9"<?php if(date('H', $clubdata['datestart']) == "09") {echo ' selected';} ?> >09</option>
  <option value="10"<?php if(date('H', $clubdata['datestart']) == "10") {echo ' selected';} ?> >10</option>
  <option value="11"<?php if(date('H', $clubdata['datestart']) == "11") {echo ' selected';} ?> >11</option>
  <option value="12"<?php if(date('H', $clubdata['datestart']) == "12") {echo ' selected';} ?> >12</option>
  <option value="13"<?php if(date('H', $clubdata['datestart']) == "13") {echo ' selected';} ?> >13</option>  
  <option value="14"<?php if(date('H', $clubdata['datestart']) == "14") {echo ' selected';} ?> >14</option>
  <option value="15"<?php if(date('H', $clubdata['datestart']) == "15") {echo ' selected';} ?> >15</option>
  <option value="16"<?php if(date('H', $clubdata['datestart']) == "16") {echo ' selected';} ?> >16</option>
  <option value="17"<?php if(date('H', $clubdata['datestart']) == "17") {echo ' selected';} ?> >17</option>
  <option value="18"<?php if(date('H', $clubdata['datestart']) == "18") {echo ' selected';} ?> >18</option>
  <option value="19"<?php if(date('H', $clubdata['datestart']) == "19") {echo ' selected';} ?> >19</option>
  <option value="20"<?php if(date('H', $clubdata['datestart']) == "20") {echo ' selected';} ?> >20</option>
  <option value="21"<?php if(date('H', $clubdata['datestart']) == "21") {echo ' selected';} ?> >21</option>
  <option value="22"<?php if(date('H', $clubdata['datestart']) == "22") {echo ' selected';} ?> >22</option>
  <option value="23"<?php if(date('H', $clubdata['datestart']) == "23") {echo ' selected';} ?> >23</option>

</select> : <select style="width:100px;" name="edit_group_start_minutes" style="width:185px;">
  <option value="0"<?php if(date('i', $clubdata['datestart']) == "01") {echo ' selected';} ?> >00</option>
  <option value="1"<?php if(date('i', $clubdata['datestart']) == "02") {echo ' selected';} ?> >01</option>
  <option value="2"<?php if(date('i', $clubdata['datestart']) == "03") {echo ' selected';} ?> >02</option>
  <option value="3"<?php if(date('i', $clubdata['datestart']) == "03") {echo ' selected';} ?> >03</option>
  <option value="4"<?php if(date('i', $clubdata['datestart']) == "04") {echo ' selected';} ?> >04</option>
  <option value="5"<?php if(date('i', $clubdata['datestart']) == "05") {echo ' selected';} ?> >05</option>
  <option value="6"<?php if(date('i', $clubdata['datestart']) == "06") {echo ' selected';} ?> >06</option>
  <option value="7"<?php if(date('i', $clubdata['datestart']) == "07") {echo ' selected';} ?> >07</option>
  <option value="8"<?php if(date('i', $clubdata['datestart']) == "08") {echo ' selected';} ?> >08</option>
  <option value="9"<?php if(date('i', $clubdata['datestart']) == "09") {echo ' selected';} ?> >09</option>
  <option value="10"<?php if(date('i', $clubdata['datestart']) == "10") {echo ' selected';} ?> >10</option>
  <option value="11"<?php if(date('i', $clubdata['datestart']) == "11") {echo ' selected';} ?> >11</option>
  <option value="12"<?php if(date('i', $clubdata['datestart']) == "12") {echo ' selected';} ?> >12</option>
  <option value="13"<?php if(date('i', $clubdata['datestart']) == "13") {echo ' selected';} ?> >13</option>  
  <option value="14"<?php if(date('i', $clubdata['datestart']) == "14") {echo ' selected';} ?> >14</option>
  <option value="15"<?php if(date('i', $clubdata['datestart']) == "15") {echo ' selected';} ?> >15</option>
  <option value="16"<?php if(date('i', $clubdata['datestart']) == "16") {echo ' selected';} ?> >16</option>
  <option value="17"<?php if(date('i', $clubdata['datestart']) == "17") {echo ' selected';} ?> >17</option>
  <option value="18"<?php if(date('i', $clubdata['datestart']) == "18") {echo ' selected';} ?> >18</option>
  <option value="19"<?php if(date('i', $clubdata['datestart']) == "19") {echo ' selected';} ?> >19</option>
  <option value="20"<?php if(date('i', $clubdata['datestart']) == "20") {echo ' selected';} ?> >20</option>
  <option value="21"<?php if(date('i', $clubdata['datestart']) == "21") {echo ' selected';} ?> >21</option>
  <option value="22"<?php if(date('i', $clubdata['datestart']) == "22") {echo ' selected';} ?> >22</option>
  <option value="23"<?php if(date('i', $clubdata['datestart']) == "23") {echo ' selected';} ?> >23</option>
  <option value="24"<?php if(date('i', $clubdata['datestart']) == "24") {echo ' selected';} ?> >24</option>
  <option value="25"<?php if(date('i', $clubdata['datestart']) == "25") {echo ' selected';} ?> >25</option>
  <option value="26"<?php if(date('i', $clubdata['datestart']) == "26") {echo ' selected';} ?> >26</option>
  <option value="27"<?php if(date('i', $clubdata['datestart']) == "27") {echo ' selected';} ?> >27</option>
  <option value="28"<?php if(date('i', $clubdata['datestart']) == "28") {echo ' selected';} ?> >28</option>
  <option value="29"<?php if(date('i', $clubdata['datestart']) == "29") {echo ' selected';} ?> >29</option>
  <option value="30"<?php if(date('i', $clubdata['datestart']) == "30") {echo ' selected';} ?> >30</option>
  <option value="31"<?php if(date('i', $clubdata['datestart']) == "31") {echo ' selected';} ?> >31</option>
  <option value="32"<?php if(date('i', $clubdata['datestart']) == "32") {echo ' selected';} ?> >32</option>
  <option value="33"<?php if(date('i', $clubdata['datestart']) == "33") {echo ' selected';} ?> >33</option>
  <option value="34"<?php if(date('i', $clubdata['datestart']) == "34") {echo ' selected';} ?> >34</option>
  <option value="35"<?php if(date('i', $clubdata['datestart']) == "35") {echo ' selected';} ?> >35</option>
  <option value="36"<?php if(date('i', $clubdata['datestart']) == "36") {echo ' selected';} ?> >36</option>
  <option value="37"<?php if(date('i', $clubdata['datestart']) == "37") {echo ' selected';} ?> >37</option>
  <option value="38"<?php if(date('i', $clubdata['datestart']) == "38") {echo ' selected';} ?> >38</option>
  <option value="39"<?php if(date('i', $clubdata['datestart']) == "39") {echo ' selected';} ?> >39</option>
  <option value="40"<?php if(date('i', $clubdata['datestart']) == "40") {echo ' selected';} ?> >40</option>
  <option value="41"<?php if(date('i', $clubdata['datestart']) == "41") {echo ' selected';} ?> >41</option>
  <option value="42"<?php if(date('i', $clubdata['datestart']) == "42") {echo ' selected';} ?> >42</option>
  <option value="43"<?php if(date('i', $clubdata['datestart']) == "43") {echo ' selected';} ?> >43</option>
  <option value="44"<?php if(date('i', $clubdata['datestart']) == "44") {echo ' selected';} ?> >44</option>  
  <option value="45"<?php if(date('i', $clubdata['datestart']) == "45") {echo ' selected';} ?> >45</option>
  <option value="46"<?php if(date('i', $clubdata['datestart']) == "46") {echo ' selected';} ?> >46</option>
  <option value="47"<?php if(date('i', $clubdata['datestart']) == "47") {echo ' selected';} ?> >47</option>
  <option value="48"<?php if(date('i', $clubdata['datestart']) == "48") {echo ' selected';} ?> >48</option>
  <option value="49"<?php if(date('i', $clubdata['datestart']) == "49") {echo ' selected';} ?> >49</option>
  <option value="50"<?php if(date('i', $clubdata['datestart']) == "50") {echo ' selected';} ?> >50</option>
  <option value="51"<?php if(date('i', $clubdata['datestart']) == "51") {echo ' selected';} ?> >51</option>
  <option value="52"<?php if(date('i', $clubdata['datestart']) == "52") {echo ' selected';} ?> >52</option>
  <option value="53"<?php if(date('i', $clubdata['datestart']) == "53") {echo ' selected';} ?> >53</option>
  <option value="54"<?php if(date('i', $clubdata['datestart']) == "54") {echo ' selected';} ?> >54</option>
  <option value="55"<?php if(date('i', $clubdata['datestart']) == "55") {echo ' selected';} ?> >55</option>
  <option value="56"<?php if(date('i', $clubdata['datestart']) == "56") {echo ' selected';} ?> >56</option>
  <option value="57"<?php if(date('i', $clubdata['datestart']) == "57") {echo ' selected';} ?> >57</option>
  <option value="58"<?php if(date('i', $clubdata['datestart']) == "58") {echo ' selected';} ?> >58</option>
  <option value="59"<?php if(date('i', $clubdata['datestart']) == "59") {echo ' selected';} ?> >59</option>
    

</select>



</td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Дата окончания:</div></td><td>
  <select style="width:50px;" name="edit_group_finish_day">
  <option value="1"<?php if(date('d', $clubdata['datefinish']) == "01") {echo ' selected';} ?> >01</option>
  <option value="2"<?php if(date('d', $clubdata['datefinish']) == "02") {echo ' selected';} ?> >02</option>
  <option value="3"<?php if(date('d', $clubdata['datefinish']) == "03") {echo ' selected';} ?> >03</option>
  <option value="4"<?php if(date('d', $clubdata['datefinish']) == "04") {echo ' selected';} ?> >04</option>
  <option value="5"<?php if(date('d', $clubdata['datefinish']) == "05") {echo ' selected';} ?> >05</option>
  <option value="6"<?php if(date('d', $clubdata['datefinish']) == "06") {echo ' selected';} ?> >06</option>
  <option value="7"<?php if(date('d', $clubdata['datefinish']) == "07") {echo ' selected';} ?> >07</option>
  <option value="8"<?php if(date('d', $clubdata['datefinish']) == "08") {echo ' selected';} ?> >08</option>
  <option value="9"<?php if(date('d', $clubdata['datefinish']) == "09") {echo ' selected';} ?> >09</option>
  <option value="10"<?php if(date('d', $clubdata['datefinish']) == "10") {echo ' selected';} ?> >10</option>
  <option value="11"<?php if(date('d', $clubdata['datefinish']) == "11") {echo ' selected';} ?> >11</option>
  <option value="12"<?php if(date('d', $clubdata['datefinish']) == "12") {echo ' selected';} ?> >12</option>
  <option value="13"<?php if(date('d', $clubdata['datefinish']) == "13") {echo ' selected';} ?> >13</option>
  <option value="14"<?php if(date('d', $clubdata['datefinish']) == "14") {echo ' selected';} ?> >14</option>
  <option value="15"<?php if(date('d', $clubdata['datefinish']) == "15") {echo ' selected';} ?> >15</option>
  <option value="16"<?php if(date('d', $clubdata['datefinish']) == "16") {echo ' selected';} ?> >16</option>
  <option value="17"<?php if(date('d', $clubdata['datefinish']) == "17") {echo ' selected';} ?> >17</option>
  <option value="18"<?php if(date('d', $clubdata['datefinish']) == "18") {echo ' selected';} ?> >18</option>
  <option value="19"<?php if(date('d', $clubdata['datefinish']) == "19") {echo ' selected';} ?> >19</option>
  <option value="20"<?php if(date('d', $clubdata['datefinish']) == "20") {echo ' selected';} ?> >20</option>
  <option value="21"<?php if(date('d', $clubdata['datefinish']) == "21") {echo ' selected';} ?> >21</option>
  <option value="22"<?php if(date('d', $clubdata['datefinish']) == "22") {echo ' selected';} ?> >22</option>
  <option value="23"<?php if(date('d', $clubdata['datefinish']) == "23") {echo ' selected';} ?> >23</option>
  <option value="24"<?php if(date('d', $clubdata['datefinish']) == "24") {echo ' selected';} ?> >24</option>
  <option value="25"<?php if(date('d', $clubdata['datefinish']) == "25") {echo ' selected';} ?> >25</option>
  <option value="26"<?php if(date('d', $clubdata['datefinish']) == "26") {echo ' selected';} ?> >26</option>
  <option value="27"<?php if(date('d', $clubdata['datefinish']) == "27") {echo ' selected';} ?> >27</option>
  <option value="28"<?php if(date('d', $clubdata['datefinish']) == "28") {echo ' selected';} ?> >28</option>
  <option value="29"<?php if(date('d', $clubdata['datefinish']) == "29") {echo ' selected';} ?> >29</option>
  <option value="30"<?php if(date('d', $clubdata['datefinish']) == "30") {echo ' selected';} ?> >30</option>
  <option value="31"<?php if(date('d', $clubdata['datefinish']) == "31") {echo ' selected';} ?> >31</option>
  

</select><select style="width:50px;" name="edit_group_finish_month" >
  <option value="1"<?php if(date('m', $clubdata['datefinish']) == "01") {echo ' selected';} ?> >Янв</option>
  <option value="2"<?php if(date('m', $clubdata['datefinish']) == "02") {echo ' selected';} ?> >Фев</option>
  <option value="3"<?php if(date('m', $clubdata['datefinish']) == "03") {echo ' selected';} ?> >Мар</option>
  <option value="4"<?php if(date('m', $clubdata['datefinish']) == "04") {echo ' selected';} ?> >Апр</option>
  <option value="5"<?php if(date('m', $clubdata['datefinish']) == "05") {echo ' selected';} ?> >Май</option>
  <option value="6"<?php if(date('m', $clubdata['datefinish']) == "06") {echo ' selected';} ?> >Июн</option>
  <option value="7"<?php if(date('m', $clubdata['datefinish']) == "07") {echo ' selected';} ?> >Июл</option>
  <option value="8"<?php if(date('m', $clubdata['datefinish']) == "08") {echo ' selected';} ?> >Авг</option>
  <option value="9"<?php if(date('m', $clubdata['datefinish']) == "09") {echo ' selected';} ?> >Сен</option>
  <option value="10"<?php if(date('m', $clubdata['datefinish']) == "10") {echo ' selected';} ?> >Окт</option>
  <option value="11"<?php if(date('m', $clubdata['datefinish']) == "11") {echo ' selected';} ?> >Ноя</option>
  <option value="12"<?php if(date('m', $clubdata['datefinish']) == "12") {echo ' selected';} ?> >Дек</option>
  

</select>
<select style="width:100px;" name="edit_group_finish_year" style="width:185px;">
  <option value="2031"<?php if(date('Y', $clubdata['datefinish']) == "2031") {echo ' selected';} ?> >2031</option>
  <option value="2030"<?php if(date('Y', $clubdata['datefinish']) == "2030") {echo ' selected';} ?> >2030</option>
  <option value="2029"<?php if(date('Y', $clubdata['datefinish']) == "2029") {echo ' selected';} ?> >2029</option>
  <option value="2028"<?php if(date('Y', $clubdata['datefinish']) == "2028") {echo ' selected';} ?> >2028</option>
  <option value="2027"<?php if(date('Y', $clubdata['datefinish']) == "2027") {echo ' selected';} ?> >2027</option>
  <option value="2026"<?php if(date('Y', $clubdata['datefinish']) == "2026") {echo ' selected';} ?> >2026</option>
  <option value="2025"<?php if(date('Y', $clubdata['datefinish']) == "2025") {echo ' selected';} ?> >2025</option>
  <option value="2024"<?php if(date('Y', $clubdata['datefinish']) == "2024") {echo ' selected';} ?> >2024</option>
  <option value="2023"<?php if(date('Y', $clubdata['datefinish']) == "2023") {echo ' selected';} ?> >2023</option>
  <option value="2022"<?php if(date('Y', $clubdata['datefinish']) == "2022") {echo ' selected';} ?> >2022</option>
  <option value="2021"<?php if(date('Y', $clubdata['datefinish']) == "2021") {echo ' selected';} ?> >2021</option>
  <option value="2020"<?php if(date('Y', $clubdata['datefinish']) == "2020") {echo ' selected';} ?> >2020</option>
  <option value="2019"<?php if(date('Y', $clubdata['datefinish']) == "2019") {echo ' selected';} ?> >2019</option>
  <option value="2018"<?php if(date('Y', $clubdata['datefinish']) == "2018") {echo ' selected';} ?> >2018</option>  

</select> в 

<select style="width:100px;" name="edit_group_finish_hours" style="width:185px;">
  <option value="0"<?php if(date('H', $clubdata['datefinish']) == "01") {echo ' selected';} ?> >00</option>
  <option value="1"<?php if(date('H', $clubdata['datefinish']) == "02") {echo ' selected';} ?> >01</option>
  <option value="2"<?php if(date('H', $clubdata['datefinish']) == "03") {echo ' selected';} ?> >02</option>
  <option value="3"<?php if(date('H', $clubdata['datefinish']) == "03") {echo ' selected';} ?> >03</option>
  <option value="4"<?php if(date('H', $clubdata['datefinish']) == "04") {echo ' selected';} ?> >04</option>
  <option value="5"<?php if(date('H', $clubdata['datefinish']) == "05") {echo ' selected';} ?> >05</option>
  <option value="6"<?php if(date('H', $clubdata['datefinish']) == "06") {echo ' selected';} ?> >06</option>
  <option value="7"<?php if(date('H', $clubdata['datefinish']) == "07") {echo ' selected';} ?> >07</option>
  <option value="8"<?php if(date('H', $clubdata['datefinish']) == "08") {echo ' selected';} ?> >08</option>
  <option value="9"<?php if(date('H', $clubdata['datefinish']) == "09") {echo ' selected';} ?> >09</option>
  <option value="10"<?php if(date('H', $clubdata['datefinish']) == "10") {echo ' selected';} ?> >10</option>
  <option value="11"<?php if(date('H', $clubdata['datefinish']) == "11") {echo ' selected';} ?> >11</option>
  <option value="12"<?php if(date('H', $clubdata['datefinish']) == "12") {echo ' selected';} ?> >12</option>
  <option value="13"<?php if(date('H', $clubdata['datefinish']) == "13") {echo ' selected';} ?> >13</option>  
  <option value="14"<?php if(date('H', $clubdata['datefinish']) == "14") {echo ' selected';} ?> >14</option>
  <option value="15"<?php if(date('H', $clubdata['datefinish']) == "15") {echo ' selected';} ?> >15</option>
  <option value="16"<?php if(date('H', $clubdata['datefinish']) == "16") {echo ' selected';} ?> >16</option>
  <option value="17"<?php if(date('H', $clubdata['datefinish']) == "17") {echo ' selected';} ?> >17</option>
  <option value="18"<?php if(date('H', $clubdata['datefinish']) == "18") {echo ' selected';} ?> >18</option>
  <option value="19"<?php if(date('H', $clubdata['datefinish']) == "19") {echo ' selected';} ?> >19</option>
  <option value="20"<?php if(date('H', $clubdata['datefinish']) == "20") {echo ' selected';} ?> >20</option>
  <option value="21"<?php if(date('H', $clubdata['datefinish']) == "21") {echo ' selected';} ?> >21</option>
  <option value="22"<?php if(date('H', $clubdata['datefinish']) == "22") {echo ' selected';} ?> >22</option>
  <option value="23"<?php if(date('H', $clubdata['datefinish']) == "23") {echo ' selected';} ?> >23</option>

</select> : <select style="width:100px;" name="edit_group_finish_minutes" style="width:185px;">
  <option value="0"<?php if(date('i', $clubdata['datefinish']) == "01") {echo ' selected';} ?> >00</option>
  <option value="1"<?php if(date('i', $clubdata['datefinish']) == "02") {echo ' selected';} ?> >01</option>
  <option value="2"<?php if(date('i', $clubdata['datefinish']) == "03") {echo ' selected';} ?> >02</option>
  <option value="3"<?php if(date('i', $clubdata['datefinish']) == "03") {echo ' selected';} ?> >03</option>
  <option value="4"<?php if(date('i', $clubdata['datefinish']) == "04") {echo ' selected';} ?> >04</option>
  <option value="5"<?php if(date('i', $clubdata['datefinish']) == "05") {echo ' selected';} ?> >05</option>
  <option value="6"<?php if(date('i', $clubdata['datefinish']) == "06") {echo ' selected';} ?> >06</option>
  <option value="7"<?php if(date('i', $clubdata['datefinish']) == "07") {echo ' selected';} ?> >07</option>
  <option value="8"<?php if(date('i', $clubdata['datefinish']) == "08") {echo ' selected';} ?> >08</option>
  <option value="9"<?php if(date('i', $clubdata['datefinish']) == "09") {echo ' selected';} ?> >09</option>
  <option value="10"<?php if(date('i', $clubdata['datefinish']) == "10") {echo ' selected';} ?> >10</option>
  <option value="11"<?php if(date('i', $clubdata['datefinish']) == "11") {echo ' selected';} ?> >11</option>
  <option value="12"<?php if(date('i', $clubdata['datefinish']) == "12") {echo ' selected';} ?> >12</option>
  <option value="13"<?php if(date('i', $clubdata['datefinish']) == "13") {echo ' selected';} ?> >13</option>  
  <option value="14"<?php if(date('i', $clubdata['datefinish']) == "14") {echo ' selected';} ?> >14</option>
  <option value="15"<?php if(date('i', $clubdata['datefinish']) == "15") {echo ' selected';} ?> >15</option>
  <option value="16"<?php if(date('i', $clubdata['datefinish']) == "16") {echo ' selected';} ?> >16</option>
  <option value="17"<?php if(date('i', $clubdata['datefinish']) == "17") {echo ' selected';} ?> >17</option>
  <option value="18"<?php if(date('i', $clubdata['datefinish']) == "18") {echo ' selected';} ?> >18</option>
  <option value="19"<?php if(date('i', $clubdata['datefinish']) == "19") {echo ' selected';} ?> >19</option>
  <option value="20"<?php if(date('i', $clubdata['datefinish']) == "20") {echo ' selected';} ?> >20</option>
  <option value="21"<?php if(date('i', $clubdata['datefinish']) == "21") {echo ' selected';} ?> >21</option>
  <option value="22"<?php if(date('i', $clubdata['datefinish']) == "22") {echo ' selected';} ?> >22</option>
  <option value="23"<?php if(date('i', $clubdata['datefinish']) == "23") {echo ' selected';} ?> >23</option>
  <option value="24"<?php if(date('i', $clubdata['datefinish']) == "24") {echo ' selected';} ?> >24</option>
  <option value="25"<?php if(date('i', $clubdata['datefinish']) == "25") {echo ' selected';} ?> >25</option>
  <option value="26"<?php if(date('i', $clubdata['datefinish']) == "26") {echo ' selected';} ?> >26</option>
  <option value="27"<?php if(date('i', $clubdata['datefinish']) == "27") {echo ' selected';} ?> >27</option>
  <option value="28"<?php if(date('i', $clubdata['datefinish']) == "28") {echo ' selected';} ?> >28</option>
  <option value="29"<?php if(date('i', $clubdata['datefinish']) == "29") {echo ' selected';} ?> >29</option>
  <option value="30"<?php if(date('i', $clubdata['datefinish']) == "30") {echo ' selected';} ?> >30</option>
  <option value="31"<?php if(date('i', $clubdata['datefinish']) == "31") {echo ' selected';} ?> >31</option>
  <option value="32"<?php if(date('i', $clubdata['datefinish']) == "32") {echo ' selected';} ?> >32</option>
  <option value="33"<?php if(date('i', $clubdata['datefinish']) == "33") {echo ' selected';} ?> >33</option>
  <option value="34"<?php if(date('i', $clubdata['datefinish']) == "34") {echo ' selected';} ?> >34</option>
  <option value="35"<?php if(date('i', $clubdata['datefinish']) == "35") {echo ' selected';} ?> >35</option>
  <option value="36"<?php if(date('i', $clubdata['datefinish']) == "36") {echo ' selected';} ?> >36</option>
  <option value="37"<?php if(date('i', $clubdata['datefinish']) == "37") {echo ' selected';} ?> >37</option>
  <option value="38"<?php if(date('i', $clubdata['datefinish']) == "38") {echo ' selected';} ?> >38</option>
  <option value="39"<?php if(date('i', $clubdata['datefinish']) == "39") {echo ' selected';} ?> >39</option>
  <option value="40"<?php if(date('i', $clubdata['datefinish']) == "40") {echo ' selected';} ?> >40</option>
  <option value="41"<?php if(date('i', $clubdata['datefinish']) == "41") {echo ' selected';} ?> >41</option>
  <option value="42"<?php if(date('i', $clubdata['datefinish']) == "42") {echo ' selected';} ?> >42</option>
  <option value="43"<?php if(date('i', $clubdata['datefinish']) == "43") {echo ' selected';} ?> >43</option>
  <option value="44"<?php if(date('i', $clubdata['datefinish']) == "44") {echo ' selected';} ?> >44</option>  
  <option value="45"<?php if(date('i', $clubdata['datefinish']) == "45") {echo ' selected';} ?> >45</option>
  <option value="46"<?php if(date('i', $clubdata['datefinish']) == "46") {echo ' selected';} ?> >46</option>
  <option value="47"<?php if(date('i', $clubdata['datefinish']) == "47") {echo ' selected';} ?> >47</option>
  <option value="48"<?php if(date('i', $clubdata['datefinish']) == "48") {echo ' selected';} ?> >48</option>
  <option value="49"<?php if(date('i', $clubdata['datefinish']) == "49") {echo ' selected';} ?> >49</option>
  <option value="50"<?php if(date('i', $clubdata['datefinish']) == "50") {echo ' selected';} ?> >50</option>
  <option value="51"<?php if(date('i', $clubdata['datefinish']) == "51") {echo ' selected';} ?> >51</option>
  <option value="52"<?php if(date('i', $clubdata['datefinish']) == "52") {echo ' selected';} ?> >52</option>
  <option value="53"<?php if(date('i', $clubdata['datefinish']) == "53") {echo ' selected';} ?> >53</option>
  <option value="54"<?php if(date('i', $clubdata['datefinish']) == "54") {echo ' selected';} ?> >54</option>
  <option value="55"<?php if(date('i', $clubdata['datefinish']) == "55") {echo ' selected';} ?> >55</option>
  <option value="56"<?php if(date('i', $clubdata['datefinish']) == "56") {echo ' selected';} ?> >56</option>
  <option value="57"<?php if(date('i', $clubdata['datefinish']) == "57") {echo ' selected';} ?> >57</option>
  <option value="58"<?php if(date('i', $clubdata['datefinish']) == "58") {echo ' selected';} ?> >58</option>
  <option value="59"<?php if(date('i', $clubdata['datefinish']) == "59") {echo ' selected';} ?> >59</option>
    

</select>



</td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Организатор:</div></td><td><input id="text" style="width:380px;" disabled <?php echo 'value="'.$userthis['name'].' '.$userthis['surname'].' "'; ?> ></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Email:</div></td><td><input id="text" type="email" style="width:380px;" name="edit_group_email" <?php echo 'value="'.$clubdata['email'].'"'; ?>></td></tr>
  <?php } ?>
</table><br>
<div style="margin-left:157px;"><input type="submit" id="button" value="Сохранить" name="edit_group_submit"></div><br>
</form>
<hr style="margin-left:-10px;margin-right:-10px;"><br>
<div>
<div id="content-infoname"><b>Аватар</b></div>
<form method="post" enctype="multipart/form-data" action="add_gavatar.php">
<input name="edit_avatar_id" type="hidden" <?php echo 'value="'.$clubdata['id'].'"'; ?>>
<div style="margin-left:157px;"><span style="color:#B5B5B5;font-size:11px;">А здесь вы можете изменить свою аватарку.</span></div><br>
<table border="0" style="font-size:11px;">
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Файл:</div></td><td><input type="file" accept="image/jpeg,image/png,image/gif" name="picture"></td></tr>
</table><br>
<div style="margin-left:157px;"><input type="submit" id="button" value="Изменить аватар"></div>
</form>
</div>
</div>
<div id="_Requestions" style="display: none;">
<?php $qs = $dbh1->prepare("SELECT * FROM `clubsubrequest` WHERE `id2` = '".$clubdata['id']."'"); 
$qs->execute();
while($fr = $qs->fetch()){
$qu = $dbh1->prepare("SELECT * FROM `users` WHERE `id` = '".$fr['id1']."'");
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
$ver = ' <img src="img/verify.png" width="12" height="12" style="margin-left:0;margin-right:0;margin_bottom:-2;">';
}elseif($user['verify'] == "5"){
$ver = ' <img src="img/verify_orange.png" width="12" height="12" style="margin-left:0;margin-right:0;margin_bottom:-2;">';
}elseif($user['verify'] == "3"){
$ver = ' <img src="data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2216%22%20height%3D%2216%22%20viewBox%3D%220%200%2016%2016%22%3E%0A%20%20%3Cg%20fill%3D%22none%22%20fill-rule%3D%22evenodd%22%3E%0A%20%20%20%20%3Cpath%20fill%3D%22%2374A2D6%22%20d%3D%22M5.82331983%2C14.8223666%20L4.54259486%2C15.0281417%20C4.15718795%2C15.0900653%203.78122933%2C14.8730055%203.64215331%2C14.5082715%20L3.17999726%2C13.2962436%20C3.09635683%2C13.0768923%202.92310766%2C12.9036432%202.70375635%2C12.8200027%20L1.49172846%2C12.3578467%20C1.12699447%2C12.2187707%200.909934662%2C11.842812%200.971858288%2C11.4574051%20L1.17763336%2C10.1766802%20C1.21487428%2C9.94489615%201.15146068%2C9.70823338%201.00331709%2C9.52612299%20L0.184748166%2C8.51987017%20C-0.0615827221%2C8.21705981%20-0.0615827221%2C7.78294019%200.184748166%2C7.48012983%20L1.00331709%2C6.47387701%20C1.15146068%2C6.29176662%201.21487428%2C6.05510385%201.17763336%2C5.82331983%20L0.971858288%2C4.54259486%20C0.909934662%2C4.15718795%201.12699447%2C3.78122933%201.49172846%2C3.64215331%20L2.70375635%2C3.17999726%20C2.92310766%2C3.09635683%203.09635683%2C2.92310766%203.17999726%2C2.70375635%20L3.64215331%2C1.49172846%20C3.78122933%2C1.12699447%204.15718795%2C0.909934662%204.54259486%2C0.971858288%20L5.82331983%2C1.17763336%20C6.05510385%2C1.21487428%206.29176662%2C1.15146068%206.47387701%2C1.00331709%20L7.48012983%2C0.184748166%20C7.78294019%2C-0.0615827221%208.21705981%2C-0.0615827221%208.51987017%2C0.184748166%20L9.52612299%2C1.00331709%20C9.70823338%2C1.15146068%209.94489615%2C1.21487428%2010.1766802%2C1.17763336%20L11.4574051%2C0.971858288%20C11.842812%2C0.909934662%2012.2187707%2C1.12699447%2012.3578467%2C1.49172846%20L12.8200027%2C2.70375635%20C12.9036432%2C2.92310766%2013.0768923%2C3.09635683%2013.2962436%2C3.17999726%20L14.5082715%2C3.64215331%20C14.8730055%2C3.78122933%2015.0900653%2C4.15718795%2015.0281417%2C4.54259486%20L14.8223666%2C5.82331983%20C14.7851257%2C6.05510385%2014.8485393%2C6.29176662%2014.9966829%2C6.47387701%20L15.8152518%2C7.48012983%20C16.0615827%2C7.78294019%2016.0615827%2C8.21705981%2015.8152518%2C8.51987017%20L14.9966829%2C9.52612299%20C14.8485393%2C9.70823338%2014.7851257%2C9.94489615%2014.8223666%2C10.1766802%20L15.0281417%2C11.4574051%20C15.0900653%2C11.842812%2014.8730055%2C12.2187707%2014.5082715%2C12.3578467%20L13.2962436%2C12.8200027%20C13.0768923%2C12.9036432%2012.9036432%2C13.0768923%2012.8200027%2C13.2962436%20L12.3578467%2C14.5082715%20C12.2187707%2C14.8730055%2011.842812%2C15.0900653%2011.4574051%2C15.0281417%20L10.1766802%2C14.8223666%20C9.94489615%2C14.7851257%209.70823338%2C14.8485393%209.52612299%2C14.9966829%20L8.51987017%2C15.8152518%20C8.21705981%2C16.0615827%207.78294019%2C16.0615827%207.48012983%2C15.8152518%20L6.47387701%2C14.9966829%20C6.29176662%2C14.8485393%206.05510385%2C14.7851257%205.82331983%2C14.8223666%20L5.82331983%2C14.8223666%20Z%22%2F%3E%0A%20%20%20%20%3Cpolyline%20stroke%3D%22%23FFFFFF%22%20stroke-width%3D%221.6%22%20points%3D%224.755%208.252%207%2010.5%2011.495%206.005%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%2F%3E%0A%20%20%3C%2Fg%3E%0A%3C%2Fsvg%3E" width="13" height="12" style="margin-left:0;margin-right:0;margin_bottom:-2;">';
}elseif($user['verify'] == "4"){
$ver = ' <img src="img/verify_hacker.png" width="13" height="12" style="margin-left:0;margin-right:0;margin_bottom:-2;">';
}else{
$ver = '';
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
<br><a href="add_toclub.php?id='.$user['id'].'&club='.$clubdata['id'].'" id="button" style="clear:both;">Добавить в группу</a><br><br>
</div>
</div>
</div>
</td>
</tr>
</table>
<br><br>';
}
}
if($user['id'] == ""){
echo '<div style="margin:0 -10px;padding:55px;"><center><img src="img/error.png"><br><br><b style="font-size:25px;">Здесь ничего нет...</b><br><text style="font-size:14px;">Заявки отсутствуют.</text></center></div>';
}
?>
  </div>
</div>
 </div>
 </div>
 </div>
 <div>
 <? include('exec/footer.php'); ?>
 </div>
 </div>
 </body>
 <script type="text/javascript">
// 1
function _GeneralInfo()
{
  // Табы
  document.getElementById('GeneralInfoTab').className = 'SelectedTab';
  document.getElementById('RequestionsTab').className = 'Tab';
 
  // Страницы
  document.getElementById('_GeneralInfo').style.display = 'block';
  document.getElementById('_Requestions').style.display = 'none';
 
}
// 2
function _RequestionsTab()
{
  document.getElementById('GeneralInfoTab').className = 'Tab';
  document.getElementById('RequestionsTab').className = 'SelectedTab';
 
  // Страницы
  document.getElementById('_GeneralInfo').style.display = 'none';
  document.getElementById('_Requestions').style.display = 'block';
 
}
</script>
</html>
<?php }else if($_SESSION['loginin'] != "1"){
echo '<meta charset="utf-8">Пожалуйста, авторизируйтесь.<meta http-equiv="refresh" content="3;blank/../">';
exit();
}
}else{
echo '<meta charset="utf-8">Вы не являетесь владельцем этой группы.';
}
}
?>