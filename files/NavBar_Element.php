<?php
$st = explode("/", $_SERVER['PHP_SELF']);
$path = $st[count($st) - 1];
$logged = isset($_SESSION['username']);
?>
<nav class="row>">
    <?php if($path != "index.php"){?><a href="../index.php">Home</a><?php }?>
    <?php if($logged) {?><a <?php if($path != "index.php"){ ?>href="../files/profilo.php" <?php } else { ?> href="./files/profilo.php" <?php } ?>>Profilo</a>
    <?php }else{?>
        <a <?php if($path != "index.php"){ ?>href="../files/login.php" <?php } else { ?> href="./files/login.php" <?php } ?>>Login</a>
    <?php }?>
</nav>
<hr>