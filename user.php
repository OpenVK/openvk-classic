<?php
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');

if (isset($_GET['id']) != null) {
    $id = $_GET['id'];
    $q = "SELECT * FROM `users` WHERE id='".$id."'"; // выбираем нашего
 $q1 = $dbh1->prepare($q); // отправляем запрос серверу
 $q1 -> execute();
    $user = $q1->fetch(); // ответ в переменную
} elseif (isset($_SESSION['id']) != null) {
    $id = $_SESSION['id'];
    $q = "SELECT * FROM `users` WHERE id='".$id."'"; // выбираем нашего
 $q1 = $dbh1->prepare($q); // отправляем запрос серверу
 $q1 -> execute();
    $user = $q1->fetch(); // ответ в переменную
}
 $h = "SELECT * FROM `users`"; // выбираем нашего
 $h1 = $dbh1->prepare($h); // отправляем запрос серверу
 $h1 -> execute();
 $admin = $h1->fetch(); // ответ в переменную
$_SESSION['userwall'] = $id;
if ($user['id'] == "") {
    header("Location: blank.php?id=1");
    exit();
}
if (isset($_GET['id']) == null) {
    header("Location: blank.php?id=1");
    exit();
}

$qthis = "SELECT `groupu`, `verify` FROM `users` WHERE id = '".$_SESSION['id']."'"; // выбираем нашего
$q1this = $dbh1->prepare($qthis); // отправляем запрос серверу
$q1this -> execute();
$userthis = $q1this->fetch(); // ответ в переменную
include('exec/header.php');
include('exec/datefn.php');
include('exec/leftmenu.php');
?>
<script type="text/javascript" src="js/profile.js?<?echo date(" U");?>
">
</script>
<div id="content-infoname"><b><?php echo $user['name'].' '.$user['surname']; ?></b><?php if ($user['verify'] == '1') {
    echo '<img src="img/verify_silver.svg" width="12" height="12" style="margin-left:5px;margin-right:5px;margin-bottom:-2px;" onmouseenter="openVerify();" onmouseleave="openVerify();"><div id="verify" style="display:none;margin:5px 0;">Верифицированная страница</div>';
} ?><?php if ($user['verify'] == '5') {
    echo '<img src="img/verify_green.svg" width="12" height="12" style="margin-left:4px;margin-right:4px;margin-bottom:-2px;" onmouseenter="openVerify();" onmouseleave="openVerify();"><div id="verify" style="display:none;margin:5px 0;">Верифицированная страница администратора OpenVK</div>';
} ?><?php if ($user['verify'] == '3') {
    echo '<img src="img/verify_blue.svg" width="12" height="12" style="margin-left:4px;margin-right:4px;margin-bottom:-2px;" onmouseenter="openVerify();" onmouseleave="openVerify();"><div id="verify" style="display:none;margin:5px 0;">Верифицированная страница тестера OpenVK</div>';
} ?>
    <?php if ($_SESSION['id'] == $id) {?><span><b>(это Вы)</b></span><?php }
    if ($user['ban'] != '1') {
        if ($user['id'] != '100') {
            ?>
    <text style="font-size: 8pt; color: #aaa; float: right;"><?php if (time()-2629743 <= $user['lastonline']) {
                if (time()-300 <= $user['lastonline']) {
                    echo "<b>Онлайн</b>";
                } else {
                    if ($user['gender'] == '1') {
                        echo "был в сети ";
                    } elseif ($user['gender'] == '2') {
                        echo "была в сети ";
                    } elseif ($user['gender'] == '0') {
                        echo "было в сети ";
                    }
                    echo zmdate($user['lastonline']);
                }
            }
        } ?></text><?php
    }?></div>
<?php
if ($user['id'] == $_SESSION['id'] and $user['advice_settings'] != 5) {
        echo '<div style="
    background: #eceff3;
    margin-bottom: 10px;
    padding: 10px;
    line-height: 1.5;
    border: 1px solid #cacede;
">
<b>Добро Пожаловать</b> в <b>OpenVK.</b><br>
Вы только что прошли регистрацию. <br>
Заполните основную информацию о себе чтобы сделать свою страницу узнаваемой.
    <br>
    <div style="
    width: 100%;
    text-align: right;
"><a href="cluvd.php?id='.$_SESSION['id'].'" style="
    cursor: pointer;
">закрыть</a></div>
</div>';
    }
?>
<div id="content-left">
    <div id="content-avatar">
        <?php
    if ($user['avatar'] != null and $user['ban'] == '0') {
        echo '<img src="'.$user['avatar_200'].'" width="200px"><br>';
        if ($user['id'] != 100) {
            echo '<br>';
        }
    } else {
        if ($user['id'] == $_SESSION['id']) {
            echo '<form method="post" enctype="multipart/form-data" action="add_avatar.php"><div style="
    position: absolute;
    font-size: 12px;
    margin: 7px;
    margin-top: 116px;
" align="center"><label for="uppho" style="
    color: black;
    font-size: 11px;
	cursor: pointer;
">выберите фотографию</label><input style="display: none;" type="file" accept="image/jpeg,image/png,image/gif" name="picture" id="uppho"><input value="загрузить" type="submit" id="button" style="
    margin-left: 5px;
	cursor: pointer;
"></div></form>';
        } else {
            echo '<div style="
    position: absolute;
    font-size: 12px;
    margin: 0px 58px;
    margin-top: 120px;
" align="center"><label for="uppho" style="
    color: black;
    font-size: 11px;
	cursor: pointer;
">Нет фотографии</label></div>';
        }
        echo '<img src="img/camera_200.png"><br><br>';
    }
    /*if($user['advice_settings'] == '1'){
      echo '<img src="https://i.imgur.com/MuJ4hhF.png" width=200>';
    }*/
