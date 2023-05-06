<?php
session_start();
if(!isset($_SESSION['login'])){header('Location: logowanie');}
require_once "conect.php";
$conect = @new mysqli($host,$db_user,$db_password,$db_name);

$iduzer = $_SESSION['id'];


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
$data = date("Y-m-d H:i:s");
$post = htmlentities($_POST['komentaz'], ENT_QUOTES, "UTF-8");
if(empty($_POST['komentaz']) && empty($_FILES['plik']['tmp_name'][0])){ 
	echo 'ty zły człowieku ';
	return;
}else{
	$trimmed = trim($_POST['komentaz']);
	if(empty($_FILES['plik']['tmp_name'][0]) && $trimmed == ''){
		echo 'ty zły człowieku ';
		return;
	}
}
$conect->query("INSERT INTO `posty` VALUES (NULL,'$post','$iduzer','$data')");
$postid = @$conect->query("SELECT `id` FROM `posty` WHERE id = LAST_INSERT_ID()");
$d = $postid->fetch_assoc();
$postid = $d["id"];
echo 'okej'.$postid.'';


$i = 0;
$login1 = date('Y-m-d-H-i-s').'_-_'.rand(0,9999).'_-_';
mkdir("img/$login1");
while(isset($_FILES['plik']['name'][$i])){
	if (is_uploaded_file($_FILES['plik']['tmp_name'][$i])) {
		if($_FILES['plik']['type'][$i] == "video/mp4" || $_FILES['plik']['type'][$i] == "image/png" || $_FILES['plik']['type'][$i] == "image/jpg" || $_FILES['plik']['type'][$i] == "image/gif" || $_FILES['plik']['type'][$i] == "image/jpeg"){
			
				$tmp_name = $_FILES["plik"]["tmp_name"][$i];
				$name = basename($_FILES["plik"]["name"][$i]);
				echo 'Odebrano plik '.$i.'. Początkowa nazwa: '.$_FILES['plik']['name'][$i];
				echo '<br/>';
			if (isset($_FILES['plik']['type'][$i])) {
				echo 'Typ: '.$_FILES['plik']['type'][$i].'<br/>';
			}
			$file = htmlentities($_FILES['plik']['name'][$i], ENT_QUOTES, "UTF-8");
			$file = str_replace("#"."",'',$file);
			$file = str_replace(" "."",'',$file);
			$login = 'img/'.$login1.'/'.$file;
			$login = htmlentities($login, ENT_QUOTES, "UTF-8");
			move_uploaded_file($_FILES['plik']['tmp_name'][$i],''.$login);
			resize($login,600,$_FILES['plik']['type'][$i]);
			$conect->query("INSERT INTO `imgs` VALUES (NULL,'$login','$postid')");
		}
		
	} 
	$i++;
} 
$conect->close();
header('Location: dom');



?>