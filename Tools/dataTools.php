<?php

function dataTools(){
        $base_name = "moviesdb";
        $base_host = "127.0.0.1"; //localhost
        $base_port = "3306"; //default SQL port

        $usr = "root";
        $passwd = "";

        //connect
        try{
            $source_name = 'mysql:dbname='.$base_name.';host='.$base_host.';port='.$base_port;
            $db = new PDO($source_name, $usr, $passwd);
        }

        catch(\Exception $e){
            die("ERROR : ".$e->getMessage());
        }

        $request = "SELECT * FROM Movies";
        $rqst = $db->prepare($request);
        $rqst->execute() or die(var_dump($rqst->errorInfo()));
        $result = $rqst->fetchAll(PDO::FETCH_OBJ);

        foreach ($result as $r): ?>
            <article class="art-mov">
                <div class="main-title">
                    <?= $r->title ?>
                </div>
                <div class="main-poster"
                     style="background-image: url('<?php echo($r->poster)?>')">
                </div>
            </article>
        <?php endforeach;
}
