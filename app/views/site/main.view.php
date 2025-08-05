

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chronus</title>
    <link rel="stylesheet" href="/public/css/mainStyles.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alata&family=Bebas+Neue&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Arimo:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="navbar">
        <div class="botaoAbrirNavbar"><button type="button" onclick="abrirNavbar('idNavbarInterativa')">
            <img src="/public/assets/tresRetas.png" alt=""></button>
        </div>
        
        <div class="logo"><img src="/public/assets/CHRONUS.png" alt=""></div>
        <div class="nivel"><p>NÍVEL BRONZE</p></div>
    </nav>
    <section class="informacao">
        <?php $usuario = \App\Core\App::get('database')->selectOne('usuarios', $_SESSION['id']); ?>
        <p>Olá, <?= $usuario->nome?> </p>
        <button type="button" onclick="abrirPopup('idFundo', 'idPopupAdicionar')">Adicionar</button>
        <p>Tempo na Semana: 23:00:00</p>
    </section>

    <section class="container-Cartoes">
        <?php foreach($assuntos as $assunto): ?>
        <?php $usuario = \App\Core\App::get('database')->selectOne('usuarios', $_SESSION['id']); ?>
        <div class="cartao">
            <div class="info-Cartao">
                <div class="titulo-Cartao"> <?= $assunto->titulo ?>
                </div>
                <div class="botoes-Cartao">
                    <button onclick="abrirPopup('idFundo', 'idPopup<?= $assunto->id ?>')">+</button>
                </div>
            </div>
        </div>
        <?php endforeach ?>

       
    </section>

    <section class="fundoPopup" id="idFundo">
    </section>
<!--     -------------------POPUP---------------------                -->
<!--     -------------------POPUP---------------------                -->
<!--     -------------------POPUP---------------------                -->
    <?php foreach($assuntos as $assunto): ?>
    <section class="popup" id="idPopup<?= $assunto->id ?>">
        <div class="cabecalho-Popup">
            <?php $usuario = \App\Core\App::get('database')->selectOne('usuarios', $_SESSION['id']); ?>
            <div class="titulo-Popup"><?= $assunto->titulo ?></div>
            <div class="botaoFechar-Popup"> 
                <button type="button" onclick="fecharPopup('idFundo', 'idPopup<?= $assunto->id ?>'); pausa(<?= $assunto->id ?>);">X</button>
            </div>
        </div>

        <div class="notasPopup">
            <input type="text">
        </div>

        <div class="container-cronometroPopup">
            <div class="botoesCronometro"> 
                <form action="salvar-tempo" method="POST">
                <button id="botaoIniciar" onclick="inicializador(<?= $assunto->id ?>)">INICIAR</button>
                <button id="botaoPausar" onclick="pausa(<?= $assunto->id ?>); salvarTempo(<?= $assunto->id ?>)">PAUSAR</button>
            </div>
            <div class="cronometroPopup" id="cronometroPopup<?= $assunto->id ?>"><?= $assunto->tempo ?></div>
            </form>
        </div>
    </section>
<?php endforeach ?>

<!--     -------------------POPUP---------------------                -->
<!--     -------------------POPUP---------------------                -->
<!--     -------------------POPUP---------------------                -->


<!--     -------------------NAVBAR---------------------                -->
<!--     -------------------NAVBAR---------------------                -->
<!--     -------------------NAVBAR---------------------                -->

<section class="navbarInterativa" id="idNavbarInterativa">
    <div class="cabecalhoNavbar">
        <button type="button" onclick="fecharNavbar('idNavbarInterativa')">X</button>
        <img src="/public/assets/CHRONUS.png" alt="">
    </div>
    <div class="botoesNavbar">
            <button><a href="/app/views/site/main.html">Início</a></button>
            <button type="button" onclick="abrirPopup('idFundo', 'alterarConta-container' )">Conta</button>
            <form action="/logout" method="POST">
            <button type="submit">Sair</button>
        </form>
        </div>

</section>
<!--     -------------------NAVBAR---------------------                -->
<!--     -------------------NAVBAR---------------------                -->
<!--     -------------------NAVBAR---------------------                -->


<!--     -------------------POPUP ADICIONAR---------------------                -->
<!--     -------------------POPUP ADICIONAR---------------------                -->
<!--     -------------------POPUP ADICIONAR---------------------                -->

<section class="container-Adicionar" id="idPopupAdicionar">
    <div class="cabecalho-Adicionar">Adicionar Assunto:</div>
    <form action="store" method="POST">
    <div class="input-Adicionar"><input type="text" name="titulo"></div>
    <div class="botoes-Adicionar">
        <button type="submit">Salvar</button>
        </form>
        <button type="button" onclick="fecharPopup('idFundo', 'idPopupAdicionar')">Cancelar</button>
    </div>


</section>
<!--     -------------------POPUP ADICIONAR---------------------                -->
<!--     -------------------POPUP ADICIONAR---------------------                -->
<!--     -------------------POPUP ADICIONAR---------------------                -->

<!--     -------------------POPUP ALTERAR CONTA---------------------                -->
<!--     -------------------POPUP ALTERAR CONTA---------------------                -->
<!--     -------------------POPUP ALTERAR CONTA---------------------                -->



 <section id="alterarConta-container">
    <div id="titulo-alterar">
            <h1>Alterar Cadastro</h1>
        </div>
        <div id="alteracao-container">
            <div id="altera-nome">
                <p>Nome</p>
            <input type="text">
            </div>
            <div id="altera-email">
                <p>Email</p>
            <input type="text">
            </div>
            
            <div id="altera-senha">
                <p>Senha</p>
            <input type="text">
            </div>
        </div>
        <div class="botoes-alterar">
        <button><a href="/site/main.html">ALTERAR</a></button>
        <button type="button" onclick="fecharPopup('idFundo', 'alterarConta-container' )">CANCELAR</button>
        </div>

    </section>



</body>
<script src="/public/js/cliques.js"></script>
<script src="/public/js/cronometro.js"></script>

</html>