<?php

require_once "database.php";

    $title = "Calcetto";
    $data = Database::getInstance()->getConnection();
    $result = $data -> query("SELECT * FROM campi ORDER BY capienza DESC");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$title?></title>
    <link rel="icon" href="./files/img/ico.png">
    <link href="./files/css/index.css" rel="stylesheet">
</head>
<body>
<?php require_once "files/NavBar_Element.php";
?>
    <div class="row">
        <h1><?=$title?></h1>
    </div>
    <div class="full row">
        <?php foreach ($result as $row) {?>
            <div class="col box">
                <div class="row">
                    <h3><?=$row['nome_campo']?></h3>
                    <h4><?=$row['capienza']?> persone</h4>
                </div>
                <div class="box-img">
                    <a class="nope" href="./files/campo.php?id_campo=<?=$row['nome_campo']?>"><img src="<?=$row['foto_url']?>"> </a>
                </div>
            </div>
        <?php }?>
    </div>
</body>
</html>