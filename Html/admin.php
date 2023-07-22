<!--
    name:           TBT Application
    author:			Nizar TAJMOUTI
    creation:       17/07/2023
-->
<?php
if (!isset($_SESSION)) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}    if(!isset($_SESSION['mail']) || $_SESSION['role'] != 'admin'){
        header('Location: ../Connexion/');
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>TBT - Thierry Breton Traiteur App</title>
        <link rel="stylesheet" type="text/css" href="../css/admin/admin.css">
        <link rel="stylesheet" type="text/css" href="../css/admin/sideBar.css">
        <link rel="stylesheet" type="text/css" href="../css/admin/table.css">
        <link rel="stylesheet" type="text/css" href="../css/lib/toastr.css">
        <link rel="stylesheet" type="text/css" href="../css/lib/semantic.css">
        <link rel="stylesheet" href="../lib/semantic.js" />
        <link rel="stylesheet" href="../lib/toastr.js" />
        <meta name="description" content="Page d'administration de l'application TBT App">
        <meta name="keywords" content="tbt, tbt app, TBT, TBT App">
        <link rel="icon" href="" type="image/x-icon">
	    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="container">
        <!-- SideBar Responsive -->
            <div class="sideBar">
                    <nav>
                        <ul class="mcd-menu">
                            <li>
                                <a href="">
                                    <i class="fa fa-home"></i>
                                    <strong>Home</strong>
                                    <small>sweet home</small>
                                </a>
                            </li>
                            <li>
                                <a href="" class="active">
                                    <i class="fa fa-edit"></i>
                                    <strong>About us</strong>
                                    <small>sweet home</small>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="fa fa-gift"></i>
                                    <strong>Features</strong>
                                    <small>sweet home</small>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="fa fa-globe"></i>
                                    <strong>News</strong>
                                    <small>sweet home</small>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="fa fa-comments-o"></i>
                                    <strong>Blog</strong>
                                    <small>what they say</small>
                                </a>
                                <ul>
                                    <li><a href="#"><i class="fa fa-globe"></i>Mission</a></li>
                                    <li>
                                        <a href="#"><i class="fa fa-group"></i>Our Team</a>
                                        <ul>
                                            <li><a href="#"><i class="fa fa-female"></i>Leyla Sparks</a></li>
                                            <li>
                                                <a href="#"><i class="fa fa-male"></i>Gleb Ismailov</a>
                                                <ul>
                                                    <li><a href="#"><i class="fa fa-leaf"></i>About</a></li>
                                                    <li><a href="#"><i class="fa fa-tasks"></i>Skills</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#"><i class="fa fa-female"></i>Viktoria Gibbers</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#"><i class="fa fa-trophy"></i>Rewards</a></li>
                                    <li><a href="#"><i class="fa fa-certificate"></i>Certificates</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="">
                                    <i class="fa fa-picture-o"></i>
                                    <strong>Portfolio</strong>
                                    <small>sweet home</small>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="fa fa-envelope-o"></i>
                                    <strong>Contacts</strong>
                                    <small>drop a line</small>
                                </a>
                            </li>
                            <li class="float">
                                <a class="search">
                                    <input type="text" value="search ...">
                                    <button><i class="fa fa-search"></i></button>
                                </a>
                                <a href="" class="search-mobile">
                                    <i class="fa fa-search"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
            </div>
        <!-- Tableau -->
            <div class="container2">
                <div class="main_page">
                    <!-- Overview class -->
                    <div class="container3">
                        <div class="box_main" id="box_main">
                            <div class="text_h1" id="text_h1">
                                <h1 class="h1_box">Utilisateurs</h1>
                                <a href="./../AdminEdit/"><button>+ Nouvel utilisateur</button></a>
                            </div>

                            <div class="bandeau"> 
                                <table id="tableau2" class="backgroundb table tableParam">
                                    <tr class="tr1">
                                        <td id="mail_table" class="no_padding center">mail</td>
                                        <td id="permission_table" class="no_padding center">Permission</td>
                                        <td id="action_table" class="no_padding center">Actions</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="bandeau2">
                                <table id="tableau" class="table tableParam">
                                    <tbody id="ligneReference">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <script type="text/javascript" src="../Js/admin.js"></script>
    </body>
</html>