<?php
require "directories.php";
require "dbConnect.php";

$q = $_GET['q'];

$db = (new \Tools\dbConnect())->config();
$request = "SELECT * FROM Movies WHERE title = '".$q."';";
$rqst = $db->prepare($request);
$rqst->execute() or die(var_dump($rqst->errorInfo()));
$res = $rqst->fetchAll(PDO::FETCH_OBJ);

foreach ($res as $r) { ?>
    <div id="fullPagePoster" style="background-image: url('<?php echo ($GLOBALS['POSTERS'].$r->poster) ?>')"></div>
    <div id="fullPageTitle"><?php echo $r->title?></div>
    <div id="fullPageSyn"><?php echo $r->synopsis ?></div>
<?php
}
