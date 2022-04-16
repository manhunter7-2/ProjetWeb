<?php

require "directories.php";
require "dbConnect.php";

$q = intval($_GET['q']);

$db = (new Tools\dbConnect)->config();
$request = "SELECT * FROM Movies WHERE title = '.$q.'";
$rqst = $db->prepare($request);
$rqst->execute();
$result = $rqst->fetchAll(PDO::FETCH_OBJ);
echo count($result);
echo $q;?>
    <?php foreach ($result as $r){
        echo $r;
    } ?>