if ($id != 100) {
    if ($user['ban'] != '1') {
        if ($_SESSION['loginin'] == "1") {
            if ($id != $_SESSION['id']) {
                $qfcs = $dbh1->prepare("SELECT * FROM `subs` WHERE `id1` = '".$_SESSION['id']."' AND `id2` = '".$id."'");
                $qfcs->execute();
                $fcs = $qfcs->fetch();
                $qfcs2 = $dbh1->prepare("SELECT * FROM `subs` WHERE `id1` = '".$id."' AND `id2` = '".$_SESSION['id']."'");
                $qfcs2->execute();
                $fcs2 = $qfcs2->fetch();
                $qfc = $dbh1->prepare("SELECT * FROM `friends` WHERE `id1` = '".$_SESSION['id']."' AND `id2` = '".$id."'");
                $qfc->execute();
                $fc = $qfc->fetch();
                $qfc2 = $dbh1->prepare("SELECT * FROM `friends` WHERE `id1` = '".$id."' AND `id2` = '".$_SESSION['id']."'");
                $qfc2->execute();
                $fc2 = $qfc2->fetch();
                if ($id != '100') {
                    if ($_SESSION['id'] != $id and $_SESSION['groupu'] == 3) {
                        echo '<a style="color: gray;">Админ-панель пользователя:</a><hr style="border-style: dashed;border-width: 0.5px;border-color: #b8bdd0;margin: 5 0;">';
                        echo '<a id="aprofile" href="add_ban.php?id='.$user['id'].'">Заморозить</a>';
                        echo '<a id="aprofile" href="add_groupu.php?gr=3&id='.$user['id'].'">Назначить администратором</a>';
                        echo '<a id="aprofile" href="add_groupu.php?gr=2&id='.$user['id'].'">Назначить тестером</a>';
                        echo '<hr style="border-style: dashed;border-width: 0.5px;border-color: #b8bdd0;margin: 10 0;">';
                    }
                    if ($fc['id1'] == $_SESSION['id'] && $fc['id2'] == $id && $fc2['id1'] == $id && $fc2['id2'] == $_SESSION['id']) {
                        echo '<a id="aprofile" href="del_friend.php">Удалить из друзей</a><a id="aprofile" href="sendmessage.php?id='.$id.'">Отправить сообщение</a>';
                        $friends_verify = 1;
                    } elseif ($fcs['id1'] == $_SESSION['id'] && $fcs['id2'] == $id) {
                        echo '<a id="aprofile" href="del_friend_sub.php">Отменить заявку</a><div style="color:black;font-size:10px;margin-top:8px;margin-left:7px;">Вы подписаны на него</div>';
                        $friends_verify = 0;
                    } elseif ($fcs2['id1'] == $id && $fcs2['id2'] == $_SESSION['id']) {
                        echo '<a id="aprofile" href="add_friend.php">Добавить в друзья</a><div style="color:black;font-size:10px;margin-top:8px;margin-left:25px;">Подписан на Вас</div>';
                        $friends_verify = 0;
                    } else {
                        echo '<a id="aprofile"  href="add_friend_sub.php">Добавить в друзья</a>';
                        $friends_verify = 0;
                    }
                }
            }
        }
    }
    if ($_SESSION['id'] == $id) {
        echo '<a id="aprofile" href="edit_page.php">Редактировать страницу</a>';
    }
    if ($_SESSION['groupu'] == "2" and $_SESSION['id'] != $id) {
        echo '<a id="aprofile" href="admin_users.php?idu='.$user['id'].'">Админ-Панель Юзера</a>';
    } ?>

        <br>


        <?php
    $regs = 5;
    if ($user['avatar'] != null) {
        $avas = 25;
    } else {
        $avas = 0;
    }
    
    if ($user['gender'] == 1 or $user['gender'] == 2 or $user['gender'] == 3) {
        $gens = 10;
    } else {
        $gens = 0;
    }
    
    if ($user['aboutuser'] != null) {
        $abos = 10;
    } else {
        $abos = 0;
    }
    
    if ($user['email'] != null) {
        $ems = 20;
    } else {
        $ems = 0;
    }
    
    if ($user['telephone'] != null) {
        $phs = 20;
    } else {
        $phs = 0;
    }
    
    if ($user['status'] != null) {
        $stats = 10;
    } else {
        $stats = 0;
    }
    
    if ($user['rating'] == null) {
        $lastr = 0;
    } else {
        $lastr = $user['rating'];
    }
    $rejting = $regs + $avas + $gens + $abos + $ems + $phs + $stats + $lastr;
    if ($rejting > 100) {
        $rwr = $rejting/5;
        $ratwid = round($rwr);
    } elseif ($rejting <= 100) {
        $ratwid = $rejting*2;
    } ?>


        <div style="
<?php if ($rejting <= 100) { ?>
    background: #f7f7f7;
    border-top: 1px solid #ececec;
<?php } else { ?>
	background: #e1cd7b;
    border-top: 1px solid #bda954;
<?php } ?>
    height: 18px;
" align="center">
            <div style="
<?php if ($rejting <= 100) { ?>
    background: #dae1e7;
    border-top: 1px solid #b8bdd0;
<?php } else { ?>
    background: #cab563;
    border-top: 1px solid #a38b3d;
<?php } ?>
    height: 18px;
    margin-top: -1px;
    max-width: 200px;
    position: absolute;
    width: <?php echo $ratwid; ?>px;
"></div>
            <div style="
    width: max-content;
    position: relative;
<?php if ($rejting <= 100) { ?>
    color: #2b587a;
<?php } else { ?>
	color: #8e772f;
<?php } ?>
    padding: 2px 0;
"><?php echo $rejting; ?>%</div>

        </div>
        <?php
if ($rejting < 100 and $user['id'] == $_SESSION['id']) {
        echo '<br>';
    }
    if ($user['id'] == $_SESSION['id']) {
        if ($user['avatar'] == null) {
            echo '<div style="background: url(/img/images/icon3.gif) no-repeat 1px;padding: 4px 23px;padding-right: 0px;"><a>Загрузить фотографию </a><a style="color: black;">(+25%)</a></div>';
        }
    
        if ($user['gender'] != 1 and $user['gender'] != 2 and $user['gender'] != 3) {
            echo '<div style="background: url(/img/images/icon4.gif) no-repeat 1px;padding: 4px 23px;padding-right: 0px;"><a>Указать пол </a><a style="color: black;">(+10%)</a></div>';
        }
    
        if ($user['aboutuser'] == null) {
            echo '<div style="background: url(/img/images/icon1.gif) no-repeat 1px;padding: 4px 23px;padding-right: 0px;"><a>Рассказать о себе </a><a style="color: black;">(+10%)</a></div>';
        }
    
        if ($user['email'] == null) {
            echo '<div style="background: url(/img/images/icon2.gif) no-repeat 1px;padding: 4px 23px;padding-right: 0px;"><a>Указать email </a><a style="color: black;">(+20%)</a></div>';
        }
    
        if ($user['telephone'] == null) {
            echo '<div style="background: url(/img/images/icon2.gif) no-repeat 1px;padding: 4px 23px;padding-right: 0px;"><a>Указать номер телефона </a><a style="color: black;">(+20%)</a></div>';
        }
    
        if ($user['status'] == null) {
            echo '<div style="background: url(/img/images/icon5.gif) no-repeat 1px;padding: 4px 23px;padding-right: 0px;"><a>Написать статус </a><a style="color: black;">(+10%)</a></div>';
        }
    }
}
?>
    </div>

    <?php
   
   $qfriendscount = $dbh1->prepare("SELECT COUNT(1) FROM `friends` WHERE `id1`='".$id."'");
   $qfriendscount -> execute();
   $frcount = $qfriendscount->fetch();
   $frcount = $frcount[0];
   if ($frcount == '1') {
       $frcounnt = (string)$frcount." друг";
   } elseif ($frcount == '2' or $frcount == '3' or $frcount == '4') {
       $frcounnt = (string)$frcount." друга";
   } else {
       $frcounnt = (string)$frcount." друзей";
   }
   if ($frcount!=0) {
       ?>

    <div id="content-friends" class="content_left">
        <div id="content-wall-title" class="clear_fix" style="margin-top:15px;"
            onclick="hidePanel(this,<?echo $frcount; ?>);">
            <div class="hideTitle"></div>Друзья
        </div>
        <div id="profile_friends_list">
            <div id="content-wall-send">
                <?echo $frcounnt; ?><a href="/friends.php?id=<?echo $id; ?>" class="fl_r">Все</a></div>
            <div class="profile_info" style="padding:0px;">
                <?php
   
    $q4 = $dbh1->prepare("SELECT * FROM `friends` WHERE `id1`='".$id."' ORDER BY RAND() limit 6");
       $q4 -> execute();
       while ($friend1 = $q4->fetch()) {
           $q5 = $dbh1->prepare("SELECT * FROM `users` WHERE `id`='".$friend1['id2']."'"); // отправляем запрос серверу
           $q5 -> execute();
           $friend = $q5->fetch(); // ответ в переменную .
           if ($friend['ban'] != '1') {
               if ($friend['avatar_50'] != null) {
                   echo '<div id="content-friends-friend"><img id="avatar" src="'.$friend['avatar_50'].'" style="margin-top: 3px;">
     <b style="margin-right: 3px;"><a style="margin-top: 3px;" href="id'.$friend['id'].'">'.$friend['name'].'<br> <text style="font-size: 8px;">'.$friend['surname'].'</text></a></b></div>';
               } else {
                   echo '<div id="content-friends-friend"><img id="avatar" src="img/images/nophoto1.gif" width="50" style=" margin-top: 3px;">
     <b style="margin-right: 3px;"><a style="margin-top: 3px;" href="id'.$friend['id'].'">'.$friend['name'].'<br> <text style="font-size: 8px;">'.$friend['surname'].'</text></a></b></div>';
               }
           }
       } ?>
            </div>
        </div>
    </div>

    <?php
   }
   $qgroupscount = $dbh1->prepare("SELECT COUNT(1) FROM `clubsub` WHERE `id1`='".$id."'");
   $qgroupscount -> execute();
   $grcount = $qgroupscount->fetch();
   $grcount = $grcount[0];
   if ($grcount == '1') {
       $grcounnt = (string)$grcount." группа";
   } elseif ($grcount == '2' or $grcount == '3' or $grcount == '4') {
       $grcounnt = (string)$grcount." группы";
   } else {
       $grcounnt = (string)$grcount." групп";
   }
   
   if ($grcount!=0) {
       ?>
    <div id="content-groups" class="content_left">
        <div id="content-wall-title" class="clear_fix" style="margin-top:15px;"
            onclick="hidePanel(this,<?echo $grcount; ?>);">
            <div class="hideTitle"></div>Группы
        </div>
        <div id="profile_friends_list">
            <div id="content-wall-send">
                <?echo $grcounnt; ?><a href="/groups.php?id=<?echo $id; ?>" class="fl_r">Все</a></div>
            <div class="profile_info" style="padding:0px;">
                <?php

   $qsubclub = $dbh1->prepare("SELECT * FROM `clubsub` WHERE `id1` = '".$id."' ORDER BY RAND() LIMIT 5");
       $qsubclub->execute();
       while ($subclub = $qsubclub->fetch()) {
           $qsubu = $dbh1->prepare("SELECT * FROM `club` WHERE `id` = '".$subclub['id2']."'");
           $qsubu->execute();
           $subu = $qsubu->fetch();
           if ($subu['avatar'] != null) {
               echo '<table border="0" style="font-size:11px;clear:both;"><div style="clear:both;"><tr><td style="width:25px;margin-right:7px;"><img src="'.$subu['avatar'].'" width="25" height="auto" style="clear:both;"></td><td style="width:168px;"><b style="padding-left:7px;clear:both;"><a href="club'.$subu['id'].'" style="clear:both;">'.substr($subu['name'], 0, 45).'</a></b></td></tr></div></table>';
           } else {
               echo '<table border="0" style="font-size:11px;clear:both;"><div style="clear:both;"><tr><td style="width:25px;margin-right:7px;"><img src="img/images/nophoto1.gif" width="25" height="auto" style="clear:both;"></td><td style="width:168px;"><b style="padding-left:7px;clear:both;"><a href="club'.$subu['id'].'" style="clear:both;">'.substr($subu['name'], 0, 45).'</a></b></td></tr></div></table>';
           }
       } ?>
            </div>
        </div>
    </div>

    <?php
   }
   $qvideoscount = $dbh1->prepare("SELECT COUNT(1) FROM `video` WHERE `aid`='".$id."'");
   $qvideoscount -> execute();
   $vdcount = $qvideoscount->fetch();
   $vdcount = $vdcount[0];
   if ($vdcount == '1') {
       $vdcounnt = (string)$vdcount." видеозапись";
   } elseif ($vdcount == '2' or $vdcount == '3' or $vdcount == '4') {
       $vdcounnt = (string)$vdcount." видеозаписи";
   } else {
       $vdcounnt = (string)$vdcount." видеозаписей";
   }
   if ($vdcount!=0) {
       ?>
    <div id="content-groups" class="content_left">
        <div id="content-wall-title" class="clear_fix" style="margin-top:15px;"
            onclick="hidePanel(this,<?echo $vdcount; ?>);">
            <div class="hideTitle"></div>Видеозаписи
        </div>
        <div id="profile_friends_list">
            <div id="content-wall-send">
                <?echo $vdcounnt; ?><a href="/videos.php?id=<?echo $id; ?>" class="fl_r">Все</a></div>
            <div class="profile_info" style="padding:0px;">
                <?php
$qvideo = $dbh1->prepare("SELECT * FROM `video` WHERE `aid` = '".$id."' ORDER BY id DESC LIMIT 2");
       $qvideo->execute();
       while ($vid = $qvideo->fetch()) {
           $qg = $dbh1->prepare("SELECT * FROM `video` WHERE `id` = '".$vid['id']."'");
           $qg->execute();
           $video = $qg->fetch();
           if ($video['avatar']) {
               $av = $video['avatar'];
               $video['avatar'] = 'avatart.php?image='.$video['avatar'];
           } else {
               $video['avatar'] = "img/images/nophoto1.gif";
               $av = $video['avatar'];
           }
           echo '<table border="0" style="font-size:11px;clear:both;"><div style="clear:both;"><tr><td style="width:25px;margin-right:7px;"><img style="width: 170px;clear:both;margin: 0px 11px;" src="https://img.youtube.com/vi/'.$video['id_video'].'/0.jpg" height="auto" style="clear:both;"><div style="margin: 0px 11px;margin-top: 3px;"><b><a href="video'.$video['id'].'" style="clear:both;">'.$video['name'].'</a></b></div></td></tr></div></table>';
       } ?>

            </div>
        </div>
    </div>
    <?php
   }
   $qgiftscount = $dbh1->prepare("SELECT COUNT(1) FROM `giftogift` WHERE `toid`='".$id."'");
   $qgiftscount -> execute();
   $gfcount = $qgiftscount->fetch();
   $gfcount = $gfcount[0];
   if ($gfcount == '1') {
       $gfcounnt = (string)$vdcount." подарок";
   } elseif ($gfcount == '2' or $gfcount == '3' or $gfcount == '4') {
       $gfcounnt = (string)$gfcount." подарка";
   } else {
       $gfcounnt = (string)$gfcount." подарков";
   }
   if ($gfcount!=0) {
       ?>
    <div id="content-groups" class="content_left">
        <div id="content-wall-title" class="clear_fix" style="margin-top:15px;"
            onclick="hidePanel(this,<?echo $gfcount; ?>);">
            <div class="hideTitle"></div>Подарки
        </div>
        <div id="profile_friends_list">
            <div id="content-wall-send">
                <?echo $gfcounnt; ?><a href="/owngifts.php?id=<?echo $id; ?>" class="fl_r">Все</a></div>
            <div class="profile_info" style="padding:0px;">
                <?php
$qsi = "SELECT * FROM giftogift WHERE toid = '".$id."' ORDER BY RAND() LIMIT 4"; // выбираем нашего
$qsa = $dbh1->prepare($qsi); // отправляем запрос серверу
$qsa -> execute();
       while ($qsu = $qsa->fetch()) {
           $mama = $dbh1->prepare("SELECT * FROM `gifts` WHERE `id` = '".$qsu['giftid']."'");
           $mama->execute();
           $gafa = $mama->fetch();
           echo '<img style="width: 49px;" src="content/gift/'.$gafa['id'].'.jpg">';
       } ?>

            </div>
        </div>
    </div>
    <?php
   }
   $qalbumscount = $dbh1->prepare("SELECT COUNT(1) FROM `albums` WHERE `aid`='".$id."'");
   $qalbumscount -> execute();
   $alcount = $qalbumscount->fetch();
   $alcount = $alcount[0];
   if ($alcount == '1') {
       $alcounnt = (string)$alcount." видеозапись";
   } elseif ($alcount == '2' or $alcount == '3' or $alcount == '4') {
       $alcounnt = (string)$alcount." видеозаписи";
   } else {
       $alcounnt = (string)$alcount." видеозаписей";
   }
   
   if ($alcount!=0) {
       ?>
    <div id="content-groups" class="content_left">
        <div id="content-wall-title" class="clear_fix" style="margin-top:15px;"
            onclick="hidePanel(this,<?echo $alcount; ?>);">
            <div class="hideTitle"></div>Фотоальбомы
        </div>
        <div id="profile_friends_list">
            <div id="content-wall-send">
                <?echo $alcount; ?><a href="/albums.php?id=<?echo $id; ?>" class="fl_r">Все</a></div>
            <div class="profile_info" style="padding:0px;">
                <?php
 $qphoto = $dbh1->prepare("SELECT * FROM `albums` WHERE `aid` = '".$id."' ORDER BY RAND() LIMIT 2");
       $qphoto->execute();
       while ($pho = $qphoto->fetch()) {
           $qgg = $dbh1->prepare("SELECT * FROM `albums` WHERE `id` = '".$pho['id']."'");
           $qgg->execute();
           $photo = $qgg->fetch();

           $qphotoo = $dbh1->prepare("SELECT * FROM `photo` WHERE `album` = '".$photo['id']."' ORDER BY id LIMIT 1");
           $qphotoo->execute();
           $photoo = $qphotoo->fetch();
           if ($phocount == "0") {
               $photoalbum = "img/nophoto.jpg";
           } else {
               $photoalbum = $photoo['image'];
           }
           echo '<table border="0" style="font-size:11px;clear:both;"><div style="clear:both;"><tr><td style="width:25px;margin-right:7px;"><a href="album'.$photo['id'].'" style="clear:both;"><img src="'.$photoalbum.'" width="75" height="auto" style="clear:both;"></a></td><td style="width:168px;"><b style="padding-left:7px;clear:both;"><a href="album'.$photo['id'].'" style="clear:both;">'.$photo['name'].'</a></b></td></tr></div></table>';
       } ?>
            </div>
        </div>
    </div>

    <?php
   }
   $qnotesscount = $dbh1->prepare("SELECT COUNT(1) FROM `note` WHERE `aid`='".$id."'");
   $qnotesscount -> execute();
   $ntcount = $qnotesscount->fetch();
   $ntcount = $ntcount[0];
   if ($ntcount == '1') {
       $ntcounnt = (string)$ntcount." заметка";
   } elseif ($ntcount == '2' or $ntcount == '3' or $ntcount == '4') {
       $ntcounnt = (string)$ntcount." заметки";
   } else {
       $ntcounnt = (string)$ntcount." заметок";
   }
   
   if ($ntcount!=0) {
       ?>
    <div id="content-groups" class="content_left">
        <div id="content-wall-title" class="clear_fix" style="margin-top:15px;"
            onclick="hidePanel(this,<?echo $ntcount; ?>);">
            <div class="hideTitle"></div>Заметки
        </div>
        <div id="profile_friends_list">
            <div id="content-wall-send">
                <?echo $ntcounnt; ?><a href="/notes.php?id=<?echo $id; ?>" class="fl_r">Все</a></div>
            <div class="profile_info" style="padding:0px;">
                <?php
$qnote = $dbh1->prepare("SELECT * FROM `note` WHERE `aid` = '".$id."' ORDER BY RAND() LIMIT 2");
       $qnote->execute();
       while ($notee = $qnote->fetch()) {
           echo '<table border="0" style="font-size: 11px;">
    <tbody> 
      <tr>
        <td width="16" style="vertical-align: top;">
          <img src="img/note.gif">
        </td>
        <td style="vertical-align: 0;">
          <a href="note'.$notee['id'].'"><h4><b>'.$notee['name'].'</b></h4></a><span>Написана '.zmdate($notee['date']).'</span><br>
        </td>
      </tr>
    </tbody>
    </table>';
       } ?>
            </div>
        </div>
    </div><?php
   }?>
