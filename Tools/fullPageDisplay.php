<?php
namespace Tools;
require "directories.php";
require "dbConnect.php";

class fullPageDisplay{

    public function addComm():array{
        $com = "";
        if (!(isset($_SESSION['logged']))){ ?>
       <a>Vous n'êtes pas connecté. Veuillez <a href="login.php">vous connecter</a> pour commenter.</a>
<?php
        } else {
            $pdo = (new dbConnect())->config();
            if (($_SERVER["REQUEST_METHOD"]) == "POST") {
                    if (!(empty(trim($_POST["txtComm"])))) {
                        $sql = "INSERT INTO comments (title, txt, author) VALUES (:tit, :comm, :auth)";
                        if ($rqst = $pdo->prepare($sql)) {
                            $com = htmlspecialchars((trim($_POST["txtComm"])));
                            $rqst->bindParam(":tit", $_GET['q']);
                            $rqst->bindParam(":comm", $com);
                            $rqst->bindParam(":auth", $_SESSION["usr"]);
                            if (strlen(trim($_POST["txtComm"])) == 0){
                                die();
                            }else if((strlen(trim($_POST["txtComm"]))-substr_count(trim($_POST["txtComm"]), ' ')) > 1500){ ?>
                                <a>Le commentaire ne doit pas excéder 1500 caractères !</a>
                            <?php
                            die();
                            }else{
                            if ($rqst->execute()) {
                                header("location:" . $_SERVER['PHP_SELF']);
                            }
                        }
                        unset($rqst);
                        unset($pdo);
                    }
                }
            }
        }
        return array(
            'txtComm' => $com,
        );
    }


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
            $array = $this->addComm();
        } ?>

            <form
                action="" method="POST">
<!--                    action="--><?php //echo htmlspecialchars($_SERVER["PHP_SELF"]) ?><!--" method="post">-->
        <div class="form-group">
            <textarea type="text" name="txtComm" id="txtComm" rows="2" cols="30" placeholder="Votre commentaire..." value="<?php echo $array['txtComm'] ?>"></textarea>
            <input type="submit" class="btn btn-primary cmtBtn" value="Publier">
        </div>
            </form>


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
        </div>
<?php
    }
}
