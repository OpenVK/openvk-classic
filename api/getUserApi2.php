<?php 
include "../exec/dbconnect.php";
include "../exec/datefn.php";
$id;
echo '<meta charset = "UTF-8" />';
if (isset($_GET['id']) != null) { 
 $id = $_GET['id'];
 $q = "SELECT * FROM users WHERE id='".$id."'"; // выбираем нашего 
 $q1 = $dbh1->prepare($q); // отправляем запрос серверу
 $q1 -> execute(); 
 $user = $q1->fetch(); // ответ в переменную 
}
if ($user['gender'] != "") {
$user['aboutuser'] = str_replace("<br>","\\n",$user['aboutuser'] ); // перенос строк
echo '{"name":"'.$user['name'].'", "surname":"'.$user['surname'].'", "gender":"'.$user['gender'].'", "verify":"'.$user['verify'].'", "nickname":"'.$user['nickname'].'", "aboutuser":"'.$user['aboutuser'].'", "birthdate":"'.zmdateapi($user['birthdate']).'", "lastonlinedate":"'.zmdateapi($user['lastonline']).'", "lastonlinetime":"'.date("H:i",$user['lastonline']).'", "status":"'.$user['status'].'", "avatar":"'.$user['avatar'].'"}';
}else{
echo '{"error":"1", "description":"user not found"}';
}
?>