<?php
session_start();
$kogo = htmlspecialchars($_GET["a"]);
require_once"conect.php";
$conect = @new mysqli($host, $db_user, $db_password, $db_name);
$id = $_SESSION['id'];
$sqluzers = 'SELECT * FROM `kontakty` WHERE kto='.$id.' AND zkim='.$kogo.'' ;
$fileuzers = $conect->query($sqluzers);
$i = $fileuzers->num_rows;
	if($i <= 0){
	$conect->query("INSERT INTO `kontakty` VALUES ( '$id', '$kogo', NULL)");
	}
header('Location: index.php');

?>
