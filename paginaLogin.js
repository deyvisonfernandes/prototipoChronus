function abrirCadastro(cadastroContainer, loginContainer){
    document.getElementById(cadastroContainer).style.display = "flex";
    document.getElementById(loginContainer).style.display = "none";

}

function cancelarCadastro(cadastroContainer, loginContainer){
    document.getElementById(cadastroContainer).style.display = "none";
    document.getElementById(loginContainer).style.display = "flex";

}
