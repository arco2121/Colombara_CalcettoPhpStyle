<?php
require_once "database.php";
require_once "NavBar_Element.php";

$nome = $_GET['id_campo'];
$err = "";
$data = Database::getInstance()->getConnection();
$st = $data -> prepare("SELECT * FROM campi WHERE nome_campo = :nome");
$st -> execute(['nome' => $nome]);
$res = $st -> fetch();
if(empty($res)){
    header("Location: ./");
}
$aia = $data->prepare("SELECT id FROM utenti WHERE username = :nome");
$aia -> execute(['nome' => $_SESSION["username"]]);
$resu  = $aia -> fetch()['id'];
$statem = $data->prepare("SELECT prenotazioni.data_prenotazione AS data, 
                                    utenti.username AS username,
                                    utenti.id AS id
                               FROM prenotazioni 
                               JOIN utenti ON prenotazioni.id_utente = utenti.id 
                               WHERE prenotazioni.id_campo = :idcampo 
                               ORDER BY prenotazioni.data_prenotazione");
$statem -> execute(['idcampo' => $nome]);
$pren = $statem -> fetchAll();
if(!empty($_POST)){
    try{
        $state = $data -> prepare("INSERT INTO prenotazioni (id_utente, id_campo, data_prenotazione) VALUES (:id_utente, :id_campo, :data)");
        $state -> execute([
                ':id_campo' => $_POST['nome_campo'],
                ':id_utente' => $_POST['utente'],
                ':data' => $_POST['data']
        ]);
        echo "<script>alert('Prenotazione aggiornata');</script>";
        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    }
    catch (Exception $e){
        $err = $e;
    }
}
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
<?php if($err != "") echo("Errore nella prenotazione: ".$err);
?>
<div class="row">
    <h1><?=$nome?></h1>
</div>
<div class="row">
    <div class="col box">
        <div class="row">
            <h3><?=$res['nome_campo']?></h3>
            <h4><?=$res['capienza']?> persone</h4>
        </div>
        <div class="box-img">
            <img src="<?=$res['foto_url']?>">
        </div>
    </div>
    <div class="col box">
        <form method="post" class="col">
            <h3>Prenotazione</h3>
            <hr>
            <input type="hidden" id="utente" name="utente" value="<?=$resu?>">
            <div class="col">
                <label for="capienza_dentro">Quantità:</label>
                <input min="1" required type="number" id="capienza_dentro" name="capienza_dentro">
            </div>
            <div class="col">
                <label for="data">Data:</label>
                <input required name="data" type="date" id="data">
            </div>
            <input readonly type="hidden" value="<?=$res['nome_campo']?>" name="nome_campo">
            <input type="submit" value="Prenota">
        </form>
    </div>
    <div class="col box">
        <h3>Prenotazioni</h3>
        <div class="col">
            <?php if(!empty($pren)) { foreach ($pren as $pre) { ?>
                <h5><?= ($pre['id'] == $resu)?$pre['username']:"Busy" ?> - <?=$pre['data']?></h5>
            <?php } } else{
                echo "<p>Nessun campo per prenotazione</p>";
            }?>
        </div>
    </div>
</div>
</body>
</html>