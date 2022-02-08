<?php 
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
include('exec/header.php');
include('exec/datefn.php');
include('exec/leftmenu.php');?>
<div id="content-infoname"><b>Блог</b></div>
<div id="content-wall">
	

<?php
$id = $_GET['id'];
 $q = "SELECT * FROM blog ORDER BY id DESC"; // выбираем нашего 
 $q1 = $dbh1->prepare($q); // отправляем запрос серверу
 $q1 -> execute(); 
 while ($blog = $q1->fetch()) {
 	$q11 = "SELECT * FROM users WHERE id = '".$blog['idauthor']."'"; // выбираем нашего 
 $q111 = $dbh1->prepare($q11); // отправляем запрос серверу
 $q111 -> execute(); 
 $user = $q111->fetch();
 	echo '<div id="content-wall-post">
	<table border="0" style="font-size:11px;">
		<tr>
			<td style="width: 27px;vertical-align: top;"></td>
			<td style="width: 600px;vertical-align: top;">
				<div id="content-wall-post-infoofpost">
				<div id="content-wall-post-authorofpost">
					<a href="blog_'.$blog['id'].'"><b>'.$blog['name'].'</b></a><br>
					<a href="id'.$user['id'].'">'.$user['name'].' '.$user['surname'].'</a> '.zmdate($blog['date']).'
				</div>
				<div id="content-wall-post-text">
					'.$blog['k_about'].'
				</div>
				</div>
			</td>
		</tr>
	</table>
</div>';
 } // ответ в переменную 
?>



</div>
</div>
</div>
</div>
<div>
<? include('exec/footer.php'); ?>
</div>
</body>
</html>