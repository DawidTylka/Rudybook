<?php session_start(); 
require_once "conect.php";
$conect = @new mysqli($host,$db_user,$db_password,$db_name);
$page = isSet( $_GET['page'] ) ? intval( $_GET['page'] ) :1;
$pageilosicifoto = 12;
?>

<?php
				$useridikij=$_SESSION['id'];
				if ($page != 1){
				$pagex = $page - 1 ;
				$from = $pagex * $pageilosicifoto + 64 - 12;
				$i = $from;
				}else{
				$pageilosicifoto = 64;
				$pagex = $page - 1 ;
				$from = $pagex * $pageilosicifoto;
				$i = $from;	
				}
				$conect = @new mysqli($host,$db_user,$db_password,$db_name);
				$sql = "SELECT * FROM `kontakty` WHERE kto='$useridikij'";
				$file = $conect->query($sql);
				if($file->num_rows > 0){
					$i=0;
					while($dane = $file->fetch_assoc()){
						$tabid[$i]= $dane['zkim'];
						$i++;
					}
					$tabid[$i] = $useridikij;
				
				$arraySize = sizeof($tabid);
				
					$sql = 'SELECT * FROM `posty` WHERE ktoadd_fk IN (' . implode(',', array_map('intval', $tabid)) . ') ORDER BY id DESC LIMIT '.$from.','.$pageilosicifoto.'';
					$file = $conect->query($sql);
					if($file->num_rows > 0){
						while($dane = $file->fetch_assoc()){
								$idpost = $dane["id"];
								$posts = $dane["posts"];
								$ktoadd_fk = $dane["ktoadd_fk"];
								$kiedy = $dane["data_dodania"];
								
								$sqluzers = "SELECT * FROM `komentarze` WHERE post_fk='$idpost'" ;
								$fileuzers = $conect->query($sqluzers);
								$i = $fileuzers->num_rows;
								if($i > 0){
									$danekom = $fileuzers->fetch_assoc();
									$kom=$danekom['komentaz'];
									$ktoaddkom=$danekom['kto_fk'];
									$sqluzers = "SELECT * FROM `uzers` WHERE id='$ktoaddkom'" ;
									$fileuzers = $conect->query($sqluzers);
									$daneuzers = $fileuzers->fetch_assoc();
									$imiekom = $daneuzers['imie'];
									$nazwiskokom = $daneuzers['nazwisko'];
									$profilowekom = $daneuzers['profilowe'];
									$idkom = $daneuzers['id'];
								}
								$sqluzers = "SELECT * FROM `uzers` WHERE id='$ktoadd_fk'" ;
								$fileuzers = $conect->query($sqluzers);
								$daneuzers = $fileuzers->fetch_assoc();
								
								$imie = $daneuzers['imie'];
								$nazwisko = $daneuzers['nazwisko'];
								$profilowe = $daneuzers['profilowe'];
								$id = $daneuzers['id'];
								
								$sqluzers = "SELECT * FROM `imgs` WHERE posty_fk='$idpost'" ;
								$fileuzers = $conect->query($sqluzers);
								$img = "";
							while($daneuzers = $fileuzers->fetch_assoc()){
								$fotoname= $daneuzers['img'];
								if(substr($fotoname, -3,3) == 'mp4'){
								$img = '<video controls><source src="ustawfoto.php?a='.$fotoname.'" type="video/mp4"></video>'.$img.'';
								}else{
								$img = '<img src="ustawfoto.php?a='.$fotoname.'" onclick="foto(this)" >'.$img.'';
								}
							}
							$userid =$_SESSION['id'];
							$sqluzers = "SELECT * FROM `reakcje` WHERE post_fk='$idpost' AND serduszko != '0'" ;
							$fileuzers = $conect->query($sqluzers);
							$serce = $fileuzers->num_rows;
							
							$sqluzers = "SELECT * FROM `reakcje` WHERE post_fk='$idpost' AND serduszko != '0' AND kto_fk='$userid'" ;
							$fileuzers = $conect->query($sqluzers);
							$sercdanee = $fileuzers->fetch_assoc();
							if($sercdanee > 0){
							$serceuzer = $sercdanee['serduszko'];}else{$serceuzer=0;}
							
							$sqluzers = "SELECT * FROM `reakcje` WHERE post_fk='$idpost' AND gwiazdeczka != '0'" ;
							$fileuzers = $conect->query($sqluzers);
							$gwiazda = $fileuzers->num_rows;
							
							$sqluzers = "SELECT * FROM `reakcje` WHERE post_fk='$idpost' AND gwiazdeczka != '0' AND kto_fk='$userid'" ;
							$fileuzers = $conect->query($sqluzers);
							$gwiazdadane = $fileuzers->fetch_assoc();
							if($gwiazdadane > 0){
							$gwiazdauzer = $gwiazdadane['gwiazdeczka'];}else{$gwiazdauzer=0;}
							$sercepost = 1;
							$gwiazdapost = 1;
							if($serce > 0 && isSet($serceuzer))
								if($serceuzer == 0){$sercepost =1;}else{$sercepost = 0;}
							if($gwiazda > 0 && isSet($gwiazdauzer))
								if($gwiazdauzer == 0){$gwiazdapost = 1;}else{$gwiazdapost = 0;}
							
							echo'
							<div id="postnr'.$idpost.'" class="post">
								<div class="user"><img src="ustawfoto.php?a='.$profilowe.'"><div>'.$imie.' <br> '.$nazwisko.'</div><p>'.$kiedy.'</p>';
								
							if($_SESSION['id'] == $ktoadd_fk){
							echo'	
								<form enctype="multipart/form-data" action="del-post.php" method="post">
									<input type="number" value="'.$idpost.'" name="postid" style="display:none;">
									<input type="submit" value="usuń post">
								</form>
								';
							}
							$blackheart = "black";
								if($sercepost)
								$blackheart = "normal";
							$blackstar = "black";
									if($gwiazdapost)
									$blackstar = "normal";
							echo '</div>
								<p> '.$posts.' </p>
								<div class="image">
								'.$img.' 
								</div>
								<div class="oceny">
									<div class="heart '.$blackheart.'" onclick="reakcje(this,'.$sercepost.','.$gwiazdauzer.','.$idpost.')"><i class="icon-heart">'.$serce.'</i></div>
									<div class="star '.$blackstar.'" onclick="reakcje(this,'.$serceuzer.','.$gwiazdapost.','.$idpost.')"><i  class="icon-star-empty">'.$gwiazda.'</i></div>
									<div class="sta"><i  class="icon-commenting">'.$i.'</i></div>
								</div>
								<div class="kom click" onclick="addkom('.$idpost.')">Więcej kom</div>
								<div id="kom'.$idpost.'" class="komentaze">
								
									';
									if($i > 0){echo'
									<div class="kom">
										<div class="user"><img src="ustawfoto.php?a='.$profilowekom.'"><div>'.$imiekom.' <br> '.$nazwiskokom.'</div></div>
										<p>'.$kom.'</p>
									</div>';}
									
								echo'</div><div class="addcom">
									<form class="uzerinfo" enctype="multipart/form-data" action="dodaj_kom.php" method="post" rel="nofollow" target="kurwablackhole">
									<textarea name="komentaz" required></textarea><br />
									<input type="number" value="'.$idpost.'" name="postid" style="display:none;">
									<input type="submit" onclick="cleard(this)" value="Dodaj ocene pisemną posta" />
									</form>
								</div>
							</div>';
						}
					}
					}
					$conect->close();
				?>
				