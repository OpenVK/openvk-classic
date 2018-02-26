<?php
session_start();
include "exec/dbconnect.php";
include "exec/check_user.php";
include "exec/datefn.php";
if($_SESSION['loginin'] != "1"){
$_SESSION['errormsg'] = "Пожалуйста, авторизируйтесь.";
header("Location: blank/..");
exit();
}
include "exec/header.php";
include "exec/leftmenu.php";
?>
<style>
#content-infoname{
margin-bottom:0px;
}

.im{
text-decoration:none;
color:black;
margin:-10px;
}

.im:hover{
text-decoration:none;
color:black;
}

.im-mess{
border-top:solid 1px #e7e8ec;
}

.im-mess:hover{
background:#F5F7FA;
}

.im-mess-unread{
border-top:solid 1px #e7e8ec;
background:#FAFBFD;
}

.im-mess-unread:hover{
background:#F5F7FA;
}

.messages-listelement{
width:639px;
}
</style>

<? if ($_GET == null){ ?>
<div id="content-infoname"><b>Личные сообщения</b><div style="float:right;"><a href="sendmessage.php">Написать сообщение</a></div></div>
<div>
	<ul id="Tabs">
  <li id="RecivedTab" class="SelectedTab"><a href="#" onclick=" Recived(); return false;">Полученные</a></li>
	<li id="SendedTab" class="Tab"><a href="#" onclick="Sended(); return false;">Отправленные</a></li>
	
</ul>
<div id="Content" style="width:619px;">
	<!-- Первая -->
	<div id="Recived">
		<p>
<?php 
$qim1 = $dbh1->prepare("SELECT * FROM `messages` WHERE id2 = '".$_SESSION['id']."' ORDER BY id DESC");
$qim1->execute();
while($im1 = $qim1->fetch()){
if($im1['topic']){
$top =  ' / '.$im1['topic'];
}
if($im1['readed'] == "0"){
$redit = "-unread";
}else{
$redit = "";
}
$imc1 = "1";
$quser = $dbh1->prepare("SELECT * FROM `users` WHERE id = '".$im1['id1']."'");
$quser->execute();
$user = $quser->fetch();
if ($im1['readed'] == "0") {
  $readedd = 'style="background-color: #CCC"';
}else{
  $readedd = '';
}
if ($user['avatar'] == "") {
  $avatar = 'img/camera_200.png';
}else{
  $avatar = 'avatarc.php?image='.$user['avatar'];
}
/*echo '
<a href="messages.php?id='.$im1['id'].'">
<table class="messages-listelement" '.$readedd.'>
      <tr>
        <td>
          <img src="'.$avatar.'" width="50">
        </td>
        <td width="559px">
          <table>
            <tr>
              <td style="font-size: 11px;">
                '.$user['name'].' '.$user['surname'].'
              </td>
              <td style="font-size: 11px;color: #555;">
                '.$im1['topic'].'
              </td>
            </tr>
            <tr>
              <td style="font-size: 11px;color: #111;">
                '.zmdate($im1['date']).'
              </td>
              <td style="font-size: 11px;color: #777;">
                '.$im1['text'].'
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    </a>';*/
?>
<a href="messages.php?id=<?php echo $im1['id']; ?>" class="im">
<div class="im-mess<?php echo $redit; ?>" style="padding:15px;margin:0 -10px;">
<table border="0" style="font-size:11px;">
<tr>
<td style="width:54px;"><img src="<?php echo $avatar; ?>" width="50px" height="auto"></td>
<div style="float:right;"><?php
$daydate = date("z",$im1['date']);
$daynow = date("z",time());
if($daynow == $daydate){
echo date("H:i",$im1['date']);
}else{
echo zmdate($im1['date']);
}
$im1['text'] = htmlentities($im1['text'],ENT_QUOTES);
$im1['text'] = str_replace(array("\r\n", "\r", "\n", "<", ">", "<script>", "&"), '<br>', $im1['text']);
?></div>
<td style="padding-left:10px;"><b style="font-size:14px;"><?php echo $user['name'].' '.$user['surname']; ?></b><br><div style="margin-top:8px;"></div>
<?php echo $im1['text']; ?>
</td>
</tr>
</table>
</div>
</a>
<?php
}
if($imc1 != "1"){
echo '<center><div style="margin:80px 120px;">
<table>
<tr>
<td style="width:80px;">
<img src="new/img/msnofo-error.png" style="border-radius:50%;margin-bottom:-3px;">
</td>
<td style="margin-left:8px;">
<b style="font-size:26px;">Пусто.</b><br>
<span style="font-size:13px;color:#000;">Вы можете зайти в список <a href="friends.php">своих друзей</a> и выбрать того, с кем Вы хотите пообщаться.</span>
</td>
</tr>
</table>
</div></center>';
} ?>
  
    
</p>
	</div>
 
	
	<div id="Sended" style="display: none;">
		<p><?php 
$qim2 = $dbh1->prepare("SELECT * FROM `messages` WHERE id1 = '".$_SESSION['id']."' ORDER BY id DESC");
$qim2->execute();
while($im2 = $qim2->fetch()){
if($im2['topic']){
$top =  ' / '.$im2['topic'];
}
if($im2['readed'] == "0"){
$redit = "-unread";
}else{
$redit = "";
}
$imc2 = "1";
$quser = $dbh1->prepare("SELECT * FROM `users` WHERE id = '".$im2['id2']."'");
$quser->execute();
$user = $quser->fetch();
if ($im2['readed'] == "0") {
  $readedd = 'style="background-color: #CCC"';
}else{
  $readedd = '';
}
if ($user['avatar'] == null) {
  $avatar = "img/camera_200.png";
}else{
  $avatar = 'avatarc.php?image='.$user['avatar'];
}
/*echo '
<table class="messages-listelement" '.$readedd.'>
      <tr>
        <td>
          <img width="50" src="'.$avatar.'">
        </td>
        <td width="559px">
          <table>
            <tr>
              <td style="font-size: 11px;">
                '.$user['name'].' '.$user['surname'].'
              </td>
              <td style="font-size: 11px;color: #555;">
                '.$im2['topic'].'
              </td>
            </tr>
            <tr>
              <td style="font-size: 11px;color: #111;">
                '.zmdate($im2['date']).'
              </td>
              <td style="font-size: 11px;color: #777;">
                '.$im2['text'].'
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>';*/
?>
<div class="im" style="margin:0 -10px;">
<div class="im-mess<?php echo $redit; ?>" style="padding:15px;">
<table border="0" style="font-size:11px;">
<tr>
<td style="width:54px;"><img src="<?php echo $avatar; ?>" width="50px" height="auto"></td>
<div style="float:right;"><?php
$daydate = date("z",$im2['date']);
$daynow = date("z",time());
if($daynow == $daydate){
echo date("H:i",$im2['date']);
}else{
echo zmdate($im2['date']);
}
$im2['text'] = htmlentities($im2['text'],ENT_QUOTES);
$im2['text'] = str_replace(array("\r\n", "\r", "\n", "<", ">", "<script>", "&"), '<br>', $im2['text']);
?></div>
<td style="padding-left:10px;"><b style="font-size:14px;"><?php echo $user['name'].' '.$user['surname']; ?></b><br><div style="margin-top:8px;"></div>
<text style="padding-right:5px;color:#8b939b;">Вы:</text><?php echo $im2['text']; ?>
</td>
</tr>
</table>
</div>
</div>
<?php
}
if($imc2 != "1"){
echo '<center><div style="margin:80px 120px;">
<table>
<tr>
<td style="width:80px;">
<img src="new/img/msnofo-error.png" style="border-radius:50%;margin-bottom:-3px;">
</td>
<td style="margin-left:8px;">
<b style="font-size:26px;">Пусто.</b><br>
<span style="font-size:13px;color:#000;">Вы можете зайти в список <a href="friends.php">своих друзей</a> и выбрать того, с кем Вы хотите пообщаться.</span>
</td>
</tr>
</table>
</div></center>';
}
?></p>
	</div>
</div>
<script type="text/javascript">
// 1
function Recived()
{
  // Табы
  document.getElementById('RecivedTab').className = 'SelectedTab';
  document.getElementById('SendedTab').className = 'Tab';
 
  // Страницы
  document.getElementById('Recived').style.display = 'block';
  document.getElementById('RecivedTab').className = 'SelectedTab';
  document.getElementById('Sended').style.display = 'none';
 
}
// 2
function Sended()
{
  // Табы
  document.getElementById('RecivedTab').className = 'Tab';
  document.getElementById('SendedTab').className = 'SelectedTab';
 
  // Страницы
  document.getElementById('Recived').style.display = 'none';
  document.getElementById('Sended').style.display = 'block';
 
}
</script>
<!--
<a href="#" class="testim">
<div class="testim-mess" style="padding:15px;margin:0 -10px;">
<table border="0" style="font-size:11px;">
<tr>
<td style="width:54px;"><img src="content/avatars/5150282922.jpg" width="50px" height="auto"></td>
<div style="float:right;">13:37</div>
<td style="padding-left:10px;"><b style="font-size:14px;">Илья Прокопенко</b><br><div style="margin-top:8px;"></div><text style="padding-right:5px;color:#8b939b;">Вы:</text>тест
</td>
</tr>
</table>
</div>
</a>
-->
</div>
<?php }else{ 
  $qim = $dbh1->prepare("SELECT * FROM `messages` WHERE id = '".$_GET['id']."' ORDER BY id DESC");
$qim->execute();
$im = $qim->fetch();
if ($im['id2'] != $_SESSION['id']) {
  echo 'Security Error!'; 
  echo '<script type="text/javascript">'; 
echo 'window.location.href="index.php";'; 
echo '</script>'; 
  exit();
}

$qimq = $dbh1->prepare("UPDATE `messages` SET `readed` = '1' WHERE id = ".$_GET['id']);
$qimq->execute();
$qimq->fetch();

$quser = $dbh1->prepare("SELECT * FROM `users` WHERE id = '".$im['id1']."'");
$quser->execute();
$user = $quser->fetch();
$im['topic'] = htmlentities($im['topic'],ENT_QUOTES);
$im['topic'] = htmlentities($im['topic'],ENT_QUOTES);
$im['topic'] = str_replace(array("\r\n", "\r", "\n", "<", ">"), '<br>', $im['topic']);

?>
<div id="content-infoname"><b><a href="messages.php">Личные сообщения</a> » Просмотр сообщения</b></div>
<div>
  <div class="messages-view">
    <h3>Сообщение:</h3>
    <hr>
    <span style="font-size: 9px"><?php echo zmdate($im['date']) ?></span>
    <table>
      <tr>
        <td>
          
        	<?php if($user['avatar'] != ""){?>
          <img src="avatarc.php?image=<?php echo $user['avatar'] ?>">
          <?php }else{?>
          <img src="img/camera_200.png" width="50">
          <?php }?> 

        </td>
        <td>
          <table>
            <tr>
              <td style="font-size: 11px;">
                <span>От кого:</span> 
              </td>
              <td style="font-size: 11px;">
                <?php echo '<a href="id'.$user['id'].'">'.$user['name'].' '.$user['surname'].'</a>'?>
              </td>
            </tr>
            <tr>
              <td style="font-size: 11px;">
                <span>Кому:</span>
              </td>
              <td style="font-size: 11px;">
                Вам
              </td>
            </tr>
            <tr>
              <td style="font-size: 11px;">
                <span>Тема:</span>
              </td>
              <td style="font-size: 11px;">
                <?php echo $im['topic']?>
              </td>
            </tr>
            <tr>
              <td style="font-size: 11px;">
                <span>Сообщение:</span>
              </td>
              <td style="font-size: 11px;">
                <?php echo $im['text']?>
              </td>
            </tr>
            
          </table>
        </td>
      </tr>
    </table>
    <form action="send_message.php" method="post">
      <input name="id" type="hidden" value="<?php echo $user['id'] ?>">
      <input type="hidden" name="topic" value="<?php echo 'Re: '.$im['topic']?>">
    <textarea rows="5" id="text" name="text" style="min-width:420px;max-width:420px;min-height:71px;"></textarea><br><br>
    <input type="submit" id="button" value="Отправить">
    </form>
  </div><br>
    
</p>
  </div>
 
  
  
</div>

</div>

<?php } ?>
</div>
<div>
<?php include "exec/footer.php"; ?>
</div>
</body>
</html>