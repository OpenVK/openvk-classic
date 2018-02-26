<?php 
session_start(); // начинаем сессию
include('exec/dbconnect.php');
if($_SESSION['loginin'] == "1"){
include('exec/datefn.php');
  if ($_GET['button'] != "") { 
  if ($_GET['verify'] == "yep") {
    $q = "SELECT * FROM `invitecodes` WHERE createdby = '".$_SESSION['id']."' ORDER BY id DESC LIMIT 1"; // добавляем коммент 
    $q1 = $dbh1->prepare($q); // отправляем запрос серверу
    $q1 -> execute(); 
    $q11 = $q1->fetch();
      
      
      if (time()-259200 > $q11['date'] OR empty($q11['date'])){
      $length = 14;
      $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
      $numChars = strlen($chars);
      $string = '';
      for ($i = 0; $i < $length; $i++) {
          $string .= substr($chars, rand(1, $numChars) - 1, 1);
      }
      $q2 = "INSERT INTO `invitecodes` (`id`, `code`, `createdby`, `usedby`, `date`) VALUES (NULL, '".$string."', '".$_SESSION['id']."', '0', '".time()."')"; // добавляем коммент 
      $q22 = $dbh1->prepare($q2); // отправляем запрос серверу
      $q22 -> execute(); 
      $q22->fetch();
      $_SESSION['errormsg'] = "invite-код создан! Код: ".$string;
      }else{
        $_SESSION['errormsg'] = "Вы уже создали invite-код! Подождите 72 часа. Последний был создан ".zmdate($q11['date']);
    }
    
  }else{
    $_SESSION['errormsg'] = "Вы не поставили флажок подтверждения!";
  }
}
include('exec/header.php');
include('exec/leftmenu.php');

?>
<div id="content-infoname"><b>Пригласить друга</b></div>
<?php if($_SESSION['errormsg']){
    echo '<div id="msg">'.$_SESSION['errormsg'].'</div><br>';
    $_SESSION['errormsg'] = NULL;
  } ?>
  <span>После нажатия на кнопку, вы получаете invite-код для приглашения друга в <b>OpenVK</b>. Код действует бесконечно, но его можно создать только раз в 72 часа (3 суток).</span>
<form method="get" action="invite.php"><br>
  <center><input type="checkbox" name="verify" value="yep"> подтверждение<br><br>
  <input type="submit" value="Создать invite-код!" id="button" name="button"></center><br><br>
  <table>
   <caption>Созданные invite-коды:</caption>
   <tr>
    <th>Код</th>
    <th>Дата</th>
    <th>Использован?</th>
   </tr>
   
     <?php $q = "SELECT * FROM `invitecodes` WHERE createdby = '".$_SESSION['id']."' ORDER BY id DESC"; // добавляем коммент 
    $q1 = $dbh1->prepare($q); // отправляем запрос серверу
    $q1 -> execute(); 
    while ($q11 = $q1->fetch()) {
      if ($q11['usedby'] != '0') {
        $used = "Да";
      }elseif($q11['usedby'] == '0'){
        $used = "Нет";
      }
      echo "<tr><td>".$q11['code']."</td><td>".zmdate($q11['date'])."</td><td>".$used."</td>";
    }

    ?>
   
 </table>
</form>
  </div>
 </div>
 </div>
 <div>
 <? include ('exec/footer.php'); ?>
 </div>
 </body>
</html>

<?php }else{echo '<meta charset="utf-8">Пожалуйста, авторизируйтесь.<meta http-equiv="refresh" content="3;blank/../">';} ?>