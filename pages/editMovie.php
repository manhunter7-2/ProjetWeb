<?php
$pageName = "Edit Movie";
require "../Tools/directories.php";

require $GLOBALS['TOOLS']."autoloader.php";
autoloader::register();
use Templates\Template;
//complete here
//complete here
ob_start();
//complete here
$ttl = ob_get_clean();
Template::render($ttl, $pageName);
