<?php
session_start();
if(!isset($_SESSION['id'])){header('Location: zaloguj.php');}
require_once "conect.php";
$conect = @new mysqli($host,$db_user,$db_password,$db_name);
$serce = isSet( $_GET['serce'] ) ? intval( $_GET['serce'] ) :0;
$gwiazdka = isSet( $_GET['gwiazdka'] ) ? intval( $_GET['gwiazdka'] ) :0;
$idpost = isSet( $_GET['postid'] ) ? intval( $_GET['postid'] ) :0;
$kto = $_SESSION['id'];
$userid =$_SESSION['id'];
							$sqluzers = "SELECT COUNT(id) FROM `reakcje` WHERE post_fk='$idpost' AND serduszko != '0'" ;
							$fileuzers = $conect->query($sqluzers);
							$sercdanee = $fileuzers->fetch_assoc();
							$ileserc = $sercdanee['COUNT(id)'];
							
							
							$sqluzers = "SELECT COUNT(id) FROM `reakcje` WHERE post_fk='$idpost' AND gwiazdeczka != '0'" ;
							$fileuzers = $conect->query($sqluzers);
							$sercdanee = $fileuzers->fetch_assoc();
							$ilegwiazd= $sercdanee['COUNT(id)'];
							
							
							$sqluzers = "SELECT * FROM `komentarze` WHERE post_fk='$idpost'" ;
								$fileuzers = $conect->query($sqluzers);
								$i = $fileuzers->num_rows;
					
					
								$sercepost = 1;
								if($serce){
								$sercepost = 0 ;
								}
								$gwiazdapost = 1;
								if($gwiazdka){
								$gwiazdapost = 0 ;
								}
					$blackheart = "black";
							if($sercepost)
							$blackheart = "normal";
					$blackstar = "black";
							if($gwiazdapost)
							$blackstar = "normal";
					echo'
					<div class="heart '.$blackheart.'" onclick="reakcje(this,'.$sercepost.','.$gwiazdka.','.$idpost.')"><i class="icon-heart">'.$ileserc.'</i></div>
					<div class="star '.$blackstar.'" onclick="reakcje(this,'.$serce.','.$gwiazdapost.','.$idpost.')"><i  class="icon-star-empty">'.$ilegwiazd.'</i></div>
					<div class="sta"><i  class="icon-commenting">'.$i.'</i></div>';
					
$conect->close();
?>