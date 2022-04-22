<?php
namespace Tools;

class movEditor{
    public function editor(){



        $q = $_GET['q'];
        $sql = "SELECT * FROM Movies WHERE title='".$q."';";
        $pdo = (new \Tools\dbConnect())->config();
        $request = $pdo->prepare($sql);
        $request->execute();
        $all = $request->fetchAll(\PDO::FETCH_OBJ);
        foreach ($all as $r) {

            $pdoEdit = (new \Tools\dbConnect())->config();
            $ttl = $date = $syn = "";
            if ($_SERVER['REQUEST_METHOD'] == "POST"){
                if (!empty(trim($_POST['newTitle']))){
                    $ttl = htmlspecialchars(trim($_POST['newTitle']));
                }else{
                    $ttl = "";
                }

                if (!empty(trim($_POST['newSyn']))){
                    $syn = htmlspecialchars(trim($_POST['newSyn']));
                }else{
                    $syn = "";
                }

                if (!empty(trim($_POST['newDate']))){
                    $date = date('Y-m-d', strtotime($_POST['date']));
                }else{
                    $date = "";
                }
            }
                if ($ttl != ""){
                    $sql_ttl = " title=:ttl,";
                    $editRqst->bindParam(":ttl", $ttl);
                }else{
                    $sql_ttl = "";
                if ($syn != ""){
                    $sql_syn = " synopsis=:syn,";
                    $editRqst->bindParam(":syn", $syn);
                }else{
                    $sql_syn = "";
                }
                if($date != ""){
                    $date_sql = " movDate=:date";
                    $editRqst->bindParam(":dat", $date);
                }else{
                    $date_sql = "";
                }
                $sqlEdit = "UPDATE Movies SET $sql_ttl, $sql_syn, $date_sql WHERE poster='$r->poster'";

        }

            if ($editRqst->execute()){
                header("location: mainPage.php");
            }else{
                echo("ERREUR");
            }

        ?>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
            <div class="ttl-form-group">
                <div id="oldTitle"><?php echo $r->title ?></div>
                <input type="text" name="newTitle" id="newTitle" class="form-control">
            </div>

            <div id="syn-form-group">
                <div id="oldSyn"><?php echo $r->synopsis ?></div>
                <textarea type="text" name="newSyn" id="newSyn" rows="3" cols="30" placeholder="Nouveau Synopsis..."></textarea>
            </div>

            <div id="date-form-group">
                <div id="oldDate"><?php echo $r->date ?></div>
                <input type="date" id="newDate" name="newDate" class="form-control" placeholder="YYYY/MM/DD">
            </div>
        </form>

<?php    }
        }
}
