<?php

session_start();

if(isset($_POST['haslo'])){

require_once "conect.php";

$conect = @new mysqli($host,$db_user,$db_password,$db_name);


/*zabespieczasz dane*/


if($conect->connect_error!=0)

{

	echo'error';

}

else


		$id = $_SESSION['id'];
		$haslo = $_POST['haslo'];
		$haslo = password_hash($haslo, PASSWORD_DEFAULT);
			$sql = 'UPDATE uzers SET haslo="'.$haslo.'" WHERE id='.$id.'';

				/*dane z poĹ‚Ä…czenia sÄ… zamieniane*/
			if ($conect->query($sql) === TRUE) {

			header('Location: index.php');

			}

			echo "$sql";

		

		$conect->close();

	}else{

		
	}
header('Location: ./');

?>