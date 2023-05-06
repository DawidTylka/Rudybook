<?php
session_start();
if(!isset($_SESSION['id'])){header('Location: zaloguj.php');}
require_once "conect.php";
$conect = @new mysqli($host,$db_user,$db_password,$db_name);
$serce = isSet( $_GET['serce'] ) ? intval( $_GET['serce'] ) :0;
$gwiazdka = isSet( $_GET['gwiazdka'] ) ? intval( $_GET['gwiazdka'] ) :0;
$idpost = isSet( $_GET['postid'] ) ? intval( $_GET['postid'] ) :0;
$kto = $_SESSION['id'];

					$sqluzers = "SELECT * FROM `reakcje` WHERE post_fk='$idpost' AND kto_fk='$kto'" ;
					$fileuzers = $conect->query($sqluzers);
					$ile = $fileuzers->num_rows;
					$d = $fileuzers->fetch_assoc();;
					$id = $d['id'];
					if($ile > 0){
					$sql = 'UPDATE reakcje SET serduszko="'.$serce.'", gwiazdeczka="'.$gwiazdka.'" WHERE id='.$id.'';
					if ($conect->query($sql) === TRUE) {
					}
					}else{
					$conect->query("INSERT INTO `reakcje` VALUES (NULL,'$serce','$gwiazdka','$kto','$idpost')");
					}
$conect->close();
?>