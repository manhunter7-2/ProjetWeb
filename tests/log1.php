<?php require "../Tools/db_credentials.php";

function config()
{
    try {
        $pdo = new PDO("mysql:host=" . $GLOBALS['DB_SERV'] . ";dbname=" . $GLOBALS['DB_NAME'], $GLOBALS['DB_USER'], $GLOBALS['DB_PWD']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch
    (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
    return $pdo;
}