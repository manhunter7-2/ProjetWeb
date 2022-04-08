<?php
$pageName = "Login";
require "../Tools/directories.php";

require $GLOBALS['TOOLS']."autoloader.php";
autoloader::register();
use Templates\Template;
use Tools\logger;
$logger = new logger();
ob_start();
$logger->generateLogin();
$ttl = ob_get_clean();
$pageName = "Login";
Template::render($ttl, $pageName);
