<?php
		session_start();
		?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8" />
        <title>Rudy Book</title>
		 <link rel="shortcut icon" href="tlo.png.png">
        <meta name="author" content="Loki" />
        <link href="style.css" rel="stylesheet" id="color-opt">
		<link href="fontello-3b1745f6/css/fontello.css" rel="stylesheet" id="color-opt">
		<script src="index.js" type="text/javascript"></script> 
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>
    <body>
	<div id="offfoto" style="display:block;" >
		<div id="hoverfotobox">
		
		  <form action="sprawdzimail.php" method='post' class="uzerinfo">
		  <a href="./">back</a><br />
				<input class="rej" type="text" name="ziarno" value="<?php echo rand(1000000000, 9999999999); ?>" style="display:none;" placeholder="" required=""><br />
				<input class="rej" type="email" name="email" style="padding:7px;" placeholder="podaj_emaila" required=""><br />
				<input class="rej" type="text" name="login" style="padding:7px;" placeholder="podaj_login" required=""><br />
				<input class="rejbutton" type="submit" style="margin:-1px 0px 0px 20px;" class="btn btn-primary " value="Wyślij" >
		  </form>
		  </div>
      </div> 
      
   
    </body>
</html>