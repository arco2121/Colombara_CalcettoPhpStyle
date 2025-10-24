<?php
require_once "../database.php";
require_once "NavBar_Element.php";

    $nome = "Profilo";
    $data = Database::getInstance()->getConnection();
    if(!empty($_POST))
    {
        if(isset($_POST["logout"]) && $_POST["logout"] == 1)
        {
            session_destroy();
            header("Location: ./login.php");
            exit;
        }
        $std = $data -> prepare("DELETE FROM prenotazioni WHERE 
                             id_utente = :id_utente AND 
                             id_campo = :id_campo AND
                             data_prenotazione = :data_prenotazione"
        );
        $std -> execute([":id_utente" => $_POST['id_utente'], ":id_campo" => $_POST['id_campo'], ":data_prenotazione" => $_POST['data_prenotazione']]);
    }
    $sta = $data -> prepare("SELECT prenotazioni.*, utenti.username FROM prenotazioni JOIN utenti ON prenotazioni.id_utente = utenti.id WHERE utenti.username = :id");
    $sta -> execute([":id" => $_SESSION['username']]);
    $st = $sta->fetchAll();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$nome?></title>
    <link href="style" rel="stylesheet">
    <link rel="icon" href="../files/img/ico.png">
</head>
<body>
<div class="row">
    <h1><?=$nome?></h1>
</div>
<div class="row">
    <div class="col box">
        <h3>Prenotazioni effettuate</h3>
       <div class="col">
           <?php
           if(!empty($st))
           {
               foreach ($st as $pre) {
                   echo("<form action='profilo.php' method='post'><h5>".$pre['username']." - ".$pre['data_prenotazione']."</h5><input type='hidden' name='id_utente' value='".$pre['id_utente']."'><input type='hidden' name='id_campo' value='".$pre['id_campo']."'><input type='hidden' name='data_prenotazione' value='".$pre['data_prenotazione']."'><input type='submit' value='Elimina'></form>");
               }
               echo "</div>";
           }
           else
           {
               echo "<h5>Nothing to show</h5>";
           }
           ?>
       </div>
    </div>
</div>
<div class="col">
    <form method="post" action="./profilo.php">
        <input type="hidden" value="1" name="logout">
        <input type="submit" value="Logout">
    </form>
</div>
</body>
</html>