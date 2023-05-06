<?php
session_start();
require_once "conect.php";
$conect = @new mysqli($host,$db_user,$db_password,$db_name);
$id =$_POST['postid'];
/*zabespieczasz dane*/
$id = htmlentities($id, ENT_QUOTES, "UTF-8");

if($conect->connect_error!=0)
{
	echo'error';
}
else
	{
				$id_uzer = $_SESSION['id'];
				
						$a = "SELECT * FROM `posty` WHERE id='$id'";
						/*połączenie*/
						$o = @$conect->query($a);
						/*dane z połączenia*/
						$d = $o->fetch_assoc();
						/*liczy kolumny*/
						$i = $o->num_rows;
						if($i>0){
							$id_kto_add = $d['ktoadd_fk'];
							}
				if($id_kto_add == $id_uzer && $i>0){
				mysqli_query($conect,"DELETE FROM `posty` WHERE id='$id'");
					$a = "SELECT * FROM `imgs` WHERE posty_fk='$id'";
						/*połączenie*/
						$o = @$conect->query($a);
						/*dane z połączenia*/
						while($d = $o->fetch_assoc()){
							$img = $d['img'];
							unlink($img);
							}
				mysqli_query($conect,"DELETE FROM `imgs` WHERE posty_fk='$id'");
				mysqli_query($conect,"DELETE FROM `komentarze` WHERE post_fk='$id'");
				}
				$conect->close();
	}

header('Location: dom');


 ?>
