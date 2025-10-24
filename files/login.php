<?php
require_once "database.php";
require_once "send_mail.php";
require_once "NavBar_Element.php";
$nome = "Login";
$err = "";
if(!empty($_POST))
{
    $data = Database::getInstance()->getConnection();
    $stmt = $data->prepare("SELECT * from utenti WHERE username = :username");
    $stmt->execute([":username" => $_POST['username']]);
    $utente = $stmt->fetch();
    if($utente && password_verify($_POST['password'], $utente['password']))
    {
        $_SESSION['username'] = $utente['username'];
        sendLoginMail($utente['username']."@gmail.com", $utente['nome']);
        header("Location: ./");
        exit;
    }
    else
    {
        $err = "Non valido";
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
<?php if($err != "") echo $err;?>
<div class="row">
    <h1><?=$nome?></h1>
</div>
<div class="row">
    <div class="col box">
        <form action="./login" method="post" class="col">
           <input type="text" name="username" required>
            <input type="password" name="password" required>
            <input type="submit" value="Vai">
        </form>
    </div>
</div>
</body>
    </html>
