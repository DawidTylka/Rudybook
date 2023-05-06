<?php 
session_start();
if(!isset($_SESSION['login'])){header('Location: zaloguj.php');}
require_once "conect.php";
$conect = @new mysqli($host,$db_user,$db_password,$db_name);
$ktoid =$_POST['uzerid'];
$ktoid = htmlentities($ktoid, ENT_QUOTES, "UTF-8");

if($conect->connect_error!=0)
{
	echo'error';
}
else
	{
		
				$id_uzer = $_SESSION['id'];
				echo "$id_uzer $ktoid";
				mysqli_query($conect,"DELETE FROM `kontakty` WHERE kto='$id_uzer' AND zkim='$ktoid' OR kto='$ktoid' AND zkim='$id_uzer'");
				$conect->close();
	}

header('Location: index.php');

?>