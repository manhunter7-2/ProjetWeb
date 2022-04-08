<?php

namespace Tools;

use PDO;
use PDOException;

require "../Tools/db_credentials.php";

class register{

    public function setRegisterParams():array
    {
        /* Attempt to connect to MySQL database */
        try {
            $pdo = new PDO("mysql:host=" . $GLOBALS['DB_SERV'] . ";dbname=" . $GLOBALS['DB_NAME'], $GLOBALS['DB_USER'], $GLOBALS['DB_PWD']);
            // Set the PDO error mode to exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("ERROR: Could not connect. " . $e->getMessage());
        }
        $usr = $pwd = $conf_pwd = $usr_err = $pwd_err = $conf_pwd_err = "";

// Processing form data when form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Validate username
            if (empty(trim($_POST["usr"]))) {
                $username_err = "ERREUR : Veuillez entrer un nom d'utilisateur ";
            }else {
                // Prepare a select statement
                $rqst = "SELECT id FROM logins WHERE nickname = :usr";

                if ($sql_rqst = $pdo->prepare($rqst)) {
                    // Bind variables to the prepared statement as parameters
                    $sql_rqst->bindParam(":usr", $param_usr);

                    // Set parameters
                    $param_usr = trim($_POST["usr"]);

                    // Attempt to execute the prepared statement
                    if ($sql_rqst->execute()) {
                        if ($sql_rqst->rowCount() == 1) {
                            $username_err = "Ce nom d'utilisateur existe déjà, veuillez en choisir un autre";
                        } else {
                            $usr = trim($_POST["usr"]);
                        }
                    } else {
                        echo "ERREUR : Registration failed (REG_ERR_1)";
                    }

                    // Close statement
                    unset($sql_rqst);
                }
            }

            // Validate password
            if (empty(trim($_POST["pwd"]))) {
                $pwd_err = "Veuillez entrer un mot de passe";
            } elseif (strlen(trim($_POST["pwd"])) < 4) {
                $pwd_err = "Le mot de passe doit faire au moins 4 caractères";
            } else {
                $pwd = trim($_POST["pwd"]);
            }

            // Validate confirm password
            if (empty(trim($_POST["conf_pwd"]))) {
                $conf_pwd_err = "Veuillez cofirmer votre mot de passe";
            } else {
                $conf_pwd = trim($_POST["conf_pwd"]);
                if (empty($pwd_err) && ($pwd != $conf_pwd)) {
                    $conf_pwd_err = "Les mots de passe ne correspondent pas";
                }
            }

            // Check input errors before inserting in database
            if (empty($usr_err) && empty($pwd_err) && empty($conf_pwd_err)) {

                // Prepare an insert statement
                $sql = "INSERT INTO logins (nickname, password) VALUES (:usr, :pwd)";

                if ($rqst = $pdo->prepare($sql)) {
                    // Bind variables to the prepared statement as parameters
                    $rqst->bindParam(":usr", $param_usr);
                    $rqst->bindParam(":pwd", $param_pwd);

                    // Set parameters
                    $param_usr = $usr;
                    $param_pwd = password_hash($pwd, PASSWORD_DEFAULT); // Creates a password hash

                    // Attempt to execute the prepared statement
                    if ($rqst->execute()) {
                        // Redirect to login page
                        header("location: login.php");
                    } else {
                        echo "Oops! Something went wrong. Please try again later.";
                    }

                    // Close statement
                    unset($rqst);
                }
            }

            // Close connection
            unset($pdo);
        }
        return array(
            'pwd' => $pwd,
            'usr' => $usr,
            'conf_pwd' => $conf_pwd,
            'conf_pwd_err' => $conf_pwd_err,
            'usr_err' => $usr_err,
            'pwd_err' => $pwd_err
        );
    }


    public function generateRegister(){
        $array = $this->setRegisterParams();
        ?>

        <div class="wrapper">
            <h2>Sign Up</h2>
            <p>Please fill this form to create an account.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label>Nom d'utilisateur</label>
                    <input type="text" name="usr" class="form-control <?php echo (!empty($array['usr_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $array['usr']; ?>">
                    <span class="invalid-feedback"><?php echo $array['usr_err']; ?></span>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="pwd" class="form-control <?php echo (!empty($array['pwd_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $array['pwd']; ?>">
                    <span class="invalid-feedback"><?php echo $array['pwd_err']; ?></span>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="conf_pwd" class="form-control <?php echo (!empty($array['conf_pwd_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $array['conf_pwd']; ?>">
                    <span class="invalid-feedback"><?php echo $array['conf_pwd_err']; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <input type="reset" class="btn btn-secondary ml-2" value="Reset">
                </div>
                <p>Vous avez déjà un compte ?<a href="login.php">Se connecter</a>.</p>
            </form>
        </div>

    <?php }
} ?>