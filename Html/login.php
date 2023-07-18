<!--
    name:           TBT Application
    author:			Nizar TAJMOUTI
    creation:       17/07/2023
-->
<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>TBT - Thierry Breton Traiteur App</title>
        <link rel="stylesheet" type="text/css" href="login.css">
        <link rel="stylesheet"  href="login.js">
        <meta name="description" content="Page de connexion de l'application TBT App">
        <meta name="keywords" content="tbt, tbt app, TBT, TBT App">
        <link rel="icon" href="" type="image/x-icon">
	    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="main">
            <div class="login">
                <label class="titre">Connexion</label>
                <p class="soustitre">TBT App</p>
                <input class="champMail" type="text" name="mail" id="mail" placeholder="Email" required="">
				<input class="champMdp" type="password" name="mdp" id="mdp"  placeholder="Mot de passe" required="">
				<button id="btnConnexion" class="btnArca">Connexion</button>
                <div id="popupErreur"></div>
            </div>
            <div class="popupLogin"></div>
        </div>
        <script type="text/javascript" src="login.js"></script>
    </body>
</html>