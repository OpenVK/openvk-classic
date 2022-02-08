<?php 
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
include('exec/header.php');
include('exec/datefn.php');
include('exec/leftmenu.php'); ?>
<div id="content-infoname"><b>Пригласить</b>
</div>
<p>Вы можете пригласить <b>3 друзей</b> или <b>родственников</b> — это позволит им стать участниками <b>OpenVK</b>.<br>
Зарегистривовавшись, ваши близкие смогут всегда оставаться с вами <b>В Контакте</b>.<br><br>Скопируйте сообщение ниже и отправте человеку, которого хотели бы пригласить. Вы можете редактировать его как вам удобно, <b style="
    color: #ef0000;
">но не изменяя ссылку</b>. 
<br><br>
За каждого зарегистриванного по ссылке ниже человека вы получите 10% к <b>рейтингу</b>.</p>
<div style="
    width: max-content;
    margin: auto;
"><textarea style="width: 310px;height: 122px;padding: 10px;font-size: 12px;">Привет. Я сейчас сижу в OpenVK. Это как ВКонтакте, но только по образцу 2007 года. Регистрируйся по ссылке:
http://openvk.veselcraft.ru/register.php?invt=<?php echo $_SESSION['id'];?>


Вот моя страница: http://openvk.veselcraft.ru/id<?php echo $_SESSION['id'];?>

Добавляйся в друзья.</textarea></div>
<br>

  </div>
  </div>
  </div>
  <div>
  <? include('exec/footer.php'); ?>
  </div>
 </body>
</html>