</div>

<div id="content-right">
    <div id="content-info">
        <h4 class="simple">
            <?php if ($user['nickname'] == null) {
       echo substr($user['name'], 0, 26).' '.substr($user['surname'], 0, 26);
   } else {
       echo substr($user['name'], 0, 26).' '.substr($user['nickname'], 0, 30).' '.substr($user['surname'], 0, 26);
   } ?>


            <?php if ($_SESSION['loginin'] == '1') { ?>
            <div class="clear" id="profile_current_info">
                <div class="absolutemenu" id="statusarea" style="display: none;padding: 5px;margin:-10px;">
                    <form method="get" action="change_status.php" style="margin:0;"><input type="text" name="status"
                            id="text" size="75" value="<?php if ($user['ban'] != '1') {
       echo $user['status'];
   }?>"><br><br><input type="submit" id="button" value="Сохранить"></form>
                </div><a <?php if ($_SESSION['id'] == $id) {?> href="#" onclick="openStatusEdit()" <?php } ?>
                    style="font-size:11px;word-wrap:break-word;overflow:hidden;text-decoration: none;color: black;font-weight: initial;"><?php if ($user['ban'] != '1') {
       if ($user['status'] != null) {
           echo $user['status'];
       } else {
           if ($user['id']==$_SESSION['id']) {
               echo '<div style="margin-top: 3px;margin-bottom: 7px;"><a href="#" onclick="openStatusEdit()" style="color: #c5c5c5;font-family: verdana, arial, sans-serif;font-size: 11px;">[ Изменить статус ]</a></div>';
           }
       }
   }?></a>
            </div>
            <?php } ?>


        </h4>
        <?php if ($user['id'] != '100') {?>
        <?php if ($user['ban'] != '1') {?>
        <div id="page_inf">
            <table style="font-size: 11px;">
                <tbody>
                    <?php if ($user['gender'] != '0' and $user['gender'] != null) {
       if ($user['gender'] == '1') {
           echo '<tr><td id="info_title">Пол:</td><td>мужской</td></tr>';
       } elseif ($user['gender'] == '2') {
           echo '<tr><td id="info_title">Пол:</td><td>женский</td></tr>';
       }
   }
      if ($user['sp'] != '0' and $user['sp'] != null) {
          echo '<tr><td id="info_title">Семейное положение:</td><td>';
          if ($user['sp'] == '1') {
              if ($user['gender'] == 2) {
                  echo "не замужем";
              } else {
                  echo "нe женат";
              }
          } elseif ($user['sp'] == '2') {
              echo "встречаюсь";
          } elseif ($user['sp'] == '3') {
              if ($user['gender'] == 2) {
                  echo "помолвлена";
              } else {
                  echo "помолвлен";
              }
          } elseif ($user['sp'] == '4') {
              if ($user['gender'] == 2) {
                  echo "замужем";
              } else {
                  echo "женат";
              }
          } elseif ($user['sp'] == '5') {
              echo "в гражданском браке";
          } elseif ($user['sp'] == '6') {
              if ($user['gender'] == 2) {
                  echo "влюблена";
              } else {
                  echo "влюблён";
              }
          } elseif ($user['sp'] == '7') {
              echo "всё сложно";
          } elseif ($user['sp'] == '5') {
              echo "в активном поиске";
          }
          echo '</td></tr>';
      }
      if ($user['city'] != '0' and $user['city'] != null) {
          echo '<tr><td id="info_title">Родной город:</td><td>'.$user['city'].'</td></tr>';
      }
      if ($user['pv'] != '0' and $user['pv'] != null) {
          echo '<tr><td id="info_title">Полит. взгляды:</td><td>'.$user['pv'].'</td></tr>';
      }
      if ($user['rv'] != '0' and $user['rv'] != null) {
          echo '<tr><td id="info_title">Религ взгляды:</td><td>'.$user['rv'].'</td></tr>';
      }
      ?>
                </tbody>
            </table>
        </div>











        <div id="osninf" class="profile_info" class="clear_fix">
            <div class="clear_fix">



            </div>
        </div>

        <div id="content-full-info">
            <div id="content-wall-title" class="clear_fix" style="margin-top:15px;" onclick="hidePanel(this);">
                <div class="hideTitle"></div>Информация
            </div>
            <div id="inf" class="profile_info">
                <h4 style="
    border-bottom: none;
    font-size: 11px;
    padding: 0;
    display: inline-block;
">Контактная информация</h4><?php if ($user['id'] == $_SESSION['id']) {
          echo'<a href="/edit_page.php" style="color: #c5c5c5;font-family: verdana, arial, sans-serif;font-size: 11px;font-weight: bold;margin-left: 10px;">[ редактировать ]</a>';
      } ?>
                <div class="clear_fix miniblock">
                    <?php
if ($user['city2']!=null) {
          echo '<div class="label fl_l">Город: </div>
<div id="labelblue" class="labeled fl_l">'.$user['city2'].'
</div>';
      }
if ($user['telephone']!=null) {
    if ($user['telephone_settings']==1 or $friends_verify==1 or $user['id']==$_SESSION['id']) {
        echo '<div class="label fl_l">Моб. телефон: </div>
<div id="labelblue" class="labeled fl_l">'.$user['telephone'].'
</div>';
    } else {
        echo '<div class="label fl_l">Моб. телефон: </div>
<div style="color: darkgray; class="labeled fl_l">Информация скрыта
</div>';
    }
}
if ($user['email']!=null) {
    if ($user['email_settings']==1 or $friends_verify==1 or $user['id']==$_SESSION['id']) {
        echo '<div class="label fl_l">Эл. почта: </div>
<div id="labelblue" class="labeled fl_l">'.$user['email'].'
</div>';
    } else {
        echo '<div class="label fl_l">Эл. почта: </div>
<div style="color: darkgray;" class="labeled fl_l">Информация скрыта
</div>';
    }
}
$website = preg_replace("~(http|https|ftp|ftps)://(.*?)(\s|\n|[,.?!](\s|\n)|$)~", '<a href="$1://$2">$1://$2</a>$3', $user['site']);
if ($user['site']!=null) {
    echo '<div class="label fl_l">Веб-сайт: </div>
<div class="labeled fl_l">'.$website.'
</div>';
}
?>
                </div>
                <div class="clear_fix miniblock">
                    <h4 style="
    border-bottom: none;
    font-size: 11px;
    padding: 10px 0 2px;
">Личная информация<?php if ($user['id'] == $_SESSION['id']) {
    echo'<a href="/edit_page.php" style="color: #c5c5c5;font-family: verdana, arial, sans-serif;font-size: 11px;font-weight: bold;margin-left: 10px;">[ редактировать ]</a>';
} ?></h4>
                    <?php
  if ($user['do']!=null) {
      echo '<div class="label fl_l">Должность: </div>
<div id="labelblue" class="labeled fl_l">'.$user['do'].'
</div>';
  }
