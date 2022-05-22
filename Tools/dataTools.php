<?php

function dataTools(){
        $base_name = "movies";
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

        $request = "SELECT * FROM movies";
        $rqst = $db->prepare($request);
        $rqst->execute() or die(var_dump($rqst->errorInfo()));
        $result = $rqst->fetchAll(PDO::FETCH_OBJ);

        foreach ($result as $r): ?>
            <li><?= $r->title ?> </li>
        <?php endforeach;
        echo ("Bite");
}
