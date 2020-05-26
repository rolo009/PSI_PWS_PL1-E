<?php


class Tabuleiro
{
    private $dado;
    public $resultadoDado1;
    public $resultadoDado2;
    private $numerosBloqueioP1;
    private $numerosBloqueioP2;

    public function __construct(){
        $this->numerosBloqueioP1 = new NumerosBloqueio();
        $this->numerosBloqueioP2 = new NumerosBloqueio();

        $this->dado = new Dado();

    }

    public function rolarDados(){

        $this->resultadoDado1 = $this->dado->rolarDado();
        $this->resultadoDado2 = $this->dado->rolarDado();

}
    public function checkFinalJogadaP1(){

}
    public function checkFinalJogadaP2(){

}
    public function getVencedor(){

}
    public function getPointsVencedor(){

}
}