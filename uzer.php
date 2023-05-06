<?php 
session_start();
if(!isset($_SESSION['login'])){header('Location: zaloguj.php');}
?>
<!DOCTYPE html>
<html lang="pl">
	<head>
        <meta charset="utf-8" />
        <title>Rudy Book</title>
		 <link rel="shortcut icon" href="tlo.png">
        <meta name="author" content="Loki" />
        <link href="style.css" rel="stylesheet" id="color-opt">
		<link href="fontello-3b1745f6/css/fontello.css" rel="stylesheet" id="color-opt">
		<script src="index.js" type="text/javascript"></script> 
	</head>
	
	<body>
	<div id="offfoto" style="display:block;" >
		<div id="hoverfotobox">
			<form enctype="multipart/form-data" action="zmiana-profil.php" method="post" class="uzerinfo">
				<div>Konto:<a href="./">back</a></div>
				<div class="user"><img src="ustawfoto.php?a=<?php echo "$_SESSION[profilowe]"; ?>"><input type="file" name="plik" class="file" /><br /></div>
				<input class="rej" type="text"  value="<?php echo "$_SESSION[imie]"; ?>" name="imie" /><br />
				<input class="rej" type="text"  value="<?php echo "$_SESSION[nazwisko]"; ?>" name="nazwisko" /><br />
				<input class="rej" type="text"  value="<?php echo "$_SESSION[login]"; ?>" name="login" /><br />
				<a href="zmiana_chasla">zmieni hasło<a><br />
				<input class="rejbutton" type="submit" value="zmineni" />
			</form>
		</div>
	<div>
	
	</body>

</html>