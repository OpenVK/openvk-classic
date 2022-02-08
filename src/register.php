<?php
session_start(); // начинаем сессию
include('exec/dbconnect.php');
include('exec/header.php');
include('exec/leftmenu.php');
$captchaa = $_POST['captcha'];
    $_POST['name'] = htmlentities($_POST['name'], ENT_QUOTES);
    $_POST['surname'] = htmlentities($_POST['surname'], ENT_QUOTES);
    $_POST['name'] = str_replace(array("\r\n", "\n"), '<br>', $_POST['name']);
    $_POST['surname'] = str_replace(array("\r\n", "\n"), '<br>', $_POST['surname']);
if (!empty($_POST['login']) and !empty($_POST['password']) and !empty($_POST['name']) and !empty($_POST['surname'])) {
    $checkquery = $dbh1->prepare("SELECT * FROM users WHERE login = :login");
    $checkquery->bindValue(":login", trim($_POST["login"]));
    $checkquery->execute();
    $resultcheck = $checkquery->fetch();
    if (!empty($resultcheck['login'])) {
        echo "<p>Этот пользователь с таким логином уже зарегистрирован!</p>";
    } else {
        $captchaa = $_POST['captcha'];
        if ($_SESSION['sec_code'] != $captchaa) {
            echo "<p>Капча введена неправильно!</p>";
        } else {
            if (isset($_GET['invt'])) {
                $qs = "SELECT * FROM users WHERE id = '".$_GET['invt']."'"; // выбираем нашего
                $qstyle = $dbh1->prepare($qs); // отправляем запрос серверу
                $qstyle -> execute();
                $qst = $qstyle->fetch();

                if ($qst['invitecode'] != 11 and $qst['invitecode'] != 22 and $qst['invitecode'] != 33) {
                    $rat = 10;
                    $invtstat = 11;
                } elseif ($qst['invitecode'] == 11) {
                    $rat = 10;
                    $invtstat = 22;
                } elseif ($qst['invitecode'] == 22) {
                    $rat = 10;
                    $invtstat = 33;
                } elseif ($qst['invitecode'] == 33) {
                    $rat = 0;
                    $invtstat = 33;
                }
                if ($qst['rating'] == null) {
                    $lastr = 0;
                } else {
                    $lastr = $qst['rating'];
                }
                $rating = $lastr + $rat;
                $qrr = "UPDATE `users` SET `invitecode` = '".$invtstat."', `rating` = '".$rating."' WHERE `users`.`id` = '".$_GET['invt']."'";
                $qrr1 = $dbh1->prepare($qrr);
                $qrr1 -> execute();
                $qrr1->fetch();
            }
            $query = $dbh1->prepare('INSERT INTO users (`id`, `name`, `surname`, `regdate`, `login`, `password`, `regip`) VALUES (NULL, :name, :surname, :regdate, :login, :password, :ip)');
            $query->bindValue(':name', $_POST['name']);
            $query->bindValue(':surname', $_POST['surname']);
            $query->bindValue(':regdate', time());
            $query->bindValue(':login', $_POST['login']);
            $query->bindValue(':password', md5($_POST['password']));
            $query->bindValue(':ip', $_SERVER['REMOTE_ADDR']);
    
            $query->execute();
            $result = $query->fetch();
            session_start();
            $userr = $dbh1->prepare('SELECT * FROM users WHERE login = :login');
            $userr->bindValue(':login', $_POST['login']);
            $userr->execute();
            $user = $userr->fetch();
            if (!empty($user['id'])) {
                $_SESSION['loginin'] = '1'; // ставим сессионную переменную
                $_SESSION['login'] = $user['login'];
                $_SESSION['id'] = $user['id'];
                $_SESSION['pass'] = $user['password']; // надо для проверки
                $_SESSION['groupu'] = $user['groupu']; // хм
                header('Location: id'.$_SESSION['id']);
            } else {
                echo '<p>Произошла непредвиденная ошибка.</p>';
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