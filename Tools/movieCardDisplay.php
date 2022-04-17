<?php

require "directories.php";
require "dbConnect.php";

$q = $_GET['q'];

$db = (new Tools\dbConnect)->config();
$request = "SELECT * FROM Movies WHERE title = '".$q."';";
$rqst = $db->prepare($request);
$rqst->execute() or die(var_dump($rqst->errorInfo()));
$res = $rqst->fetchAll(PDO::FETCH_OBJ);


foreach ($res as $r){ ?>
<div class="bigPoster" style="background-image: url('<?php echo $GLOBALS['POSTERS'].$r->poster ?>')"></div>
    <div class="bigTitle"><?php echo $r->title ?></div>
    <div class="bigSyn"><?php echo $r->synopsis ?></div>
    <button class="checkMov" href="">Voir la fiche...</button>
<?php }
?>
