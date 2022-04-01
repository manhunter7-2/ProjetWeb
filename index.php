<?php
ob_start();
echo ("Hello World !");
$code = ob_get_clean();

use template\Template;

Template::render($code);
?>


