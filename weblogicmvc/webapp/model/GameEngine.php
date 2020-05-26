<?php

include_once ("NumerosBloqueio.php");

class GameEngine
{

    public $tabuleiro = Tabuleiro::class;

    private $estadoJogo;

    public function iniciarJogo(){
        $this -> estadoJogo = 1;
        $numerosBloqueio = new numerosBloqueio();
        $numerosBloqueio->iniciar();
    }

    public function getEstadoJogo(){
        return $this -> estadoJogo;
    }
    public function updateEstadoJogo(){
        $this -> estadoJogo += 1;
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