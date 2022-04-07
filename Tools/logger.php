<?php

namespace Tools;

use PDO;

class logger
{
    public function loginForm(string $act = '/', string $usr=null, string $pwd=null, $msg=null):void{
        if (isset($resp['error'])): ?>
    <div class="error">
        <?php echo $msg ?>
    </div>
    <?php endif ?>

<form method="post"
      action="<?php echo $act ?>"
      target="_blank"
      class="login-form">
    <div>
        <input type="text" class="form-control" id="name" placeholder="Nom d'utilisateur" name ="form-name" value="<?php echo $usr ?>">
    </div>
    <div>
        <input type="text" class="form-control" id="pwd" placeholder="Mot de passe" name="form-pwd" value="<?php echo $pwd ?>">
    </div>
    <button type="submit" class="btn btn-primary" style="margin-top:10px; width: 100%">
        Send
    </button>
</form>
<?php }

    public function login(string $usr, string $pwd): array
    {

//-------------- DATABASE CONNECT --------------------------
        $base_name = "moviesdb";
        $base_host = "127.0.0.1";
        $base_port = "3306";
        $usr = "root";
        $passwd = "";

        try {
            $source_name = 'mysql:dbname=' . $base_name . ';host=' . $base_host . ';port=' . $base_port;
            $db = new PDO($source_name, $usr, $passwd);
        } catch (\Exception $e) {
            die("ERROR : " . $e->getMessage());
        }

        $request = "SELECT * FROM logins";
        $rqst = $db->prepare($request);
        $result = $rqst->fetchAll(PDO::FETCH_OBJ);

        $name_request = "SELECT nickname FROM logins WHERE EXISTS (SELECT nickname FROM logins WHERE nickname= ";
        $pwd_request = "SELECT password FROM logins WHERE EXISTS (SELECT password FROM logins WHERE password= ";
        $end = ")";
//---------------------------------------------------------------

        $error = null;
        $pseudo = null;
        $ok_access = null;
        if (empty($usr)){
            $error = "Veuillez saisir un nom d'utilisateur";
        }
        elseif (empty($pwd)){
            $error = "Veuillez saisir un mot de passe";
        }
        else{
            $usr = htmlspecialchars($usr);
            $pwd = htmlspecialchars($pwd);
            $usr_sql = " '$usr' ";
            $pwd_sql = " '$pwd' ";
            $usr_rqst = $name_request.$usr_sql.$end;
            $pwd_rqst = $pwd_request.$pwd_sql.$end;

            $usr_rqst2 = $db->prepare($usr_rqst);
            $usr_rqst2->execute() or die(var_dump($rqst->errorInfo()));
            $usr_result = $usr_rqst2->fetchAll(PDO::FETCH_OBJ);

            $pwd_rqst2 = $db->prepare(($pwd_rqst));
            $pwd_rqst2->execute() or die(var_dump($rqst->errorInfo()));
            $pwd_result = $pwd_rqst2->fetchAll(PDO::FETCH_OBJ);

            if ($usr_result != true){
                $error = "Veuillez saisir un autre nom d'utilisateur ";
            }
            elseif ($pwd_result != true){
                $error = "Veuillez saisir un autre mot de passe";
            }
            elseif($pwd_result && $usr_result){
                $ok_access = true;
                $pseudo = $usr;
            }
        }
    }
        return array(
                'ok_access' => $ok_access,
                'pseudo' => $pseudo,
            'erreur' => $error
        );
    }

}

?>