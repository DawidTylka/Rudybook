<?php session_start(); 
require_once "conect.php";
$conect = @new mysqli($host,$db_user,$db_password,$db_name);
$page = isSet( $_GET['down'] ) ? intval( $_GET['down'] ) :1;
?>

<?php
				$conect = @new mysqli($host,$db_user,$db_password,$db_name);
				$sql = "SELECT * FROM `komentarze` WHERE post_fk='$page'";
				$file = $conect->query($sql);
				if($file->num_rows > 0){
						while($dane = $file->fetch_assoc()){
							$kom=$dane['komentaz'];
							$ktoaddkom=$dane['kto_fk'];
							
							$sqluzers = "SELECT * FROM `uzers` WHERE id='$ktoaddkom'" ;
							$fileuzers = $conect->query($sqluzers);
							$daneuzers = $fileuzers->fetch_assoc();
							$imiekom = $daneuzers['imie'];
							$nazwiskokom = $daneuzers['nazwisko'];
							$profilowekom = $daneuzers['profilowe'];
						echo'	<div class="kom">
									<div class="user"><img src="ustawfoto.php?a='.$profilowekom.'"><div>'.$imiekom.' <br> '.$nazwiskokom.'</div></div>
									<p>'.$kom.'</p>
								</div>';
						}
				}
				$conect->close();
				?>