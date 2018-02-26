<?php

session_start();

$id = $_GET['id'];

include 'exec/dbconnect.php';

include 'exec/check_user.php';

include 'exec/header.php';

include 'exec/leftmenu.php';

$q = "SELECT * FROM rule WHERE id='".$id."'"; // выбираем нашего 

 $q1 = $dbh1->prepare($q); // отправляем запрос серверу

 $q1 -> execute(); 

 $buga = $q1->fetch(); // ответ в переменную 

?>

<div style="margin-bottom:10px;">

<div id="content-infoname"><span style="font-weight:bold;color:#000000;">Правила</span><div style="float:right;"><span style="font-style:italic;">последнее обновление: 14/12/2017 (DD/MM/YYYY)</span></div></div>

<? if($id == "1"){ ?>

<div id="faqhead">Правила сайта</div>

<div id="faqcontent">С правилами сайта, вы можете ознакомиться тут: <a href="/rules.txt">https://openvk.gfx3336007.com/rules.txt</a></div>

<? } ?>

<? if($id == "2"){ ?>

<div id="faqhead">Правила оформления отчета</div>

<div id="faqcontent"><b>1. </b>Не писать в название отчёта "Баг", "очень странный баг", "что-то не так" и тому подобное.<br>
<b>2. </b>Уточните проблему в описании, напишите с какого адреса вы переходили и куда попали (если баг только на одной странице) и с какого браузера вы заходите или напишите свой User-Agent. При желании прикрепите ссылку на картинку (залить фотографию можно через серфис imgur).<br>
<center><b>Соблюдайте правила!</b></center></div>

<? } 

if($id == null){

	echo '<meta http-equiv="refresh" content="0.1;blank/../">';

	exit();

}

if($id == '0'){

	echo '<meta http-equiv="refresh" content="0.1;blank/../">';

	exit();

}?>



</div>

</div>

<div>

<?php include 'exec/footer.php'; ?>

</div>

</body>

</html>