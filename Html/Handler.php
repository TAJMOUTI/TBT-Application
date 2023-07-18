<?php

class Handler{
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
            default:
                $result = "Erreur:GDMx00 Fonction non reconnue";
                break; 
        }
    }
    
    function connexion() {
        if (isset($_POST['mail']) && isset($_POST['mdp'])) {
            $mail = $_POST['mail'];
            $mdp = $_POST['mdp'];
            $dbcontroller = new DBController();
            $parammail = mysqli_escape_string($dbcontroller->getConn(), $mail);
            $stmt = mysqli_prepare($dbcontroller->getConn(), "SELECT user.nom, user.mail,role.role FROM user INNER JOIN role ON user.role = role.id WHERE mail=?");
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
}