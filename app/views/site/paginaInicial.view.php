<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chronus</title>
    <link rel="stylesheet" href="/public/css/paginaInicial.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alata&family=Bebas+Neue&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
</head>
<body>
    <section class="logo-container">
        <img src="/public/assets/CHRONUS.png" alt="">
    </section>

    <section id="login-container">
        <form action="login" method="POST">
        <div id="titulo-login">
            <h1>Login</h1>
        </div>
        <div id="input-container">
            <div id="nome-usuario">
                <p>Email do Usuário</p>
            <input type="text" name="email">
            </div>
            
            <div id="senha-usuario">
                <p>Senha</p>
            <input type="text" name="senha">
            </div>
        </div>
        <div class="mensagem-erro-Login">
            <p><?php
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                if(isset($_SESSION['mensagem-erro'])){
                     echo($_SESSION['mensagem-erro']);
                }
                unset($_SESSION['mensagem-erro']);
                ?>
            </p>
        </div>
        <div class="button-container">
        <button type="submit">ENTRAR</button>

</form>
        <button type="button" onclick="abrirCadastro('cadastro-container', 'login-container')">CADASTRE-SE</button>
        </div>
    </section>

    <section id="cadastro-container">
        <div id="input-container">
            <form action="cadastro" method="POST">
            <div id="nome-usuario">
                <p>Nome</p>
            <input type="text" name="nome">
            </div>
            <div id="email-usuario">
                <p>Email</p>
            <input type="text" name="email">
            </div>
            
            <div id="senha-usuario">
                <p>Senha</p>
            <input type="text" name="senha">
            </div>
        </div>
        <div class="button-container">
        <button type="submit">CADASTRAR</button>
        <button type="button" onclick="cancelarCadastro('cadastro-container', 'login-container')">CANCELAR</button>
        </div>
        </form>

    </section>
</body>
<script src="/public/js/paginaLogin.js"></script>
</html>