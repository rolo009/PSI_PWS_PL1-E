<?php


class Tabuleiro
{
    private $dado = Dado::class;
    private $resultadoDado1;
    private $resultadoDado2;
    private $numerosBloqueioP1 = NumerosBloqueio::class;
    private $numerosBloqueioP2 = NumerosBloqueio::class;

    public function rolarDados(){
        $resultadoDado1 = rolarDado();
        $resultadoDado2 = rolarDado();
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