<?php
$pageName = "Register";
require "../Tools/directories.php";
require $GLOBALS['TOOLS']."autoloader.php";
autoloader::register();
use Templates\Template;
ob_start();
(new Tools\register)->generateRegister();
$code = ob_get_clean();
Template::render($code, $pageName);
?>

