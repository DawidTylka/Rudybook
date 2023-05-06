<?php
session_start();
require_once "conect.php";
$conect = @new mysqli($host,$db_user,$db_password,$db_name);
$i = 0;
$login1 = date('Y-m-d-H-i-s').'_-_'.rand(0,9999).'_-_';
mkdir("img/$login1");
while(isset($_FILES['plik']['name'][$i])){
if (is_uploaded_file($_FILES['plik']['tmp_name'][$i])) {
        echo 'Odebrano plik '.$i.'. Początkowa nazwa: '.$_FILES['plik']['name'][$i];
        echo '<br/>';
        if (isset($_FILES['plik']['type'][$i])) {
            echo 'Typ: '.$_FILES['plik']['type'][$i].'<br/>';
        }
		$login = 'img/'.$login1.'/'.$_FILES['plik']['name'][$i];
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
        move_uploaded_file($_FILES['plik']['tmp_name'][$i],''.$login);
		$uzer = $_SESSION['id'];
		$conect->query("INSERT INTO `img` VALUES (NULL,'$login','$uzer')");
	$i++;
} else {
	
	
}

} 
$conect->close();
header('Location: index.php');




?>

