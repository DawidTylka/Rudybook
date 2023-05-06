<?php
session_start();
require_once "conect.php";
$conect = @new mysqli($host,$db_user,$db_password,$db_name);
$komentaz =$_POST['komentaz'];
$postid =$_POST['postid'];
/*zabespieczasz dane*/

$komentaz = htmlentities($komentaz, ENT_QUOTES, "UTF-8");
$postid = htmlentities($postid, ENT_QUOTES, "UTF-8");
if($conect->connect_error!=0)
{
	echo'error';
}
else
	{
				$id = $_SESSION['id'];
				/*dane z połączenia są dodawane*/
				$conect->query("INSERT INTO `komentarze` VALUES (NULL, '$komentaz', '$id', '$postid')");
				$conect->close();
	}
	header('Location: dom');

?>

