<?php 
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
if (isset($_GET['id']) != null) {
 $id = $_GET['id'];
 $q = "SELECT * FROM users WHERE id='".$id."'"; // выбираем нашего 
 $q1 = $dbh1->prepare($q); // отправляем запрос серверу
 $q1 -> execute(); 
 $user = $q1->fetch(); // ответ в переменную 
}else if (isset($_SESSION['id']) != null){
  $id = $_SESSION['id'];
 $q = "SELECT * FROM users WHERE id='".$id."'"; // выбираем нашего 
 $q1 = $dbh1->prepare($q); // отправляем запрос серверу
 $q1 -> execute(); 
 $user = $q1->fetch(); // ответ в переменную 
}
 $h = "SELECT * FROM users"; // выбираем нашего 
 $h1 = $dbh1->prepare($h); // отправляем запрос серверу
 $h1 -> execute(); 
 $admin = $h1->fetch(); // ответ в переменную 
$_SESSION['userwall'] = $id;
if ($user['id'] == ""){
    header("Location: blank.php?id=1");
    exit();
}
if (isset($_GET['id']) == null) {
  header("Location: blank.php?id=1");
  exit();
}

$q = "SELECT * FROM users WHERE id='".$_SESSION['id']."'"; // выбираем нашего 
 $q1 = $dbh1->prepare($q); // отправляем запрос серверу
 $q1 -> execute(); 
 $userlogin = $q1->fetch();

