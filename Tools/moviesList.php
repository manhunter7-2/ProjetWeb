<?php

use Tools\dbConnect;

function moviesList(){
    $db = (new dbConnect())->config();

    $nbre = $db->prepare("SELECT COUNT(poster) AS cpt FROM Movies");
    $nbre->execute();
    $ttl = $nbre->fetchAll(PDO::FETCH_ASSOC);
    $nb_elem_per_page = 10;
    $nb_pages = ceil($ttl[0]["cpt"]/$nb_elem_per_page);
    if (isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page=1;
    }
    $begin = ($page-1)*$nb_elem_per_page;


    $request = "SELECT * FROM Movies LIMIT $begin,$nb_elem_per_page";
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
            <article class="art-mov" value="<?php echo $r->title ?>">
                <div class="main-title">
                    <?= $r->title?>
                </div>
                <div class="main-poster"
                     style="background-image: url('<?php echo($GLOBALS['POSTERS'].$r->poster)?>')">
                </div>

<!--                <div class="main-resume">-->
<!--                    --><?//= $r->synopsis ?>
<!--                </div>-->
            </article>
        <?php endforeach; ?>
        </div>
<!--    <div class="mov-all">-->
<!--        tostestas-->
<!--    </div>-->
<?php
}
