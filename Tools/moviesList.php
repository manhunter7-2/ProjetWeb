<?php

use Tools\dbConnect;

function moviesList():void{
    $admin = (isset($_SESSION["usr"]) && $_SESSION["usr"] == "admin");

    if (isset($_GET['q'])){
        $q = $_GET['q'];
        $comp_sql = " WHERE LOWER(title) LIKE LOWER('%".$q."%')";
    }else{
        $q = "";
        $comp_sql = "";
    }
    $db = (new dbConnect())->config();

    $nbre = $db->prepare("SELECT COUNT(poster) AS cpt FROM Movies");
    $nbre->execute();
    $ttl = $nbre->fetchAll(PDO::FETCH_ASSOC);
    $nb_elem_per_page = 6;
    $nb_pages = ceil($ttl[0]["cpt"]/$nb_elem_per_page);
    if (isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page=1;
    }
    $begin = ($page-1)*$nb_elem_per_page;


    $request = "SELECT * FROM Movies $comp_sql LIMIT $begin,$nb_elem_per_page"; ?>

<?php
    $rqst = $db->prepare($request);
    $rqst->execute() or die(var_dump($rqst->errorInfo()));
    $result = $rqst->fetchAll(PDO::FETCH_OBJ);


 ?>

    <div id="pagination">
            <?php for ($i=1; $i<=$nb_pages; $i++){
                echo "<a href='?page=$i'>$i</a>&nbsp;";
            } ?>
    </div>
    <div id="mov-all">

    </div>
        <div class="test">
        <?php foreach ($result as $r): ?>
            <div class="art-mov" id="<?php echo $r->title ?>">
                <div class="main-title">
                    <?= $r->title?>
                </div>
                <div class="main-poster"
                     style="background-image: url('<?php echo($GLOBALS['POSTERS'].$r->poster)?>')">
                </div>
                <div id="lowCard">
                <div class="outDate"><?php echo date("d-m-Y", strtotime($r->movDate))?></div>
                <?php if ($admin){ ?>
                <input type="submit" class="edit" value="Editer" id="<?php echo $r->title ?>">
                <?php } ?>
            </div>
            </div>
        <?php endforeach; ?>
<?php
}
?>
