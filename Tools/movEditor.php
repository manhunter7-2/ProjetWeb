<?php
namespace Tools;
require "directories.php";

class movEditor{
    public function editor(): void
    {

        $q = $_GET['q'];
        $sql = "SELECT * FROM Movies WHERE title='".$q."';";
        $pdo = (new \Tools\dbConnect())->config();
        $request = $pdo->prepare($sql);
        $request->execute();
        $all = $request->fetchAll(\PDO::FETCH_OBJ);
        foreach ($all as $r) {
            echo $r->poster;

            $pdoEdit = (new \Tools\dbConnect())->config();
            $ttl = $date = $syn = "";
            if ($_SERVER['REQUEST_METHOD'] == "POST"){
                $ttlPdo = (new dbConnect())->config();

                if (!empty(trim($_POST['newTitle']))){
                    $text = htmlspecialchars(trim($_POST['newTitle']));
                    $sql = "UPDATE Movies SET title=:ttl WHERE poster=:pst;";
                    $rqst = $ttlPdo->prepare($sql);
                    $rqst->bindParam(":ttl", $text);
                    $rqst->bindParam(":pst", $r->poster);
                    $rqst->execute() or die(var_dump($rqst->errorInfo()));
                }

                if (!empty(trim($_POST['newSyn']))){
                    $syn = htmlspecialchars(trim($_POST['newSyn']));
                    $sql = "UPDATE Movies SET synopsis=:syn WHERE title='".$q."';";
                    $rqst = $ttlPdo->prepare($sql);
                    $rqst->bindParam(":syn", $syn);
                    if($rqst->execute()) {
                        header("location:".$GLOBALS['PAGES']."mainPage.php");
                    }else{
                        header("location:https://www.google.com/search?channel=fs&client=ubuntu&q=one+submit+button+per+input");
                    }
                }

                if(!empty(trim($_POST['date']))){
                    $date = date('Y-m-d', strtotime(trim($_POST['date'])));
                    $sql = "UPDATE Movies SET movDate=:dat WHERE id='$r->id';";
                    $rqst = $ttlPdo->prepare($sql);
                    $rqst->bindParam(":dat", $date);
                    $rqst->execute() or die(var_dump($rqst->errorInfo()));
                }
                unset($rqst);
                unset($ttlPdo);
            }

        ?>
                <div id="editWritings">
                <h2 id>Edition de film</h2>
            <p>NE MODIFIER QUE LES CHAMPS NECESSAIRES</p>
                </div>
                <div id="editor">
        <form action="" method="post">
            <div class="ttl-form-group">
                <div id="oldTitle"><?php echo $r->title ?></div>
                <input type="text" name="newTitle" id="newTitle" class="form-control">
                <input type="submit"  name="ttlSubmit" class="btn btn-primary" value="Edit">
            </div>
        </form>

        <form action="" method="post">
        <div class="syn-form-group">
                <div id="oldSyn"><?php echo $r->synopsis ?></div>
                <textarea type="text" name="newSyn" id="newSyn" rows="3" cols="30" placeholder="Nouveau Synopsis..."></textarea>
                <input type="submit" name="ttlSubmit" id="smt" class="btn btn-primary" value=".Edit">
            </div>
        </form>

        <form action="" method="post">
        <div class="date-form-group">
                <div id="oldDate"><?php if (isset($r->movDate)){ echo date("Y-m-d", strtotime($r->movDate));}else{echo("");}?></div>
                <input type="date" id="date" name="date" class="form-control" placeholder="Nouvelle Date...">
                <input type="submit" name="ttlSubmit" class="btn btn-primary" value="Edit.">
            </div>
        </form>
                </div>
            <input type="submit" name="delete" value="Effacer">

<?php  }
        }
}
