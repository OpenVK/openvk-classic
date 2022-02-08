<?php
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
include 'reseample.php';
$path = 'content/avatars/';
$rand = rand("1000000000", "9999999999");
if (file_exists($path.$rand.".jpg")) {
    $rand = rand("1000000000", "9999999999");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!move_uploaded_file($_FILES['picture']['tmp_name'], $path . $_FILES['picture']['name'])) {
        echo 'error! check logs.';
    } else {
        if (strpos($_FILES['picture']['name'], '.jpg') || strpos($_FILES['picture']['name'], '.png') || strpos($_FILES['picture']['name'], '.jpeg') || strpos($_FILES['picture']['name'], '.gif')) {
            $timep = time();
            $rand = rand("1000000000", "9999999999");
            if (file_exists($path.$rand.".jpg")) {
                $rand = rand("1000000000", "9999999999");
            }
            $filename = $path.$rand."_temp.jpg";
            imagejpeg(imagecreatefromstring(file_get_contents($path . $_FILES['picture']['name'])), $filename, 75);
                        
            $filename_final = $path.$rand.".jpg";
            $filename_avatar = $path.$rand."_200.jpg";
            $filename_75 = $path.$rand."_75.jpg";
            $filename_50 = $path.$rand."_50.jpg";
            $filename_25 = $path.$rand."_25.jpg";
                    
            reseample($filename, $filename_final, 1024, 768);
            reseample($filename, $filename_avatar, 200, 800);
            reseample($filename, $filename_75, 75, 225);
            reseample($filename, $filename_50, 50, 150);
            reseample($filename, $filename_25, 25, 75);

            unlink($path . $_FILES['picture']['name']);
            
            unlink($filename);
            $qoq = 'UPDATE `users` SET `avatar` = :avatar, `avatar_200` = :avatar_200, `avatar_75` = :avatar_75, `avatar_50` = :avatar_50, `avatar_25` = :avatar_25 WHERE `users`.`id` = :id'; // выбираем нашего
            $qoqa = $dbh1->prepare($qoq); // отправляем запрос серверу
            $qoqa->bindValue(':id', $_SESSION['id']);
            $qoqa->bindValue(':avatar', $filename_final);
            $qoqa->bindValue(':avatar_200', $filename_avatar);
            $qoqa->bindValue(':avatar_75', $filename_75);
            $qoqa->bindValue(':avatar_50', $filename_50);
            $qoqa->bindValue(':avatar_25', $filename_25);
            
            $qoqa -> execute();
            $qoqa->fetch();
        } else {
            echo '<meta charset="utf-8">выберите картинку, а не что-то другое.<br><br>Debug: '.$_FILES['picture']['name'];
            unlink($path . $_FILES['picture']['name']);
            exit();
        }
   
        header("Location: index.php");
    }
}
