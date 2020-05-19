<?php
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\View;

class GameController extends BaseController
{
    public function index(){

        return View::make('jogo_stb.index');
    }

    public function game(){

        return View::make('jogo_stb.game');
    }

    public function register(){

        return View::make('jogo_stb.register');
    }

    public function login(){

        return View::make('jogo_stb.login');
    }

    public function instructions(){

        return View::make('jogo_stb.instructions');
    }
    public function private_area(){

        return View::make('jogo_stb.private_area');
    }

    public function update_register(){

        return View::make('jogo_stb.update_register');
    }

    public function topTen(){

        return View::make('jogo_stb.top10');
    }

    public function admin(){

        return View::make('jogo_stb.admin_users');
    }

    public function iniciarJogo() {
        session_start();

        $gameEngine = new gameEngine();
        $gameEngine = $gameEngine->iniciarJogo();

        $_SESSION['IniciarJogo'] = $gameEngine;
    }

    public function rolarDados() {

        $gameEngine = new gameEngine();
        $gameEngine = $gameEngine->rolarDados();

    }
}