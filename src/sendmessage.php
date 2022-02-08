<?php 
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
/*if ($_GET['id'] == null) { echo '<meta charset="utf-8">Что-бы написать сообщение, допишите ?id=, где id= - ваш друг.<br>https://openvk.gfx3336007.com/sendmessage.php?id=2 - <b> Пример </b>'; exit(); }
никита (или вова) блять чо ты делаешь заебал (- илья) */
if($_SESSION['loginin'] == "1"){
include('exec/header.php');
include('exec/leftmenu.php');
?>
<div>
<div id="content-infoname"><b>Личные сообщения</b></div>

<div class="messages-view">
    <h3>Сообщение:</h3>
    <hr>
    <form action="send_message.php" method="post">
    <table>
      <tr>
        <td>
          <table>
            <tr>
              <td style="font-size: 11px;">
                <span>Кому:</span> 
              </td>
              <td style="font-size: 11px;">
              	<select name="id">
                <?php
                $qs = $dbh1->prepare("SELECT * FROM friends WHERE id1 = '".$_SESSION['id']."'");
                $qs->execute();
                while($fr = $qs->fetch()){
$qu = $dbh1->prepare("SELECT * FROM users WHERE id = '".$fr['id2']."'");
$qu->execute();
while ($user = $qu->fetch()) {
	if ($_GET['id'] != null) {
		if ($_GET['id'] == $user['id']) {
echo '<option value="'.$user['id'].'" selected>'.$user['name'].' '.$user['surname'].'</option>';
		}
	}else{
		echo '<option value="'.$user['id'].'">'.$user['name'].' '.$user['surname'].'</option>';
	}
}
}
                ?>
            </select>
              </td>
            </tr>
            <tr>
              <td style="font-size: 11px;">
                <span>Тема:</span>
              </td>
              <td style="font-size: 11px;">
                <input type="text" name="topic">
              </td>
            </tr>
            <tr>
              <td style="font-size: 11px;">
                <span>Сообщение:</span>
              </td>
              <td style="font-size: 11px;">
                <?php echo $im['topic']?>
              </td>
            </tr>            
          </table>
        </td>
      </tr>
    </table>
    <textarea rows="5" id="text" name="text" style="min-width:420px;max-width:420px;min-height:71px;"></textarea><br><br>
    <input type="submit" id="button" value="Отправить">
    </form>
  </div><br><br>
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