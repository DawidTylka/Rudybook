<?php
session_start();
require_once "conect.php";
$conect = @new mysqli($host,$db_user,$db_password,$db_name);
$login =$_POST['login'];
$haslo =$_POST['password'];
/*zabespieczasz dane*/
$login = htmlentities($login, ENT_QUOTES, "UTF-8");
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
	/*dane z połączenia*/
	$d = $o->fetch_assoc();
	/*liczy kolumny*/
	$i = $o->num_rows;
	if($i>0){
	$haslodb = $d['haslo'];
		if(password_verify($haslo, $haslodb)){
			$_SESSION['id'] = $d['id'];
			$_SESSION['login'] = $d['login'];
			$_SESSION['imie'] = $d['imie'];
			$_SESSION['nazwisko'] = $d['nazwisko'];
			$_SESSION['profilowe'] = $d['profilowe'];
			}
		}
		$conect->close();
	header('Location: dom');
}
