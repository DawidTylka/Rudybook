<?php
$url = explode('/rudybook_v0.2/', $_SERVER['REQUEST_URI']);
switch ($url[1]){
	case "":
			require("index.php");
		break;
	case "dom":
			require("index.php");
		break;
	case "logowanie":
		require("zaloguj.php");
		break;
	case "edytuj_uzytkownika":
		require("uzer.php");
		break;
	case "rejestracja":
		require("rejestracja.php");
		break;
	case "zmiana_chasla":
		require("haslohange.php");
		break;
	default:
		if(strstr($url[1], "?")){
			$url = explode('?', $url[1]);
			require($url[0]);
		}else{require($url[1]);}
		break;
	
}
