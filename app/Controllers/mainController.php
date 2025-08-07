<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class mainController
{
    public function index() {
    session_start();
    if (!isset($_SESSION['id'])) {
        header('Location: /');
        exit;
    }
 $assuntos = App::get('database')->selectWhere('assuntos', ['idAutor' => $_SESSION['id']]);
    return view('site/main', compact('assuntos')); 

    return view('site/main');
}



     public function logout(){
        session_start();
        session_unset();
        session_destroy();
        header('Location: /');
        exit;
    }

    public function store() {
        session_start();

    if (!isset($_SESSION['id'])) {
        header('Location: /main');
        exit;
    }
        $parametros = [
            'titulo' => $_POST['titulo'],
            'idAutor' => $_SESSION['id'],
        ];
        
        App::get('database')->insert('assuntos', $parametros);
        header('Location: /main');
        exit;
    }

    public function salvarTempo() {
    session_start();

    if (!isset($_SESSION['id'])) {
        http_response_code(401);
        echo "Não autorizado";
        return;
    }

    $id = $_POST['id'] ?? null;
    $tempo = $_POST['tempo'] ?? null;

    if (!$id || !$tempo) {
        http_response_code(400);
        echo "Dados incompletos";
        return;
    }
    \App\Core\App::get('database')->update('assuntos', $id, ['tempo' => $tempo]);

    echo "Tempo salvo com sucesso";
}

public function salvarTempoSemanal() {
    session_start();

    if (!isset($_SESSION['id'])) {
        http_response_code(401);
        echo "Não autorizado";
        return;
    }

    $idUsuario = $_SESSION['id'];
    $tempo = $_POST['tempo'] ?? null;

    if (!$tempo) {
        http_response_code(400);
        echo "Tempo não recebido";
        return;
    }

    \App\Core\App::get('database')->update('usuarios', $idUsuario, [
        'tempoSemana' => $tempo
    ]);

    echo "Tempo semanal salvo com sucesso";
}

  public function edit(){
        $id = $_POST['id'];
        $post = App::get('database')->selectOne('usuarios', $id);
        $parameters = [
            'nome' => $_POST['nome'],
            'email'=> $_POST['email'],
            'senha' => $_POST['senha'],
        ];
        $id = $_POST['id'];
        App::get('database')->update('usuarios', $id, $parameters);
        header('Location: /main');

    }



    
}