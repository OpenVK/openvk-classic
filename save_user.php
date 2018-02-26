  <meta charset="utf-8">
<?php
   $form = $_POST;
$login = $form[ 'login' ];
$password = $form[ 'password' ];
$name = $form[ 'name' ];
$surname = $form[ 'surname' ];
$sql = "INSERT INTO users (`id`, `name`, `surname`, `groupu`, `nickname`, `status`, `regdate`, `birthdate`, `lastonline`, `avatar`, `login`, `password`, `regip`, `gender`, `ban`, `comment_ban`, `aboutuser`, `verify`, `aboutuser2`, `cssstyle`) VALUES ( '', '".$name."', '".$surname."', '', '', '', '', '', '', '', '".$login."', '".$password."', '', '', '', '', '', '', '', '')";
$query = $db->prepare( $sql );
$query->execute();
$result = $query->execute();
if ( $result ){
  echo "<p>Thank you. You have been registered</p>";
} else {
  echo "<p>Sorry, there has been a problem inserting your details. Please contact admin.</p>";
}
    ?>
