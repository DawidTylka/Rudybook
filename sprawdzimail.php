<?php
session_start();
require_once "conect.php";
$conect = @new mysqli($host,$db_user,$db_password,$db_name);
$_SESSION["email"]= $_POST['email'];
$_SESSION["logina"]= $_POST['login'];
$_SESSION["ziarno"]= $_POST['ziarno'];
$login = $_POST['login'];
$email = $_POST['email'];
$ziarno = $_POST['ziarno'];

$ziarno = password_hash($ziarno, PASSWORD_DEFAULT);
if($conect->connect_error!=0)
{
	echo'error';
}
else
	{
				/*select line*/
				$a = "SELECT * FROM `uzers` WHERE login='$login' AND mail='$email'";
				/*połączenie*/
				$o = @$conect->query($a);
				/*liczy kolumny*/
				$i = $o->num_rows;
				if($i>0){
				/*dane z połączenia są dodawane*/
				$conect->query("UPDATE `uzers` SET haslo='$ziarno' WHERE login='$login' AND mail='$email'");
				header('Location: phpmailer/mail.php');
				}
	$conect->close();
			
	}
echo"$email";
echo"$i";
echo"błędnedane";

?>  