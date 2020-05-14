<?php
include_once ("NumerosBloqueio.php");

class GameEngine
{

    public $tabuleiro = Tabuleiro::class;
    
    private $estadoJogo;

    public function iniciarJogo(){
        $estadoJogo = 1;
        $numerosBloqueio = new numerosBloqueio();
        $numerosBloqueio = $numerosBloqueio->iniciar();
    }

    public function getEstadoJogo(){

    }
    public function updateEstadoJogo(){
        $estadoJogo++;
    }

}