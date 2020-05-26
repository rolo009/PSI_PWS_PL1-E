<?php


class Tabuleiro
{
    private $dado = Dado::class;
    private $resultadoDado1;
    private $resultadoDado2;
    private $numerosBloqueioP1 = NumerosBloqueio::class;
    private $numerosBloqueioP2 = NumerosBloqueio::class;

    public function rolarDados(){
        $dado = new Dado();
        $resultadoDado1 = $dado->rolarDado();
        $resultadoDado2 = $dado->rolarDado();

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