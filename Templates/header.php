<?php
$log = isset($_SESSION["logged"]);
$admin = (isset($_SESSION["usr"]) && $_SESSION["usr"] == "admin");
?>

<header>
    <a href="mainPage.php">
    <div id="main-menu">
        <div id="head-pic">
        </div>
        <h3 id="head-title">Good Movies</h3>
    </div>
    </a>
    <div id="head-login-btn">
        <?php if ($log){ ?>
            <a href="https://www.php.net/manual/fr/language.types.array.php">PHP</a>
            <a href="<?php echo ($GLOBALS['TOOLS']."disconnect.php") ?>">Se déconnecter</a>

        <?php } ?>

        <?php if (!$log){ ?>
        <a href="login.php">Se connecter</a>
        <?php } ?>
    </div>
</header>
