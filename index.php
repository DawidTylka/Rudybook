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
		 	<meta property="og:site_name" content="Dawid Ja">
			<meta property="og:title" content="Rudybook">
			<meta property="og:description" content="Better Facebook">
			<meta property="og:image" content="https://dawid2020.usermd.net/rudybook_v0.2/jebanetlopierodlone.png">
			<meta  property="og:url" content="https://dawid2020.usermd.net" />
			<meta content="#43B581" data-react-helmet="true" name="theme-color" />
			<meta name="twitter:card" content="summary_large_image">
			<meta name="twitter:site" content="@discord">
			<meta name="twitter:creator" content="@yourtwitter">
        <link href="style.css" rel="stylesheet" id="color-opt">
		<link href="fontello-3b1745f6/css/fontello.css" rel="stylesheet" id="color-opt">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="index.js" type="text/javascript" defer></script> 
		<script src="ajax.js" type="text/javascript" defer></script> 
		
	</head>
	
	<body id="cialo">
	<iframe name="blackhole" style="display:none;"></iframe>
	<?php echo $_SESSION['login']; ?>
	<div id="off" onclick="off(this)" style="display:none;"></div>
	<nav>
		<div id="rightnav" class="nav">
			<img src="tlo.png" alt="logo" height="100%" />
			<input id="search" class="search"  type="search" placeholder="wyszukaj" onkeyup="szukaj()">
		</div>
		<div id="menu">
			<div><i class="icon-users" > </i></div>
			<div><i class="icon-user-1" > </i></div>
			<div><i class="icon-heart" > </i></div>
		</div>
		<div id="leftnav" class="nav"> 
			<div id="hover_info" style="display:none;">
				<div><a href="edytuj_uzytkownika"><?php echo "$_SESSION[imie] $_SESSION[nazwisko]"; ?></a></div>
				<div id="mobil_menu"><a href="mobilmenu.php">Powieszeni</a></div>
				<div><a href="logowanie"><i class="icon-user-times"> Wyloguj</i> </a></div>
			</div>
			<div id="dane">
				<div id="uzer" class="user" onclick="hoverInfoOn()"><img src="<?php echo "ustawfoto.php?a=$_SESSION[profilowe]"; ?>"></div>
				komunikator
			</div>
		</div>
		<div id="leftnavmobi" class="nav"> 
		<submit style="display:flex; justify-content:center; align-items: center; height:100%;" onclick="location.reload(true)" >reload</submit>
		</div>
	</nav>
	
	<main>
		<article id="mainleft" >
		</article>
		<article id="maincenter">
			<div id="polenaftowe" class="post"> 
				<form enctype="multipart/form-data" action="dajposta-script.php" method="post" class="razem">
				Dodaj Posta:<br />
				<textarea name="komentaz" ></textarea><br />
				<input type="file" name="plik[]" class="file" multiple=""/><br />
				<input type="submit" onclick="hujwpost()" value="wyślij" />
				</form>
			</div>
				<div id="posty" style="background-color:black;">
				</div>
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