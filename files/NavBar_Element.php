<?php
session_start();
$path = basename($_SERVER['PHP_SELF']);
$logged = isset($_SESSION['username']);
if(!$logged && $path != "index.php" && $path != "login.php")
{
    header("Location: login");
    exit;
}
?>
<nav class="row>">
    <?php if($path != "index.php"){?><a href="./">Home</a><?php }?>
    <?php if($logged) {?><a href="./profilo">Profilo</a>
    <?php }else{?>
        <a href="./login">Login</a>
    <?php }?>
</nav>
<hr>