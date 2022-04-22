<?php
$pageName = "Edit Movie";
require "../Tools/directories.php";

require $GLOBALS['TOOLS']."autoloader.php";
autoloader::register();
use Templates\Template;
use Tools\movEditor;
$edt = new movEditor();
ob_start();
$edt->editor();
$ttl = ob_get_clean();
Template::render($ttl, $pageName);
