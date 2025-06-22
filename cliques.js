function abrirPopup(idFundo, idPopup ){
    document.getElementById(idFundo).style.display = "flex";
    document.getElementById(idPopup).style.display = "flex";
}

function fecharPopup(idFundo, idPopup){
    document.getElementById(idFundo).style.display = "none";
    document.getElementById(idPopup).style.display ="none";
}

function abrirNavbar(idNavbarInterativa){
    document.getElementById(idNavbarInterativa).style.display = "flex";
}
function fecharNavbar(idNavbarInterativa){
    document.getElementById(idNavbarInterativa).style.display = "none";
}
