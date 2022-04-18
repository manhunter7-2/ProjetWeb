<?php
$pageName = "Fiche film";
require "../Tools/directories.php";

require $GLOBALS['TOOLS']."autoloader.php";
autoloader::register();
use Templates\Template;
use Tools\fullPageDisplay;
$disp = new fullPageDisplay();
session_start();
ob_start();
$disp->display();
$ttl = ob_get_clean();
Template::render($ttl, $pageName);