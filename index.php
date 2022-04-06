<?php
require "Tools/directories.php";

session_start();
$isLog = isset($_SESSION['admin']);

require $GLOBALS['TOOLS']."autoloader.php";
autoloader::register();
use Templates\Template;
?>

<?php ob_start()?>
<h1>Hello World !</h1>
<?php //echo(str_word_count("xd loul    jaaj jesaispas"))?>
<?php include ("Tools/dataTools.php");
dataTools();?>
<?php $add = ob_get_clean();

Template::render($add);
