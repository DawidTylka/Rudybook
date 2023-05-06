<?php
session_start();
if(isset($_POST['login']) && isset($_POST['imie']) && isset($_POST['nazwisko']) && isset($_POST['password'])){
require_once "conect.php";
$conect = @new mysqli($host,$db_user,$db_password,$db_name);
$login =$_POST['login'];
$imie =$_POST['imie'];
$nazwisko =$_POST['nazwisko'];
$haslo =$_POST['password'];
$email = $_POST['email'];
/*zabespieczasz dane*/

$login = htmlentities($login, ENT_QUOTES, "UTF-8");
$imie = htmlentities($imie, ENT_QUOTES, "UTF-8");
$nazwisko = htmlentities($nazwisko, ENT_QUOTES, "UTF-8");
$haslo = password_hash($haslo, PASSWORD_DEFAULT);

//Bot or not? Oto jest pytanie!
        $sekret = "6Leonx8aAAAAAFnZVB2LM6QQwWay8JqhEZd1tLCv";
         
        $sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);
         
        $odpowiedz = json_decode($sprawdz);
         
        if($odpowiedz->success===true){       




if($conect->connect_error!=0)
{
	echo'error';
}
else
	{
		/*select line*/
		$a = "SELECT * FROM `uzers` WHERE login='$login'";
		/*połączenie*/
		$o = @$conect->query($a);
		/*liczy kolumny*/
		$i = $o->num_rows;
		if($i == 0){
				/*dane z połączenia są dodawane*/
				$conect->query("INSERT INTO `uzers` VALUES (NULL, '$login', '$haslo', '$imie', '$nazwisko','jebanetlopierodlone.png', '$email')");
			}
	}
}
$conect->close();
header('Location: logowanie');
}else{header('Location: rejestracja');}
?>
