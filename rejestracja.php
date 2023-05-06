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
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	</head>
	
	<body>


	<div id="offfoto" style="display:block;" >
		<div id="hoverfotobox">
			<form enctype="multipart/form-data" action="rejestracja-script.php" method="post" class="uzerinfo">
				<div>Rejestracja:<a href="./">back</a></div>
				<input class="rej" type="text"  placeholder="Imie" name="imie" required=""/><br />
				<input class="rej" type="text"  placeholder="Nazwisko" name="nazwisko" required=""/><br />
				<input class="rej" type="text"  placeholder="Login" name="login" required=""/><br />
				<input class="rej" type="password"  placeholder="Hasło" name="password" required=""/><br />
				<input class="rej" type="email"  placeholder="email do odzyskiwania" name="email" required=""/><br />
				<div class="g-recaptcha" data-sitekey="6Leonx8aAAAAAOzYIvWz1U1SScQq6seAX8NhTvlM"></div><br />
				<input class="rejbutton" type="submit" value="zaloguj" />
			</form>
		</div>
	<div>
	</body>

</html>