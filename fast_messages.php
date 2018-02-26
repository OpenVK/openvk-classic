<?php 
session_start();
include('exec/dbconnect.php');
include('exec/datefn.php');
if($_SESSION['loginin'] != "1"){
$_SESSION['errormsg'] = "Пожалуйста, авторизируйтесь.";
header("Location: blank/..");
exit();
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Быстрые сообщения</title>
	<style type="text/css">
		body {
			margin: 0;
			padding: 0;
		}

		* {
			font-family: Tahoma, sans-serif;
			font-size: 11px;
		}

		.header {
			background-color: #2877A3;
			padding: 7px 10px; 
			font-size: 14px;
			font-weight: bold;
			color: #ffffff;
			position: fixed;
			width: 100%;
			margin-top: -30px;
		}

		.content {
			margin-top: 30px;
		}
	</style>
</head>
<body>
	<div class="header">Личные сообщения</div>
	<div class="content" style="height: auto;">
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		кавесру<br>
		
	</div>
</body>
<script type="text/javascript">

function Resize() {
  var i;
	i = document.documentElement.clientHeight.toString();
	i - 30;
document.getElementById('content').style.height = i+"px";
}

setTimeout(Resize, 1000);
	
</script>
</html> 