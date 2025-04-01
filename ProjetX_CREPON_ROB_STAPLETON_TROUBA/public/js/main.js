const buttonConnexion = document.getElementById("b_connexion");
const backgroundPopup = document.getElementById("background_popup");
const backgroundPopupInscription = document.getElementById("background_popup_inscription");
const buttonClose = document.getElementById("button_close");
const buttonCloseInscription = document.getElementById("button_close_inscription");
const buttonSignup = document.getElementById("b_creer_compte")

buttonConnexion.addEventListener("click", () =>{
    backgroundPopupInscription.style.display = "flex";
});

buttonSignup.addEventListener("click", () =>{
    backgroundPopup.style.display = "flex";
});

buttonClose.addEventListener("click", () =>{
    backgroundPopup.style.display = "none";
});

buttonCloseInscription.addEventListener("click", () =>{
    backgroundPopupInscription.style.display = "none";
});
