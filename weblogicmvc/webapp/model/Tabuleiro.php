<?php


class Tabuleiro
{
    private $dado;
    public $resultadoDado1;
    public $resultadoDado2;
    public $numerosBloqueioP1;

    public $numerosBloqueioP2;

    public function __construct(){
        $this->numerosBloqueioP1 = new NumerosBloqueio();
        \Tracy\Debugger::barDump($this->numerosBloqueioP1, 'no construtor');
        $this->numerosBloqueioP2 = new NumerosBloqueio();

        $this->dado = new Dado();

    }

    public function rolarDados(){

        $this->resultadoDado1 = $this->dado->rolarDado();
        $this->resultadoDado2 = $this->dado->rolarDado();

}
    public function checkFinalJogadaP1($nb){

        $total = 0;
        for($i = 1; $i <= 9; $i ++){
            if($nb[$i] == false){
                $total += $i;
            }
        }
        return $total;
}
    public function checkFinalJogadaP2($nb){
        $total = 0;
        for($i = 1; $i <= 9; $i ++){
            if($nb[$i] == false){
                $total += $i;
            }
        }
        return $total;
}
    public function getVencedor(){
    $totalP1 = $this -> checkFinalJogadaP1();
    $totalP2 = $this -> checkFinalJogadaP2();

    if($totalP1 > $totalP2){
        return $winner = "Jogador 2";
    }
    else if ($totalP1 < $totalP2){
        return $winner = "Jogador 1";
    }
    else if ($totalP1 == $totalP2){
        $winner = "Empate";
    }
}
    public function getPointsVencedor(){

}
}