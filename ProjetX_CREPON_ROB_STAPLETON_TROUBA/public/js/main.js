const buttonConnexion = document.getElementById("b_connexion");
const backgroundPopup = document.getElementById("background_popup");
const buttonClose = document.getElementById("button_close");
//const buttonInscription = document.getElementById("b_creer_compte")
//const backgroundPopupInscription = document.getElementById("background_popup_inscription");
//const buttonCloseInscription = document.getElementById("button_close_inscription");

buttonConnexion.addEventListener("click", () =>{
    backgroundPopup.style.display = "flex";
});

buttonClose.addEventListener("click", () =>{
    backgroundPopup.style.display = "none";
});

/*buttonInscription.addEventListener("click", () =>{
    backgroundPopupInscription.style.display = "flex";
});*/

/*buttonCloseInscription.addEventListener("click", () =>{
    backgroundPopupInscription.style.display = "none";
});*/
