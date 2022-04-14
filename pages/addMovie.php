<?php
$pageName = "add movie";
require "../Tools/directories.php";
require $GLOBALS['TOOLS']."autoloader.php";
autoloader::register();
use Templates\Template;
use Tools\movieAdder;
$add = new movieAdder();
ob_start();
$add->generateUploadForm();
$ttl = ob_get_clean();
Template::render($ttl, $pageName);
