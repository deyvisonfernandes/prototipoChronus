<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class paginaInicialController
{

    public function index()
    {
    return view('site/PaginaInicial');
    }

    public function cadastro(){
        $parametros = [
            'nome' => $_POST['nome'],
            'email' => $_POST['email'],
            'senha' => $_POST['senha'],
        ];
        App::get('database')->insert('usuarios', $parametros);

        header('Location: /');
        exit;

    }

    public function verificacao()
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            header('Location: /main');
        }
        return view('site/PaginaInicial');
    }

    public function login(){
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $user = App::get('database')->verificaLogin($email, $senha);

        if($user != false){
            session_start();
            $_SESSION['id'] = $user->id;
            header('Location: /main');
        }

        else{
            session_start();
            $_SESSION['mensagem-erro'] = "Usuário e/ou Senha incorretos!";
            header('Location: /');

        }

    }


    
}