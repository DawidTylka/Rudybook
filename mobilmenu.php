<?php 
session_start();
if(!isset($_SESSION['login'])){header('Location: logowanie');}
?>
<!DOCTYPE html>
<html lang="pl">
	<head>
        <meta charset="utf-8" />
        <title>Rudy Book</title>
		 <link rel="shortcut icon" href="tlo.png">
        <meta name="author" content="Loki" />
        <link href="main.css" rel="stylesheet" id="color-opt">
		<link href="fontello-3b1745f6/css/fontello.css" rel="stylesheet" id="color-opt">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="index.js" type="text/javascript" defer></script> 
		<script type="text/javascript" defer>
		window.onload = ajax;
window.onload = scrollHandler;
let ilestron = 1;
let poprzednio = 0;
let teraz = 1;
function ajax(){
  var XHR = null;
  try
  {
    XHR = new XMLHttpRequest();
  }
  catch(e)
  {
      try
    {
      XHR = new  ActiveXObject("Msxm12.XMLHTTP");
    }catch(e2)
    {
        try
      {
        XHR = new  ActiveXObject("Microsoft.XMLHTTP");
      }catch(e3)
      {
        window.alert('błąd');
      }
    }
  }
  return XHR;
}
function szukaj()
{

      var link = "szukaj.php?down=";

	  var tekst = document.getElementById('search').value;

        link += tekst;

        setTimeout(addszukaj(link), 9);

}
function addszukaj(link)
{

XHR= ajax();

  if ( XHR != null ){



    XHR.open("GET", link, true)

    

    XHR.onreadystatechange = function()

    {

      if (XHR.readyState == 4)

      { 

        document.getElementById('mainleft').innerHTML = XHR.responseText;

      }

    }

    XHR.send(null);

} 

}</script> 
		
	</head>
	
	<body id="cialo">
	<iframe name="kurwablackhole" style="display:none;"></iframe>
	<?php echo $_SESSION['login']; ?>
	<div id="off" onclick="off(this)" style="display:none;"></div>
	<nav>
		<div id="rightnav" class="nav">
			<img onclick="window.location='./';" src="jebanetlopierodlone.png" alt="logo" height="100%" />
			<input id="search" class="search"  type="search" placeholder="wyszukaj" onkeyup="szukaj()">
		</div>
	</nav>
	
	<main>
		<article id="mainleft" />
		</article>
		
		<article id="mainright">
		<div>
			Powieszeni:
			<div id="contact">
<?php
require_once "conect.php";
?>

<?php
				
				$id = $_SESSION['id'];
				$conect = @new mysqli($host,$db_user,$db_password,$db_name);
				$sql = "SELECT `zkim` FROM `kontakty` WHERE kto='$id' ";
				$file = $conect->query($sql);
				if($file->num_rows > 0){
					while($dane = $file->fetch_assoc()){
						$zkim = $dane["zkim"];
						$sqluzers = "SELECT * FROM `uzers` WHERE id='$zkim'" ;
						$fileuzers = $conect->query($sqluzers);
						$daneuzers = $fileuzers->fetch_assoc();
						$iduz = $daneuzers['id'];
						$imie = $daneuzers['imie'];
						$nazwisko = $daneuzers['nazwisko'];
						$img = $daneuzers['profilowe'];
					echo'<div class="user"><img src="ustawfoto.php?a='.$img.'"><div>'.$imie.'<br>'.$nazwisko.'</div>
					<form enctype="multipart/form-data" action="usuni-znajomych.php" method="post" class="razem">
					<input type="number" name="uzerid" value="'.$iduz.'" style="display:none;"/><br />
					<input type="submit" value="Odwieś" />
					</form>
					
					
					</div>';
					}
				}
				$conect->close();
				?>
			</div>
		</div>
		
		</article>
	</main>
	
	<footer>
	Copy ryte by me Sprawdz <a href="http://dawid2020.usermd.net/rltopln/">Tesz rudy translator</a>
	</footer>
	<div id="offfoto" onclick="off(this)" style="display:none;" >
		<div id="hoverfotobox">
			<img id="hoverfoto" alt="xd"> 
		</div>
	<div>
	</body>

</html>