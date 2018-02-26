<?php
session_start(); // начинаем сессию
include('exec/dbconnect.php');
include('exec/header.php');
include('exec/leftmenu.php');

$captchaa = $_POST['captcha'];

    $_POST['name'] = htmlentities($_POST['name'],ENT_QUOTES);
    $_POST['surname'] = htmlentities($_POST['surname'],ENT_QUOTES);
    $_POST['name'] = str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['name']);
    $_POST['surname'] = str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['surname']);

if (!empty($_POST['login']) AND !empty($_POST['password']) AND !empty($_POST['name']) AND !empty($_POST['surname'])) {
    $checkquery = $dbh1->prepare("SELECT * FROM users WHERE login = '".$_POST['login']."'");
    $checkquery->execute();
    $resultcheck = $checkquery->fetch();
    if ($resultcheck['login'] == $_POST['login']) {
        echo "Этот пользователь с таким логином уже зарегистрирован!";
    }else{
        $captchaa = $_POST['captcha'];
        if ($_SESSION['sec_code'] != $captchaa) {
            echo "Капча введена неправильно!";
        }else{
$sql = "INSERT INTO users (`id`, `name`, `surname`, `regdate`, `login`, `password`, `regip`) VALUES (NULL, '".$_POST['name']."', '".$_POST['surname']."', '".date('d-m-Y H:i:s')."', '".$_POST['login']."', '".md5($_POST['password'])."', '".$_SERVER['REMOTE_ADDR']."')";
$query = $dbh1->prepare( $sql );
$query->execute();
$result = $query->fetch();
    session_start();
    $userr = $dbh1->prepare("SELECT * FROM users WHERE login = '".$_POST['login']."'");
    $userr->execute();
    $user = $userr->fetch();
    if (!empty($user['id'])){
    $_SESSION['loginin'] = '1'; // ставим сессионную переменную
    $_SESSION['login'] = $user['login']; 
    $_SESSION['id'] = $user['id'];
    $_SESSION['pass'] = $user['password']; // надо для проверки
    $_SESSION['groupu'] = $user['groupu']; // хм
  header('Location: id'.$_SESSION['id']);
}else{
    echo '<p> error </p>';
}
}
}
}

    ?>


<div id="content-infoname"><b>Регистрация</b></div>
  <form method="post">
    <!--**** save_user.php - это адрес обработчика.  То есть, после нажатия на кнопку "Зарегистрироваться", данные из полей  отправятся на страничку save_user.php методом "post" ***** -->
<p>
    <label>Ваш логин:<br></label>
    <input name="login" type="text" size="15" maxlength="15">
    </p>
<!--**** В текстовое поле (name="login" type="text") пользователь вводит свой логин ***** -->
<p>
    <label>Ваш пароль:<br></label>
    <input name="password" type="password" size="15" maxlength="15">
    </p>
    <p>
    <label>Ваше Имя:<br></label>
    <input name="name" type="text" size="15" maxlength="15">
    </p>
<!--**** В текстовое поле (name="login" type="text") пользователь вводит свой логин ***** -->
<p>
    <label>Ваш Фамилия:<br></label>
    <input name="surname" type="text" size="15" maxlength="15">
    </p>
<!--**** В поле для паролей (name="password" type="password") пользователь вводит свой пароль ***** --> 
<p>
    <label>Капча:<br></label>
    <img src="captcha.php"><br>
    <input type="text" name="captcha"><br>
    <p>
        

    </p>
    <input type="submit" name="submit" value="Зарегистрироваться">
<!--**** Кнопочка (type="submit") отправляет данные на страничку save_user.php ***** --> 
</p></form>
  </div>
 </div>
 </body>
</html>