/*
    name:           TBT Application
    author:			Nizar TAJMOUTI
    creation:       17/07/2023
*/

/**
 * @function :ready
 * Fonction au démarrage de l'application
 */

$(document).ready(function() {
    /**
     * Connexion à l'application par l'utilisateur
     */
     
    $("#btnConnexion").click(function() {

        $.ajax({
            cache: false,
            url: "./data/connexion",
            type: "POST",
            async: false,
            data: ({
                mail: $("#mail").val(),
                mdp: $("#mdp").val()
            }),
            success: function (response, status) {
                console.log(21, response);
                console.log("mail:", $("#mail").val());
                console.log("mdp:", $("#mdp").val());
                switch (response) {
                    case "Réussite : Connexion accordée.":
                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-bottom-center",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "1000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                            }
                        toastr.options.onHidden = function() { document.location.href = "../Accueil/"; }
                        toastr["success"]("Connexion en cours ...");
                        console.log(30, "OK");
                        console.log(57,$response);
                        break;
                    case "Erreur : Utilisateur refusée.":
                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-bottom-center",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "2000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                            }
                        toastr["error"]("Utilisateur non autorisé.");
                        console.log(78,$response);

                        break;

                    case "Erreur : Connexion refusée.":
                        console.log(34, "OK");
                        $("#afficherErreur").show();
                        $("#afficherErreur").html("Vous ne possédez pas les droits requis.");
                        console.log(86,$response);
                        break;
                    case "Erreur : mail et/ou mot de passe invalide.":
                        console.log(39, "OK");
                        $("#afficherErreur").show();
                        $("#afficherErreur").html("L'mail et/ou le mot de passe sont incorrects.");
                        console.log(92,$response);
                        break;
                    case "Erreur : Il manque un mail ou un mot de passe.":
                        console.log(44, "OK");
                        $("#afficherErreur").show();
                        $("#afficherErreur").html("L'mail et/ou le mot de passe sont manquants.");
                        console.log(98,$response);
                        break;
                    default:
                        break;
                }
            },
            error: function (response, status) {
                console.log(50, response);
                console.log(51, status);
            }
        });
    });

    /**
     * Test si l'utilisateur a pressé la touche entrée lors de la connexion ARCA
     */
    $("body").keypress(function (event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            $("#btnConnexion").click();
        }
    });

    /**
     * Test si l'utilisateur a demander à garder son identifiant et son mot de passe en mémoire
     */
    // if (getCookie("ffc52ae69d8b54") && getCookie("ffc2ee6dcd8b54")) {
    //     $("#mail").val(CryptoJS.AES.decrypt(getCookie("ffc52ae69d8b54"), "ctrlAccesAA").toString(CryptoJS.enc.Utf8));
    //     $("#mdp").val(CryptoJS.AES.decrypt(getCookie("ffc2ee6dcd8b54"), "ctrlAccesAA").toString(CryptoJS.enc.Utf8));
    //     $("#souvenir").prop('checked', true);
    // }
});