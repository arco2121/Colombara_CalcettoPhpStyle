<?php
use databases\database;
require_once "database.php";
require_once "NavBar_Element.php";

$nome = "Login";
$data = Database::getInstance()->getConnection();
if(!empty($_POST))
{

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
    <link href="./css/index.css" rel="stylesheet">
    <link rel="icon" href="../files/img/ico.png">
</head>
<body>
<div class="row">
    <h1><?=$nome?></h1>
</div>
<div class="row">
    <div class="col box">
        <form action="./login.php" method="post" class="col">
           <input type="text" name="username" required>
            <input type="password" name="password" required>
            <input type="submit" value="Vai">
        </form>
    </div>
</div>
</body>
    </html><?php
