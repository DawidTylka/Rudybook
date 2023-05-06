<?php

session_start();

if(isset($_POST['login']) && isset($_POST['imie']) && isset($_POST['nazwisko'])){

require_once "conect.php";

$conect = @new mysqli($host,$db_user,$db_password,$db_name);

$login =$_POST['login'];

$imie =$_POST['imie'];

$nazwisko =$_POST['nazwisko'];

/*zabespieczasz dane*/



$login = htmlentities($login, ENT_QUOTES, "UTF-8");

$imie = htmlentities($imie, ENT_QUOTES, "UTF-8");

$nazwisko = htmlentities($nazwisko, ENT_QUOTES, "UTF-8");

if($conect->connect_error!=0)

{

	echo'error';

}

else

$a = "SELECT * FROM `uzers` WHERE login='$login'";

/*poĹ‚Ä…czenie*/

$o = @$conect->query($a);

/*liczy kolumny*/

$d = $o->fetch_assoc();



$i = $o->num_rows;











function resize($file,$max_rez,$type){

		if(file_exists($file)){
			if($type == "image/gif"){
				$orginal = imagecreatefromgif($file);
				$org_width = imagesx($orginal);
				$org_height = imagesy($orginal);
				
				if($org_width > $max_rez){

					$raito = $max_rez / $org_width;

					$new_width = $max_rez;

					$new_height = $org_height*$raito;

				}
				else
				{

					$new_width = $org_width;

					$new_height = $org_height;

				}
				$oldFile = $file;
				$newFile = $file;
				exec("convert $oldFile -coalesce $oldFile");
				exec("convert -size ".$org_width."x".$org_height." $oldFile -resize  ".$new_width."x".$new_height." $newFile");
				
			}else{
				if($type == "image/jpeg" || $type == "image/img"){	

						$orginal = imagecreatefromjpeg($file);

					}else if($type == "image/png"){

						$orginal = imagecreatefrompng($file);

					}else if($type == "image/gif"){

						$orginal = imagecreatefromgif($file);

					}

				

				$org_width = imagesx($orginal);

				$org_height = imagesy($orginal);

				if($org_width > $max_rez){

					$raito = $max_rez / $org_width;

					$new_width = $max_rez;

					$new_height = $org_height*$raito;

				}
				else
				{

					$new_width = $org_width;

					$new_height = $org_height;

				}

				if($orginal){

						$new = imagecreatetruecolor($new_width,$new_height);

						imagecopyresampled($new,$orginal,0,0,0,0,$new_width,$new_height,$org_width,$org_height);

						imagejpeg($new,$file,90);

					
				}

		
			}
			

		}

	}





if($i == 0 || $d['id'] == $_SESSION['id']){

		$id = $_SESSION['id'];

		$login1 = date('Y-m-d-H-i-s').'_-_'.rand(0,9999).'_-_';

		mkdir("img/$login1");

		if($_FILES['plik']['type'] == "image/png" || $_FILES['plik']['type'] == "image/jpg" || $_FILES['plik']['type'] == "image/gif" || $_FILES['plik']['type'] == "image/jpeg"){

			if(isset($_FILES['plik']['name'])){

				if (is_uploaded_file($_FILES['plik']['tmp_name'])) {

					echo 'Odebrano plik  PoczÄ…tkowa nazwa: '.$_FILES['plik']['name'];

					echo '<br/>';

						if (isset($_FILES['plik']['type'])) {

							echo 'Typ: '.$_FILES['plik']['type'].'<br/>';

						}

					

					$file = htmlentities($_FILES['plik']['name'], ENT_QUOTES, "UTF-8");

					$file = str_replace("#"."",'',$file);

					$file = str_replace(" "."",'',$file);

					$img = 'img/'.$login1.'/'.$file;

					

					$img = htmlentities($img, ENT_QUOTES, "UTF-8");

					move_uploaded_file($_FILES['plik']['tmp_name'],''.$img);

						resize($img,200,$_FILES['plik']['type']);
						
						if($_SESSION['profilowe'] != "jebanetlopierodlone.png"){
						unlink($_SESSION['profilowe']);	}
						$_SESSION['profilowe'] = $img;
					$conect->query('UPDATE uzers SET profilowe="'.$img.'" WHERE id='.$id.'');

					

				}

			}

		}

	

			$_SESSION['login'] =$login;

			$_SESSION['imie'] =$imie;

			$_SESSION['nazwisko'] =$nazwisko ;

			

			$sql = 'UPDATE uzers SET login="'.$login.'", imie="'.$imie.'", nazwisko="'.$nazwisko.'" WHERE id='.$id.'';

				/*dane z poĹ‚Ä…czenia sÄ… zamieniane*/

			if ($conect->query($sql) === TRUE) {

			header('Location: index.php');

			}

			echo "$sql";

		

		$conect->close();

	}else{

		header('Location: uzer.php');

	}

}

?>