<?php 
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
include('exec/header.php');
include('exec/datefn.php');
include('exec/leftmenu.php');
$id = $_GET['id'];
 $q = "SELECT * FROM blog WHERE id='".$id."'"; // выбираем нашего 
 $q1 = $dbh1->prepare($q); // отправляем запрос серверу
 $q1 -> execute(); 
 $user = $q1->fetch(); // ответ в переменную 

if ($user['id'] == ""){
header("Location: blank.php?id=4");
exit();
}
?>
 <link href="blog1.css" rel="stylesheet">

<h1><?php echo $user['name']; ?></h1>
<h6> Автор: <?php echo $user['author']; ?></h6>
<hr>
<? if($user['imgur'] == '1'){
echo '	
<img src="'.$user["photo1"].'" width="400" height="auto">
';
     } ?>
<p> <?php echo $user['text']; ?> </p>
</div>
</div>
</div>
<div>
<? include('exec/footer.php'); ?>
</div>
</body>
</html>