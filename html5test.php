<?php 
session_start();
include('exec/dbconnect.php');
include('exec/check_user.php');
if (isset($_GET['video']) != null && is_file($_GET['video'])){ 
$image = $_GET['video'];
}else{
header("Location: blank.php?id=6");
exit();
}
include('exec/header.php');
include('exec/datefn.php');
include('exec/leftmenu.php'); ?>
<div id="content-infoname"><b><?php echo 'HTML5 Плеер'; ?></b></div>
<link rel="stylesheet" href="player/fluidplayer.css" type="text/css"/>
    <script src="player/fluidplayer.js"></script>
<div id="content-main-gray"><center>
  <video id='video-main' controls style="width: 480px; height: 360px;">
                        <source src='<?php echo $_GET['video'];?>' type='video/mp4' title="360p" />
                    </video></center></div>
<br><hr>
<table border="0" style="font-size:11px;">

	
  

  <div>
  <? include('exec/footer.php'); ?>
  </div>
 </body>
 <script type="text/javascript">
   var VideoMain = fluidPlayer(
            'video-main',
            'vast.xml',
            {
                layout: 'metal'
            }
        );
 </script>
</html>