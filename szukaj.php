  <?php
  session_start();
  require_once"conect.php";
  $conect = @new mysqli($host, $db_user, $db_password, $db_name);
  if($conect->connect_errno!=0){echo 'error';}else{
  
        $zkim = $_GET["down"];
            $sqluzers = 'SELECT * FROM `uzers` WHERE imie LIKE "%'.$zkim.'%" OR nazwisko LIKE "%'.$zkim.'%"' ;
            $fileuzers = $conect->query($sqluzers);
            $i=0;
            while($daneuzers = $fileuzers->fetch_assoc()){
            $imie = $daneuzers['imie'];
            $nazwisko = $daneuzers['nazwisko'];
            $img = $daneuzers['profilowe'];
          echo'<a href="dodaj_kontakt.php?a='.$daneuzers["id"].'" style="color:white;"><div class="user" value="'.$daneuzers["id"].'" ><img src="ustawfoto.php?a='.$img.'"><div>'.$imie.'<br>'.$nazwisko.'</div></div></a>';
            $i++;
            }
          $conect->close();
        }

        ?>