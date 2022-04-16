<?php
$q = intval($_GET['q']);

$db = (new Tools\dbConnect())->config();
$request = "SELECT * FROM Movies WHERE title = '".$q."' ";
$rqst = $db->prepare($request);
$rqst->execute();
$result = $rqst->fetchAll(PDO::FETCH_OBJ);
echo ($result);?>
<div class="mov-poster"
     style="background-image: url('<?php echo ($GLOBALS['POSTERS'].$result['poster']) ?>')"
     </div>
