<?php 
session_start();
if(isset($_SESSION['login']))
{
  session_destroy();
}
?>
<!DOCTYPE html>
<html lang="pl">
	<head>
        <meta charset="utf-8" />
        <title>Rudy Book</title>
		 <link rel="shortcut icon" href="jebanetlopierodlone.png">
		 <meta property="og:type" content="website">
			<meta property="og:site_name" content="Dawid Ja">
			<meta property="og:title" content="Rudybook">
			<meta property="og:description" content="Better Facebook">
			<meta property="og:image" content="https://dawid2020.usermd.net/rudybook_v0.2/jebanetlopierodlone.png">
			<meta  property="og:url" content="https://dawid2020.usermd.net" />
			<meta content="#43B581" data-react-helmet="true" name="theme-color" />
			<meta name="twitter:card" content="summary_large_image">
			<meta name="twitter:site" content="@discord">
			<meta name="twitter:creator" content="@yourtwitter">
        <meta name="author" content="Loki" />
        <link href="style.css" rel="stylesheet" id="color-opt">
		<link href="fontello-3b1745f6/css/fontello.css" rel="stylesheet" id="color-opt">
		<script src="index.js" type="text/javascript"></script> 
	</head>
	
	<body>

	<div id="offfoto" style="display:block;" >
		<div id="hoverfotobox">
			<form enctype="multipart/form-data" action="loguj-script.php" method="post" class="poleadduser">
				<div>Zaloguj:</div>
				<input class="rej" type="text"  placeholder="Login" name="login" /><br />
				<input class="rej" type="password"  placeholder="Hasło" name="password"/><br />
				<input class="rejbutton" type="submit" value="zaloguj" /><br />
				<?php if(isset($_GET['popraw'])){echo"nosz niezbyt";} ?>
				<div class="rej"><a href="rejestracja">Zarejestruj</a>/<a href="odzyskaj.php">Zapomniałeś hasła?</a></div>
			</form>
		</div>
	<div>
	
	</body>

</html>