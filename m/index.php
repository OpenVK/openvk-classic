<?php 
session_start(); // начинаем сессию
include('exec/dbconnect.php');
if ($_SESSION['loginin'] != '1') {
 if ($_POST['login'] != null && $_POST['password'] != null) {
  $q = "SELECT * FROM users WHERE login='".$_POST['login']."'"; // выбираем нашего 
  $q1 = $dbh1->prepare($q); // отправляем запрос серверу
  $q1 -> execute(); 
  $user = $q1->fetch(); // ответ в переменную 
  if ($user['password'] == md5($_POST['password'])) {
  if ($user['ban'] == '1') {
    echo "<meta charset='utf-8'>Ваша страница был заблокированна модераторами. Комментарий модератора: ".$user['comment_ban'].". Сожалеем об этом.";
    exit();
  }
    
    $_SESSION['loginin'] = '1'; // ставим сессионную переменную
    $_SESSION['login'] = $user['login']; 
    $_SESSION['id'] = $user['id'];
    $_SESSION['admin'] = $user['groupu'];
    $_SESSION['pass'] = $user['password']; // надо для проверки
    $_SESSION['groupu'] = $user['groupu']; // хм
    header('Location: id'.$_SESSION['id']);
     }else{
      $errormsg = "myApp.alert('Проверьте правилость набранного пароля.', 'Ошибка');";
     }
   }
}else if($_SESSION['loginin'] == '1'){
  //print('<center>  <h3> Привет! Ты уже зашел на свой аккаунт, нажми <a href="/openvk/id' . $_SESSION['id'] . '">КЛИК </a> </h3>');
  header("Location: id".$_SESSION['id']);
  exit();
}
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
    <title>My App</title>
    <!-- Path to Framework7 iOS CSS theme styles-->
    <link rel="stylesheet" href="css/framework7.ios.min.css">
    <link rel="stylesheet" href="css/framework7.ios.colors.min.css">
  </head>
  <body class="layout-dark">
    <!-- Status bar overlay for full screen mode (PhoneGap) -->
    <div class="statusbar-overlay"></div>
    <!-- Panels overlay-->
    <div class="panel-overlay"></div>
    <!-- Left panel with reveal effect-->
    <div class="panel panel-left panel-reveal">
      <div class="content-block">
        <p>Left panel content goes here</p>
      </div>
    </div>
    <!-- Views -->
    <div class="views">
      <!-- Your main view, should have "view-main" class -->
      <div class="view view-main">
        <!-- Top Navbar-->
        <div class="navbar">
          <div class="navbar-inner">
            <!-- We need cool sliding animation on title element, so we have additional "sliding" class -->
            <div class="center sliding">OpenVK</div>
          </div>
        </div>
        <!-- Pages container, because we use fixed-through navbar and toolbar, it has additional appropriate classes-->
        <div class="pages navbar-through toolbar-through">
          <!-- Page, "data-page" contains page name -->
          <div data-page="index" class="page">
            <!-- Scrollable page content -->
            <div class="page-content">
              <div class="content-block">
              <p><b>Добро пожаловать в OpenVK.</b><br><br>
   Этот сайт создан для быстрой связи с друзьями, одноклассниками и однокурсниками.<br><br>
 Мобильная версия ещё в разработке. Могут отсутствовать некоторые функции.</p></div>
              <form method="post">
              <div class="content-block-title">Вход на сайт</div>
              <div class="list-block">
                <ul>
                 <!-- Text inputs -->
                  <li>
                    <div class="item-content">
                      <div class="item-inner">
                        <div class="item-title label">Логин</div>
                        <div class="item-input">
                          <input type="text" name="login">
                        </div>
                      </div>
                      
                      
                    </div>
                    <div class="item-content">
                    <div class="item-inner">
                        <div class="item-title label">Пароль</div>
                        <div class="item-input">
                          <input type="password" name="password">
                        </div>
                      </div>
                    </div>  
                  </li>            
            </div>
            <div class="content-block">
            <p class="login"><input value="Войти" type="submit" class="button button-big button-round"></p>
            </form>
          </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Path to Framework7 Library JS-->
    <script type="text/javascript" src="js/framework7.min.js"></script>
    <!-- Path to your app js-->
    <script type="text/javascript" src="js/openvk.js"></script>
    <script type="text/javascript">
      <?php  echo $errormsg; ?>
      $$('.login .button').on('click', function () {
    var container = $$('body');
    if (container.children('.progressbar, .progressbar-infinite').length) return; //don't run all this if there is a current progressbar loading
    myApp.showProgressbar(container, 'multi');
    setTimeout(function () {
        myApp.hideProgressbar();
    }, 3000);
    });
    </script>
  </body>
</html>  