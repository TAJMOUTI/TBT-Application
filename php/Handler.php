<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: text/html; charset=utf-8');
require_once '../Controller/dbcontroller.php';
if (!isset($_SESSION)) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}

class Handler
{
    function HandlerController($type) {
        date_default_timezone_set('Europe/Paris');
        switch ($type) {
            case "connexion":
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $result = $this->connexion();
                }else{
                    $result = "Erreur:GDMx00 Méthode POST attendue";
                }
                break;
            case "verifConnexion":
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $result = $this->verifConnexion();
                }else{
                    $result = "Erreur:GDMx00 Méthode POST attendue";
                }
                break;
            case 'getUsers':
                if($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $result = $this->getUsers();
                }else{
                    $result = "Error";
                }
                break;
            case 'getDataUser':
                if($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $result = $this->getDataUser();
                }else{
                    $result = "Error";
                }
                break;
            case 'deleteUser':
                if($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $result = $this->deleteUser();
                }else{
                    $result = "Error";
                }
                break;
            default:
                $result = "Erreur:GDMx00 Fonction non reconnue";
                break; 
        }
        return $result;
    }
    
    function connexion() {
        if (isset($_POST['mail']) && isset($_POST['mdp'])) {
            $mail = $_POST['mail'];
            $mdp = $_POST['mdp'];
            $dbcontroller = new DBController();
            $parammail = mysqli_escape_string($dbcontroller->getConn(), $mail);
            $stmt = mysqli_prepare($dbcontroller->getConn(), "SELECT user.nom, user.mail, role.role FROM user INNER JOIN role ON user.role = role.id WHERE mail=?");
            mysqli_stmt_bind_param($stmt, 's', $mail);
            mysqli_stmt_execute($stmt);
            $data = mysqli_stmt_get_result($stmt);
            $dbcontroller->closeQuerySQL();
            if ($data) {
                while ($row = $data->fetch_array()) {
                    $usermail = $row['mail'];
                    $userRole = $row['role'];
                    $usernom = $row['nom'];
                }
                if($usermail == $mail && $userRole != null) {
                    session_start(['cookie_lifetime' => 60]);
                    $date = date("Y-m-d");
                    $_SESSION['mail'] = $mail;
                    $_SESSION['nom'] = $usernom;
                    $_SESSION['role'] = $userRole;
                    $_SESSION['mail'] = sha1($mail);
                    $_SESSION['mdp'] = sha1($mdp);
                    $_SESSION['token'] = sha1($mail) . sha1($mdp) . sha1($date);
                    $result = "Réussite : Connexion accordée.";
                }else{
                    $result = "Erreur : Utilisateur refusée.";
                }
            } else {
                $result =  "Erreur : Connexion refusée.";
            }
        } else {
            $result = "Erreur : Il manque un mail ou un mot de passe.";
        }
        return $result;
    }
    
    /**
     * @function verifConnexion
     * Vérifie le token de connexion pour un utilisateur
     * Si le token est faux, l'utilisateur ne peut accéder au page de la session
     */
    function verifConnexion() {
        if (isset($_SESSION['token']) && isset($_SESSION['mail']) && isset($_SESSION['mdp'])) {
            $date = date("Y-m-d");
            $tokenVerif = $_SESSION['mail'] . $_SESSION['mdp'] . sha1($date);
            if ($_SESSION['token'] == $tokenVerif) {
                $result = "Réussite : token valide.";
            } else {
                $result = "Erreur : token invalide.";
            }
        } else {
            $result = "Erreur : token inexistant.";
        }
        return $result;
    }

    function getUsers(){
        $dbcontroller = new DBController();
        $stmt = mysqli_prepare($dbcontroller->getConn(), "SELECT user.mail,user.nom,role.role FROM user INNER JOIN role ON user.role = role.id;");
        $data = $dbcontroller->executeSelectQueryMSQL($stmt);
        $dbcontroller->closeQuerySQL();
        $data = json_encode($data);
        return $data;
    }

    // Function to crypt data. It used to crypt data before pass them into the browser and decrypt them after.
    function getDataUser(){
        $key = random_bytes(32);  // generate a random 256-bit key
        $iv = random_bytes(16);  // generate a random 128-bit IV
        $mail = $_POST['mail'];
        $dbcontroller = new DBController();
        $stmt = mysqli_prepare($dbcontroller->getConn(), "SELECT user.mail AS 'x',user.mail AS 'y',user.premail AS 'z',role.role AS 'r' FROM user INNER JOIN role ON user.role = role.id WHERE mail=?");
        mysqli_stmt_bind_param($stmt, 's', $mail);
        $data = $dbcontroller->executeSelectQueryMSQL($stmt);
        $dbcontroller->closeQuerySQL();
        // Chiffrement des éléments du tableau
        foreach ($data[0] as &$item) {
            $item = openssl_encrypt($item, 'AES-256-CBC', $key, 0, $iv);
        }
        $data = json_encode($data);
        $data = json_decode($data, true);
        $url = "../Html/admin.php?i=".urlencode($data[0]['x'])."&n=".urlencode($data[0]['y'])."&p=".urlencode($data[0]['z'])."&r=".urlencode($data[0]['r'])."&vi=".urlencode(base64_encode($iv))."&ke=".urlencode(base64_encode($key));
        return $url;
    }

    // Function used to delete a user from the database
    function deleteUser(){
        $dbcontroller = new DBController();
        $mail = $_POST['mail'];
        $stmt = mysqli_prepare($dbcontroller->getConn(), "DELETE FROM user WHERE mail=?;");
        mysqli_stmt_bind_param($stmt, 's', $mail);
        $data = $dbcontroller->executeSelectQueryMSQL($stmt);
        $dbcontroller->closeQuerySQL();
        if ($data === false) {
            // La requête SQL a échoué
            $error_message = mysqli_error($conn);
            // Traiter l'erreur ici
        }
    }
}