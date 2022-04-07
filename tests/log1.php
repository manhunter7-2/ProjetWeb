<?php

namespace tests;

use PDO;

class log1{
    public function sql_log(){
        $db_serv = "localhost";
        $db_usr = "root";
        $db_pwd = "";
        $db_name = "logins";

        try{
            $pdo = new PDO("mysql:host=".$db_serv.";dbname=".$db_name,$db_usr, $db_pwd);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (\PDOException $e){
            die("ERROR : ".$e->getMessage());
        }

        $usr = $pwd = $conf_pwd = $usr_err = $pwd_err = $conf_pwd_err = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST"){

            if (empty(trim($_POST["usr"]))){
                $usr_err = "Erreur, veuillez saisir un nom d'utilisateur";
            }
            else{
                $usr = htmlspecialchars($usr);
                $rqst = "SELECT id FROM logins WHERE nickname = :usr";

                if ($var = $pdo->prepare($rqst)){
                    $var->bindParam("usr", $param_usr);
                    $param_usr = trim($_POST["usr"]);

                    if ($var->execute()){
                        if($var->rowCount() == 1){
                            $usr_err = "Ce nom est déjà pris";
                        }else{
                            $usr = trim($_POST["usr"]);
                        }
                    }else{
                        echo("Il y a eu un problème (ERR_LOG_1)");
                    }

                    unset($var);
                }
            }

        }
        if (empty(trim($_POST["pwd"]))){
            $pwd_err = "Veuillez entrer un mot de passe";
        }elseif(strlen(trim($_POST["pwd"])) < 6){
            $pwd_err = "Le mot de passe doit être d'au moins 6 caractères";
        }else{
            $pwd = trim($_POST["pwd"]);
        }
        if (empty(trim($_POST["conf_pwd"]))){
            $conf_pwd_err = "Veuillez confirmer le mot de passe";
        }else{
            $conf_pwd = trim($_POST["conf_pwd"]);
            if (empty($pwd_err) && ($pwd != $conf_pwd)){
                $conf_pwd_err = "Les mots de passe ne correspondent pas";
            }
        }
        if(empty($usr_err) && empty($pwd_err) && empty($conf_pwd_err)){
            $rqst_ttl = "INSERT INTO logins (nickname, password) VALUES (:usr, :pwd)";
            if ($rqst_ins = $pdo->prepare($rqst_ttl)){

            }
        }
    }
}
