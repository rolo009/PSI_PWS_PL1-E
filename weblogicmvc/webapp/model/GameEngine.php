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

    public function getEstadoJogo($estadoJogo){
        return $estadoJogo;
    }
    public function updateEstadoJogo($estadoJogo){
        $estadoJogo++;
    }

    public function rolarDados(){
        $tabuleiro = new Tabuleiro();
        $tabuleiro -> rolarDados();
    }

    public function bloquearNumero($numerosBloqueio, $nJogador){
        $tabuleiro = new Tabuleiro();
        if ($nJogador == 1){
            $tabuleiro -> checkFinalJogadaP1();
        }
        else if ($nJogador == 2){
            $tabuleiro -> checkFinalJogadaP2();
        }
        else {
            echo "Jogador não encontrado!";
        }
    }

}