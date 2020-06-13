<?php



class GameEngine
{

    public $tabuleiro;


    private $estadoJogo;

    public function __construct(){
        $this->tabuleiro = new Tabuleiro();
}

    public function iniciarJogo(){
        $this -> estadoJogo = 1;
        $this->tabuleiro->numerosBloqueioP1->iniciar();
        $this->tabuleiro->numerosBloqueioP2->iniciar();

    }

    public function getEstadoJogo(){
        return $this -> estadoJogo;
    }

    public function updateEstadoJogo(){
        $this -> estadoJogo += 1;


    }

    public function goToEstadoRolarDados(){
        $this -> estadoJogo = 1;
    }

    public function rolarDados(){

        $this->tabuleiro -> rolarDados();
    }

    public function bloquearNumero($numerosBloqueio, $nJogador){
        

        if ($nJogador == 1){
            $this->tabuleiro -> checkFinalJogadaP1();
        }
        else if ($nJogador == 2){
            $this->tabuleiro -> checkFinalJogadaP2();
        }
        else {
            echo "Jogador não encontrado!";
        }
    }

}