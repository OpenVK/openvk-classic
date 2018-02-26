<? 
include "../exec/dbconnect.php";
$id;
if (isset($_GET['id']) != null) { 
 $id = $_GET['id'];
 $q = "SELECT * FROM friends WHERE id1='".$id."'"; // выбираем нашего 
 $q1 = $dbh1->prepare($q); // отправляем запрос серверу
 $q1 -> execute(); 
 $fr = $q1->fetch(); // ответ в переменную 
}

echo "{friends: [";
while ($fr = $q1->fetch()) {
	 $q2 = $dbh1->prepare("SELECT * FROM users WHERE id='".$fr['id2']."'"); // отправляем запрос серверу
 	$q2 -> execute(); 
	 $user = $q2->fetch(); // ответ в переменную 
	echo '{"id":"'.$fr['id2'].'", "login":"'.$user['login'].'", "name":"'.$user['name'].'", "surname":"'.$user['surname'].'"},';
}
echo "]}";

?>