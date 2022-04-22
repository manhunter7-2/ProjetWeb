<?php
$log = isset($_SESSION["logged"]);
$admin = (isset($_SESSION["usr"]) && $_SESSION["usr"] == "admin");
?>

<header>
    <div id="main-menu">
    <a id="redirectMain">
        <div id="head-pic">
        </div>
        <h3 id="head-title">Good Movies</h3>

    </a>
    </div>
    <div id="head-login-btn">
        <input type="text" name="search" class="search" placeholder="Rechercher un film...">
        <input type="submit" id="searchBtn" value="Search">
        <?php if ($log){ ?>
                <?php if ($admin): ?>
            <a href="<?php echo $GLOBALS['PAGES']."addMovie.php" ?>">Upload</a>
            <?php endif ?>
            <a href="<?php echo ($GLOBALS['TOOLS']."disconnect.php") ?>">Se déconnecter</a>
        <?php } ?>

        <?php if (!$log){ ?>
        <a href="login.php">Se connecter</a>
        <?php } ?>
    </div>
</header>