$qthis = "SELECT groupu, verify FROM users WHERE id = '".$_SESSION['id']."'"; // выбираем нашего 
$q1this = $dbh1->prepare($qthis); // отправляем запрос серверу
$q1this -> execute(); 
$userthis = $q1this->fetch(); // ответ в переменную 
include('exec/datefn.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <!-- Required meta tags-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- Your app title -->
    <title>OpenVK</title>
    <!-- Path to Framework7 iOS CSS theme styles-->
    <link rel="stylesheet" href="css/framework7.ios.min.css">
    <link rel="stylesheet" href="css/framework7.ios.colors.min.css">
    <style>
  .facebook-card .card-header {
    display: block;
    padding: 10px;
  }
  .facebook-card .facebook-avatar {
    float: left;
  }
  .facebook-card .facebook-name {
    margin-left: 44px;
    font-size: 14px;
    font-weight: 500;
  }
  .facebook-card .facebook-date {
    margin-left: 44px;
    font-size: 13px;
    color: #8e8e93;
  }
  .facebook-card .card-footer {
    background: #1C1D1F;
  }
  .facebook-card .card-footer a {
    color: white;
    font-weight: 500;
  }
  .facebook-card .card-content img {
    display: block;
  }
  .facebook-card .card-content-inner {
    padding: 15px 10px;
  }  
  div[class*="col-"] {
  background: #000;
  text-align: center;
  color: #fff;
  border: 1px solid #333;
  padding: 5px;
}
.row {
  margin-bottom: 15px;
}     
</style>
  </head>
  <body id="app" class="layout-dark">
    <!-- Status bar overlay for full screen mode (PhoneGap) -->
    <div class="statusbar-overlay"></div>
    <!-- Panels overlay-->
    <div class="panel-overlay"></div>
    <!-- Left panel with reveal effect-->
    <div class="panel panel-left panel-cover panel-active">
      <div class="page" >
        <div class="page-content">
          
      <div class="content-block">
        <div class="blcok-title"></div>
        <div class="list links-list">
  <ul>
    <li>
        <a href="id<?php echo $_SESSION['id']?>" class="panel-close">
        
          <?php echo $userlogin['name'] ?>
        
      </a>
      </li>
  </ul>
</div>
      </div>
        </div>
      </div>
    </div>
    <!-- Views -->
    <div class="views">
      <!-- Your main view, should have "view-main" class -->
      <div class="view view-main">
        <!-- Top Navbar-->
        <div class="navbar">
          <div class="navbar-inner">
          	<div class="left">
              <a href="index.php" class="link back with-animation"><i class="icon icon-back"></i><span></span></a>
            </div>
            <!-- We need cool sliding animation on title element, so we have additional "sliding" class -->
            <div class="center sliding"><?php echo $user['name'] ?></div>
            <div class="right">
              <!-- 
                Right link contains only icon - additional "icon-only" class
                Additional "open-panel" class tells app to open panel when we click on this link
              -->
              <a href="#" class="link icon-only open-panel"><i class="icon icon-bars"></i></a>
            </div>
          </div>
        </div>
        <!-- Pages container, because we use fixed-through navbar and toolbar, it has additional appropriate classes-->
        <div class="pages navbar-through toolbar-through">
          <!-- Page, "data-page" contains page name -->
          <div data-page="index" class="page">
            <!-- Scrollable page content -->
            <div class="page-content">
            <div class="list-block media-list">
  <ul>
    <li>
      <div class="item-content">
        <div class="item-media"><img src="../avatar.php?image=<?php echo $user['avatar']?>" width="44"></div>
        <div class="item-inner">
          <div class="item-title-row">
            <div class="item-title"><?php echo $user['name'].' '.$user['surname']; ?></div>
          </div>
          <div class="item-subtitle"><span><?php if(time()-300 <= $user['lastonline']){ echo "<b>Online</b>";}else{ echo zmdate($user['lastonline']);}?></span></div>
          <div class="item-subtitle"><?php echo $user['status'];?></div>
          
        </div>
        
      </div>
      <div class="item-content">
      	<p class="buttons-row">
      		<?php if($_SESSION['loginin'] == "1"){
if($id != $_SESSION['id']){
$qfcs = $dbh1->prepare("SELECT * FROM subs WHERE `id1` = '".$_SESSION['id']."' AND `id2` = '".$id."'");
$qfcs->execute();
$fcs = $qfcs->fetch();
$qfcs2 = $dbh1->prepare("SELECT * FROM subs WHERE `id1` = '".$id."' AND `id2` = '".$_SESSION['id']."'");
$qfcs2->execute();
$fcs2 = $qfcs2->fetch();
$qfc = $dbh1->prepare("SELECT * FROM friends WHERE `id1` = '".$_SESSION['id']."' AND `id2` = '".$id."'");
$qfc->execute();
$fc = $qfc->fetch();
$qfc2 = $dbh1->prepare("SELECT * FROM friends WHERE `id1` = '".$id."' AND `id2` = '".$_SESSION['id']."'");
$qfc2->execute();
$fc2 = $qfc2->fetch();
if($fc['id1'] == $_SESSION['id'] && $fc['id2'] == $id && $fc2['id1'] == $id && $fc2['id2'] == $_SESSION['id']){
echo '<a href="#" class="button">Личное сообщение</a>
  			<a href="#" class="button">Удалить из друзей</a>';
}elseif($fcs['id1'] == $_SESSION['id'] && $fcs['id2'] == $id){
echo '<a href="#" class="button">Отменить заявку</a>';
}elseif($fcs2['id1'] == $id && $fcs2['id2'] == $_SESSION['id']){
echo '<a href="#" class="button">Принять запрос</a>';
}else{
echo '<a href="#" class="button">Добавить в друзья</a>';
}
}
} ?>
		</p>
      </div>

    </li>
  </ul>
</div>

      <div class="content-block">
<div class="row"><?php
   $qfriendscount = $dbh1->prepare("SELECT COUNT(1) FROM friends WHERE id1='".$id."'");
   $qfriendscount -> execute();
   $frcount = $qfriendscount->fetch();
   $frcount = $frcount[0];
   if ($frcount == '1') {
     $frcounnt = (string)$frcount."</text></center>друг";
   }elseif ($frcount == '2' OR $frcount == '3' OR $frcount == '4') {
     $frcounnt = (string)$frcount."</text></center>друга";
   }else{
     $frcounnt = (string)$frcount."</text></center>друзей";
   }

$qcountclub = $dbh1->prepare("SELECT COUNT(1) FROM clubsub WHERE `id1` = '".$id."'");
$qcountclub->execute();
$countclub = $qcountclub->fetch();
$countclub = $countclub[0];
if ($countclub == '1' OR $countclub == '21') {
$couuntclub = $countclub."</text></center>группа";
}elseif ($countclub == '2' OR $countclub == '3' OR $countclub == '4' OR $countclub == '22') {
$couuntclub = $countclub."</text></center>группы";
}else{
$couuntclub = $countclub."</text></center>групп";
}

$qvideoscount = $dbh1->prepare("SELECT COUNT(1) FROM video WHERE `aid` = '".$id."'");
   $qvideoscount -> execute();
   $vidcount = $qvideoscount->fetch();
   $vidcount = $vidcount[0];
   if ($vidcount == '1') {
     $vidcouunt = (string)$vidcount."</text></center>видео";
   }elseif ($vidcount == '2' OR $vidcount == '3' OR $vidcount == '4') {
     $vidcouunt = (string)$vidcount."</text></center>видео";
   }else{
     $vidcouunt = (string)$vidcount."</text></center>видео";
   }?>
        <div class="col-33"><center><text style="font-size: 20px;"><?php echo $frcounnt?></div>
        <div class="col-33"><center><text style="font-size: 20px;"><?php echo $couuntclub?></div>
        <div class="col-33"><center><text style="font-size: 20px;"><?php echo $vidcouunt?></div>
      </div>
    </div>
<?php
$q2 = $dbh1->prepare("SELECT * FROM wall WHERE idwall='".$id."' ORDER BY id DESC");
$q2 -> execute();
while($wall = $q2->fetch()) {
  
  if ($id != $wall['iduser']) {
   $q3 = $dbh1->prepare("SELECT * FROM users WHERE id='".$wall['iduser']."'"); // отправляем запрос серверу
   $q3 -> execute(); 
   $authorwall = $q3->fetch(); // ответ в переменную .
   if ($authorwall['avatar'] != null) {
    if ($wall['image'] != null) {
     $im = '<br><br><img width="100%" src="../imagep.php?image='.$wall['image'].'">';
   }else{
        $im = '';
      }
   echo '<div class="card facebook-card">
  <div class="card-header">
    <div class="facebook-avatar"><img src="../avatarc.php?image='.$authorwall['avatar'].'" width="34"></div>
    <div class="facebook-name"><a href="id'.$authorwall['id'].'">'.$authorwall['name'].' '.$authorwall['surname'].'</a></div>
    <div class="facebook-date">'.zmdate($wall['date']).'</div>
  </div>
  <div class="card-content">
    <div class="card-content-inner">
      <p>'.$wall['text'].$im.'</p>
    </div>
  </div>
  <div class="card-footer">
    <a href="#" class="link">Комментарии</a>
  </div>
</div>';
   }else{
    if ($wall['image'] != null) {
     $im = '<br><br><img width="100%" src="../imagep.php?image='.$wall['image'].'">';
   }else{
        $im = '';
      }
    echo '<div class="card facebook-card">
  <div class="card-header">
    <div class="facebook-avatar"><img src="../img/camera_200.png" width="34"></div>
    <div class="facebook-name">'.$authorwall['name'].' '.$authorwall['surname'].'</div>
    <div class="facebook-date">'.zmdate($wall['date']).'</div>
  </div>
  <div class="card-content">
    <div class="card-content-inner">
      <p>'.$wall['text'].$im.'</p>
    </div>
  </div>
  <div class="card-footer">
    <a href="#" class="link">Comment</a>
  </div>
</div>';
   }
  }else{
    if ($wall['image'] != null) {
     $im = '<br><br><img width="100%" src="../imagep.php?image='.$wall['image'].'">';
   }else{
        $im = '';
      }
    if ($user['avatar'] != null) {
    echo '<div class="card facebook-card">
  <div class="card-header">
    <div class="facebook-avatar"><img src="../avatarc.php?image='.$user['avatar'].'" width="34"></div>
    <div class="facebook-name">'.$user['name'].' '.$user['surname'].'</div>
    <div class="facebook-date">'.zmdate($wall['date']).'</div>
  </div>
  <div class="card-content">
    <div class="card-content-inner">
      <p>'.$wall['text'].$im.'</p>
    </div>
  </div>
  <div class="card-footer">
    <a href="#" class="link">Comment</a>
  </div>
</div>';
    }else{
      if ($wall['image'] != null) {
        $im = '<br><br><a href="watchi.php?image='.$wall['image'].'"><img src="imagep.php?image='.$wall['image'].'"></a>';
      }else{
        $im = '';
      }
     echo '<div class="card facebook-card">
  <div class="card-header">
    <div class="facebook-avatar"><img src="../img/camera_200.png" width="34"></div>
    <div class="facebook-name">'.$user['name'].' '.$user['surname'].'</div>
    <div class="facebook-date">'.zmdate($wall['date']).'</div>
  </div>
  <div class="card-content">
    <div class="card-content-inner">
      <p>'.$wall['text'].$im.'</p>
    </div>
  </div>
  <div class="card-footer">
    <a href="#" class="link">Comment</a>
  </div>
</div>';
    }
}
}
?>
          </div>
        </div>
      </div>
    </div>
    <!-- Path to Framework7 Library JS-->
    <script type="text/javascript" src="js/framework7.min.js"></script>
    <!-- Path to your app js-->
    <script type="text/javascript" src="js/openvk.js"></script>
  </body>
</html>  