if ($user['interes']!=null) {
    echo '<div class="label fl_l">Интересы: </div>
<div id="labelblue" class="labeled fl_l">'.$user['interes'].'
</div>';
}
if ($user['mus']!=null) {
    echo '<div class="label fl_l">Любимая музыка: </div>
<div id="labelblue" class="labeled fl_l">'.$user['mus'].'
</div>';
}
if ($user['films']!=null) {
    echo '<div class="label fl_l">Любимые фильмы: </div>
<div id="labelblue" class="labeled fl_l">'.$user['films'].'
</div>';
}
if ($user['favorite_shows']!=null) {
    echo '<div class="label fl_l">Любимые телешоу: </div>
<div id="labelblue" class="labeled fl_l">'.$user['favorite_shows'].'
</div>';
}
if ($user['book']!=null) {
    echo '<div class="label fl_l">Любимые книги: </div>
<div id="labelblue" class="labeled fl_l">'.$user['book'].'
</div>';
}
if ($user['games']!=null) {
    echo '<div class="label fl_l">Любимые игры: </div>
<div id="labelblue" class="labeled fl_l">'.$user['games'].'
</div>';
}
if ($user['quo']!=null) {
    echo '<div class="label fl_l">Любимые цитаты: </div>
<div id="labelblue" class="labeled fl_l">'.$user['quo'].'
</div>';
}
  ?>
                    <div class="label fl_l">О себе:</div>
                    <?php if ($user['aboutuser']) {
      echo '<div class="labeled fl_l">'.$user['aboutuser'].'</div>';
  } else {
      echo '<div class="labeled fl_l"><a style="color: darkgray;">Нет информации</a></div>';
  }?>
                </div>
            </div>
        </div>
    </div>
    <?php
   $qwallcount = $dbh1->prepare("SELECT COUNT(1) FROM `wall` WHERE `idwall`='".$id."'");
   $qwallcount -> execute();
   $wlcount = $qwallcount->fetch();
   $wlcount = $wlcount[0];
   ?>
    <div id="content-wall" class="clear_fix" style="padding-top:15px;">
        <div id="content-wall-title" class="clear_fix" onclick="hidePanel(this,<?echo $wlcount;?>);">
            <div class="hideTitle"></div>Стена
        </div>
        <div id="profile_wall">
            <div id="content-wall-send" class="clear_fix">
                <?php

   if ($wlcount == '1' or $wlcount == '21') {
       if ($wlcount < '10') {
           $wlcounnt = "Показано ".(string)$wlcount." из ".(string)$wlcount." записи";
       } else {
           $wlcounnt = "Показано 10 из ".(string)$wlcount." запись";
       }
   } elseif ($wlcount == '2' or $wlcount == '3' or $wlcount == '4' or $wlcount == '22') {
       if ($wlcount < '10') {
           $wlcounnt = "Показано ".(string)$wlcount." из ".(string)$wlcount." записей";
       } else {
           $wlcounnt = "Показано 10 из ".(string)$wlcount." записей";
       }
   } elseif ($wlcount == '0') {
       $wlcounnt = "Нет записей";
   } else {
       if ($wlcount < '10') {
           $wlcounnt = "Показано ".(string)$wlcount." из ".(string)$wlcount." записей";
       } else {
           $wlcounnt = "Показано 10 из ".(string)$wlcount." записей";
       }
   }
   echo '<div class="post-textarea-button">'.$wlcounnt;?><?php if ($_SESSION['loginin'] == '1') { ?>
                <?php if ($user['id'] != '0') { ?><a href="wall<?php echo $id ?>"
                    style="display: block;float: right;">Все</a><?php if ($user['closedwall'] == '0') { ?><text
                    style="display: block;float: right;margin-left:5px;margin-right:5px;">|</text><a href="#"
                    style="display: block;float: right;" onmousedown="openTextarea();">Написать</a><?php } else {
   } ?><?php } ?></div>
            <div class="post-textarea" style="display: none;">
                <form method="post" action="add_post.php" enctype="multipart/form-data">
                    <textarea placeholder="Что нового?" name="text"></textarea>
                    <div id="postphoto" style="display: none;"><input type="file" name="upimg"
                            accept="image/jpeg,image/png,image/gif"></div>
                    <div style="float:right;clear:both;margin-top: 8px;"><a href="#" onclick="openMenuPin();"
                            class="pinlink">Прикрепить</a>
                        <div class="absolutemenu" id="pinpostmenu" style="display: none;"><a href="#"
                                onclick="menuPinPhoto();"><img src="img/photo-icon.png"> Фотография</a></div>
                    </div><input type="submit" id="button" value="Опубликовать" style="float:left;margin-top:5px;">
                </form>
                <div style="clear:both;"></div>
            </div>
            <?php }
    ?>
        </div>
        <?php if ($wlcount == '0') {
        echo '<div style="margin-left: 10px;">Здесь никто ничего не написал... Пока.</div>';
    } /*if($user['advice_settings'] == '1'){
  echo '<img src="https://i.imgur.com/16Dt2OV.png" width=400>';
 }*/ ?>
        <?php
    if ($_SESSION['loginin'] == '1') {
        $q2 = $dbh1->prepare("SELECT * FROM `wall` WHERE `idwall`='".$id."' ORDER BY id DESC LIMIT 10");
        $q2 -> execute();
        while ($wall = $q2->fetch()) {
            if ($wall['iduser'] == $_SESSION['id'] or $wall['idwall'] == $_SESSION['id']) {
                $deletebutton = '<a href="#" onclick="openWindowsQDel('.$wall['id'].')" style="float:left;">Удалить</a>';
            } else {
                $deletebutton = '';
            }
            if ($id != $wall['iduser']) {
                $q3 = $dbh1->prepare("SELECT * FROM `users` WHERE `id`='".$wall['iduser']."'"); // отправляем запрос серверу
                $q3 -> execute();
                $authorwall = $q3->fetch(); // ответ в переменную .
                $onlinewall = "";
                if ($authorwall['avatar'] != null) {
                    if ($wall['image'] != null) {
                        $q3 = $dbh1->prepare("SELECT * FROM `photo` WHERE id = :id");
                        $q3->bindValue(':id', $wall['image']);
                        $q3 -> execute();
                        $photowall = $q3->fetch(); // ответ в переменную .
                        if (!empty($photowall['image_333'])) {
                            $im = '<br><br><a href="watchi.php?id='.$wall['image'].'"><img src="'.$photowall['image_333'].'"></a>';
                        } else {
                            $im = '';
                        }
                    } else {
                        $im = '';
                    }
                    if ($wall['action'] == 1) {
                        if ($authorwall['gender'] == 1) {
                            $nap = "обновил фотографию на странице";
                        } elseif ($authorwall['gender'] == 2) {
                            $nap = "обновила фотографию на странице";
                        } else {
                            $nap = "обновил(-а) фотографию на странице";
                        }
                    } else {
                        if ($authorwall['gender'] == 1) {
                            $nap = "написал";
                        } elseif ($authorwall['gender'] == 2) {
                            $nap = "написала";
                        } else {
                            $nap = "написало";
                        }
                    }
   
                    if ($wall['date']+172800 > time()) {
                        if ($authorwall['id'] == $_SESSION['id']) {
                            $redach = ' | <a href="#" onclick="openTextareaEdit('.$wall['id'].');">Редактировать</a>';
                            $redachtext = str_replace(array('<br><br>', '<br>'), '
', $wall['text']);
                            $redachtext = str_replace('</b>', '', $redachtext);
                        } else {
                            $redach = '';
                        }
                    } else {
                        $redach = '';
                    }
   
  
                    if ($wall['edited'] == "1") {
                        $redached = " <span> (ред.)</span>";
                    } else {
                        $redached = '';
                    }
 
                    if ($wall['action'] == 1) {
                        $redach = '';
                    }
                    echo '<div id="content-wall-post"><table border="0" style="font-size:11px;"><tr><td style="width:54px;vertical-align:top;">
   <div id="content-wall-post-avatar"><img id="avatar" src="'.$authorwall['avatar_50'].'" width="50"></div>'.$onlinewall.'</td><td style="width:345px;vertical-align:0;">
     <div id="content-wall-post-infoofpost">
      
      <div id="content-wall-post-authorofpost"><text style="margin-right: 3px;"><b><a href="id'.$authorwall['id'].'">'.$authorwall['name'].' '.$authorwall['surname'].'</a></b></text>'.$nap.$redached.'<br><div id="content-date"><a href="post'.$wall['id'].'">'.zmdate($wall['date']).'</a></div></div>
     
     <div id="content-wall-post-text" class="post'.$wall['id'].'">'.$wall['text'].$im.' </div>
     <div id="content-wall-post-text" class="postedit'.$wall['id'].'" style="display:none;">
     <form method="post" action="edit_post.php">
     <input name="id" type="hidden" value="'.$wall['id'].'"><textarea name="text" id="text">'.$redachtext.'</textarea><br>
     <input type="submit" value="Изменить" id="button">
     </form>
     </div>
     </div>'.$deletebutton.$redach.'<a href="post'.$wall['id'].'" style="float:right;">Открыть комментарии</a><div style="clear:both;"></div>
    
    </td></tr></table></div><br>';
                } else {
                    if ($wall['image'] != null) {
                        $qua = "SELECT * FROM `photo` WHERE `id`=:photo";
                        $q3 = $dbh1->prepare($qua);
                        $q3->bindParam(':photo', $wall['image']);
                        $q3->execute();
                        $photowall = $q3->fetch(); // ответ в переменную .
                        if (!empty($photowall['image_333'])) {
                            $im = '<br><br><a href="watchi.php?id='.$wall['image'].'"><img style="max-width: 333px;" src="'.$photowall['image_333'].'"></a>';
                        } else {
                            $im = '';
                        }
                    } else {
                        $im = '';
                    }
   
                    if ($wall['action'] == "1") {
                        $im = '<a href="watchi.php?id='.$wall['image'].'"><img style="max-width: 333px;" src="'.$wall['image'].'"></a>';
                    }

                    $onlinewall = "";

                    if ($wall['action'] == 1) {
                        if ($authorwall['gender'] == 1) {
                            $nap = "написал фотографию на странице";
                        } elseif ($authorwall['gender'] == 2) {
                            $nap = "обновила фотографию на странице";
                        } else {
                            $nap = "обновил(-а) фотографию на странице";
                        }
                    } else {
                        if ($authorwall['gender'] == 1) {
                            $nap = "написал";
                        } elseif ($authorwall['gender'] == 2) {
                            $nap = "написала";
                        } else {
                            $nap = "написало";
                        }
                    }
   
                    if ($wall['date']+172800 > time()) {
                        if ($authorwall['id'] == $_SESSION['id']) {
                            $redach = ' | <a href="#" onclick="openTextareaEdit('.$wall['id'].');">Редактировать</a>';
                            $redachtext = str_replace(array('<br><br>', '<br>'), '
', $wall['text']);
                            $redachtext = str_replace('</b>', '', $redachtext);
                        } else {
                            $redach = '';
                        }
                    } else {
                        $redach = '';
                    }
                    if ($wall['edited'] == "1") {
                        $redached = "<span> (ред.)</span>";
                    } else {
                        $redached = '';
                    }
                    if ($wall['action'] == 1) {
                        $redach = '';
                    }
                    echo '<div id="content-wall-post"><table border="0" style="font-size:11px;"><tr><td style="width:54px;vertical-align:top;">
    <div id="content-wall-post-avatar"><img id="avatar" src="img/images/nophoto1.gif" width="50"></div>'.$onlinewall.'</td><td style="width:345px;vertical-align:0;">
     <div id="content-wall-post-infoofpost">
      
      <div id="content-wall-post-authorofpost"><text style="margin-right: 3px;"><b><a href="id'.$authorwall['id'].'">'.$authorwall['name'].' '.$authorwall['surname'].' '.$var.'</a></b></text>'.$nap.$redached.'<br><div id="content-date"><a href="post'.$wall['id'].'">'.zmdate($wall['date']).'</a></div></div>
     
     <div id="content-wall-post-text" class="post'.$wall['id'].'">'.$wall['text'].$im.'</div>
     <div id="content-wall-post-text" class="postedit'.$wall['id'].'" style="display:none;">
     <form method="post" action="edit_post.php">
     <input name="id" type="hidden" value="'.$wall['id'].'"><textarea name="text" id="text">'.$redachtext.'</textarea><br>
     <input type="submit" value="Изменить" id="button">
     </form>
     </div>
     </div>'.$deletebutton.$redach.'<a href="post'.$wall['id'].'" style="float:right;">Открыть комментарии</a><div style="clear:both;"></div>
    
   </td></tr></table></div><br>';
                }
            } else {
                if ($wall['image'] != null) {
                    $q3 = $dbh1->prepare("SELECT * FROM `photo` WHERE `id`=:id");
                    $q3->bindValue(':id', $wall['image']);
                    $q3 -> execute();
                    $photowall = $q3->fetch();
                    $im = '<br><br><a href="watchi.php?id='.$wall['image'].'"><img style="max-width: 333px;" src="'.$photowall[3].'"></a>';// ответ в переменную .
                    if (!empty($photowall[3])) {
                        $im = '<br><br><a href="watchi.php?id='.$wall['image'].'"><img style="max-width: 333px;" src="'.$photowall[3].'"></a>';
                    } else {
                        $im = '';
                    }
                } else {
                    $im = '';
                }
                if ($wall['action'] == "1") {
                    $im = '<a href="watchi.php?id='.$wall['image'].'"><img style="max-width: 333px;" src="'.$wall['image'].'"></a>';
                }

                $onlinewall = "";

                if ($user['avatar'] != null) {
                    if ($wall['action'] == 1) {
                        if ($authorwall['gender'] == 1) {
                            $nap = "написал фотографию на странице";
                        } elseif ($authorwall['gender'] == 2) {
                            $nap = "обновила фотографию на странице";
                        } else {
                            $nap = "обновил(-а) фотографию на странице";
                        }
                    } else {
                        if ($authorwall['gender'] == 1) {
                            $nap = "написал";
                        } elseif ($authorwall['gender'] == 2) {
                            $nap = "написала";
                        } else {
                            $nap = "написало";
                        }
                    }
   
                    if ($wall['date']+172800 > time()) {
                        if ($user['id'] == $_SESSION['id']) {
                            $redach = ' | <a href="#" onclick="openTextareaEdit('.$wall['id'].');">Редактировать</a>';
                            $redachtext = str_replace(array('<br><br>', '<br>'), '
', $wall['text']);
                            $redachtext = str_replace('</b>', '', $redachtext);
                        } else {
                            $redach = '';
                        }
                    } else {
                        $redach = '';
                    }
                    if ($wall['edited'] == "1") {
                        $redached = " <span>(ред.)</span>";
                    } else {
                        $redached = '';
                    }
                    if ($wall['action'] == 1) {
                        $redach = '';
                    }
                    echo '<div id="content-wall-post"><table border="0" style="font-size:11px;"><tr><td style="width:54px;vertical-align:top;">
      <div id="content-wall-post-avatar"><img id="avatar" src="'.$user['avatar_50'].'" width="50"></div>'.$onlinewall.'</td><td style="width:345px;vertical-align:0;">
     <div id="content-wall-post-infoofpost">
      
      <div id="content-wall-post-authorofpost"><text style="margin-right: 3px;"><b><a href="id'.$user['id'].'">'.$user['name'].' '.$user['surname'].' '.$var.'</a></b></text>'.$nap.$redached.'<br><div id="content-date"><a href="post'.$wall['id'].'">'.zmdate($wall['date']).'</a></div></div>
     
     <div id="content-wall-post-text" class="post'.$wall['id'].'">'.$wall['text'].$im.'</div>
     <div id="content-wall-post-text" class="postedit'.$wall['id'].'" style="display:none;">
     <form method="post" action="edit_post.php">
     <input name="id" type="hidden" value="'.$wall['id'].'"><textarea name="text" id="text">'.$redachtext.'</textarea><br>
     <input type="submit" value="Изменить" id="button">
     </form>
     </div>
     </div>'.$deletebutton.$redach.'<a href="post'.$wall['id'].'" style="float:right;">Открыть комментарии</a><div style="clear:both;"></div>
    
    </td></tr></table></div><br>';
                } else {
                    if ($wall['image'] != null) {
                        $q3 = $dbh1->prepare("SELECT * FROM `photo` WHERE `id`=:id");
                        $q3->bindValue(':id', $wall['image']);
                        $q3 -> execute();
                        $photowall = $q3->fetch(); // ответ в переменную .
                        if (!empty($photowall['image_333'])) {
                            $im = '<br><br><a href="watchi.php?id='.$wall['image'].'"><img style="max-width: 333px;" src="'.$photowall['image_333'].'"></a>';
                        } else {
                            $im = '';
                        }
                    } else {
                        $im = '';
                    }
                    if ($wall['action'] == "1") {
                        $im = '<a href="watchi.php?id='.$wall['image'].'"><img style="max-width: 333px;" src="'.$wall['image'].'"></a>';
                    }

                    $onlinewall = "";

                    if ($wall['action'] == 1) {
                        if ($authorwall['gender'] == 1) {
                            $nap = "написал фотографию на странице";
                        } elseif ($authorwall['gender'] == 2) {
                            $nap = "обновила фотографию на странице";
                        } else {
                            $nap = "обновил(-а) фотографию на странице";
                        }
                    } else {
                        if ($authorwall['gender'] == 1) {
                            $nap = "написал";
                        } elseif ($authorwall['gender'] == 2) {
                            $nap = "написала";
                        } else {
                            $nap = "написало";
                        }
                    }
  
                    if ($wall['date']+172800 > time()) {
                        if ($user['id'] == $_SESSION['id']) {
                            $redach = ' | <a href="#" onclick="openTextareaEdit('.$wall['id'].');">Редактировать</a>';
                            $redachtext = str_replace(array('<br><br>', '<br>'), '
', $wall['text']);
                            $redachtext = str_replace('</b>', '', $redachtext);
                        } else {
                            $redach = '';
                        }
                    } else {
                        $redach = '';
                    }
                    if ($wall['edited'] == "1") {
                        $redached = "<span> (ред.)</span>";
                    } else {
                        $redached = '';
                    }
                    echo '
      <div id="content-wall-post"><table border="0" style="font-size:11px;"><tr><td style="width:54px;vertical-align:top;">
      <div id="content-wall-post-avatar"><img id="avatar" src="img/images/nophoto1.gif" width="50"></div>'.$onlinewall.'</td><td style="width:345px;vertical-align:0;">
     <div id="content-wall-post-infoofpost">
      
      <div id="content-wall-post-authorofpost"><text style="margin-right: 3px;"><b><a href="id'.$user['id'].'">'.$user['name'].' '.$user['surname'].' '.$var.'</a></b></text>'.$nap.$redached.'<br><div id="content-date"><a href="post'.$wall['id'].'">'.zmdate($wall['date']).'</a></div></div>
     
     <div id="content-wall-post-text" class="post'.$wall['id'].'">'.$wall['text'].$im.'</div>
     <div id="content-wall-post-text" class="postedit'.$wall['id'].'" style="display:none;">
     <form method="post" action="edit_post.php">
     <input name="id" type="hidden" value="'.$wall['id'].'"><textarea name="text" id="text">'.$redachtext.'</textarea><br>
     <input type="submit" value="Изменить" id="button">
     </form>
     </div>
     </div>'.$deletebutton.$redach.'<a href="post'.$wall['id'].'" style="float:right;">Открыть комментарии</a><div style="clear:both;"></div>
    
    </td></tr></table></div><br>';
                }
            }
        }
    } else {
        ?> <div id="msg">Для того, чтобы просматривать стену пользователя, вам необходимо авторизоваться</div><?php
    } ?>
    </div>
    <?php } else { ?>
    <div id="msg">К сожалению нам пришлось заблокировать этого пользователя.<br> Комментарий модератора: <?php if ($user['comment_ban'] == null) {
        echo "Причина не указана.";
    } else {
        echo $user['comment_ban'];
        echo ".";
    } ?></div>
    <?php } ?>
    <?php } else { ?>
    <div style="padding: 69px 0;color: darkgray;text-align: center;width: 410px;">Страница используется Администрацией
        OpenVK. <br><br>По всем вопросам обращайтесь к <a href="id1">Владимиру Баринову</a> или <a
            href="id4">Константину Кичулкину</a>.</div>
    <?php } ?>
</div>
</div>
</div>
</div>
</div>
</div>
<div>
    <?php include('exec/footer.php'); ?>
</div>
</body>
</script>

</html>
<script type="text/javascript">
function openWindowsQDel(id) {
    WindowsQ = $.window({
        title: "Подтверждение",
        content: '<div style="padding:10px; font-size:11px;"><center>Вы действительно хотите удалить запись?</center><br><center><a href="del_post.php?id=' +
            id +
            '" id="button">Да</a> <a href="#" onclick="WindowsQ.close();" id="button">Нет</a></center></div>',
        draggable: false,
        resizable: false,
        maximizable: false,
        minimizable: false,
        showModal: true,
        width: 300,
        height: 110
    });
}
</script>