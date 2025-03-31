const buttonConnexion = document.getElementById("b_connexion");
const backgroundPopup = document.getElementById("background_popup");
const buttonClose = document.getElementById("button_close");

buttonConnexion.addEventListener("click", () =>{
    backgroundPopup.style.display = "flex";
});

buttonClose.addEventListener("click", () =>{
    backgroundPopup.style.display = "none";
});