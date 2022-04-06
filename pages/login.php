<?php
$pageName = "Login";
require "../Tools/directories.php";
session_start();

require $GLOBALS['TOOLS']."autoloader.php";
autoloader::register();
use Templates\Template;
use Tools\logger;

$log = new logger();
$usr = null;
$pwd = null;
if (isset($POST['form-name']) && isset($POST['form-pwd'])){
    $usr = $POST['form-name'];
    $pwd = $POST['form-pwd'];
    $resp = $log->login(trim($usr), trim($pwd));
    if ($resp['ok_access']){
        $SESSION['form-name'] = $resp['pseudo'];
        header("Location: index.php");
        exit;
    }
}
ob_start();
if (!isset($resp)){
    $log->loginForm("", $usr);
}
elseif(!$resp['ok_access']){

}
