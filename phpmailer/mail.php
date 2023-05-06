<?php
session_start();
$data = date("Y-m-d H:i:s");
	if($_SESSION["mail"] != "Informacje na temat ustawieni zostały przesłane."){
    require_once('class.phpmailer.php');    //dodanie klasy phpmailer
    require_once('class.smtp.php');    //dodanie klasy smtp
    $mail = new PHPMailer();    //utworzenie nowej klasy phpmailer
    $mail->From = "";    //adres e-mail użyty do wysyłania wiadomości
    $mail->FromName = "ja";    //imię i nazwisko lub nazwa użyta do wysyłania wiadomości
    $mail->AddReplyTo('', ''); //adres e-mail nadawcy oraz jego nazwa
                                                 //w polu "Odpowiedz do"  
    $mail->Host = "	";    //adres serwera SMTP wysyłającego e-mail
    $mail->Mailer = "smtp";    //do wysłania zostanie użyty serwer SMTP
    $mail->SMTPAuth = true;    //włączenie autoryzacji do serwera SMTP
    $mail->Username = "";    //nazwa użytkownika do skrzynki e-mail
    $mail->Password = "";    //hasło użytkownika do skrzynki e-mail
    $mail->Port = 25;   //Temat wiadomości, można stosować zmienne i znaczniki HTML
    $mail->Body = "
	Login:
	".$_SESSION["logina"]." 
	Hasło:
	".$_SESSION["ziarno"]." 
	Data:
	".$data."
	";    //Treść wiadomości, można stosować zmienne i znaczniki HTML     
    $mail->AddAddress ($_SESSION["email"],"kontakt");    //adres skrzynki e-mail oraz nazwa
                                              //adresata, do którego trafi wiadomość
     if($mail->Send())    //sprawdzenie wysłania, jeśli wiadomość została pomyślnie wysłana
        {                      
        $_SESSION["mail"] = "Informacje na temat ustawieni zostały przesłane.";  //wyświetl ten komunikat
        }            
    else    //w przeciwnym wypadku
        {           
        $_SESSION["mail"] = 'Informacje na temat ustawieni nie zostały przesłane.(error)';     //wyświetl następujący
        }
	}else{}
		echo ''.$_SESSION["mail"].' '.$_SESSION["email"].' '.$_SESSION["ziarno"].'';
		header('Location: ../');
  ?>  