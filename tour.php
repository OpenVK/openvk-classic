<?php
session_start();
include 'exec/dbconnect.php';
include('exec/check_user.php');
include 'exec/datefn.php';
include 'exec/header.php';
include 'exec/leftmenu.php';
?>
<div id="content-infoname"><b>Тур по сайту</b></div>
<div style="min-width:0;width:415px;min-height:300px;float:left;margin-top:-10px;border-right:#BEBEBE solid 1px;">
<br>
<?php if ($_GET['a'] == 1){?>
Ну вот, вы стали или хотите стать участником нашего плениума, и сейчас мы вам расскажем о основных функциях этой социальной сети. <br><br>
<b>OpenVK</b> - клон ВКонтакте/Facebook, но с открытым исходным кодом и адаптивным дизайном для старых браузеров. Надо знать, что OpenVK не является точной копией ВКонтакте.<br>
<img src="img/tour1.gif"><br>
После входа в аккаунт вы сразу попадайте в свою анкету, вы можете заполнить информацию о себе в настройках. <br>Остальные функции находятся в шапке и меню сайта.<br>Если вы видите галочку около имени в анкете, значит этот человек подтвердил свою личность.<br><center><a id="button" href="tour.php?a=2">Далее →</a></center>
<?php }else if($_GET['a'] == 2){?>
Группы - одна из важных частей социальной сети. Они тут тоже есть, пользователь может его спокойно создать без проблем и стукача в тех поддержку. <br>
<img src="img/tour2.gif"> <br>
<center><a id="button" href="tour.php?a=3">Далее →</a></center>
<?php }else if($_GET['a'] == 3){?>
<h4>Создавайте фотоальбомы</h4>
<ul>
    <li>На Вашей странице находятся ссылки на Ваши фотоальбомы.</li>
    <li>Вы определяете, кому доступен тот или иной Ваш альбом.</li>
    <li>Вы можете отмечать на фотографиях лица друзей.</li>
    <li>И конечно, Ваши друзья могут комментировать Ваши фотографии.</li>
</ul>
<br>
<img src="img/tour3.gif"> 
<center>Вы сможете загрузить столько фотографий, сколько захотите. Ограничения устанавливаете только Вы.</center>
<?php } ?>
</div>
<div style="float:right;width:200px;margin-top:-8px;">
<div style="margin:10px;">
<a id="aprofile" href="tour.php?a=1">Ваша страница</a>
<a id="aprofile" href="tour.php?a=2">Группы</a>
<a id="aprofile" href="tour.php?a=3">Фотографии</a>
<hr style="margin-left:-14px;margin-right:-20px;margin-top:10px;margin-bottom:10px;">
</div>
</div>
</div>
<div>
<?php include 'exec/footer.php'; ?>
</div>