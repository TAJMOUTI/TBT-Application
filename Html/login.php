<!--
    name:           TBT Application
    author:			Nizar TAJMOUTI
    creation:       17/07/2023
-->

<?php 
/* 
vérifie si la variable de session 'mail' est définie. Si oui, l'utilisateur est déjà connecté et a accès à la page d'accueil ('home.php'). = redirection vers la page d'accueil.

Si la variable de session 'mail' n'est pas définie, cela signifie que l'utilisateur n'est pas encore connecté et doit être redirigé vers la page de connexion.
 
Ainsi, ce code sert à protéger l'accès à la page d'accueil et à empêcher les utilisateurs non autorisés d'y accéder directement sans connexion.
*/
if (!isset($_SESSION)) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}
if(isset($_SESSION['mail'])){
	header('Location: ../Administration/');
}
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <title>TBT - Thierry Breton Traiteur App</title>
        <link rel="stylesheet" type="text/css" href="../css/login.css">
        <link rel="stylesheet" type="text/css" href="../css/lib/toastr.css"/>
        <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
	    <link rel="stylesheet" type="text/css" href="../css/lib/toastr.css"/>
        <script src="../lib/toastr.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <meta name="description" content="Page de connexion de l'application TBT App">
        <meta name="keywords" content="tbt, tbt app, TBT, TBT App">
        <link rel="icon" href="" type="image/x-icon">
    </head>
    <body>
        <div class="main">
            <div class="login">
                <label class="titre">Connexion</label>
                <p class="soustitre">TBT App</p>
                <input class="champMail" type="text" name="mail" id="mail" placeholder="Email" required="">
				<input class="champMdp" type="password" name="mdp" id="mdp"  placeholder="Mot de passe" required="">
				<button id="btnConnexion" class="btnConnexion">Connexion</button>
                <div id="popupErreur"></div>
            </div>
            <div class="popupLogin"></div>
        </div>
        <script type="text/javascript" src="../js/login.js"></script>
    </body>
</html>