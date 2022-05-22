<?php

namespace Tools;

use PDO;
use PDOException;

require "../Tools/db_credentials.php";

class register{

    public function setRegisterParams():array
    {
        $usr = $mail = $usr_err = $mail_err = " ";

// Processing form data when form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Validate username
            if (empty(trim($_POST["usr"]))) {
                $username_err = "ERREUR : Veuillez entrer un nom d'utilisateur ";
            }else {
                // Prepare a select statement
                $rqst = "SELECT id FROM logins WHERE nickname = :usr";
                $pdo = (new dbConnect())->config();

                if ($sql_rqst = $pdo->prepare($rqst)) {
                    // Bind variables to the prepared statement as parameters
                    $sql_rqst->bindParam(":usr", $param_usr);

                    // Set parameters
                    $param_usr = trim($_POST["usr"]);

                    // Attempt to execute the prepared statement
                    if ($sql_rqst->execute()) {
                        if ($sql_rqst->rowCount() == 1) {
                            $usr_err = "Ce nom d'utilisateur existe déjà, veuillez en choisir un autre";
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
            if (empty(trim($_POST["mail"]))) {
                $pwd_err = "Veuillez entrer une adresse mail";
            }else {
                $mail = trim($_POST["mail"]);
            }

            // Check input errors before inserting in database
            if (empty($usr_err) && empty($mail_err)) {

                // Prepare an insert statement
                $sql = "INSERT INTO logins (nickname, email) VALUES (:usr, :mail)";

                if ($rqst = $pdo->prepare($sql)) {
                    // Bind variables to the prepared statement as parameters
                    $rqst->bindParam(":usr", $param_usr);
                    $rqst->bindParam(":mail", $param_mail);

                    // Set parameters
                    $param_usr = $usr;
                    $param_mail = $mail;

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
            'mail' => $mail,
            'usr' => $usr,
            'usr_err' => $usr_err,
            'mail_err' => $mail_err
        );
    }


    public function generateRegister(){
        $array = $this->setRegisterParams();
        ?>

        <div class="wrapper">
            <h2 id="regTitle">S'inscrire</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="login-forms">
                    <label>Nom d'utilisateur</label>
                    <input type="text" name="usr" class="form-control <?php echo (!empty($array['usr_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $array['usr']; ?>">
                    <span class="invalid-feedback"><?php echo $array['usr_err']; ?></span>
                </div>
                <div class="login-forms">
                    <label>Adresse mail</label>
                    <input type="text" name="mail" class="form-control <?php echo (!empty($array['mail_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $array['mail']; ?>">
                    <span class="invalid-feedback"><?php echo $array['mail_err']; ?></span>
                </div>
                <div id="regTitle">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <input type="reset" class="btn btn-secondary ml-2" value="Reset">
                </div>
                <p id="loginMainTitle">Vous avez déjà un compte ?<a href="login.php">Se connecter</a>.</p>
            </form>
        </div>

    <?php }
} ?>