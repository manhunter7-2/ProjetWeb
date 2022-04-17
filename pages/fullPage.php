<?php
$pageName = "Fiche film";
$ttl = "";
require "../Tools/directories.php";

require $GLOBALS['TOOLS']."autoloader.php";
autoloader::register();
use Templates\Template;
session_start();
ob_start(); ?>
<div id="full-page-test"></div>
<?php
$ttl = ob_get_clean();
Template::render($ttl, $pageName);