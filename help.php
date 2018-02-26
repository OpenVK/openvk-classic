<?php
session_start();
include 'exec/dbconnect.php';
include 'exec/check_user.php';
include 'exec/header.php';
include 'exec/leftmenu.php';
?>
<div style="margin-bottom:10px;">
<div id="content-infoname"><span style="font-weight:bold;color:#000000;">Помощь</span><div style="float:right;"><span style="font-style:italic;">последнее обновление: 10/02/2018 (DD/MM/YYYY)</span></div></div>
<h4>Часто задаваемые вопросы</h4><br>
<div id="faqhead">Что это за сайт?</div>
<div id="faqcontent"><span style="font-weight:bold;color:#000000;">OpenVK</span> &mdash; открытая социальная сеть, распространяемая под лицензией GPL v3.0 (<a href="LICENSE.txt">изучить на англ.</a>, <a href="LICENSE_RU.txt">рус.</a> или <a href="LICENSE_UA.txt">укр.</a>). Не является точным клоном ВКонтакте.<br></div>
<div id="faqhead">Что может эта социальная сеть?</div>
<div id="faqcontent">Она имеет базовые функции, которые могут быть дополнены разработчиками нового проекта на основе нашей. Возможна привязка плагинов и тем.</div>
<div id="faqhead">Данную сеть разрабатывает команда или только один человек?</div>
<div id="faqcontent">Команда.
<br><br>
<table border="0" style="font-size:11px;">
<tr>
<td style="width:72px;vertical-align:top;">
<?php
$qt1 = $dbh1->prepare("SELECT avatar FROM users WHERE id = '1'");
$qt1->execute();
$t1 = $qt1->fetch();
?>
<a href="id1"><img <?php echo 'src="'.$t1['avatar'].'"'; ?> width="70px" height="auto" style="border:1px dashed #000;"></a>
</td>
<td style="vertical-align:0;">
<div style="padding-left:16px;">
<a href="id1" style="font-size:24px;font-weight:bold;">Владимир Баринов</a><br>
<span style="font-size:14px;color:#000000;">Основатель, главный разработчик.</span>
</div>
</td>
</tr>
<tr style="opacity:75%;">
<td style="padding-top:16px;width:72px;vertical-align:top;">
<?php
$qt2 = $dbh1->prepare("SELECT avatar FROM users WHERE id = '2'");
$qt2->execute();
$t2 = $qt2->fetch();
?>
<a href="id2"><img <?php echo 'src="'.$t2['avatar'].'"'; ?> width="70px" height="auto" style="border:1px dashed #000;"></a>
</td>
<td style="vertical-align:0;padding-top:16px;">
<div style="padding-left:16px;">
<a href="id2" style="font-size:24px;font-weight:bold;">Илья Прокопенко</a><br>
<span style="font-size:14px;color:#000000;">Сооснователь, второй разработчик. Ищет баги и убивает их. <span style="font-style:italic;">(ушёл с 09/02/2018)</span></span>
</div>
</td>
</tr>
<tr>
<td style="padding-top:16px;width:72px;vertical-align:top;">
<?php
$qt3 = $dbh1->prepare("SELECT avatar FROM users WHERE id = '3'");
$qt3->execute();
$t3 = $qt3->fetch();
?>
<a href="id3"><img <?php echo 'src="'.$t3['avatar'].'"'; ?> width="70px" height="auto" style="border:1px dashed #000;"></a>
</td>
<td style="vertical-align:0;padding-top:16px;">
<div style="padding-left:16px;">
<a href="id3" style="font-size:24px;font-weight:bold;">Даниил Мысливец</a><br>
<span style="font-size:14px;color:#000000;">Тестер. А так же хороший друг :)</span>
</div>
</td>
</tr>
<tr>
<td style="padding-top:16px;width:72px;vertical-align:top;">
<?php
$qt4 = $dbh1->prepare("SELECT avatar FROM users WHERE id = '4'");
$qt4->execute();
$t4 = $qt4->fetch();
?>
<a href="id4"><img <?php echo 'src="'.$t4['avatar'].'"'; ?> width="70px" height="auto" style="border:1px dashed #000;"></a>
</td>
<td style="vertical-align:0;padding-top:16px;">
<div style="padding-left:16px;">
<a href="id4" style="font-size:24px;font-weight:bold;">Артём Приходов</a><br>
<span style="font-size:14px;color:#000000;">Третий разработчик.</span>
</div>
</td>
</tr>
<tr>
<td style="padding-top:16px;width:72px;vertical-align:top;">
<?php
$qt5 = $dbh1->prepare("SELECT avatar FROM users WHERE id = '6'");
$qt5->execute();
$t5 = $qt5->fetch();
?>
<a href="id6"><img <?php echo 'src="'.$t5['avatar'].'"'; ?> width="70px" height="auto" style="border:1px dashed #000;"></a>
</td>
<td style="vertical-align:0;padding-top:16px;">
<div style="padding-left:16px;">
<a href="id6" style="font-size:24px;font-weight:bold;">Никита Волков</a><br>
<span style="font-size:14px;color:#000000;">Четвёртый разработчик. Какой-то битард.</span>
</div>
</td>
</tr>
</table></div>
<div id="faqhead">Не отображается дата последнего захода пользователя на сайт. Почему?</div>
<div id="faqcontent">Потому что пользователь не заходил в социальную сеть больше месяца.</div>
<div id="faqhead">Я нашёл баг. Куда можно обратиться?</div>
<div id="faqcontent">На данный момент у нас пока нет обратной связи. Вы можете написать свою жалобу <a href="club2">сюда</a>.</div>
<div id="faqhead">Баните ли вы фейковые страницы знаменитостей?</div>
<div id="faqcontent">Только по жалобе от самой знаменитости.</div>
<div id="faqhead">Не нашёл ответ на свой вопрос. Что делать?</div>
<div id="faqcontent">Опять же, на данный момент у нас нету обратной связи. Обращайтесь <a href="club2">сюда</a>. Вы можете использовать Русский или Украинский язык.</div>
<br>
</div>
</div>
<div>
<?php include 'exec/footer.php'; ?>
</div>
</body>
</html>
