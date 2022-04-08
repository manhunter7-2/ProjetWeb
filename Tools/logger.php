<?php
namespace Tools;

use PDO;
use PDOException;

class logger
{
    public function loginParams():array
    {
        require "db_credentials.php";

        try {
            $pdo = new PDO("mysql:host=" . $GLOBALS['DB_SERV'] . ";dbname=" . $GLOBALS['DB_NAME'], $GLOBALS['DB_USER'], $GLOBALS['DB_PWD']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch
        (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }

        session_start();
        if (isset($_SESSION["logged"]) && $_SESSION["logged"]) {
            header("location: mainPage.php");
            exit;
        }

        $usr = $pwd = $usr_err = $pwd_err = $log_err = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (empty(trim($_POST["usr"]))) {
                $usr_err = "Veuillez saisir un nom d'utilisateur";
            } else {
                $usr = trim($_POST["usr"]);
            }

            if (empty(trim($_POST["pwd"]))) {
                $pwd_err = "Veuillez saisir un mot de passe";
            } else {
                $pwd = trim($_POST["pwd"]);
            }

            if (empty($usr_err) && empty($pwd_err)) {
                $rqst = "SELECT id, nickname, password FROM logins WHERE nickname = :usr";
                if ($rqst2 = $pdo->prepare($rqst)) {
                    $rqst2->bindParam(":usr", $param_usr);
                    $param_usr = trim($_POST["usr"]);
                    if ($rqst2->execute()) {
                        if ($rqst2->rowCount() == 1) {
                            if ($col = $rqst2->fetch()) {
                                $id = $col["id"];
                                $usr = $col["nickname"];
                                $hash_pwd = $col["password"];
                                if (password_verify($pwd, $hash_pwd)) {
                                    session_start();
                                    $_SESSION["logged"] = true;
                                    $_SESSION["id"] = $id;
                                    $_SESSION["usr"] = $usr;
                                    header("location: mainPage.php");
                                } else {
                                    $log_err = "Mot de passe ou nom d'utilisateur incorrect";
                                }
                            }
                        } else {
                            $log_err = "Mot de passe ou nom d'utilisateur incorrect";
                        }
                    } else {
                        echo("ERREUR : login failed (LOG_ERR_1)");
                    }
                    unset($rqst2);
                }
            }
            unset($pdo);
        }
        return array(
            'pwd' => $pwd,
            'usr' => $usr,
            'usr_err' => $usr_err,
            'pwd_err' => $pwd_err,
            'log_err' => $log_err,
        );
    }

    public function generateLogin(){
        $array = $this->loginParams(); ?>
        <div class="wrapper">
            <h2>Login</h2>
            <p>Please fill in your credentials to login.</p>

            <?php
            if(!empty($array['log_err'])){
                echo '<div class="alert alert-danger">' . $array['log_err'] . '</div>';
            }
            ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label>Nom d'utilisateur</label>
                    <input type="text" name="usr" class="form-control <?php echo (!empty($array['usr_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $array['usr']; ?>">
                    <span class="invalid-feedback"><?php echo $array['usr_err']; ?></span>
                </div>
                <div class="form-group">
                    <label>Mot de passse</label>
                    <input type="password" name="pwd" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $array['pwd_err']; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Login">
                </div>
                <p>Vous n'avez pas de compte ?<a href="registerPage.php">S'inscrire</a>.</p>
            </form>
        </div>
  <?php  }
} ?>
