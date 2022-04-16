<?php
$pageName = "Good Movies";
require "../Tools/directories.php";

session_start();
$isLog = isset($_SESSION['name']);

require $GLOBALS['TOOLS']."autoloader.php";
autoloader::register();
use Templates\Template;
?>

<?php ob_start()?>
<?php //echo(str_word_count("xd loul    jaaj jesaispas"))?>
<?php include ($GLOBALS['TOOLS']."moviesList.php");
moviesList();?>
<?php $add = ob_get_clean();

Template::render($add, $pageName);

