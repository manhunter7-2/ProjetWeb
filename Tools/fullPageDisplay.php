<?php
namespace Tools;
require "directories.php";
require "dbConnect.php";

class fullPageDisplay{
    function display(){
        $q = $_GET['q']; //get movie name

        // MOVIE REQUESTS
        $db = (new dbConnect())->config();
        $request = "SELECT * FROM Movies WHERE title = '".$q."';";
        $rqst = $db->prepare($request);
        $rqst->execute() or die(var_dump($rqst->errorInfo()));
        $res = $rqst->fetchAll(\PDO::FETCH_OBJ);

        //COMMENTS REQUESTS
        $request = "SELECT * FROM comments WHERE title='".$q."';";
        $rqst = $db->prepare($request);
        $rqst->execute() or die(var_dump($rqst->errorInfo()));
        $res2 = $rqst->fetchAll(\PDO::FETCH_OBJ);

        foreach ($res as $r) { ?>
                <div id="container">
                <div id="moviePage">
            <img id="fullPagePoster" src="<?php echo $GLOBALS['POSTERS'].$r->poster; ?>" alt="Image Du Film"/>
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
                </div>

<?php
        } ?>


<!--<div id="commentSection">-->
    <table id="comments">
        <tbody>
        <?php foreach ($res2 as $b){ ?>
            <tr>
                <td><?php echo $b->author ?></td>
                <td><?php echo $b->txt ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<!--</div>-->
        </div>
<?php
    }
}
