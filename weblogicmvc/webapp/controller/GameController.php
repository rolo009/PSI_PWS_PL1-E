<?php
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\View;
use ArmoredCore\WebObjects\Data;


class GameController extends BaseController
{
    public function index(){

        return View::make('jogo_stb.index');
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

        $gameEngine = new gameEngine();
        $gameEngine->iniciarJogo();

        Session::set('ge', $gameEngine);

        return View::make('jogo_stb.game', ['ge' => $gameEngine]);
    }

    public function rolarDados() {

        $gameEngine = Session::get('ge');
        $gameEngine -> rolarDados();
        $gameEngine -> updateEstadoJogo();
        Session::set('ge', $gameEngine);

        return View::make('jogo_stb.game', ['ge' => $gameEngine]);
\Tracy\Debugger::barDump($gameEngine, "gameEngine rolar Dados");
    }

    public function selecionaNumeroP1($number){
            $gameEngine = Session::get('ge');
            //$gameEngine = new GameEngine();


            \Tracy\Debugger::barDump($number, 'Numero escolhido');
            $somaDados = $gameEngine->tabuleiro->resultadoDado1 + $gameEngine->tabuleiro->resultadoDado2;


            $seletor = $gameEngine->tabuleiro->numerosBloqueioP1->seletorNumeros;


            if($seletor->validateNumber($number, $gameEngine->tabuleiro->numerosBloqueioP1)){

                \Tracy\Debugger::barDump($number, 'Numero Validado');
                $seletor->updateSelection($number);
                \Tracy\Debugger::barDump($seletor->getNumerosSelecionados(),'Numeros escolhidos');

                if($seletor->checkSelectionTotal($somaDados)){


                    //Bloquear Numeros definitivamente porque a soma dos numeros corresponde a soma dos dados

                    $gameEngine->tabuleiro->numerosBloqueioP1->bloquearNumeros($seletor->getNumerosSelecionados(), $somaDados);

                    $seletor->clearSelection();

                    //Só para EXPERIMENTAR!
                    $gameEngine->goToEstadoRolarDadosP1();
                }

            }else{
                //$gameEngine->updateEstadoJogo();
            }

        Session::set('ge', $gameEngine);

        return View::make('jogo_stb.game', ['ge' => $gameEngine]);
    }

    public function fimJogoP1() {

        $gameEngine = Session::get('ge');

        $gameEngine -> updateEstadoJogo();
        Session::set('ge', $gameEngine);

        $gameEngine->tabuleiro->checkFinalJogadaP1($gameEngine->tabuleiro->numerosBloqueioP1->getNumerosBloqueio());

        return View::make('jogo_stb.game', ['ge' => $gameEngine]);
\Tracy\Debugger::barDump($gameEngine);
    }

    public function selecionaNumeroP2($number){

        $gameEngine = Session::get("ge");
        //$gameEngine = new GameEngine();


        \Tracy\Debugger::barDump($number, 'Numero escolhido');
        $somaDados = $gameEngine->tabuleiro->resultadoDado1 + $gameEngine->tabuleiro->resultadoDado2;


        $seletor = $gameEngine->tabuleiro->numerosBloqueioP1->seletorNumeros;


        if($seletor->validateNumber($number, $gameEngine->tabuleiro->numerosBloqueioP2)){

            \Tracy\Debugger::barDump($number, 'Numero Validado');
            $seletor->updateSelection($number);
            \Tracy\Debugger::barDump($seletor->getNumerosSelecionados(),'Numeros escolhidos');

            if($seletor->checkSelectionTotal($somaDados)){


                //Bloquear Numeros definitivamente porque a soma dos numeros corresponde a soma dos dados

                $gameEngine->tabuleiro->numerosBloqueioP2->bloquearNumeros($seletor->getNumerosSelecionados(), $somaDados);

                $seletor->clearSelection();

                //Só para EXPERIMENTAR!
                $gameEngine->goToEstadoRolarDadosP2();
            }

        }else{
            //$gameEngine->updateEstadoJogo();
        }

        Session::set('ge', $gameEngine);

        return View::make('jogo_stb.game', ['ge' => $gameEngine]);
    }

    public function fimJogoP2() {

        $gameEngine = Session::get('ge');

        $gameEngine -> updateEstadoJogo();
        Session::set('ge', $gameEngine);

        return View::make('jogo_stb.game', ['ge' => $gameEngine]);

    }
}