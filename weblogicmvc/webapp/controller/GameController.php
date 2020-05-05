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
}