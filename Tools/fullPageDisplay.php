<?php
namespace Tools;
require "directories.php";
require "dbConnect.php";

class fullPageDisplay{
    function display(){
        $q = $_GET['q'];

        $db = (new dbConnect())->config();
        $request = "SELECT * FROM Movies WHERE title = '".$q."';";
        $rqst = $db->prepare($request);
        $rqst->execute() or die(var_dump($rqst->errorInfo()));
        $res = $rqst->fetchAll(\PDO::FETCH_OBJ);

        $request = "SELECT * FROM comments WHERE title='".$q."';";
        $rqst = $db->prepare($request);
        $rqst->execute() or die(var_dump($rqst->errorInfo()));
        $res2 = $rqst->fetchAll(\PDO::FETCH_OBJ);


        foreach ($res as $r) { ?>
            <img id="fullPagePoster" src="<?php echo $GLOBALS['POSTERS'].$r->poster; ?>" alt="Image Du Film">
            <table>
                <tbody id="arrayTab">
                    <tr id="titleRow">
                        <td><?php echo $r->title ?></td>
                    </tr>
                    <tr id="spaceRow">
                        <td></td>
                    </tr>
                    <tr id="synRow">
                        <td><?php echo $r->synopsis ?></td>
                    </tr>
                </tbody>
            </table>

            <table id="comments">
                <?php foreach ($res2 as $b){ ?>


                    <?php } ?>
            </table>
<?php
        }
    }
}
