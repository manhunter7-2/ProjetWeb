<?php
namespace Tools;
require "directories.php";
require "dbConnect.php";

class fullPageDisplay{
    function display(){
        $q = $_GET['q'];
//        $q = "Shrek";

        $db = (new dbConnect())->config();
        $request = "SELECT * FROM Movies WHERE title = '".$q."';";
        $rqst = $db->prepare($request);
        $rqst->execute() or die(var_dump($rqst->errorInfo()));
        $res = $rqst->fetchAll(\PDO::FETCH_OBJ);

        foreach ($res as $r) { ?>
            <img id="fullPagePoster" src="<?php echo $GLOBALS['POSTERS'].$r->poster; ?>" alt="Image Du Film"
            <div id="textWrapper">
                <div id="fullPageTitle"><?php echo $r->title?></div>
                <div id="fullPageSyn"><?php echo $r->synopsis ?></div>
            </div>
<?php
        }
    }
}
