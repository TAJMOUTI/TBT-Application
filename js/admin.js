/* 
name:           TBT Application
author:			Nizar TAJMOUTI
creation:       21/07/2023
*/

let parentTr;
let menuVisible = false;
$(function() {
    var html_to_add = "";
    $.ajax({
        url: '../data/getUsers',
        type: 'POST',
        dataType: 'json',
        success: function(data) {
            data.forEach(element => {
                html_to_add += '<tr class="tr1" id='+element.mail+'><td id="mail_table" class="px20_padding_left left">'+element.mail+' '+element.nom+'</td><td id="mail_table">'+element.mail+'</td><td id="permission_table"><span class='+element.role+'>&nbsp;'+roleShow(element.role)+'&nbsp;</span></td><td id="action_table" class="img_showMore"><div style="display: flex;margin: auto;width: 75%;justify-content: space-evenly;"><a href="#" class="delete"><img src="../Images/corbeille.png" style="width: 20px;"></a><br><a href="#" class="edit"><img src="../Images/edit.png" style="width: 20px;"></a></div></td></tr>';
            });
            $('tbody#ligneReference').append(html_to_add);
        }
    });
  });

function roleShow(role){
    switch(role){
        case "admin":
            return "Administrateur";
        case "utilisateur":
            return "Utilisateur";
        case "gestionnaire":
            return "Gestionnaire";
        default:
            return "Inconnu";
    }

}

// On click on href with delete class
$(document).on('click', '.delete', function(e){
    e.preventDefault(); // Empêche le navigateur de suivre le lien
    
    // Get the parent tr element containing the clicked edit link
    const parentTr = $(this).closest('tr');
    
    // Get the cells in the same row as the clicked element
    const cells = parentTr.find('td');
    
    // Get the mail value from the second cell (index 1)
    const mail = cells[1].innerText;
    deleteUser(mail); // Appeler la fonction pour supprimer l'utilisateur
  });
  
  
  function deleteUser(mail) {   
    $.ajax({
      url: '../data/deleteUser',
      type: 'POST',
      data: {mail: mail}, // Envoyer l'mail de l'utilisateur à supprimer au serveur
      success: function(response) {
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
            "timeOut": "3000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
          }
          toastr["success"]("L'utilisateur a bien été supprimé !");
        // Si la suppression a réussi, supprimer la ligne du tableau
        $('#'+mail).remove();
        $(".menu").remove();
        menuVisible = false;
      }
    });
  }
  
  $(document).on('click', '.edit', function(e){
    e.preventDefault(); // Prevents the browser from following the link
    
    // Get the parent tr element containing the clicked edit link
    const parentTr = $(this).closest('tr');
    
    // Get the cells in the same row as the clicked element
    const cells = parentTr.find('td');
    
    // Get the mail value from the second cell (index 1)
    const mail = cells[1].innerText;
    
    // Call the getDataUser() function with the mail value as an argument
    getDataUser(mail);
});


function getDataUser(mail){
    $.ajax({
        url: '../data/getDataUser',
        type: 'POST',
        data: {mail: mail}, // Envoyer l'mail de l'utilisateur à supprimer au serveur
        success: function(data) {
            console.log(data)
            window.location = data;
        }

    });
}