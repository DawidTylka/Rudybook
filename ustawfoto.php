<?php
session_start();
if(!isset($_SESSION['login'])){header('Location: logowanie');}
$file = htmlspecialchars($_GET["a"]);
if (file_exists($file)) {
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
	header('Location: index.php');
}else{
	echo"o ty";
}
header('Location: dom');